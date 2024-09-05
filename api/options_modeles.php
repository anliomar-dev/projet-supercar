<?php
  // Database connection
  include('../php/connexionDB.php');
  header('Content-Type: application/json; charset=utf-8');
  if(isset($_GET['brand_id'])){
    $brand_id = intval($_GET['brand_id']);

    // Validate brand_id
    if ($brand_id <= 0) {
        http_response_code(400); // Bad request
        echo json_encode(['error' => 'Invalid brand_id parameter.']);
        exit;
    }

    $query = "SELECT ";

  }else{
    echo json_encode(array("error" => "brand_id is required"));
  }
?>