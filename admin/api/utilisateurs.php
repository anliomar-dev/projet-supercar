<?php
  // Database connection
  include_once('../../php/connexionDB.php');
  include_once('../../php/utils.php');
  include_once('../php/utils.php');
  include_once('../php/functions_get_data.php');
  include_once('../php/del-update_functions.php');
  session_start();
  // Set the content type as JSON
  header('Content-Type: application/json; charset=utf-8');

  // Initialize response array
  $response = [
    'status' => 'error',
    'message' => 'HTTP method not allowed'
  ];
  // Check if the request method is POST
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['user'])) {
      $user = $_GET['user'];
      
      // If 'user' is 'all', retrieve all users with pagination
      if ($user == 'all') {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;  // Default value of 1 if 'page' is not set
        echo get_all_users($page);
      
      // If 'user' is a numeric ID, handle different HTTP methods
      } elseif (is_numeric($user)) {
        $user_id = intval($user);
          echo get_user_details($user_id);  // Fetch user info
      }else{
        $response = [
          'status' => 'error',
          'message' => 'paramètre user est invalid'
          ];
        echo json_encode($response);
        exit;
      }
    }else{
      $response = [
        'status' => 'error',
        'message' => 'le paramètre user est manquant'
      ];
      echo json_encode($response);
      exit;
    }
  }elseif(($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'PUT' || $_SERVER['REQUEST_METHOD'] === 'DELETE')){
    $method = $_SERVER['REQUEST_METHOD'];
    // Get the request body
    $input = file_get_contents('php://input');  
    // Convert the received JSON data into an associative array
    $data = json_decode($input, true);
    
    //$csrf_token = $data['csrfToken'];
    
    // Check if the CSRF token is valid
    /*if($csrf_token !== $_SESSION['csrf_token']){
        $response = [
          'status' => 'error',
          'message' => 'token  csrf non valid'
        ];
        echo json_encode($response);
        exit;
    }*/

    // Handle different HTTP methods
    switch ($method) {
      case 'POST':
        $csrf_token = $data['csrf_token'];
        if(!is_csrf_valid($csrf_token, $_SESSION['csrf_token'])){
          $response = return_msg_json("403", 'token csrf non valid');
          echo json_encode($response);
          exit;
        }else{
          // Handle POST request
          $user_data = $data['data'];
          $insert = insertRcord("utilisateur", $user_data);
          if($insert){
            $response = return_msg_json('success', 'utilisateur ajouté avec succès');
          }else{
            $response = return_msg_json('error', 'erreur lors de l\'ajout de l\'utilisateur');
          }
        }
        break;
      
      case 'PUT':
        $user_id = $data['user_id'];
        break;
      
      case 'DELETE':
        $ids = $data['ids'];
        $delete_user = delete_rows("utilisateur", "IdUtilisateur", $ids);
        if($delete_user){
          $response = return_msg_json("success", 'Compte(s) supprimé avec succès');
        }else{
        }
        break;
      
      default:
        // HTTP method not allowed
        $response = return_msg_json('error', 'HTTP method not allowed');
        break;
    }
    echo json_encode($response);
    exit;
  }
  //https://pdtfvsz7-80.asse.devtunnels.ms/
?>
