<?php
    require_once("public/php/Funkcje.php");
    $funkcje = new Funkcje();
    if(!$funkcje->isLoggedIn())//Jeśli zalogowany, to zostan, jesli nie to odeslij do logowania
    {
        header('Location: login.php');
    }
    
    
    $account = $funkcje->getAccountDetailsById($funkcje->getLoggedAccountId());
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
        <!-- JavaScript Bundle with Popper -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function () {
                $('#my_products').DataTable(
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
    <body class="fitatu">
        <?php 
        include('public/partials/header.php');
        ?>
        <div class="product-info product_info2">  
        <h2 class="fade-in-text text-center text-white">
            <?php
            $dayOfTheWeek = date('l');
            if($dayOfTheWeek == "Monday"){ echo "Poniedziałek";}
            if($dayOfTheWeek == "Tuesday"){ echo "Wtorek";}
            if($dayOfTheWeek == "Wednesday"){ echo "Środa";}
            if($dayOfTheWeek == "Thursday"){ echo "Czwartek";}
            if($dayOfTheWeek == "Friday"){ echo "Piątek";}
            if($dayOfTheWeek == "Saturday"){ echo "Sobota";}
            if($dayOfTheWeek == "Sunday"){ echo "Niedziela";}
            ?>
            <br>
            <form action="POST">
                <?php 
                    $today =  date('Y-m-d');
                ?>
                <input type="date" class="datepicker" name="selected_date" value="<?php echo $today; ?>" />
            </form>
        </h2>
        <table id="my_products" class="table table-dark table-fitatu table3 table-hover">
            <thead>
                <tr>
                    <th colspan="3">Śniadanie</th>
                    <th style="text-align:right"><a href="fitatuBreakfastAdd.php" class="btn btn-outline-primary btn-sm"><i class="bi bi-plus">+</i></a></th>
                </tr>
                <tr style="text-align:center">
                <?php
                    $products = $funkcje->getFitatuProductsBreakfast($account['id'], $today);
                    $breakfast_suma_kcal = 0; 
                    $breakfast_suma_protein = 0; 
                    $breakfast_suma_fat = 0; 
                    $breakfast_suma_carbs = 0; 
                    foreach($products as $product){
                        $ilosc = $product['quantity'];
                        $licz = $funkcje->getFitatuProductKcalById($product['product_id']);
                        $breakfast_suma_kcal += $licz[0] * ($ilosc/100); 
                        $licz = $funkcje->getFitatuProductProteinById($product['product_id']);
                        $breakfast_suma_protein +=  $licz[0]  * ($ilosc/100);
                        $licz = $funkcje->getFitatuProductFatById($product['product_id']); 
                        $breakfast_suma_fat += $licz[0]  * ($ilosc/100);
                        $licz = $funkcje->getFitatuProductCarbsById($product['product_id']); 
                        $breakfast_suma_carbs += $licz[0]  * ($ilosc/100);
                    }

                ?>
                    <th><?php echo $breakfast_suma_kcal; ?> kcal</th>
                    <th><?php echo "Białka: ".$breakfast_suma_protein; ?> g</th>
                    <th><?php echo "Tłuszczu: ".$breakfast_suma_fat; ?> g</th>
                    <th><?php echo "Węglowodanów: ".$breakfast_suma_carbs; ?> g</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $products = $funkcje->getFitatuProductsBreakfast($account['id'], date('Y-m-d'));
                    $protein = 0; $fat = 0; $carbs = 0;
                    foreach($products as $product){
                ?>
                <tr>
                    <?php 
                        $name = $funkcje->getFitatuProductNameById($product['product_id']); 
                        $kcal = $funkcje->getFitatuProductKcalById($product['product_id']); 
                        $protein = $funkcje->getFitatuProductProteinById($product['product_id']); 
                        $fat = $funkcje->getFitatuProductFatById($product['product_id']); 
                        $carbs = $funkcje->getFitatuProductCarbsById($product['product_id']); 
                    
                    ?>
                    <td data-label="Name" colspan="1"><?php echo $name[0]; ?>
                    <td data-label="Makro" colspan="2" style="text-align:center">
                    <?php 
                        echo ($kcal[0]*$product['quantity']/100)." kcal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                        echo ($protein[0]*$product['quantity']/100)."b / ".($fat[0]*$product['quantity']/100)."t / ".($carbs[0]*$product['quantity']/100)."w&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                        echo $product['quantity']." g"; 
                    ?>
                    </td>
                    <td data-label="Name" colspan="1" style="text-align:right">
                    <?php echo "<a href='deleteFromFitatu.php?id=" . $product['id'] . "&user_id=".$account['id']."' class='btn btn-outline-danger btn-sm'><i class='bi bi-plus'>-</i></a>"; ?>
                    </td>
                </tr>
                    
                <?php } ?>
            </tbody>
        </table>
        <table cellspacing="0" id="my_products" class="table table-fitatu table3 table-dark table-hover">
            <thead>
                <tr>
                    <th colspan="3">Obiad</th>
                    <th style="text-align:right"><a href="fitatuLunchAdd.php" class="btn btn-outline-primary btn-sm"><i class="bi bi-plus">+</i></a></th>
                </tr>
                <tr style="text-align:center">
                <?php
                    $products = $funkcje->getFitatuProductsLunch($account['id'], $today);
                    $lunch_suma_kcal = 0; 
                    $lunch_suma_protein = 0; 
                    $lunch_suma_fat = 0; 
                    $lunch_suma_carbs = 0; 
                    foreach($products as $product){
                        $ilosc = $product['quantity'];
                        $licz = $funkcje->getFitatuProductKcalById($product['product_id']);
                        $lunch_suma_kcal += $licz[0] * ($ilosc/100); 
                        $licz = $funkcje->getFitatuProductProteinById($product['product_id']);
                        $lunch_suma_protein +=  $licz[0]  * ($ilosc/100);
                        $licz = $funkcje->getFitatuProductFatById($product['product_id']); 
                        $lunch_suma_fat += $licz[0]  * ($ilosc/100);
                        $licz = $funkcje->getFitatuProductCarbsById($product['product_id']); 
                        $lunch_suma_carbs += $licz[0]  * ($ilosc/100);
                    }

                ?>
                    <th><?php echo $lunch_suma_kcal; ?> kcal</th>
                    <th><?php echo "Białka: ".$lunch_suma_protein; ?> g</th>
                    <th><?php echo "Tłuszczu: ".$lunch_suma_fat; ?> g</th>
                    <th><?php echo "Węglowodanów: ".$lunch_suma_carbs; ?> g</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $products = $funkcje->getFitatuProductsLunch($account['id'], date('Y-m-d'));
                    $protein = 0; $fat = 0; $carbs = 0;
                    foreach($products as $product){
                ?>
                <tr>
                    <?php 
                        $name = $funkcje->getFitatuProductNameById($product['product_id']); 
                        $kcal = $funkcje->getFitatuProductKcalById($product['product_id']); 
                        $protein = $funkcje->getFitatuProductProteinById($product['product_id']); 
                        $fat = $funkcje->getFitatuProductFatById($product['product_id']); 
                        $carbs = $funkcje->getFitatuProductCarbsById($product['product_id']); 
                    
                    ?>
                    <td data-label="Name" colspan="1"><?php echo $name[0]; ?>
                    <td data-label="Makro" colspan="2" style="text-align:center">
                    <?php 
                        echo ($kcal[0]*$product['quantity']/100)." kcal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                        echo ($protein[0]*$product['quantity']/100)."b / ".($fat[0]*$product['quantity']/100)."t / ".($carbs[0]*$product['quantity']/100)."w&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                        echo $product['quantity']." g";
                    ?>
                    </td>
                    <td data-label="Name" colspan="1" style="text-align:right">
                    <?php echo "<a href='deleteFromFitatu.php?id=" . $product['id'] . "&user_id=".$account['id']."' class='btn btn-outline-danger btn-sm'><i class='bi bi-plus'>-</i></a>"; ?>
                    </td>
                </tr>
                    
                <?php } ?>
            </tbody>
        </table>
        <table id="my_products" class="table table-fitatu table3 table-dark table-hover">
            <thead>
                <tr>
                    <th colspan="3">Kolacja</th>
                    <th style="text-align:right"><a href="fitatuDinnerAdd.php" class="btn btn-outline-primary btn-sm"><i class="bi bi-plus">+</i></a></th>
                </tr>
                <tr style="text-align:center">
                <?php
                    $products = $funkcje->getFitatuProductsDinner($account['id'], $today);
                    $dinner_suma_kcal = 0; 
                    $dinner_suma_protein = 0; 
                    $dinner_suma_fat = 0; 
                    $dinner_suma_carbs = 0; 
                    foreach($products as $product){
                        $ilosc = $product['quantity'];
                        $licz = $funkcje->getFitatuProductKcalById($product['product_id']);
                        $dinner_suma_kcal += $licz[0] * ($ilosc/100); 
                        $licz = $funkcje->getFitatuProductProteinById($product['product_id']);
                        $dinner_suma_protein +=  $licz[0]  * ($ilosc/100);
                        $licz = $funkcje->getFitatuProductFatById($product['product_id']); 
                        $dinner_suma_fat += $licz[0]  * ($ilosc/100);
                        $licz = $funkcje->getFitatuProductCarbsById($product['product_id']); 
                        $dinner_suma_carbs += $licz[0]  * ($ilosc/100);
                    }

                ?>
                    <th><?php echo $dinner_suma_kcal; ?> kcal</th>
                    <th><?php echo "Białka: ".$dinner_suma_protein; ?> g</th>
                    <th><?php echo "Tłuszczu: ".$dinner_suma_fat; ?> g</th>
                    <th><?php echo "Węglowodanów: ".$dinner_suma_carbs; ?> g</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $products = $funkcje->getFitatuProductsDinner($account['id'], date('Y-m-d'));
                    $protein = 0; $fat = 0; $carbs = 0;
                    foreach($products as $product){
                ?>
                <tr>
                    <?php 
                        $name = $funkcje->getFitatuProductNameById($product['product_id']); 
                        $kcal = $funkcje->getFitatuProductKcalById($product['product_id']); 
                        $protein = $funkcje->getFitatuProductProteinById($product['product_id']); 
                        $fat = $funkcje->getFitatuProductFatById($product['product_id']); 
                        $carbs = $funkcje->getFitatuProductCarbsById($product['product_id']); 
                    
                    ?>
                    <td data-label="Name" colspan="1"><?php echo $name[0]; ?>
                    <td data-label="Makro" colspan="2" style="text-align:center">
                    <?php 
                        echo ($kcal[0]*$product['quantity']/100)." kcal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                        echo ($protein[0]*$product['quantity']/100)."b / ".($fat[0]*$product['quantity']/100)."t / ".($carbs[0]*$product['quantity']/100)."w&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                        echo $product['quantity']." g";
                    ?>
                    </td>
                    <td data-label="Name" colspan="1" style="text-align:right">
                    <?php echo "<a href='deleteFromFitatu.php?id=" . $product['id'] . "&user_id=".$account['id']."' class='btn btn-outline-danger btn-sm'><i class='bi bi-plus'>-</i></a>"; ?>
                    </td>
                </tr>
                    
                <?php } ?>
            </tbody>
            </table>
            <table id="my_products" class="table table-fitatu table3 table-dark table-hover">
            <thead>
                <tr>
                    <th colspan="4">Podsumowanie</th>
                </tr>
                <tr style="text-align:center">
                <?php

                ?>
                    <th><?php echo "Kcal ".$breakfast_suma_kcal+$lunch_suma_kcal+$dinner_suma_kcal; ?></th>
                    <th><?php echo "Białka: ".$breakfast_suma_protein+$lunch_suma_protein+$dinner_suma_protein; ?> g</th>
                    <th><?php echo "Tłuszczu: ".$breakfast_suma_fat+$lunch_suma_fat+$dinner_suma_fat; ?> g</th>
                    <th><?php echo "Węglowodanów: ".$breakfast_suma_carbs+$lunch_suma_carbs+$dinner_suma_carbs; ?> g</th>
                </tr>
                <tr style="text-align:center">
                <?php

                ?>
                    <?php $zapotrzebowanie = $funkcje->getZapotrzebowanie($account['id']); 
                    $bialkomin = round($zapotrzebowanie[0]*0.1 / 4);
                    $bialkomax = round($zapotrzebowanie[0]*0.3 / 4);

                    $tluszczmin = round($zapotrzebowanie[0]*0.25 / 9);
                    $tluszczmax = round($zapotrzebowanie[0]*0.35 / 9);

                    $weglemin = round($zapotrzebowanie[0]*0.45 / 4);
                    $weglemax = round($zapotrzebowanie[0]*0.65 / 4);

                    ?>
                    <th><?php echo "/".$zapotrzebowanie[0]." kcal"; ?></th>
                    <th><?php echo "/".$bialkomin."-".$bialkomax; ?> g</th>
                    <th><?php echo "/".$tluszczmin."-".$tluszczmax; ?> g</th>
                    <th><?php echo "/".$weglemin."-".$weglemax; ?> g</th>
                </tr>
            </thead>
            </table>
        </div>
    </body>
</html>