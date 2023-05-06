<?php
  require_once("public/php/Funkcje.php");
  $funkcje = new Funkcje();
  $plans = $funkcje->getTrainingPlans();
  $ebooks = $funkcje->getEbooks();
  $users = $funkcje->getUsersList();
 ?>
<!DOCTYPE html>
<html>
    <head>
    <title>Strona główna</title>
        <!-- <meta charset="UTF-8"> -->
        
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
            function calculateCalorie(obj)
            {
                const age = obj.form.age.value;
                const gender = obj.form.gender.value;
                const bodyFat = obj.form.bodyFat.value;
                const height = obj.form.height.value;
                const weight = obj.form.weight.value;
                const activity = obj.form.activity.value;
                const unit = obj.form.unit.value;
                const formula = obj.form.formula.value;

                let BMR = '';
                if(formula == 0) // Mifflin
                {
                    BMR = Mifflin(gender, age, bodyFat, height, weight);
                }
                else if(formula == 1) // Harris
                {
                    BMR = Harris(gender, age, bodyFat, height, weight);
                }
                else if(formula == 2) // Katch
                {
                    BMR = Katch(bodyFat, weight);
                }

                let ret = parseFloat(BMR)*parseFloat(activity);
                if(unit == 'kilojoules')
                {
                    ret = (ret*4.1868);
                }

                document.querySelector(".ans_calculate").innerHTML = '<div class="container"><h4 class="text-center form-control my-3 color-black font-weight-bold fs-4">You should consume <span class="color-purple">'+Math.ceil(ret)+' '+unit+'/day </span> of calorie to maintain your weight.</h4></div>';
            }

            function Mifflin(gender, age, bodyFat, height, weight)
            {
                let BMR = (10*weight) + (6.25*height) - (5*age) + 5;
                if(gender == 1) // Female
                {
                    BMR = (10*weight) + (6.25*height) - (5*age) - 161;
                }

                return BMR;
            }

            function Harris(gender, age, bodyFat, height, weight)
            {
                let BMR = (13.397*weight) + (4.799*height) - (5.677*age) + 88.362;
                if(gender == 1) // Female
                {
                    BMR = (9.247*weight) + (3.098*height) - (4.330*age) + 447.593;
                }

                return BMR;
            }

            function Katch(bodyFat, weight)
            {
                let BMR = 370 + 21.6*(1 - (bodyFat/100))*weight;

                return BMR;
            }
        </script> 
    </head>
    <body>
        <?php 
        include('public/partials/header.php');
        ?>
        <div class="content">
            <!-- content start -->
            <div class="content-header">  
                <div>
                    <h1 class="content-header-caption fade-in-text pt-5">
                        Oblicz swoje zapotrzebowanie oraz dobierz dietę do swoich potrzeb
                    </h1>
                    <p class="content-header-description fade-in-text">Zmień swoje życie już dziś</p>
                    <a href="#content-services" class="btn btn-primary btn-sm rounded fade-in-text">Rozpocznij</a>
                </div>
            </div>
            <!-- secound content -->
            <div class="content-services pt-5 text-center" id="content-services">
                <div>
                    <img src="public/img/calculator.png" alt="calculator">
                    <h2>Kalkulator</h2>
                    <hr class="hr-custom">
                    <p class="mt-3">Oblicz swoje zapotrzebanie aby dopasować dla siebie odpowiednią dietę oraz plan treningowy</p>
                </div>
                <div>
                    <img src="public/img/biceps.png" alt="biceps">
                    <h2>Trening</h2>
                    <hr class="hr-custom">
                    <p class="mt-3">Wybierz najefektywniejszy plan treningowy dla swoich potrzeb</p>
                </div>
                <div>
                    <img src="public/img/diet.png" alt="diet">
                    <h2>Dieta</h2>
                    <hr class="hr-custom">
                    <p class="mt-3">Dobierz odpowiednią dla siebie dietę, która będzie odpowiednia dla Twojego zapotrzebowania</p></div>
                </div>
            </div>
            <!-- Third content -->
            <div class="content-break" id="content-break">
                <div class=" text-white text-center pm-5">
                    <h2 class="div-h2">Mamy do zaoferowania</h2>
                </div>
                <div class="text-white content-break-description d-flex flex-wrap justify-content-evenly text-center">
                    <div><h2><?php echo count($plans); ?></h2>planów trenigowych</div>
                    <div><h2><?php echo count($ebooks); ?></h2>ebooków dietetycznych</div>
                    <div><h2>1</h2>kalkulator zapotrzebowania</div>
                    <div><h2><?php echo count($users); ?></h2>użytkowników</div>
                </div>
            </div>
            <!-- 4th content - training plans -->
            <div class="content-training-plans-div-h2">
                <div class="div-h2-fst">
                    <h5 class="color-purple">O NAS</h5>
                    <h2 class="pt-3 pb-5">Zajmujemy się wyliczaniem zapotrzebowania dla każdego</h2>
                    <p>Wyliczymy Ci dokładnie zapotrzebowanie biorąc pod uwagę Twoją aktywność w ciągu dnia oraz dobierzemy odpowiedni plan treningowy i dietę do twoich potrzeb.</p>
                </div>
                <div class="div-h2-snd">
                </div>
            </div>
            <!-- 5th break -->
            <div class="content-break text-center" id="content-training-plans">
                <div class=" text-white text-center">
                    <h2 class="div-h2">PLANY TRENINGOWE</h2>
                </div>
                    <a href="/trainingPlans.php" class="btn btn-dark btn-rounded button-purple-lighter btn-sm">Zobacz wszystkie</a>
            </div>
            <div class="content-training-plans">
                <?php 
                    $it = 0;
                    foreach($plans as $plan){
                        if($it == 4){break;}
                ?> 
                <div class="" style="padding-right: 10px; padding-left: 10px;">
                    <h3>
                    <?php 
                        echo '<a href="/productInfo.php?product_id='. $plan['id']. '" style="text-decoration: none; color: #B284FE;">'.$plan['title']  .'</a>'; 
                    ?></h3>
                    <?php echo "<img src='public/upload_products_images/".$plan['photo_title']."' alt='".$plan['photo_title']."' width='100' height='100'>";  ?>
                    <br>
                    <?php echo $plan['description']; ?>
                    <hr class="hr-custom">
                    <?php echo "Cena: ".$plan['price'] . " zł";  ?><br>
                    <?php
                        if($funkcje->isLoggedIn()){
                            echo "<a href='buyproduct.php/?user_id=".$account['id']."&product_id=".$plan['id']."' class='btn btn-dark btn-rounded button-purple-lighter'>Kup teraz</a>";
                        }
                    ?>

                </div>
                <?php $it++; } ?>
            </div>
            <!-- 6th break -->
            <div class="content-break text-center" id="content-diet-plans">
                <div class=" text-white text-center">
                    <h2 class="div-h2">EBOOKI DIETETYCZNE</h2>
                    
                </div>
                <a href="/ebooks.php" class="btn btn-dark btn-rounded button-purple-lighter btn-sm">Zobacz wszystkie</a>
            </div>
            <div class="content-diet-plans">
                <?php 
                $it = 0;
                    foreach($ebooks as $ebook){
                        if($it == 4){break;}
                ?> 
                <div class="" style="padding-right: 10px; padding-left: 10px;">
                <h3>
                    <?php 
                        echo '<a href="/productInfo.php?product_id='. $ebook['id']. '" style="text-decoration: none; color: #B284FE;">'.$ebook['title']  .'</a>'; 
                    ?></h3>
                    <?php echo "<img src='public/upload_products_images/".$ebook['photo_title']."' alt='".$ebook['photo_title']."' width='100' height='100'>";  ?>
                    <br>
                    <?php echo $ebook['description']; ?>
                    <hr class="hr-custom">
                    <?php echo "Cena: ".$ebook['price'] . " zł"; ?><br>
                    <?php
                        if($funkcje->isLoggedIn()){
                            echo "<a href='buyproduct.php/?user_id=".$account['id']."&product_id=".$ebook['id']."' class='btn btn-dark btn-rounded button-purple-lighter'>Kup teraz</a>";
                        }
                    ?>
                </div>
                <?php $it+=1; } ?>
            </div>
            <!-- 7th break -->
            <div class="content-break" id="content-calculator">
                <div class=" text-white text-center">
                    <h2 class="div-h2">KALKULATOR KALORYCZNY</h2>
                </div>
            </div>
            <div>
                <form class="CalculateForm" method="post">
                    <div class="card bg-light text-black d-flex" style="overflow-y: scroll;">
                        <div class="card-body">
                            <div class="row g-5">
                                <div class="col-sm-4">
                                    <div>
                                        <h5>Wiek</h5>
                                        <input class="form-control text-center" name="age" required="" type="number" value="25" />
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div>
                                        <h5>Płeć</h5>
                                        <div class="form-control">
                                            <div class="row">
                                                <div class="col-6 d-flex align-items-center">
                                                    <input checked="" id="gender_male" name="gender" required="" type="radio" value="0" />
                                                    <label class="ms-2">Mężczyzna</label>
                                                </div>
                                                <div class="col-6 d-flex align-items-center">
                                                    <input id="gender_female" name="gender" required="" type="radio" value="1" />
                                                    <label class="ms-2">Kobieta</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div>
                                        <h5>Poziom tkanki tłuszczowej</h5>
                                        <div class="d-flex align-items-center">
                                            <input class="form-control text-center" name="bodyFat" required="" type="number" value="15" />
                                            <span class="btn ms-1 bg-dark color-purple">%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div>
                                        <h5>Wzrost</h5>
                                        <div class="d-flex align-items-center">
                                            <input class="form-control text-center" name="height" required="" type="number" value="180" />
                                            <span class="btn ms-1 bg-dark color-purple text-nowrap">cm</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div>
                                        <h5>Waga</h5>
                                        <div class="d-flex align-items-center">
                                            <input class="form-control text-center" name="weight" required="" type="number" value="65" />
                                            <span class="btn ms-1 bg-dark color-purple text-nowrap">kg</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <h5>Aktywność</h5>
                                    <select class="form-select" name="activity" required="">
                                        <option value="">Wybierz aktywność</option>
                                        <option value="1">Podstawowa przemiana materii (B-Basal M-Metabolic R-Rate)</option>
                                        <option value="1.2">Siedzący tryb życia: mało ruchu lub całkowity jego brak</option>
                                        <option value="1.375">Lekka: trening 1-3 razy w tygodniu</option>
                                        <option selected="" value="1.465">Umiarkowana: trening 4-5 razy w tygodniu</option>
                                        <option value="1.55">Aktywna: codzienny trening lub intensywny trening 3-4 razy w tygodniu</option>
                                        <option value="1.725">Bardzo aktywna: intensywny trening 6-7 razy w tygodniu</option>
                                        <option value="1.9">Ekstremalnie aktywna: bardzo intensywny codzienny trening lub bardzo wymagająca praca fizyczna</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <div>
                                        <h5>Jednostka</h5>
                                        <div class="form-control">
                                            <div class="row">
                                                <div class="col-6 d-flex align-items-center">
                                                    <input checked="" id="unit_calories" name="unit" required="" type="radio" value="Calories" />
                                                    <label class="ms-2">kcal</label>
                                                </div>
                                                <div class="col-6 d-flex align-items-center">
                                                    <input id="unit_kilo" name="unit" required="" type="radio" value="kilojoules" />
                                                    <label class="ms-2">kJ</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div>
                                        <h5>Oszacowanie według formuły:</h5>
                                        <div class="row g-3">
                                            <div class="col-sm-12 d-flex align-items-center">
                                                <input checked="" id="Mifflin_St_Jeor" name="formula" required="" type="radio" value="0" />
                                                <label class="ms-2">Mifflin St Jeor</label>
                                            </div>
                                            <div class="col-sm-12 d-flex align-items-center">
                                                <input id="Revised_Harris_Benedict" name="formula" required="" type="radio" value="1" />
                                                <label class="ms-2">Revised Harris-Benedict</label>
                                            </div>
                                            <div class="col-sm-12 d-flex align-items-center">
                                                <input id="Katch_McArdle" name="formula" required="" type="radio" value="2" />
                                                <label class="ms-2">Katch-McArdle</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ans_calculate"></div>
                        <div class="text-center mt-4 card-footer">
                            <button class="btn btn-success" onclick="calculateCalorie(this)" type="button">
                                Oblicz
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        <!-- </div>  -->
    </body>
</html>