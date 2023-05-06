<?php
require_once("./public/php/Funkcje.php");

$funkcje = new Funkcje();

if(!$funkcje->isLoggedIn())//Jeśli zalogowany, to zostan, jesli nie to odeslij do logowania
{
	header('Location: login.php');
}

$account = $funkcje->getAccountDetailsById($funkcje->getLoggedAccountId());
if(!$funkcje->isAdmin($_SESSION['user_id']))//Jeśli nie admin to wyrzuć do strony głównej
{
    header('Location: index.php');
}


$funkcje->deleteFitatuProduct($_GET['id']);

header('Location: addToFitatu.php');
?>