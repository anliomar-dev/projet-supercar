<?php
// Database connection
include('../../php/connexionDB.php');
include_once('../php/functions_get_data.php');
header('Content-Type: application/json; charset=utf-8');

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    // Check if brand_id parameter is set
    if (isset($_GET['brand_id'])) {
        $brand_id = intval($_GET['brand_id']);

        // Validate brand_id
        if ($brand_id <= 0) {
            http_response_code(400); // Bad request
            echo json_encode(['error' => 'Invalid brand_id parameter.']);
            exit;
        }
        $brand_exists = is_row_exist($brand_id, 'marque', 'IdMarque');

        if (!$brand_exists) {
            http_response_code(404); // Brand not found
            echo json_encode(['error' => 'la marque n\'éxiste pas.']);
            mysqli_close($DB);
            exit;
        }
        get_all_models($brand_id);

        // Close database connection
        mysqli_close($DB);
    }else if(isset($_GET['modele_id'])){
        $model_id = intval($_GET['modele_id']);
        $model_exists = is_row_exist($model_id, 'modele', 'IdModele');
        if (!$model_exists) {
            $response = [
                'status' => 'error',
                'message' => 'modele non trouvé'
            ];
            echo json_encode($response);
            exit;
        }
        echo get_modele_infos($model_id);
    }else {
        http_response_code(400); // Bad request
        echo json_encode(['error' => 'paramètre invalid(brand_id ou modele_id.']);
        exit;
    }
}else if(($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'PUT' || $_SERVER['REQUEST_METHOD'] === 'DELETE')){
    ;
}
?>
