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
        <title>Konto</title>
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
        <script>
            $(document).ready(function () {
                $('#my_products').DataTable(
                    {
                        "language": {
                            "lengthMenu": "Wyświetl: _MENU_ użytkowników na stronę",
                            "zeroRecords": "Brak wyników",
                            "info": "Wyświetlono: _PAGE_ z _PAGES_",
                            "infoEmpty": "Brak odpowiadających wyników",
                            "infoFiltered": "(filtered from _MAX_ total records)",
                            "search": "Wyszukaj:",
                            "previous": "Następny",
                            "Next": "Następny"
                        }
                    }
                );
            });
        </script>
    </head>
    <body>
        <?php 
        include('public/partials/header.php');
        ?>
        <div class="product-info text-center">  
            <div class="info-column">
                <h2 class="fade-in-text">Moje konto</h2>
                <a href="#ebook-table" class="btn btn-dark btn-rounded button-purple-lighter btn-sm mb-2">Moje zamówienia</a><br>
                <?php
                    $userRoleId = $funkcje->getUserRole($_SESSION['user_id']);
                    $userRole = $funkcje->getRoleById($userRoleId[0]);
                    $fullName = $funkcje->getAccountFullNameById($_SESSION['user_id']);
                    // echo "imię: " .$fullName[0] . "<br>nazwisko: " . $fullName[1] . "<br>";
                    // echo " rola: ".$userRole[0]."<br>";

                    // if($userRole[0] == 2){echo " rola: moderator<br>";};
                    // if($userRole[0] == 3){echo " rola: administrator<br>";};
                    $user_email = $funkcje->getAccountEmailById($_SESSION['user_id']);
                    // echo  "email: ".$user_email[0] ."<br>";
                    // if($account['wiek'] == 0)
                    // {
                    //     echo "wiek: <a href='accountedit.php' class='btn btn-dark btn-rounded button-purple-lighter mt-1'>uzupełnij wiek</a><br>";
                    // }else {
                    // echo "wiek: ".$account['wiek']." lat<br>";
                    // }
                    // if($account['waga'] == 0)
                    // {
                    //     echo "waga: <a href='accountedit.php' class='btn btn-dark btn-rounded button-purple-lighter mt-1''>uzupełnij wagę</a><br>";
                    // }else {
                    // echo "waga: ".$account['waga']." kg<br>";
                    // }
                    // if($account['wzrost'] == 0)
                    // {
                    //     echo "wzrost: <a href='accountedit.php' class='btn btn-dark btn-rounded button-purple-lighter mt-1''>uzupełnij wzrost</a><br>";
                    // }else {
                    // echo "wzrost: ".$account['wzrost']." cm<br>";
                    // }
                    // if($account['zapotrzebowanie'] == 0)
                    // {
                    //     echo "wyliczone zapotrzebowanie: <a href='index.php#content-calculator' class='btn btn-dark btn-rounded button-purple-lighter mt-1 btn-sm'>wylicz</a>";
                    // }else {
                    // echo "wyliczone zapotrzebowanie: ".$account['zapotrzebowanie']." cm<br>";
                    // }
                ?>
                <table id="ebook-table" class="table2 table-striped bg-light text-center">
                <tbody>
                    <tr>
                        <!-- <td data-label="Imię">Imię:</td> -->
                        <td data-label="Imię i nazwisko"><?php echo $fullName[0] . " " . $fullName[1]; ?></td>
                    </tr>
                    <tr>
                        <td data-label="Rola">
                            <?php 
                            if($userRoleId[0] == 1){echo "zwykły";};
                            if($userRoleId[0] == 2){echo "moderator Ebooków";};
                            if($userRoleId[0] == 3){echo "administrator";};
                            if($userRoleId[0] == 4){echo "moderator planów treningowych";};
                            if($userRoleId[0] == 5){echo "moderator";};
                        ?>
                        </td>
                    </tr>
                    <tr>
                        <!-- <td data-label="Email">Email:</td> -->
                        <td data-label="Email">
                        <?php 
                            echo  $user_email[0]; 
                        ?></td>
                    </tr>
                    <tr>
                        <!-- <td data-label="Wiek">Wiek:</td> -->
                        <td data-label="Wiek"><?php 
                            if($account['wiek'] == 0)
                            {
                                echo "wiek: <a href='accountedit.php' class='btn btn-dark btn-rounded button-purple-lighter mt-1 btn-sm'>uzupełnij wiek</a><br>";
                            }else {
                            echo $account['wiek']." lata";
                        }
                        ?></td>
                    </tr>
                    <tr>
                        <!-- <td data-label="Waga">Waga:</td> -->
                        <td data-label="Waga"><?php 
                            if($account['waga'] == 0)
                            {
                                echo "waga: <a href='accountedit.php' class='btn btn-dark btn-rounded button-purple-lighter mt-1 btn-sm'>uzupełnij wagę</a><br>";
                            }else {
                            echo $account['waga']." kg";
                            }
                        ?></td>
                    </tr>
                    <tr>
                        <!-- <td data-label="Wzrost">Wzrost:</td> -->
                        <td data-label="Wzrost"><?php
                            if($account['wzrost'] == 0)
                            {
                                echo "wzrost: <a href='accountedit.php' class='btn btn-dark btn-rounded button-purple-lighter mt-1 btn-sm'>uzupełnij wzrost</a><br>";
                            }else {
                            echo $account['wzrost']." cm";
                            }
                        ?></td>
                    </tr>
                    <tr>
                        <!-- <td data-label="Zapotrzebowanie">Zapotrzebowanie:</td> -->
                        <td data-label="Zapotrzebowanie">
                            <?php
                                if($account['zapotrzebowanie'] == 0)
                                {
                                    echo "<a href='index.php#content-calculator' class='btn btn-dark btn-rounded button-purple-lighter mt-1 btn-sm'>wylicz</a>";
                                }else {
                                echo $account['zapotrzebowanie'];
                                }
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
        
        <div>
        <h2 class="fade-in-text text-center">Moje zamówienia</h2>
        <table id="my_products" class="table table-striped bg-light text-center">
            <thead>
                <tr>
                    <th>Tytuł</th>
                    <th>Opis</th>
                    <th>Cena</th>
                    <th>Ilość</th>
                    <th>Zdjęcie</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $products = $funkcje->getMyBoughtProducts();
                    
                    foreach($products as $product){
                        // $products_values = $funkcje->getBoughtProductInfo($product);
                        $product_id = $product['product_id'];
                        $product_title = $funkcje->getProductTitle($product_id);
                        $product_owner_id = $product['user_id'];
                        $product_description = $funkcje->getProductDescription($product_id);
                        $product_price = $funkcje->getProductPrice($product_id);
                        $product_quantity = $funkcje->getProductQuantityFromBoughtProducts($product['user_id'], $product_id);
                        $product_image = $funkcje->getProductImage($product_id);
                        // $product_owner_login = $funkcje->getUserLogin($product_owner_id); echo $product_owner_login[0];
                ?> 
                <tr><?php if($product_owner_id == $account[0]) {?>
                    <td data-label="Tytuł"><?php   echo $product_title[0]; ?></td>
                    <td data-label="Opis"><?php echo $product_description[0]; ?></td>
                    <td data-label="Cena"><?php echo $product_price[0] . "zł"; ?></td>
                    <td data-label="Ilość"><?php echo $product_quantity[0] . "szt."; ?></td>
                    <td data-label="Zdjęcie"><?php echo "<img src='public/upload_products_images/".$product_image['photo_title']."' alt='".$product_image['photo_title']."' width='100' height='100'>";  ?></td>
                </tr>
                <?php }} ?>
            </tbody>
        </table>
        </div>
    </body>
</html>