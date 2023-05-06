<?php
require_once("public/php/Funkcje.php");

$funkcje = new Funkcje();

$funkcje->logout();
header('Location: index.php');
?>