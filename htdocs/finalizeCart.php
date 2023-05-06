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
$user_id = $_GET['user_id'];
$cart_id = $funkcje->getProductFromUserCart($user_id);
$price = 0;
foreach($cart_id as $id){
    $product_name = $funkcje->getProductTitle($id['product_id']);
    $product_price = $funkcje->getProductPrice($id['product_id']);
    $product_quantity = $funkcje->getProductQuantityFromUserCart($account['id'], $id['product_id']);
    $product_image = $funkcje->getProductImage($id['product_id']);
    $price = $price + $product_quantity[0]*$product_price[0];
?> 
    <tr>
        <td data-label="Zdjęcie"><?php echo "<img src='public/upload_products_images/".$product_image[0]."' alt='".$product_image[0]."' width='100' height='100'>";  ?></td>
        <td data-label="Tytuł"><?php echo $product_name[0]; ?></td>
        <td data-label="Ilość">
            <?php
                if($product_quantity[0] > 1){
                echo "  <a href='/minusQuantity.php/?id=" . $account['id'] . "&product_id=".$id['product_id']."' class='btn btn-outline-info btn-sm'>-</a>  ";
                }
                echo $product_quantity[0];
                echo "  <a href='/plusQuantity.php/?id=" . $account['id'] . "&product_id=".$id['product_id']."' class='btn btn-outline-info btn-sm'>+</a>";
            ?>
        </td>
        <td data-label="Cena"><?php echo $product_price[0]; ?></td>
        <td data-label="Usuń"><?php
            echo "<a href='/deleteProductFromCart.php/?user_id=".$account['id']."&product_id=".$id['product_id']."' class='btn btn-danger btn-sm'>Usuń z koszyka</a>";
        ?></td>
        </td>
    </tr>
    
<?php 
//dodanie produktów po każdej iteracji cart(user_id, product_id, product_quantity)
$funkcje->finalizeCart($user_id, $id['product_id'], $product_quantity[0]);
// zamkniecie pętli
}


$funkcje->deleteCart($user_id);
// echo " <a href='/finalizeCart.php/?user_id=".$account['id']."' class='btn btn-success'>OPŁAĆ</a>";
header('Location: /sendConfirmation.php/?user_id='.$_GET['user_id']);
?>