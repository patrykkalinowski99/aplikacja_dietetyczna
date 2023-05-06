<?php
require_once("Config.php");
class Funkcje
{
    private $db;

    public function __construct()
    {
        session_start(); //wystartowanie sesji jak sie stworzy instacje tej klasy(czyt. stworzenie obiektu)
        $this->db = new PDO(Config::getDsn(), Config::getUser(), Config::getPassword());  //polaczenie z baza jak sie stworzy instacje tej klasy(czyt. stworzenie obiektu)
    } //^ zeby sie nie powtarzac w wielu plikach

    public function __destruct() //dekonstruktor, jak już koniec php to ma przerwac polaczenie z baza
    {
        $this->db = null;
    }

    public function isLoggedIn() // czy jest zalogowany
    {
        if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) //sprawdzamy czy jest ustawiona w sesji
        {
            return true;
        }
    
        return false;
    }

    public function register($login, $password, $email, $imie, $nazwisko) // rejestracja
    {
        $login = strip_tags($login);
        $password = strip_tags($password);
        $email = strip_tags($email);
        $imie = strip_tags($imie);
        $nazwisko = strip_tags($nazwisko);
        $errorMsg = []; //zmienna tablicowa

        if(empty($login)) 
        {
            $errorMsg[] = "Wprowadź login";
        }
        if(empty($email)) 
        {
            $errorMsg[] = "Wprowadź poprawny email";
        }

        if(empty($password))
        {
            $errorMsg[] = "Wprowadź poprawne hasło";
        }

        if(strlen($password) < 8) 
        {
            $errorMsg[] = "Wprowadź hasło z co najmniej 8 znakami";
        }
        if(empty($imie))
        {
            $errorMsg[] = "Wprowadź imię";
        }
        if(empty($nazwisko))
        {
            $errorMsg[] = "Wprowadź nazwisko";
        }
        try 
        {
            $stmt = $this->db->prepare("SELECT login, email FROM users WHERE login=:login OR email=:email");
            $stmt->execute(array(':login' => $login, ':email' => $email));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if(!empty($row)) //jesli nie jest pusta zmienna $row
            {
                if($row["login"] == $login) //jesli istnieje  login w bazie to wyrzuca błąd zapisywany do tablicy
                {
                    $errorMsg[] = "Ten login już istnieje";
                }
                else if($row["email"] == $email) //jesli istnieje email w bazie to wyrzuca błąd zapisywany do tablicy
                {
                    $errorMsg[] = "Ten email jest już przypisany do innego konta";
                }
            }
        }
        catch(PDOException $e) 
        {
            echo $e->getMessage();
        }		
        
        if(empty($errorMsg))// jesli nie ma bledow to wrzuc dane do bazy (z zahashowanym haslem) i wyjdz z funkcji, przerzucenie 
        {
            try
            {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);                                                                         // password_default to bcrypt
                $stmt = $this->db->prepare("INSERT INTO users(login, email, password, imie, nazwisko, role_id, wiek, waga, wzrost,zapotrzebowanie) VALUES (?,?,?,?,?,?,?,?,?,?)");
                var_dump($stmt);
                $stmt->execute([$login, $email, $hashedPassword, $imie, $nazwisko, 1, '', '', '','']);
                return true;
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }
        
        $_SESSION["errorMsg"] = $errorMsg;//ustawiamy w sesji bledy jesli sa
        return false;
    }

    public function addUser($login, $password, $email, $imie, $nazwisko) // rejestracja
    {
        $login = strip_tags($login);
        $password = strip_tags($password);
        $email = strip_tags($email);
        $imie = strip_tags($imie);
        $nazwisko = strip_tags($nazwisko);
        $errorMsg = []; //zmienna tablicowa

        if(empty($login)) 
        {
            $errorMsg[] = "Wprowadź login";
        }
        if(empty($email)) 
        {
            $errorMsg[] = "Wprowadź poprawny email";
        }

        if(empty($password))
        {
            $errorMsg[] = "Wprowadź poprawne hasło";
        }

        if(strlen($password) < 6) 
        {
            $errorMsg[] = "Wprowadź hasło z co najmniej 6 znakami";
        }
        if(empty($imie))
        {
            $errorMsg[] = "Wprowadź imię";
        }
        if(empty($nazwisko))
        {
            $errorMsg[] = "Wprowadź nazwisko";
        }
        try 
        {
            $stmt = $this->db->prepare("SELECT login, email FROM users WHERE login=:login OR email=:email");
            $stmt->execute(array(':login' => $login, ':email' => $email));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if(!empty($row)) //jesli nie jest pusta zmienna $row
            {
                if($row["login"] == $login) //jesli istnieje  login w bazie to wyrzuca błąd zapisywany do tablicy
                {
                    $errorMsg[] = "Ten login już istnieje";
                }
                else if($row["email"] == $email) //jesli istnieje  login w bazie to wyrzuca błąd zapisywany do tablicy
                {
                    $errorMsg[] = "Ten email jest już przypisany do innego konta";
                }
            }
        }
        catch(PDOException $e) 
        {
            echo $e->getMessage();
        }		
        
        if(empty($errorMsg))// jesli nie ma bledow to wrzuc dane do bazy (z zahashowanym haslem) i wyjdz z funkcji, przerzucenie 
        {
            try
            {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // password_default to bcrypt
                $stmt = $this->db->prepare("INSERT INTO users(login, email, password, imie, nazwisko, role_id, klasa) VALUES (?,?,?,?,?,?,?)");
                var_dump($stmt);
                $stmt->execute([$login, $email, $hashedPassword, $imie, $nazwisko, 1, "Brak"]);
                return true;
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }
        
        $_SESSION["errorMsg"] = $errorMsg;//ustawiamy w sesji bledy jesli sa
        return false;
    }

    public function deleteUser($id)
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id=". $id);
        $stmt->execute();
    }
    public function deleteComment($id)
    {
        $stmt = $this->db->prepare("DELETE FROM comments WHERE id=". $id);
        $stmt->execute();
    }
    public function deleteFitatuProduct($id)
    {
        $stmt = $this->db->prepare("DELETE FROM fitatu_products WHERE id=". $id);
        $stmt->execute();
    }
    public function deleteFromFitatu($id, $user_id, $date)
    {
        $stmt = $this->db->prepare("DELETE FROM fitatu WHERE id=". $id." AND user_id = ".$user_id." AND date='".$date."'");
        $stmt->execute();
    }
    public function deleteProduct($id)
    {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id=". $id);
        $stmt->execute();
    }
    public function deleteProductFromCart($user_id, $product_id)
    {
        $stmt = $this->db->prepare("DELETE FROM cart WHERE user_id=". $user_id ." AND product_id=".$product_id);
        $stmt->execute();
    }
    public function deleteCart($id)
    {
        $stmt = $this->db->prepare("DELETE FROM cart WHERE user_id=". $id);
        $stmt->execute();
    }
    public function login($username, $password) // logowanie
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE login=:login"); //znalezienie rekordu w tabeli users gdzie podany login odpowiada loginowi z bazy
        $stmt->execute(array(':login' => $username)); //wykonanie
        $row = $stmt->fetch();
        $errorMsg = [];

        if(!empty($row) && password_verify($password, $row['password'])) //sprawdzanie czy znaleziono użytkownika po username i sprawdzenie czy haslo jest poprawne
        {
            $_SESSION["user_id"] = $row['id']; //wstawienie do sesji id uzytkownika
            return true;
        }
        $errorMsg[] = "Brak danego loginu w bazie lub złe hasło";
        $_SESSION["errorMsg"] = $errorMsg; //ustawiamy w sesji bledy jesli sa
        return false;
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
    }

    public function printErrorsAndUnset() //wypisz bledy i usun je
    {
        if(!empty($_SESSION['errorMsg']))
        {
            echo "<ul><li>" . implode("</li><li>", $_SESSION['errorMsg']) . "</li></ul>";
            unset($_SESSION['errorMsg']); //implode łączy elementy tablicy z łańcuchem znaków
        }
    }

    public function getAccountDetailsById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id=:id");
        $stmt->execute(array(':id' => $id));
        $row = $stmt->fetch();
        return $row;
    }
    public function getZapotrzebowanie($id)
    {
        $stmt = $this->db->prepare("SELECT zapotrzebowanie FROM users WHERE id=:id");
        $stmt->execute(array(':id' => $id));
        $row = $stmt->fetch();
        return $row;
    }

    public function getAccountFullNameById($id)
    {
        $stmt = $this->db->prepare("SELECT imie, nazwisko FROM users WHERE id=:id");
        $stmt->execute(array(':id' => $id));
        $row = $stmt->fetch();
        return $row;
    }

    public function getAccountEmailById($id)
    {
        $stmt = $this->db->prepare("SELECT email FROM users WHERE id=:id");
        $stmt->execute(array(':id' => $id));
        $row = $stmt->fetch();
        return $row;
    }
    public function getProductImage($id)
    {
        $stmt = $this->db->prepare("SELECT photo_title FROM products WHERE id=:id");
        $stmt->execute(array(':id' => $id));
        $row = $stmt->fetch();
        return $row;
    }
    public function getProductOrigin($id)
    {
        $stmt = $this->db->prepare("SELECT origin_name FROM origin WHERE origin_number=:id");
        $stmt->execute(array(':id' => $id));
        $row = $stmt->fetch();
        return $row;
    }
    public function getProductCategory($id)
    {
        $stmt = $this->db->prepare("SELECT category_name FROM category WHERE category_number=:id");
        $stmt->execute(array(':id' => $id));
        $row = $stmt->fetch();
        return $row;
    }
    public function getUserRole($id)
    {
        $stmt = $this->db->prepare("SELECT role_id FROM users WHERE id=:id");
        $stmt->execute(array(':id' => $id));
        $row = $stmt->fetch();
        return $row;
    }
    public function getUserLogin($id)
    {
        $stmt = $this->db->prepare("SELECT login FROM users WHERE id=:id");
        $stmt->execute(array(':id' => $id));
        $row = $stmt->fetch();
        return $row;
    }
    public function getLoggedAccountId()
    {
        return $_SESSION['user_id'];
    }

    public function isAdmin($id)                                                                                 //dajemy do funkcji, bo mozemy chciec inaczej przechowywac id, wiec pozniej zmiana w jednym miejscu
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id=:id");
        $stmt->execute(array(':id' => $id));
        $row = $stmt->fetch();

        if($row['role_id'] == 3)// sprawdza czy ma role admina
        {
            return true;
        }
        return false;
    }

    public function changeAccountData($id, $username, $email, $imie, $nazwisko, $wiek, $wzrost, $waga, $password = "")//do zmiany loginu, emaila i hasla
    {
        $username = strip_tags($username);
        $email = strip_tags($email);
        $password = strip_tags($password);
        $imie = strip_tags($imie);
        $nazwisko = strip_tags($nazwisko);
        $wiek = strip_tags($wiek);
        $wzrost = strip_tags($wzrost);
        $bmr = 66 + (13.7 *$waga) + (5 * $wzrost) - (6.8 * $wiek);
        // $waga = strip_tags($waga);
        try
        {
            if(empty($password))
            {
                $stmt = $this->db->prepare("UPDATE users SET login=:login, email=:email, imie=:imie, nazwisko=:nazwisko, wiek=:wiek, waga=:waga, wzrost=:wzrost, zapotrzebowanie=:zapotrzebowanie WHERE id=" . $id);
                $stmt->execute(array(':login' => $username, ':email' => $email, ':imie' => $imie, ':nazwisko' => $nazwisko, ':wiek' => $wiek, ':waga' => $waga, ':wzrost' => $wzrost, ':zapotrzebowanie' => $bmr));
            }
            else
            {
                $password = password_hash($password, PASSWORD_DEFAULT);

                $stmt = $this->db->prepare("UPDATE users SET login=:login, email=:email, imie=:imie, nazwisko=:nazwisko, password=:password, wiek=:wiek, waga=:waga, wzrost=:wzrost, zapotrzebowanie=:zapotrzebowanie WHERE id=" . $id);
                $stmt->execute(array(':login' => $username, ':email' => $email, ':password' => $password, ':imie' => $imie, ':nazwisko' => $nazwisko, ':wiek' => $wiek, ':waga' => $waga, ':wzrost' => $wzrost, ':zapotrzebowanie' => $bmr));
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function changeClass($id, $klasa)//do zmiany loginu, emaila i hasla
    {
        $klasa = strip_tags($klasa);
        try
        {
            $stmt = $this->db->prepare("UPDATE users SET klasa=:klasa WHERE id=" . $id);
            $stmt->execute(array(':klasa' => $klasa));
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
    
    public function getUser($id = null)//default pobierz wszystkie, jesli jest przekazany parametr to pobierz tylko jedna wiersz
    {
        $sql = "SELECT * FROM users WHERE role_id = 1 OR role_id = 2";

        if(!empty($id))
        {
            $sql .= " WHERE id = " . $id;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        if(!empty($id))
        {
            return $stmt->fetch(); // do pojedynczego, bo przy jednym fetchAll to w takim przypadku by trzeba bylo dodac do zmiennej $zmienna[0]["yacht_name"] zamiast $zmienna["yacht_name"]
        }
        else
        {
            return $stmt->fetchAll(); // zeby wszystkie pobralo
        }
        
    }
    public function getUsersList()
    {
        $sql = "SELECT * FROM users";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        if(!empty($id))
        {
            return $stmt->fetch(); // do pojedynczego, bo przy jednym fetchAll to w takim przypadku by trzeba bylo dodac do zmiennej $zmienna[0]["yacht_name"] zamiast $zmienna["yacht_name"]
        }
        else
        {
            return $stmt->fetchAll(); // zeby wszystkie pobralo
        }
    }
    public function getUserById($id)
    {
        $sql = "SELECT * FROM users WHERE id = ".$id;
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        if(!empty($id))
        {
            return $stmt->fetch(); // do pojedynczego, bo przy jednym fetchAll to w takim przypadku by trzeba bylo dodac do zmiennej $zmienna[0]["yacht_name"] zamiast $zmienna["yacht_name"]
        }
        else
        {
            return $stmt->fetchAll(); // zeby wszystkie pobralo
        }
    }
    public function getRoleById($id)
    {
        $sql = "SELECT role_name FROM roles WHERE id = ".$id;
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        if(!empty($id))
        {
            return $stmt->fetch(); // do pojedynczego, bo przy jednym fetchAll to w takim przypadku by trzeba bylo dodac do zmiennej $zmienna[0]["yacht_name"] zamiast $zmienna["yacht_name"]
        }
        else
        {
            return $stmt->fetchAll(); // zeby wszystkie pobralo
        }
    }
    public function getEbooks()
    {
        $sql = "SELECT * FROM products WHERE product_type = 'ebook'";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        if(!empty($id))
        {
            return $stmt->fetch(); // do pojedynczego, bo przy jednym fetchAll to w takim przypadku by trzeba bylo dodac do zmiennej $zmienna[0]["yacht_name"] zamiast $zmienna["yacht_name"]
        }
        else
        {
            return $stmt->fetchAll(); // zeby wszystkie pobralo
        }
    }
    public function getTrainingPlans()
    {
        $sql = "SELECT * FROM products WHERE product_type = 'plan'";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        if(!empty($id))
        {
            return $stmt->fetch(); // do pojedynczego, bo przy jednym fetchAll to w takim przypadku by trzeba bylo dodac do zmiennej $zmienna[0]["yacht_name"] zamiast $zmienna["yacht_name"]
        }
        else
        {
            return $stmt->fetchAll(); // zeby wszystkie pobralo
        }
    }
    public function getNumberOfProducts()
    {
        $sql = "SELECT max(id) FROM products";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $number = $stmt->fetch();
        return $number[0];
    }
    public function getOrigins()
    {
        $sql = "SELECT * FROM origin";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        if(!empty($id))
        {
            return $stmt->fetch(); // do pojedynczego, bo przy jednym fetchAll to w takim przypadku by trzeba bylo dodac do zmiennej $zmienna[0]["yacht_name"] zamiast $zmienna["yacht_name"]
        }
        else
        {
            return $stmt->fetchAll(); // zeby wszystkie pobralo
        }
    }
    public function getCategories()
    {
        $sql = "SELECT * FROM category";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        if(!empty($id))
        {
            return $stmt->fetch(); // do pojedynczego, bo przy jednym fetchAll to w takim przypadku by trzeba bylo dodac do zmiennej $zmienna[0]["yacht_name"] zamiast $zmienna["yacht_name"]
        }
        else
        {
            return $stmt->fetchAll(); // zeby wszystkie pobralo
        }
    }
    public function getBoughtProducts()
    {
        $sql = "SELECT user_id, product_id FROM bought_products";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        if(!empty($id))
        {
            return $stmt->fetch(); // do pojedynczego, bo przy jednym fetchAll to w takim przypadku by trzeba bylo dodac do zmiennej $zmienna[0]["yacht_name"] zamiast $zmienna["yacht_name"]
        }
        else
        {
            return $stmt->fetchAll(); // zeby wszystkie pobralo
        }
    }
    public function getBoughtProductInfo($id)
    {
        $sql = "SELECT * FROM products WHERE id = ".$id;
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        if(!empty($id))
        {
            return $stmt->fetch(); // do pojedynczego, bo przy jednym fetchAll to w takim przypadku by trzeba bylo dodac do zmiennej $zmienna[0]["yacht_name"] zamiast $zmienna["yacht_name"]
        }
        else
        {
            return  $stmt->fetchAll(); // zeby wszystkie pobralo
        }
    }
    public function getMyBoughtProducts()
    {
        $sql = "SELECT * FROM bought_products";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        if(!empty($id))
        {
            return $stmt->fetch(); // do pojedynczego, bo przy jednym fetchAll to w takim przypadku by trzeba bylo dodac do zmiennej $zmienna[0]["yacht_name"] zamiast $zmienna["yacht_name"]
        }
        else
        {
            return $stmt->fetchAll(); // zeby wszystkie pobralo
        }
    }
    public function getProductTitle($id)
    {
        $sql = "SELECT title FROM products WHERE id = ".$id;
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        if(!empty($id))
        {
            return $stmt->fetch(); // do pojedynczego, bo przy jednym fetchAll to w takim przypadku by trzeba bylo dodac do zmiennej $zmienna[0]["yacht_name"] zamiast $zmienna["yacht_name"]
        }
        else
        {
            return $stmt->fetchAll(); // zeby wszystkie pobralo
        }
    }
    public function getProductDescription($id)
    {
        $sql = "SELECT description FROM products WHERE id = ".$id;
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        if(!empty($id))
        {
            return $stmt->fetch(); // do pojedynczego, bo przy jednym fetchAll to w takim przypadku by trzeba bylo dodac do zmiennej $zmienna[0]["yacht_name"] zamiast $zmienna["yacht_name"]
        }
        else
        {
            return $stmt->fetchAll(); // zeby wszystkie pobralo
        }
    }
    public function getProductPrice($id)
    {
        $sql = "SELECT price FROM products WHERE id = ".$id;
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        if(!empty($id))
        {
            return $stmt->fetch(); // do pojedynczego, bo przy jednym fetchAll to w takim przypadku by trzeba bylo dodac do zmiennej $zmienna[0]["yacht_name"] zamiast $zmienna["yacht_name"]
        }
        else
        {
            return $stmt->fetchAll(); // zeby wszystkie pobralo
        }
    }
    public function getProductPhotoTitle($id)
    {
        $sql = "SELECT photo_title FROM products WHERE id = ".$id;
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        if(!empty($id))
        {
            return $stmt->fetch(); // do pojedynczego, bo przy jednym fetchAll to w takim przypadku by trzeba bylo dodac do zmiennej $zmienna[0]["yacht_name"] zamiast $zmienna["yacht_name"]
        }
        else
        {
            return $stmt->fetchAll(); // zeby wszystkie pobralo
        }
    }
    public function getProductType($id)
    {
        $sql = "SELECT product_type FROM products WHERE id = ".$id;
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        if(!empty($id))
        {
            return $stmt->fetch(); // do pojedynczego, bo przy jednym fetchAll to w takim przypadku by trzeba bylo dodac do zmiennej $zmienna[0]["yacht_name"] zamiast $zmienna["yacht_name"]
        }
        else
        {
            return $stmt->fetchAll(); // zeby wszystkie pobralo
        }
    }
    public function getProductFromUserCart($user_id)
    {
        $sql = "SELECT product_id FROM cart WHERE user_id = ".$user_id;
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        // if(!empty($user_id))
        // {
        //     return $stmt->fetch(); // do pojedynczego, bo przy jednym fetchAll to w takim przypadku by trzeba bylo dodac do zmiennej $zmienna[0]["yacht_name"] zamiast $zmienna["yacht_name"]
        // }
        // else
        // {
            return $stmt->fetchAll(); // zeby wszystkie pobralo
        // }
    }
    public function getProductQuantityFromUserCart($user_id, $product_id)
    {
        $sql = "SELECT product_quantity FROM cart WHERE user_id = ".$user_id." AND product_id = ".$product_id;
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $count = $stmt->fetch();
        return $count;
    }
    public function getProductQuantityFromBoughtProducts($user_id, $product_id)
    {
        $sql = "SELECT product_quantity FROM bought_products WHERE user_id = ".$user_id." AND product_id = ".$product_id;
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $count = $stmt->fetch();
        return $count;
    }
    public function addProductQuantityInUserCart($user_id, $product_id)
    {
        $plus = 1;
        $sql = "UPDATE cart SET product_quantity = product_quantity +".$plus." WHERE user_id=".$user_id." AND product_id=".$product_id;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
    }
    public function minusProductQuantityInUserCart($user_id, $product_id)
    {
        $plus = -1;
        $sql = "UPDATE cart SET product_quantity = product_quantity +".$plus." WHERE user_id=".$user_id." AND product_id=".$product_id;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
    }
    public function addProduct($title, $description, $price, $image_title, $product_type, $product_origin, $product_category)
    {
        $title = strip_tags($title);
        $description = strip_tags($description);
        $price = strip_tags($price);
        $image_title = strip_tags($image_title);
        $product_type = strip_tags($product_type);
        $product_origin = strip_tags($product_origin);
        $product_category = strip_tags($product_category);
        $errorMsg = []; //zmienna tablicowa

        if(empty($title)) 
        {
            $errorMsg[] = "Wprowadź tytuł";
        }
        if(empty($description)) 
        {
            $errorMsg[] = "Wprowadź opis";
        }

        if(empty($price))
        {
            $errorMsg[] = "Wprowadź cenę";
        }		
        
        if(empty($errorMsg))
        {
            try
            {
                $stmt = $this->db->prepare("INSERT INTO products(title, description, price, photo_title, product_type, origin_number, category_number) VALUES (?,?,?,?,?,?,?)");
                $stmt->execute([$title, $description, $price, $image_title, $product_type, $product_origin, $product_category]);
                return true;
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }
        
        $_SESSION["errorMsg"] = $errorMsg;//ustawiamy w sesji bledy jesli sa
        return false;
    }
    public function addProductToFitatu($name, $kcal, $protein, $fat, $carbs)
    {
        $name = strip_tags($name);
        $kcal = strip_tags($kcal);
        $protein = strip_tags($protein);
        $fat = strip_tags($fat);
        $carbs = strip_tags($carbs);
        $errorMsg = []; //zmienna tablicowa

        if(empty($name)) 
        {
            $errorMsg[] = "Wprowadź imię";
        }
        if(empty($kcal)) 
        {
            $errorMsg[] = "Wprowadź kalorie";
        }
        if(empty($errorMsg))
        {
            try
            {
                $stmt = $this->db->prepare("INSERT INTO fitatu_products(name, kcal, protein, fat, carbs) VALUES (?,?,?,?,?)");
                $stmt->execute([$name, $kcal, $protein, $fat, $carbs]);
                return true;
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }
        
        $_SESSION["errorMsg"] = $errorMsg;//ustawiamy w sesji bledy jesli sa
        return false;
    }
    public function addToFitatu($user_id, $product_id, $day, $quantity)
    {
        $product_id = strip_tags($product_id);
        $user_id = strip_tags($user_id);
        $day = strip_tags($day);
        $quantity = strip_tags($quantity);
        $errorMsg = []; //zmienna tablicowa

        if(empty($day)) 
        {
            $errorMsg[] = "Wprowadź dzień";
        }
        if(empty($errorMsg))
        {
            try
            {
                $stmt = $this->db->prepare("INSERT INTO fitatu(user_id, product_id, quantity, which_meal) VALUES (?,?,?,?)");
                $stmt->execute([$user_id, $product_id, $quantity, $day]);
                return true;
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }
        
        $_SESSION["errorMsg"] = $errorMsg;//ustawiamy w sesji bledy jesli sa
        return false;
    }
    public function buyProduct($user_id, $product_id)
    {
        $user_id = strip_tags($user_id);
        $product_id = strip_tags($product_id);
        $errorMsg = []; //zmienna tablicowa
        if(empty($errorMsg))
        {
            try
            {
                $stmt = $this->db->prepare("INSERT INTO cart(user_id, product_id) VALUES (?,?)");
                $stmt->execute([$user_id, $product_id]);
                return true;
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }
        $_SESSION["errorMsg"] = $errorMsg;//ustawiamy w sesji bledy jesli sa
        return false;
    }
    public function FinalizeCart($user_id, $product_id, $quantity)
    {
        $user_id = strip_tags($user_id);
        $product_id = strip_tags($product_id);
        $quantity = strip_tags($quantity);
        $errorMsg = []; //zmienna tablicowa
        if(empty($errorMsg))
        {
            try
            {
                $stmt = $this->db->prepare("INSERT INTO bought_products(user_id, product_id, product_quantity) VALUES (?,?,?)");
                $stmt->execute([$user_id, $product_id, $quantity]);
                return true;
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }
        $_SESSION["errorMsg"] = $errorMsg;//ustawiamy w sesji bledy jesli sa
        return false;
    }
    

    public function getProductsFromShoppingCart($user_id, $product_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM cart WHERE user_id=".$user_id." AND product_id=".$product_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function promotionMod($id)
    {
        $stmt = $this->db->prepare("UPDATE users SET role_id = 5 WHERE id=". $id);
        $stmt->execute();
    }
    public function promotionEbookMod($id)
    {
        $stmt = $this->db->prepare("UPDATE users SET role_id = 2 WHERE id=". $id);
        $stmt->execute();
    }
    public function promotionTrainingPlanMod($id)
    {
        $stmt = $this->db->prepare("UPDATE users SET role_id = 4 WHERE id=". $id);
        $stmt->execute();
    }
    public function unpromotionMod($id)
    {
        $stmt = $this->db->prepare("UPDATE users SET role_id = 1 WHERE id=". $id);
        $stmt->execute();
    }
    public function getComments($id)
    {
        $sql = "SELECT * FROM comments WHERE product_id = ".$id;
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        // if(!empty($user_id))
        // {
        //     return $stmt->fetch(); // do pojedynczego, bo przy jednym fetchAll to w takim przypadku by trzeba bylo dodac do zmiennej $zmienna[0]["yacht_name"] zamiast $zmienna["yacht_name"]
        // }
        // else
        // {
            return $stmt->fetchAll(); // zeby wszystkie pobralo
        // }
    }
    public function getFitatuProducts()
    {
        $sql = "SELECT * FROM fitatu_products";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        // if(!empty($user_id))
        // {
        //     return $stmt->fetch(); // do pojedynczego, bo przy jednym fetchAll to w takim przypadku by trzeba bylo dodac do zmiennej $zmienna[0]["yacht_name"] zamiast $zmienna["yacht_name"]
        // }
        // else
        // {
            return $stmt->fetchAll(); // zeby wszystkie pobralo
        // }
    }
    public function getFitatuProductNameById($id)
    {
        $sql = "SELECT name FROM fitatu_products WHERE id=".$id;
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(); // do pojedynczego, bo przy jednym fetchAll to w takim przypadku by trzeba bylo dodac do zmiennej $zmienna[0]["yacht_name"] zamiast $zmienna["yacht_name"]

    }
    public function getFitatuProductKcalById($id)
    {
        $sql = "SELECT kcal FROM fitatu_products WHERE id=".$id;
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(); // do pojedynczego, bo przy jednym fetchAll to w takim przypadku by trzeba bylo dodac do zmiennej $zmienna[0]["yacht_name"] zamiast $zmienna["yacht_name"]

    }
    public function getFitatuProductProteinById($id)
    {
        $sql = "SELECT protein FROM fitatu_products WHERE id=".$id;
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(); // do pojedynczego, bo przy jednym fetchAll to w takim przypadku by trzeba bylo dodac do zmiennej $zmienna[0]["yacht_name"] zamiast $zmienna["yacht_name"]

    }
    public function getFitatuProductFatById($id)
    {
        $sql = "SELECT fat FROM fitatu_products WHERE id=".$id;
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(); // do pojedynczego, bo przy jednym fetchAll to w takim przypadku by trzeba bylo dodac do zmiennej $zmienna[0]["yacht_name"] zamiast $zmienna["yacht_name"]

    }
    public function getFitatuProductCarbsById($id)
    {
        $sql = "SELECT carbs FROM fitatu_products WHERE id=".$id;
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(); // do pojedynczego, bo przy jednym fetchAll to w takim przypadku by trzeba bylo dodac do zmiennej $zmienna[0]["yacht_name"] zamiast $zmienna["yacht_name"]

    }
    public function getFitatuProductsBreakfast($user_id, $date)
    {
        $sql = "SELECT * FROM fitatu WHERE which_meal = 'breakfast' AND user_id=".$user_id." AND date='".$date."'";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        // if(!empty($user_id))
        // {
        //     return $stmt->fetch(); // do pojedynczego, bo przy jednym fetchAll to w takim przypadku by trzeba bylo dodac do zmiennej $zmienna[0]["yacht_name"] zamiast $zmienna["yacht_name"]
        // }
        // else
        // {
            return $stmt->fetchAll(); // zeby wszystkie pobralo
        // }
    }
    public function getFitatuProductsLunch($user_id, $date)
    {
        $sql = "SELECT * FROM fitatu WHERE which_meal = 'lunch' AND user_id=".$user_id." AND date='".$date."'";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        // if(!empty($user_id))
        // {
        //     return $stmt->fetch(); // do pojedynczego, bo przy jednym fetchAll to w takim przypadku by trzeba bylo dodac do zmiennej $zmienna[0]["yacht_name"] zamiast $zmienna["yacht_name"]
        // }
        // else
        // {
            return $stmt->fetchAll(); // zeby wszystkie pobralo
        // }
    }
    public function getFitatuProductsDinner($user_id, $date)
    {
        $sql = "SELECT * FROM fitatu WHERE which_meal = 'dinner' AND user_id=".$user_id." AND date='".$date."'";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        // if(!empty($user_id))
        // {
        //     return $stmt->fetch(); // do pojedynczego, bo przy jednym fetchAll to w takim przypadku by trzeba bylo dodac do zmiennej $zmienna[0]["yacht_name"] zamiast $zmienna["yacht_name"]
        // }
        // else
        // {
            return $stmt->fetchAll(); // zeby wszystkie pobralo
        // }
    }
    public function addComment($user_id, $product_id, $text)
    {
        $user_id = strip_tags($user_id);
        $product_id = strip_tags($product_id);
        $text = strip_tags($text);
        $errorMsg = []; //zmienna tablicowa
        if(empty($errorMsg))
        {
            try
            {
                $stmt = $this->db->prepare("INSERT INTO comments(user_id, product_id, text) VALUES (?,?,?)");
                $stmt->execute([$user_id, $product_id, $text]);
                return true;
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }
        $_SESSION["errorMsg"] = $errorMsg;//ustawiamy w sesji bledy jesli sa
        return false;
    }
}
?>