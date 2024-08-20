<?php
    // database connexion
    include('../database/connexionDB.php');
    header('Content-Type: application/json; charset=utf-8');

    //check if there parameter brand_id
    if (isset($_GET['brand_id'])) {
        // meke sure brand_id si a integer
        $brand_id = intval($_GET['brand_id']);

        if ($brand_id <= 0) {
            http_response_code(400); // bade request
            echo json_encode(['error' => 'Invalid brand_id parameter.']);
            exit;
        }

        // check id brand exist
        $check_brand_query = "SELECT COUNT(*) as count FROM marque WHERE IdMarque = ?";
        $check_stmt = mysqli_prepare($DB, $check_brand_query);
        mysqli_stmt_bind_param($check_stmt, "i", $brand_id);
        mysqli_stmt_execute($check_stmt);
        $result = mysqli_stmt_get_result($check_stmt);
        $brand_exists = mysqli_fetch_assoc($result)['count'] > 0;

        if (!$brand_exists) {
            http_response_code(404); // no brand found
            echo json_encode(['error' => 'La marque n\'éxiste pas.']);
            mysqli_close($DB);
            exit;
        }

        // select all medels
        $query = "SELECT modele.IdModele, modele.NomModele, modele.IdMarque, images.IdImage, images.Nom
                FROM modele
                LEFT JOIN images ON modele.IdModele = images.IdModele
                WHERE modele.IdMarque = ?;";
        $stmt = mysqli_prepare($DB, $query);
        mysqli_stmt_bind_param($stmt, "i", $brand_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($result) {
            $models = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $model_id = $row['IdModele'];
                // add the model to to array models
                if (!isset($models[$model_id])) {
                    $models[$model_id] = [
                        'IdModele' => $row['IdModele'],
                        'Nom' => $row['NomModele'] ? $row['NomModele'] : 'Nom non disponible',
                        'IdMarque' => $row['IdMarque'],
                        'Images' => []
                    ];
                }
                // add image in the array for images related to the model
                if ($row['IdImage'] && $row['Nom']) {
                    $models[$model_id]['Images'][] = [
                        'id' => $row['IdImage'],
                        'Nom' => $row['Nom']
                    ];
                }
            }

            // convert data to json
            $data = array_values($models);
            if (empty($data)) {
                http_response_code(404);
                echo json_encode(['error' => 'Aucun modèle associé à cette marque.']);
            } else {
                header('Content-Type: application/json');
                echo json_encode($data);
            }
        } else {
            http_response_code(500); // server side error
            echo json_encode(['error' => 'Erreur lors de la récupération des données.']);
        }

        // close connexion with database
        mysqli_close($DB);
    } else {
        http_response_code(400); // bade request
        echo json_encode(['error' => 'Veuillez spécifier un identifiant.']);
    }
?>
