<?php
  // Database connection
  include_once('../../php/connexionDB.php');
  include_once('../php/functions.php');
  
  // Set the content type as JSON
  header('Content-Type: application/json; charset=utf-8');

  // Initialize response array
  $response = array('success' => false);

  // Check if 'user' parameter is set
  if (isset($_GET['user'])) {
    $user = $_GET['user'];
    
    // If 'user' is 'all', retrieve all users with pagination
    if ($user == 'all') {
      $page = isset($_GET['page']) ? intval($_GET['page']) : 1;  // Default value of 1 if 'page' is not set
      echo get_all_users($page);
    
    // If 'user' is a numeric ID, handle different HTTP methods
    } elseif (is_numeric($user)) {
      $user_id = intval($user);
      $method = $_SERVER['REQUEST_METHOD'];  // Corrected typo
      
      switch ($method) {
        case 'GET':
          echo get_user($user_id);  // Fetch user info
          break;
        
        case 'POST':
          // Code to create a new user
          break;
        
        case 'PUT':
          // Code to update an existing user
          break;
        
        case 'DELETE':
          // Code to delete a user
          break;
        
        default:
          // HTTP method not allowed
          $response = [
            'status' => 'error',
            'message' => 'HTTP method not allowed'
          ];
          echo json_encode($response);
          break;
      }
    }
  
  } else {
    // No parameters provided
    $response['error'] = "No parameters set.";
    echo json_encode($response);
  }
?>
