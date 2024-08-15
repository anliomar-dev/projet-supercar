<?php
    // Inclure le fichier de connexion à la base de données
    include('../database/connexionDB.php');
    header('Content-Type: application/json; charset=utf-8');

    // Vérifiez si le paramètre brand_id est présent
    if (isset($_GET['brand_id'])) {
        // Assurez-vous que brand_id est un entier
        $brand_id = intval($_GET['brand_id']);

        if ($brand_id <= 0) {
            http_response_code(400); // Mauvaise requête
            echo json_encode(['error' => 'Invalid brand_id parameter.']);
            exit;
        }

        // Vérifiez si la marque existe
        $check_brand_query = "SELECT COUNT(*) as count FROM marque WHERE IdMarque = ?";
        $check_stmt = mysqli_prepare($DB, $check_brand_query);
        mysqli_stmt_bind_param($check_stmt, "i", $brand_id);
        mysqli_stmt_execute($check_stmt);
        $result = mysqli_stmt_get_result($check_stmt);
        $brand_exists = mysqli_fetch_assoc($result)['count'] > 0;

        if (!$brand_exists) {
            http_response_code(404); // Marque non trouvée
            echo json_encode(['error' => 'La marque n\'éxiste pas.']);
            mysqli_close($DB);
            exit;
        }

        // Requête SQL préparée pour sélectionner tous les modèles associés à la marque
        $query = "SELECT modele.*, images.Nom
                FROM modele
                LEFT JOIN images ON modele.IdModele = images.IdModele
                WHERE modele.IdMarque = ?;";
        $stmt = mysqli_prepare($DB, $query);
        mysqli_stmt_bind_param($stmt, "i", $brand_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            $donnees = mysqli_fetch_all($result, MYSQLI_ASSOC);

            // Vérifiez si des données ont été récupérées
            if (empty($donnees)) {
                http_response_code(404); // Ressource non trouvée
                echo json_encode(['error' => 'Aucun modèle associé a cette marque.']);
            } else {
                // Définissez l'en-tête HTTP pour JSON
                header('Content-Type: application/json');
                // Convertissez les données en JSON et renvoyez-les
                echo json_encode($donnees);
            }

        } else {
            http_response_code(500); // Erreur interne du serveur
            echo json_encode(['error' => 'Erreur lors de la récupération des données.']);
        }

        // Fermez la connexion à la base de données
        mysqli_close($DB);

        } else {
        http_response_code(400); // Mauvaise requête
        echo json_encode(['error' => 'veuillez specifier un idenfiant.']);
    }
?>
