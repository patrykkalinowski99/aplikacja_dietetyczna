<?php
    require_once("public/php/Funkcje.php");
    $funkcje = new Funkcje();
    if(!$funkcje->isLoggedIn())//Jeśli zalogowany, to zostan, jesli nie to odeslij do logowania
    {
        header('Location: login.php');
    }
    $account = $funkcje->getAccountDetailsById($funkcje->getLoggedAccountId());
    $role_id = $funkcje->getUserRole($account['id']);
    if(isset($_POST['description']))//Jeśli wyslal formularz to wstaw do bazy danych i przekieruj do logowania
    {
        $funkcje->addComment($account[0], $_GET['product_id'], $_POST['description']);
        header("Refresh:0");
    }
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
    <body class="product-info-body">
        <?php 
        include('public/partials/header.php');
        ?>
        
        <div class="login-register-page">
            <div class="product-info">
                <?php 
                    $productTitle = $funkcje-> getProductTitle($_GET['product_id']);
                    $productDescription = $funkcje-> getProductDescription($_GET['product_id']);
                    echo "<h2 class='fade-in-text text-center'>".$productTitle[0]."</h2>";
                    $image = $funkcje->getProductImage($_GET['product_id']);
                    $category = $funkcje->getProductCategory($_GET['product_id']);
                    $origin = $funkcje->getProductOrigin($_GET['product_id']);
                    echo "<img src='public/upload_products_images/".$image['photo_title']."' alt='".$image['photo_title']."' width='300' height='300'>";  
                    // echo "Kategoria: ".$category;
                    // echo "Pochodzenia: ".$origin;
                ?>
            
                <div style="margin-right: 50px; margin-left: 50px;">
                    <?php echo "<h2 class='fade-in-text text-center'>".$productDescription[0]."</h2>";?>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="text_area pt-3">
                        <textarea class="" name="description" required></textarea>
                        <div id="buttons"><input type="submit" value="Dodaj opinię" name='updater' class="btn btn-dark btn-rounded button-purple mb-3 mt-2"></div>
                    </div>
                    <!-- <input type="submit">dodaj</input> -->
                    
                </form>
            <table id="ebook-table" class="table table-striped bg-light text-center">
                <tbody>
                    <?php 
                        $comments = $funkcje->getComments($_GET['product_id']);
                        if(empty($comments)){
                            echo "<h2 class='mt-5'>Nie ma jeszcze żadnej opinii</h2>";
                        }
                        foreach($comments as $comment){
                    ?> 
                    <tr>
                        <?php $login = $funkcje->getUserLogin($comment['user_id']); ?>
                        <td data-label="Użytkownik"><?php echo $login[0] ?></td>
                        <td data-label="Treść"><?php echo $comment['text']; ?></td>
                        <td data-label="Data"><?php echo $comment['created_at'] . " zł"; ?></td>
                        <td data-label="Usuń">
                            <?php 
                                if($role_id[0] != 1){
                                    echo "<a href='deleteComment.php?comment_id=" . $comment['id'] . "&product_id=".$comment['product_id']."' class='text-bold dropdown-item btn btn-danger'>Usuń opinię</a>";
                                }
                            ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
        </div>
    </body>
</html>