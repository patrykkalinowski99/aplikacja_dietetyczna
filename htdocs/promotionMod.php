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
$funkcje->promotionMod($_GET['id']);
header('Location: adminpanel.php#admin-panel-user-list');
?>