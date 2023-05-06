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
        <div class="text-center">  
            <h2 class="fade-in-text">Pełna lista dostępnych ebooków</h2>
        </div>
        <div>
            <div class="content-training-plans">
                <?php 
                    $ebooks = $funkcje->getEbooks();
                    foreach($ebooks as $ebook){
                ?> 
                <div class="" style="padding-right: 10px; padding-left: 10px;">
                <h3>
                    <?php 
                        echo '<a href="/productInfo.php?product_id='. $ebook['id']. '" style="text-decoration: none; color: #B284FE;">'.$ebook['title']  .'</a>'; 
                    ?></h3>
                    <?php echo "<img src='public/upload_products_images/".$ebook['photo_title']."' alt='".$ebook['photo_title']."' width='100' height='100'>";  ?>
                    <br>
                    <?php 
                    $origin = $funkcje->getProductOrigin($ebook['origin_number']);
                    if($ebook['origin_number'] != 0) {echo "Pochodzenie: ". $origin[0]; }?>
                    <br>
                    <?php $category = $funkcje->getProductCategory($ebook['category_number']); 
                    if($ebook['category_number'] != 0) {echo "Kategoria: ".$category[0]; }?>
                    <br>
                    <?php echo $ebook['description']; ?>
                    <hr class="hr-custom">
                    <?php echo "Cena: ".$ebook['price'] . " zł"; ?><br>
                    <?php
                        if($funkcje->isLoggedIn()){
                            echo "<a href='buyproduct.php/?user_id=".$account['id']."&product_id=".$ebook['id']."' class='btn btn-dark btn-rounded button-purple-lighter'>Kup teraz</a>";
                        }
                    ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </body>
</html>