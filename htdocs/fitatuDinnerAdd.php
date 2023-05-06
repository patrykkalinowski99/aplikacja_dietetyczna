<?php
    require_once("public/php/Funkcje.php");
    $funkcje = new Funkcje();
    if(!$funkcje->isLoggedIn())//Jeśli zalogowany, to zostan, jesli nie to odeslij do logowania
    {
        header('Location: login.php');
    }

    if(!$funkcje->isAdmin($_SESSION['user_id']))//Jeśli nie admin to wyrzuć do strony głównej
    {
        header('Location: index.php');
    }
    $account = $funkcje->getAccountDetailsById($funkcje->getLoggedAccountId());
    if(($account['role_id'] == 1) || ($account['role_id'] == 2) || ($account['role_id'] == 4)){ //wyrzuć gdy nie masz uprawnień
        header('Location: index.php');
    }
    
    if(isset($_POST['name']) && isset($_POST['kcal']) && isset($_POST['protein']) && isset($_POST['fat']) && isset($_POST['carbs']))//Jeśli wyslal formularz to wstaw do bazy danych i przekieruj do logowania
    {
        $result = $funkcje->addProductToFitatu($_POST['name'], $_POST['kcal'], $_POST['protein'], $_POST['fat'], $_POST['carbs']);//Jesli true to znaczy, ze zarejestrowalo(sprawdz return w metodzie register w Funkcje.php)
        if($result)
        {
            header('Location: addToFitatu.php');
        }
    }

    
 ?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Dodaj produkt</title>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="public/styles/reset.css">
        <link rel="stylesheet" href="public/styles/globals.css">
        <link rel="stylesheet" href="public/styles/globals-low-resolution.css">
        <link rel="icon" href="public/image/dumbbell-purple.png">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">   
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet">
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
                        "pageLength": 1,
                        "language": {
                            "lengthMenu": "Wyświetl: _MENU_",
                            "zeroRecords": "Brak wyników",
                            "info": "Wyświetlono: _PAGE_ z _PAGES_ dostępnych produktów",
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
        include('public/partials/header.php');
        ?>
        <form method="POST" enctype="multipart/form-data">
        <div class="admin-panel-page pt-5 admin-panel-user-list" id="admin-panel-user-list" >  
            <h2 class="fade-in-text text-white">Dodaj produkt do śniadania</h2>
            <table id="user-table" class="table table-striped bg-light text-center">
                <thead>
                    <tr>
                        <th>Nazwa</th>
                        <th>Kcal</th>
                        <th>Białko</th>
                        <th>Tłuszcz</th>
                        <th>Węglowodany</th>
                        <th>Dodaj</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $products = $funkcje->getFitatuProducts();
                        foreach($products as $product){
                    ?>
                    <tr>
                        <td data-label="Nazwa"><?php echo $product['name']; ?></td>
                        <td data-label="Kcal"><?php echo $product['kcal']; ?></td>
                        <td data-label="Białko"><?php echo $product['protein']; ?></td>
                        <td data-label="Tłuszcz"><?php echo $product['fat']; ?></td>
                        <td data-label="Węglowodany"><?php echo $product['carbs']; ?></td>
                        <td data-label="Dodaj"><?php echo "<a href='fitatuAdd.php?id=" . $product['id'] . "&user_id=". $account['id'] . "&day=dinner' class='text-bold dropdown-item'>+</a>"; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
            
        </form>
    </body>
</html>