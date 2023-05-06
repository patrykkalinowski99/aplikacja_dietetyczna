<?php
    require_once("public/php/Funkcje.php");
    $funkcje = new Funkcje();
    if(!$funkcje->isLoggedIn())//Jeśli zalogowany, to zostan, jesli nie to odeslij do logowania
    {
        header('Location: login.php');
    }
    // if(!$funkcje->isAdmin($_SESSION['user_id']))//Jeśli nie admin to wyrzuć do strony głównej
    // {
    //     header('Location: index.php');
    // }
    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['imie']) && isset($_POST['nazwisko']))//Jeśli wyslal formularz to wstaw do bazy danych i przekieruj do logowania
    {
        $funkcje->changeAccountData($funkcje->getLoggedAccountId(), $_POST['username'], $_POST['email'], $_POST['password'], $_POST['imie'], $_POST['nazwisko']);
    }
    
    $account = $funkcje->getAccountDetailsById($funkcje->getLoggedAccountId());
    if($account['role_id'] == 1){
        header('Location: index.php');
    }
 ?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Konto</title>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="public/styles/reset.css">
        <link rel="stylesheet" href="public/styles/globals.css">
        <link rel="stylesheet" href="public/styles/globals-low-resolution.css">
        <link rel="icon" href="public/img/dumbbell-purple.png">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">   
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
        <!-- JavaScript Bundle with Popper -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#user-table').DataTable(
                    {
                        "language": {
                            "lengthMenu": "Wyświetl: _MENU_ użytkowników na stronę",
                            "zeroRecords": "Brak wyników",
                            "info": "Wyświetlono: _PAGE_ z _PAGES_",
                            "infoEmpty": "Brak odpowiadających wyników",
                            "infoFiltered": "(filtered from _MAX_ total records)",
                            "search": "Wyszukaj:",
                            "previous": "Następny",
                            "Next": "Następny"
                        }
                    }
                );

            });
            $(document).ready(function () {
                $('#ebook-table').DataTable(
                    {
                        "language": {
                            "lengthMenu": "Wyświetl: _MENU_ użytkowników na stronę",
                            "zeroRecords": "Brak wyników",
                            "info": "Wyświetlono: _PAGE_ z _PAGES_",
                            "infoEmpty": "Brak odpowiadających wyników",
                            "infoFiltered": "(filtered from _MAX_ total records)",
                            "search": "Wyszukaj:",
                            "previous": "Następny",
                            "Next": "Następny"
                        }
                    }
                );

            });
            $(document).ready(function () {
                $('#plan-table').DataTable(
                    {
                        "language": {
                            "lengthMenu": "Wyświetl: _MENU_ użytkowników na stronę",
                            "zeroRecords": "Brak wyników",
                            "info": "Wyświetlono: _PAGE_ z _PAGES_",
                            "infoEmpty": "Brak odpowiadających wyników",
                            "infoFiltered": "(filtered from _MAX_ total records)",
                            "search": "Wyszukaj:",
                            "previous": "Następny",
                            "Next": "Następny"
                        }
                    }
                );

            });
            $(document).ready(function () {
                $('#bought_products').DataTable(
                    {
                        "language": {
                            "lengthMenu": "Wyświetl: _MENU_ użytkowników na stronę",
                            "zeroRecords": "Brak wyników",
                            "info": "Wyświetlono: _PAGE_ z _PAGES_",
                            "infoEmpty": "Brak odpowiadających wyników",
                            "infoFiltered": "(filtered from _MAX_ total records)",
                            "search": "Wyszukaj:",
                            "previous": "Następny",
                            "Next": "Następny"
                        }
                    }
                );

            });
        </script>
    </head>
    <body>
        <?php 
        include('public/partials/adminheader.php');
        ?>
        <div class="admin-panel-page admin-panel-first-page pt-2" id="admin-panel-page">  
            <h2 class="fade-in-text">
                <?php 
                $userRole = $funkcje->getRoleById($account['role_id']);
                echo strtoupper($userRole[0]." panel"); 
                ?>
            </h2>
            <?php if($account['role_id'] == 3){?>
                <a href="/addproduct.php" class="btn btn-dark btn-rounded mt-3 btn-sm fade-in-text button-purple-lighter">Dodaj produkt</a>
                <a href="/addToFitatu.php" class="btn btn-dark btn-rounded mt-3 btn-sm fade-in-text button-purple-lighter">Dodaj do fitatu</a>
            <?php } ?>
            <?php if($account['role_id'] == 3 || $account['role_id'] == 4 || $account['role_id'] == 5) {?>
                <a href="/addEbook.php" class="btn btn-dark btn-rounded mt-3 btn-sm fade-in-text button-purple-lighter">Dodaj ebooka</a> 
            <?php } ?>
            <?php if($account['role_id'] == 3 || $account['role_id'] == 4 || $account['role_id'] == 5) {?>
                <a href="/addTrainingPlan.php" class="btn btn-dark btn-rounded mt-3 btn-sm fade-in-text button-purple-lighter">Dodaj plan treningowy</a> 
            <?php } ?>
        </div>
        
        <div class="admin-panel-page pt-5 admin-panel-user-list" id="admin-panel-user-list" >  
            <h2 class="fade-in-text text-white">Konta użytkowników</h2>
            <table id="user-table" class="table table-striped bg-light text-center">
                <thead>
                    <tr>
                        <th>Imię</th>
                        <th>Nazwisko</th>
                        <th>Login</th>
                        <th>Email</th>
                        <th>Rola</th>
                        <th>Operacja</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $users = $funkcje->getUsersList();
                        foreach($users as $user){
                    ?>
                    <tr>
                        <td data-label="Imię"><?php echo $user['imie']; ?></td>
                        <td data-label="Nazwisko"><?php echo $user['nazwisko']; ?></td>
                        <td data-label="Login"><?php echo $user['login']; ?></td>
                        <td data-label="Email"><?php echo $user['email']; ?></td>
                        <td data-label="Rola"><?php if($user['role_id'] == 1) echo "Zwykły"; else if($user['role_id'] == 5) echo "Moderator"; else if($user['role_id'] == 2) echo "Moderator Ebook'ów"; else if($user['role_id'] == 4) echo "Moderator planów treningowych"; else echo "Administrator"  ?></td>
                        <td data-label="Operacja">
                            <div class="btn-group dropleft">
                                <?php if($user['role_id'] != 3 ){ ?>
                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Nadaj uprawnienia
                                </button>
                                <div class="dropdown-menu">
                                    <?php echo "<div style='background-color: red'>";
                                    if($account['role_id'] == 3 && $user['role_id'] != 3){echo "<a href='deleteuser.php?id=" . $user['id'] . "' class='text-bold dropdown-item'>Usuń użytkownika</a>";}
                                    echo "</div>";
                                    if(($account['role_id'] == 3 || $account['role_id'] == 2) && $user['role_id'] == 1){
                                        echo "<a href='promotionMod.php?id=" . $user['id'] . "' class='text-bold dropdown-item'>Nadaj pełnego moderatora</a>";
                                        echo "<a href='promotionEbookMod.php?id=" . $user['id'] . "' class='text-bold dropdown-item'>Nadaj moderatora dla ebooków</a>";
                                        echo "<a href='promotionTrainingPlanMod.php?id=" . $user['id'] . "' class='text-bold dropdown-item'>Nadaj moderatora dla planów treningowych</a>";
                                    }
                                    if(($account['role_id'] == 3) && $user['role_id'] != 1){echo "<a href='unpromotionmod.php?id=" . $user['id'] . "' class='text-bold dropdown-item'>Zdegraduj</a>";} 
                                    ?>
                                </div>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
            <div class="admin-panel-page pt-5 admin-panel-ebook-list" id="admin-panel-ebook-list">  
                <h2 class="fade-in-text text-white">Ebooki dietetyczne</h2>
                <table id="ebook-table" class="table table-striped bg-light text-center">
                    <thead>
                        <tr>
                            <th>Tytuł</th>
                            <th>Opis</th>
                            <th>Cena</th>
                            <th>Zdjęcie</th>
                            <th>Operacja</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $ebooks = $funkcje->getEbooks();
                            foreach($ebooks as $ebook){
                        ?> 
                        <tr>
                            <td data-label="Tytuł"><?php echo $ebook['title']; ?></td>
                            <td data-label="Opis"><?php echo $ebook['description']; ?></td>
                            <td data-label="Cena"><?php echo $ebook['price'] . " zł"; ?></td>
                            <td data-label="Zdjęcie"><?php echo "<img src='public/upload_products_images/".$ebook['photo_title']."' alt='".$ebook['photo_title']."' width='100' height='100'>";  ?></td>
                            <td data-label="Operacja"><?php echo "<a href='deleteproduct.php?id=" . $ebook['id'] . "' class='text-bold btn btn-danger'>USUŃ</a>"; ?></td>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <div class="admin-panel-page admin-panel-plans-list" id="admin-panel-training-list">  
            <h2 class="fade-in-text text-white">Plany treningowe</h2>
            <table id="plan-table" class="table table-striped bg-light text-center">
                    <thead>
                        <tr>
                            <th>Tytuł</th>
                            <th>Opis</th>
                            <th>Cena</th>
                            <th>Zdjęcie</th>
                            <th>Operacja</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $plans = $funkcje->getTrainingPlans();
                            foreach($plans as $plan){
                        ?> 
                        <tr>
                            <td data-label="Tytuł"><?php echo $plan['title']; ?></td>
                            <td data-label="Opis"><?php echo $plan['description']; ?></td>
                            <td data-label="Cena"><?php echo $plan['price'] . " zł"; ?></td>
                            <td data-label="Zdjęcie"><?php echo "<img src='public/upload_products_images/".$plan['photo_title']."' alt='".$plan['photo_title']."'>";  ?></td>
                            <td data-label="Operacja"><?php echo "<a href='deleteproduct.php?id=" . $plan['id'] . "' class='text-bold btn btn-danger'>USUŃ</a>"; ?></td>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
        </div>
        <div class="admin-panel-page admin-panel-plans-list" id="admin-panel-training-list">  
            <h2 class="fade-in-text text-white">Zamówienia użytkowników</h2>
            <table id="bought_products" class="table table-striped bg-light text-center">
            <thead>
                <tr>
                    <th>Użytkownik</th>
                    <th>Tytuł</th>
                    <th>Opis</th>
                    <th>Cena</th>
                    <th>Zdjęcie</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $productId = $funkcje->getBoughtProducts();
                    
                    foreach($productId as $product){
                    $user = $funkcje->getUserById($product['user_id']);
                    $products = $funkcje->getBoughtProductInfo($product['product_id']);
                ?> 
                <tr>
                    <td data-label="Tytuł"><?php echo $user['login']; ?></td>
                    <td data-label="Tytuł"><?php echo $products['title']; ?></td>
                    <td data-label="Opis"><?php echo $products['description']; ?></td>
                    <td data-label="Cena"><?php echo $products['price'] . " zł"; ?></td>
                    <td data-label="Zdjęcie"><?php echo "<img src='public/upload_products_images/".$products['photo_title']."' alt='".$products['photo_title']."' width='100' height='100'>";  ?></td>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
    </body>
</html>