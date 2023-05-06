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

$id = isset($_GET['id']) ? $_GET['id'] : header('Location: adminpanel.php#admin-panel-user-list');
$funkcje->deleteUser($_GET['id']);

header('Location: adminpanel.php#admin-panel-user-list');
?>