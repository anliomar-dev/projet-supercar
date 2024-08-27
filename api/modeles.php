<?php
    // database connexion
    include('../php/connexionDB.php');
    header('Content-Type: application/json; charset=utf-8');

    //check if there is a parameter brand_id
    if (isset($_GET['brand_id'])) {
        // make sure brand_id is an integer
        $brand_id = intval($_GET['brand_id']);

        if ($brand_id <= 0) {
            http_response_code(400); // bad request
            echo json_encode(['error' => 'Invalid brand_id parameter.']);
            exit;
        }

        // check if brand exists
        $check_brand_query = "SELECT COUNT(*) as count FROM marque WHERE IdMarque = ?";
        $check_stmt = mysqli_prepare($DB, $check_brand_query);
        mysqli_stmt_bind_param($check_stmt, "i", $brand_id);
        mysqli_stmt_execute($check_stmt);
        $result = mysqli_stmt_get_result($check_stmt);
        $brand_exists = mysqli_fetch_assoc($result)['count'] > 0;

        if (!$brand_exists) {
            http_response_code(404); // no brand found
            echo json_encode(['error' => 'La marque n\'existe pas.']);
            mysqli_close($DB);
            exit;
        }

        $sql = "SELECT COUNT(*) AS total FROM modele WHERE IdMarque = ?";
        $stmt_sql = mysqli_prepare($DB, $sql);
        mysqli_stmt_bind_param($stmt_sql, "i", $brand_id);
        mysqli_stmt_execute($stmt_sql);
        $count = mysqli_stmt_get_result($stmt_sql);
        $total = mysqli_fetch_assoc($count)['total'];
        $limit = 2;
        $total_pages = ceil($total / $limit);

        // current page
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        // select all models related to the brand
        $query = "SELECT modele.*, images.*, marque.*
                FROM modele
                LEFT JOIN images ON modele.IdModele = images.IdModele
                LEFT JOIN marque ON modele.IdMarque = marque.IdMarque
                WHERE modele.IdMarque = ?
                ORDER BY modele.IdModele
                LIMIT ? OFFSET ?";

        $stmt = mysqli_prepare($DB, $query);
        mysqli_stmt_bind_param($stmt, "iii", $brand_id, $limit, $offset);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            $models = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $model_id = $row['IdModele'];
                // add the model to the array models
                if (!isset($models[$model_id])) {
                    $models[$model_id] = [
                        'IdModele' => $row['IdModele'],
                        'Nom' => $row['NomModele'] ? $row['NomModele'] : 'Nom non disponible',
                        'IdMarque' => $row['IdMarque'],
                        'NomMarque' => $row['NomMarque'],
                        'logo' => $row['logo'],
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
                echo json_encode(array(
                    'page' => $page,
                    'total_pages' => $total_pages,
                    'models' => $data
                ));
            }
        } else {
            http_response_code(500); // server side error
            echo json_encode(['error' => 'Erreur lors de la récupération des données.']);
        }

        // close connexion with database
        mysqli_close($DB);
    } else {
        http_response_code(400); // bad request
        echo json_encode(['error' => 'Veuillez spécifier un identifiant.']);
    }
?>
