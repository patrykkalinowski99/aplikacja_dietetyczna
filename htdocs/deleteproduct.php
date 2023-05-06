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

$image_title = $funkcje->getProductImage($_GET['id']);
$path = "./public/upload_products_images/".$image_title['photo_title'];
if(!unlink($path)){
    echo "success";
} else {
    echo $image_title['photo_title'];
}

$funkcje->deleteProduct($_GET['id']);

header('Location: adminpanel.php#admin-panel-ebook-list');
?>