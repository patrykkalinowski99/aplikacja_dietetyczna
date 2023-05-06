<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <a class="navbar-brand" href="index.php">
        <img class="dumbell-icon color-purple-hover" style="width: 50px;" src="public/img/dumbbell.png" alt="logo">
    </a>
    <div class="collapse navbar-collapse bg-white" id="navbarNavDropdown">
        <ul class="navbar-nav mx-auto">
        <li class="nav-item">
            <a class="nav-link color-purple" href="index.php">Strona główna</a>
        </li>
        <li class="nav-item">
            <a class="nav-link color-purple-hover" href="index.php#content-calculator">Kalkulator</a>
        </li>
        <li class="nav-item">
            <a class="nav-link color-purple-hover" href="index.php#content-training-plans">Zestawy treningowe</a>
        </li>
        <li class="nav-item">
            <a class="nav-link color-purple-hover" href="index.php#content-diet-plans">Diety</a>
        </li>
        <?php if(!$funkcje->isLoggedIn()): ?><!-- Gdy nie jest zalogowany -->
        <li class="nav-item">
            <a class="nav-link color-purple-hover" href="login.php">Logowanie</a>
        </li>
        <li class="nav-item">
            <a class="nav-link color-purple-hover" href="register.php">Rejestracja</a>
        </li>
        <?php else: ?><!-- Gdy jest zalogowany -->
            <div class="dropdown">
            <li class="nav-item">
                <?php 
                    $account = $funkcje->getAccountDetailsById($funkcje->getLoggedAccountId()); 
                ?>
                <button class="dropbtn"><?php echo $account['imie']; ?></button>
                <div class="dropdown-content">
                <?php if($account['role_id'] != 1){echo "<a class='nav-link color-purple-hover' href='/adminpanel.php'>Panel administratora</a>";}?>
                <a class="nav-link color-purple-hover" href="/account.php">Moje konto</a>
                <a class="nav-link color-purple-hover" href="/accountedit.php">Edytuj moje konto</a>
                <a class="nav-link color-purple-hover" href="/logout.php">Wyloguj</a>
                </div>
        </li>
            </div>
            <li class="nav-item">
                <a class="nav-link color-purple-hover" href="shoppingcart.php">Koszyk</a>
            </li>
            <li class="nav-item">
                <a class="nav-link color-purple-hover" href="fitatu.php">Licznik kalorii</a>
            </li>
        <?php endif; ?>
        </ul>
    </div>
    <img class="dumbell-icon image-transparent" style="width: 50px;" src="public/img/dumbbell.png" alt="logo">
    <button class="navbar-toggler bg-white ms-auto" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>