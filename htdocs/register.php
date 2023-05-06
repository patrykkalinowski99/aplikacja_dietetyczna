<?php
    require_once("public/php/Funkcje.php");
    $funkcje = new Funkcje();
    if($funkcje->isLoggedIn())//Jeśli zalogowany, to wyślij do index.php
    {
        header('Location: index.php');
    }

    if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']))//Jeśli wyslal formularz to wstaw do bazy danych i przekieruj do logowania
    {
        $result = $funkcje->register($_POST['username'], $_POST['password'], $_POST['email'], $_POST['imie'], $_POST['nazwisko']);//Jesli true to znaczy, ze zarejestrowalo(sprawdz return w metodzie register w Funkcje.php)
        if($result)
        {
            header('Location: login.php');
        }
    }
 ?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Rejestracja</title>
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
        <div class="login-register-page">  
            <h1 class="fade-in-text">Rejestracja</h1>
            <form method="POST">
                <div class="text_field mt-2 mb-2 fade-in-text">
                <label for="username">Login</label><br>
                <input type="text" id="username" name="username" required>
                </div>
                <div class="text_field mt-2 mb-2 fade-in-text">
                <label for="password">Hasło</label><br>
                <input type="password" id="password" name="password" required>
                </div>
                <div class="text_field mt-2 mb-2 fade-in-text">
                    <label for="email">Email</label><br>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="text_field mt-2 mb-2 fade-in-text">
                    <label for="imie">Imię</label><br>
                    <input type="imie" id="imie" name="imie">
                </div>
                <div class="text_field mt-2 mb-2 fade-in-text">
                    <label for="nazwisko">Nazwisko</label><br>
                    <input type="nazwisko" id="nazwisko" name="nazwisko">
                </div>
                <?php 
                $funkcje->printErrorsAndUnset();
                ?>
                <input type="submit" class="btn btn-primary btn-rounded mt-3 btn-lg fade-in-text button-purple" value="Zarejestruj się" name='register'>
                <div class="signup_link">
                </div>
                <div class="signup_link">
                <a href="/login.php" class="btn btn-dark btn-rounded mt-3 fade-in-text button-purple-lighter">Posiadasz konto?</a>
                </div>
            </form>
        </div>
    </body>
</html>