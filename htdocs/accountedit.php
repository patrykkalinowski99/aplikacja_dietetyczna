<?php
    require_once("public/php/Funkcje.php");
    $funkcje = new Funkcje();
    if(!$funkcje->isLoggedIn())//Jeśli zalogowany, to zostan, jesli nie to odeslij do logowania
    {
        header('Location: login.php');
    }
    
    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['imie']) && isset($_POST['nazwisko']))//Jeśli wyslal formularz to wstaw do bazy danych i przekieruj do logowania
    {
        $funkcje->changeAccountData($funkcje->getLoggedAccountId(), $_POST['username'], $_POST['email'], $_POST['imie'], $_POST['nazwisko'] , $_POST['wiek'], $_POST['wzrost'], $_POST['waga'], $_POST['password']);
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
        
    </head>
    <body>
        <?php 
        include('public/partials/header.php');
        ?>
        <div class="login-register-page">  
            <h2 class="fade-in-text">Edycja danych użytkownika</h2>
            <form method="POST">
                <div class="text_field">
                    <label for="username">Nowy login</label><br>
                    <input type="text" id="username" name="username" value="<?= $account['login'] ?>" required>
                    <span></span>
                </div>
                <div class="text_field">
                    <label for="imie">Imię</label><br>
                    <input type="text" id="imie" name="imie" value="<?= $account['imie'] ?>" required>
                    <span></span>
                </div>
                <div class="text_field">
                    <label for="nazwisko">Nazwisko</label><br>
                    <input type="text" id="nazwisko" name="nazwisko" value="<?= $account['nazwisko'] ?>" required>
                    <span></span>
                </div>
                <div class="text_field">
                    <label for="email">Nowy email</label><br>
                    <input type="text" id="email" name="email" value="<?= $account['email'] ?>" required>
                    <span></span>
                </div>
                <div class="text_field">
                    <label for="password">Utwórz nowe hasło, ewentualnie wpisz stare</label><br>
                    <input type="password" id="password" name="password" required>
                    <span></span>
                </div>
                <div class="text_field">
                    <label for="number">Wiek</label><br>
                    <input type="number" id="wiek" name="wiek" required>
                    <span></span>
                </div>
                <div class="text_field">
                    <label for="number">Wzrost</label><br>
                    <input type="number" id="wzrost" name="wzrost" required>
                    <span></span>
                </div>
                <div class="text_field">
                    <label for="number">Waga</label><br>
                    <input type="number" id="waga" name="waga" required>
                    <span></span>
                </div>
                <input type="submit" value="Zapisz dane" name='updater' class="btn btn-primary btn-rounded mt-3 btn-lg fade-in-text button-purple">
                <?php if(!$funkcje->isAdmin($funkcje->getLoggedAccountId())):?>
                <?php else: ?>
                <div>
                <a class="nav-item nav-link text-center text-black" href="/adminpanel.php">Panel administratora</a>
                </div>
                <?php endif; ?>
            </form>



        </div>
    </body>
</html>