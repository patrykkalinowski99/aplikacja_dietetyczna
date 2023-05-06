<?php
require_once("./public/php/Funkcje.php");
$funkcje = new Funkcje();
if(!$funkcje->isLoggedIn())//Jeśli zalogowany, to zostan, jesli nie to odeslij do logowania
{
	header('Location: login.php');
}
$user = $funkcje->getAccountDetailsById($_GET["user_id"]);
$userEmail = $user['email'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\PHPException;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if(isset($_GET["user_id"])){
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'supp.dietetyk@gmail.com';
    $mail->Password = 'vdhdwoiqlhvsjcds'; //gmail haslo do aplikacji
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('supp.dietetyk@gmail.com');

    $mail->AddAddress($userEmail);

    $mail->isHTML(true);

    $mail->Subject = 'Dziękujemy za zakup w naszym sklepie';
    $mail->Body = 'opis';

    $mail->send();
    echo "wyslano na ".$userEmail;
}
?>
<form>
 <input type="button" value="Wróć!" onclick="history.back()">
</form>