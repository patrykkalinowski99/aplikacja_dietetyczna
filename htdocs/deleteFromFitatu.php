<?php
require_once("./public/php/Funkcje.php");

$funkcje = new Funkcje();

if(!$funkcje->isLoggedIn())//Jeśli zalogowany, to zostan, jesli nie to odeslij do logowania
{
	header('Location: login.php');
}

$account = $funkcje->getAccountDetailsById($funkcje->getLoggedAccountId());

$today = date('Y-m-d');
$funkcje->deleteFromFitatu($_GET['id'], $_GET['user_id'], $today);
echo "usuń produkt nr ".$_GET['id']." dla uzytkownika o id = ".$_GET['user_id'] . "dnia " . $today;
header('Location: fitatu.php');

?>