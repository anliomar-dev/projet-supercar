<?php
    include_once('../php/utils.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $login_url = "/supercar/signin.php";
        if(isset($_POST['logout'])) {
            logout($login_url);
        }
    }
?>

<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="../medias/images/logos/supercar_logo_blanc.webp" alt="SuperCar logo" style="height: 50px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/supercar/marques.php">Marques</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/supercar/essai.php">Essai</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/supercar/evennements.php">Événements</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/supercar/contact.php">Contact</a>
                </li>
            </ul>
            <div class="d-flex">
                <?php
                    if(isset($_SESSION['email'])){
                        include_once('dropdown_accountSettings.php');
                    }else{
                        echo"
                            <a class='btn btn-login me-2' href='/supercar/signin.php'>Login</a>
                            <a class='btn btn-signup' href='/supercar/signup.php'>Sign up</a>
                        ";
                    }
                ?>
            </div>
        </div>
    </div>
</nav>

