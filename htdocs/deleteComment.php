<?php
require_once("./public/php/Funkcje.php");

$funkcje = new Funkcje();

if(!$funkcje->isLoggedIn())//Jeśli zalogowany, to zostan, jesli nie to odeslij do logowania
{
	header('Location: login.php');
}

if(!$funkcje->isAdmin($funkcje->getLoggedAccountId()))//jesli nie admin to wyrzuc do konta
{
	header('Location: account.php');
}

$id = isset($_GET['comment_id']) ? $_GET['comment_id'] : header('Location: localhost/productInfo.php?product_id='.$_GET['comment_id']);
$funkcje->deleteComment($_GET['comment_id']);

header('Location: /productInfo.php?product_id='.$_GET['product_id']);
?>