<?php
 require_once("public/php/Funkcje.php");
 $funkcje = new Funkcje();
 if(!$funkcje->isLoggedIn())//Jeśli zalogowany, to zostan, jesli nie to odeslij do logowania
 {
     header('Location: login.php');
 }
//  if(isset($_POST['user_id']) && isset($_POST['product_id']))//Jeśli wyslal formularz to wstaw do bazy danych i przekieruj do logowania
//  {
    
    $checkIfExist = $funkcje->getProductsFromShoppingCart($_GET['user_id'], $_GET['product_id']);
    // var_dump($checkIfExist);
    if(!empty($checkIfExist)){
        echo "Ten produkt został już dodany do koszyka, jeśli chcesz go dodać ponownie, możesz to zrobić w koszyku";
    }
    else{
        echo "dodano do koszyka";
        $funkcje->buyProduct($_GET['user_id'], $_GET['product_id']);
    }
//  }
?>
<h2 class="fade-in-text">Dodano do koszyka</h2>
<a href="javascript:history.back()">Wróć do strony głównej</a>
