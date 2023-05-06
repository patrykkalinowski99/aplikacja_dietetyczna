<?php
    require_once("public/php/Funkcje.php");
    $funkcje = new Funkcje();
    if(!$funkcje->isLoggedIn())//Jeśli zalogowany, to zostan, jesli nie to odeslij do logowania
    {
        header('Location: login.php');
    }
    
    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['imie']) && isset($_POST['nazwisko']))//Jeśli wyslal formularz to wstaw do bazy danych i przekieruj do logowania
    {
        $funkcje->changeAccountData($funkcje->getLoggedAccountId(), $_POST['username'], $_POST['email'], $_POST['password'], $_POST['imie'], $_POST['nazwisko']);
    }
    
    $account = $funkcje->getAccountDetailsById($funkcje->getLoggedAccountId());
 ?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Koszyk</title>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="public/styles/reset.css">
        <link rel="stylesheet" href="public/styles/globals.css">
        <link rel="stylesheet" href="public/styles/globals-low-resolution.css">
        <link rel="icon" href="public/img/dumbbell-purple.png">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">   
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php 
        include('public/partials/header.php');
        ?>
        <div>
        <h2 class="fade-in-text text-center mt-4">Moj koszyk</h2>
        <table id="my_products" class="table table-striped text-center">
            <thead>
                <tr>
                    <th>Zdjęcie</th>
                    <th>Tytuł</th>
                    <th>Ilość</th>
                    <th>Cena</th>
                    <th>Usuń</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $productsId = $funkcje->getProductFromUserCart($account['id']);
                    
                    $price = 0;
                    foreach($productsId as $id){
                        $product_name = $funkcje->getProductTitle($id['product_id']);
                        $product_price = $funkcje->getProductPrice($id['product_id']);
                        $product_quantity = $funkcje->getProductQuantityFromUserCart($account['id'], $id['product_id']);
                        $product_image = $funkcje->getProductImage($id['product_id']);
                        $price = $price + $product_quantity[0]*$product_price[0];
                ?> 
                        <tr>
                            <td data-label="Zdjęcie"><?php echo "<img src='public/upload_products_images/".$product_image[0]."' alt='".$product_image[0]."' width='100' height='100'>";  ?></td>
                            <td data-label="Tytuł"><?php echo $product_name[0]; ?></td>
                            <td data-label="Ilość">
                                <?php
                                    if($product_quantity[0] > 1){
                                    echo "  <a href='/minusQuantity.php/?id=" . $account['id'] . "&product_id=".$id['product_id']."' class='btn btn-outline-info btn-sm'>-</a>  ";
                                    }
                                    echo $product_quantity[0];
                                    echo "  <a href='/plusQuantity.php/?id=" . $account['id'] . "&product_id=".$id['product_id']."' class='btn btn-outline-info btn-sm'>+</a>";
                                ?>
                            </td>
                            <td data-label="Cena"><?php echo $product_price[0]; ?></td>
                            <td data-label="Usuń"><?php
                                echo "<a href='/deleteProductFromCart.php/?user_id=".$account['id']."&product_id=".$id['product_id']."' class='btn btn-danger btn-sm'>Usuń z koszyka</a>";
                            ?></td>
                            </td>
                        </tr>
                <?php }?>
                <tr class="text-left">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?php if($price != 0) { ?>suma: <?php echo $price; ?> zł<?php } ?></td>
                    <td><?php if($price != 0) {
                            echo " <a href='/finalizeCart.php/?user_id=".$account['id']."' class='btn btn-success'>OPŁAĆ</a>";
                            echo " <a href='/deleteCart.php/?user_id=".$account['id']."' class='btn btn-danger'>WYCZYŚĆ KOSZYK</a>";
                        }?>
                    </td>
                </tr>
               
            </tbody>
        </table>
        </div>
    </body>
</html>