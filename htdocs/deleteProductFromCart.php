<?php
require_once("./public/php/Funkcje.php");
$funkcje = new Funkcje();
if(!$funkcje->isLoggedIn())//Jeśli zalogowany, to zostan, jesli nie to odeslij do logowania
{
	header('Location: login.php');
}
$account = $funkcje->getAccountDetailsById($funkcje->getLoggedAccountId());
if($account['role_id'] == 1){
    header('Location: index.php');
}
$funkcje->deleteProductFromCart($_GET['user_id'], $_GET['product_id']);

header('Location: /shoppingcart.php');
?>