<?php
// Démarrer une session si elle n'est pas déjà active
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Vérification de l'ID modèle et gestion de la redirection 404
if (isset($_GET['modele']) && is_numeric($_GET['modele'])) {
    $modele_id = (int)$_GET['modele']; // Conversion sécurisée en entier
} else {
    header("Location: /super-car/404.php"); // Redirection vers la page 404
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../stylesheets/navbar.css" rel="stylesheet">
    <link href="../stylesheets/model_details.css" rel="stylesheet">
    <title>details modele</title>
</head>
<body class="position-relative">
<?php
include_once("../components/navbar.php");
?>

<div class="container my-5">
    <div class="row">
        <!-- Image principale -->
        <div class="col-md-6">
            <img src="https://via.placeholder.com/600x400" alt="Mercedes EQB 300" class="car-image img-fluid mb-3">
            <div class="d-flex justify-content-center">
                <img src="https://via.placeholder.com/100x100" class="thumbnail mx-1" alt="Miniature 1">
                <img src="https://via.placeholder.com/100x100" class="thumbnail mx-1" alt="Miniature 2">
                <img src="https://via.placeholder.com/100x100" class="thumbnail mx-1" alt="Miniature 3">
                <img src="https://via.placeholder.com/100x100" class="thumbnail mx-1" alt="Miniature 4">
            </div>
        </div>

        <!-- Informations sur la voiture -->
        <div class="col-md-6">
            <h1 class="mb-3">Mercedes Benz</h1>
            <h4 class="text-muted">Modèle : <span class="fw-bold">EQB 300</span></h4>

            <div class="my-3">
                <button class="btn btn-custom">Images Intérieur</button>
            </div>

            <div class="d-flex align-items-center my-3">
                <div class="color-circle" style="background-color: black;"></div>
                <div class="color-circle" style="background-color: green;"></div>
                <div class="color-circle" style="background-color: blue;"></div>
            </div>

            <div class="details-card mt-4">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Modèle :</strong> EQB 300</p>
                        <p><strong>Année :</strong> 2021</p>
                        <p><strong>Prix :</strong> 200000 e</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Transmission :</strong> Automatique</p>
                        <p><strong>Type :</strong> SUV électrique</p>
                        <p><strong>carburant :</strong> essence</p>
                    </div>
                </div>
                <hr>
                <h5>Description</h5>
                <p class="overflow-y-scroll">
                    Le Mercedes EQB 300 est un SUV compact entièrement électrique offrant une autonomie impressionnante,
                    un intérieur raffiné, et des technologies de pointe. Parfait pour les amateurs d’innovation et de
                    performances écologiques.
                </p>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
</body>
</html>