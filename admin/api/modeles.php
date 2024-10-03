<?php
// Database connection
include('../../php/connexionDB.php');
include_once('../php/functions_get_data.php');
$LOGIN_URL = "/super-car/admin/login";
$SESSION_EXPIRED_URL = "/super-car/admin/session_expired";
is_user_authenticated(2, $LOGIN_URL, $SESSION_EXPIRED_URL);

header('Content-Type: application/json; charset=utf-8');
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    // Check if brand_id parameter is set
    if (isset($_GET['brand_id'])) {
        $brand_id = intval($_GET['brand_id']);
        // Current page
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
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
        echo get_rows_with_clause(
            "modele", 
            "IdMarque", 
            $brand_id, 
            "int", 
            $limit = 2, 
            $page
        );
    }else if(isset($_GET['modele'])){
        $modele = $_GET['modele'];
        // If 'contact' is 'all', retrieve all contact with pagination
        if ($modele == 'all') {
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;  // Default value of 1 if 'page' is not set
            echo get_all_rows("modele", 3, $page);
            // If 'contact' is a numeric ID, handle different HTTP methods
        } elseif (is_numeric($modele)) {
            $modele_id = intval($modele);
            // Fetch contact info
            echo get_row_details("modele", "IdModele", $modele_id);
        }else{
            $response = [
                'status' => 'error',
                'message' => 'paramètre modele est invalid'
                ];
            echo json_encode($response);
            exit;
        }
    }else {
        http_response_code(400); // Bad request
        echo json_encode(['error' => 'paramètre invalid(brand_id ou modele_id.']);
        exit;
    }
}else if(($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'PUT' || $_SERVER['REQUEST_METHOD'] === 'DELETE')){
    ;
}
?>
