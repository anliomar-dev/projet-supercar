<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SuperCar Navbar</title>
    <link href="../stylesheets/navbar.css" rel="stylesheet">
    <style>
        .navbar-custom {
            background-color: #1c1e22;
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: #ffffff;
        }
        .navbar-custom .nav-link:hover {
            color: #00ff99;
        }
        .navbar-custom .btn-login {
            border-color: #ffffff;
            color: #ffffff;
        }
        .navbar-custom .btn-signup {
            background-color: #00b33c;
            color: #ffffff;
        }
        .navbar-nav {
            margin-left: auto;
            margin-right: auto;
        }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=UTF8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba%28255, 255, 255, 0.5%29' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../medias/images/logos&icones/supercar_logo_blanc.webp" alt="SuperCar" style="height: 50px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/super-car/">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Marques</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Essai</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Événements</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a class="btn btn-login me-2" href="/super-car/supercar/signin">Login</a>
                    <a class="btn btn-signup" href="/super-car/supercar/signup">Sign up</a>
                </div>
            </div>
        </div>
    </nav>
</body>
</html>
