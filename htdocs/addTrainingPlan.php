<?php
    require_once("public/php/Funkcje.php");
    $funkcje = new Funkcje();
    if(!$funkcje->isLoggedIn())//Jeśli zalogowany, to zostan, jesli nie to odeslij do logowania
    {
        header('Location: login.php');
    }

    // if(!$funkcje->isAdmin($_SESSION['user_id']))//Jeśli nie admin to wyrzuć do strony głównej
    // {
    //     header('Location: index.php');
    // }
    $account = $funkcje->getAccountDetailsById($funkcje->getLoggedAccountId());
    if(($account['role_id'] == 1) || ($account['role_id'] == 2)){ //wyrzuć gdy nie masz uprawnień
        header('Location: index.php');
    }
    
    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['imie']) && isset($_POST['nazwisko']))//Jeśli wyslal formularz to wstaw do bazy danych i przekieruj do logowania
    {
        $funkcje->changeAccountData($funkcje->getLoggedAccountId(), $_POST['username'], $_POST['email'], $_POST['password'], $_POST['imie'], $_POST['nazwisko']);
    }
    
    if(isset($_POST['title']) && isset($_POST['price']) && isset($_POST['description']))//Jeśli wyslal formularz to wstaw do bazy danych i przekieruj do logowania
    {
        //$name = $_POST['image']; //nazwa pliku zapisywanego
        $image_number = $funkcje->getNumberOfProducts() + 1;
        $image_name = $_FILES['image']['name'];
        $whatIWant = substr($image_name, strpos($image_name, ".") + 1);
        $tmp_name = $_FILES['image']['tmp_name'];
        $folder = "public/upload_products_images/";
        move_uploaded_file($tmp_name, $folder . $image_number .".". $whatIWant);
        $result = $funkcje->addProduct($_POST['title'], $_POST['description'], $_POST['price'], $image_number .".". $whatIWant, 'plan', $_POST['product_origin'], $_POST['product_category']);//Jesli true to znaczy, ze zarejestrowalo(sprawdz return w metodzie register w Funkcje.php)
        if($result)
        {
            header('Location: addproduct.php');
        }
    }

 ?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Dodaj ebooka</title>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="public/styles/reset.css">
        <link rel="stylesheet" href="public/styles/globals.css">
        <link rel="stylesheet" href="public/styles/globals-low-resolution.css">
        <link rel="icon" href="public/image/dumbbell-purple.png">
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
        <div class="login-register-page">  
            <h2 class="fade-in-text">Dodawanie planu treningowego</h2>
            <form method="POST" enctype="multipart/form-data">
                <div class="text_field">
                    <label for="title">Tytuł</label><br>
                    <input type="text" id="title" name="title" value="" required>
                    <span></span>
                </div>
                <div class="text_field pt-3">
                    <label for="description">Opis</label><br>
                    <textarea rows="5" cols="33" class="mt-2" name="description" required></textarea>
                    <span></span>
                </div>
                <div class="text_field">
                    <label for="price">Cena</label><br>
                    <input type="number" id="price" name="price" value="" required>
                    <span></span>
                </div>
                <div class="text_field mt-3">
                    <label for="image">Wybierz zdjęcie:</label><br>
                    <input type="file" id="image" name="image" accept="image/png, image/gif, image/jpeg">
                </div>
                <!-- <div class="text_field mt-1">
                    <label for="text">Typ produktu</label><br>
                    <select name="product_type"> 
                        <option value="ebook">Ebook</option>
                        <option value="plan">Plan treningowy</option>
                    </select>
                    <span></span>
                </div> -->
                <div class="text_field mt-1">
                    <label for="text">Pochodzenie</label><br>
                    <select name="product_origin"> 
                        <?php 
                            $origins = $funkcje->getOrigins();
                            foreach($origins as $origin){
                                echo "<option value='". $origin['origin_number'] ."'>". $origin['origin_name'] ."</option>";
                            }

                        ?>
                    </select>
                    <span></span>
                </div>
                <!-- <input type="submit">dodaj</input> -->
                <input type="submit" value="Dodaj" name='updater' class="btn btn-success btn-rounded mt-3 btn-lg fade-in-text">
            </form>



        </div>
    </body>
</html>