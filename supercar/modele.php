<?php
    include '../php/connexionDB.php';
    global $DB;
    // Démarrer une session si elle n'est pas déjà active
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    // Vérification de l'ID modèle et gestion de la redirection 404
    if (isset($_GET['modele']) && is_numeric($_GET['modele'])) {
        $modele_id = (int)$_GET['modele']; // Conversion sécurisée en entier
        $query = "SELECT modele.*, marque.NomMarque 
            FROM modele
            JOIN marque ON modele.IdMarque = marque.IdMarque
            WHERE modele.IdModele = ?;
          ";
        $stmt = mysqli_prepare($DB, $query);
        mysqli_stmt_bind_param($stmt, 'i', $modele_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if($result){
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $modele = $row["NomModele"];
            $marque = $row["NomMarque"];
            $id = $row["IdModele"];
            $prix = $row["Prix"];
            $annee = $row["Annee"];
            $type = $row["TypeMoteur"];
            $carburant = $row["Carburant"];
            $description = $row["Description"];
            $transmission = $row["BoiteVitesse"];
        }
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
            <h1 class="mb-3"><?php echo $marque;?></h1>
            <h4 class="text-muted">Modèle : <span class="fw-bold"><?php echo $modele;?></span></h4>

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
                        <p><strong>Modèle :</strong> <?php echo $modele;?></p>
                        <p><strong>Année :</strong> <?php echo $annee; ?></p>
                        <p><strong>Prix :</strong> <?php echo $prix; ?>€</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Transmission :</strong> <?php echo $transmission ;?></p>
                        <p><strong>Type :</strong> <?php echo $type; ?></p>
                        <p><strong>carburant :</strong> <?php echo $carburant; ?></p>
                    </div>
                </div>
                <hr>
                <h5>Description</h5>
                <p class="overflow-y-scroll">
                    <?php echo $description; ?>
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