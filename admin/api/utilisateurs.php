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
        $first_name = $data['first_name'] ?? '';
        $last_name = $data['last_name'] ?? '';
        $phone = $data['phone'] ?? '';
        $address = $data['address'] ?? '';
        $email = $data['email'] ?? '';
        $is_admin = $data['is_admin'] ?? '';
        $is_superadmin = $data['is_superadmin'] ?? '';
        $password = $data['password'] ? $data['password'] : '';
            // create associated array for new user: the name of each key is the same as the name of the column in the database
        $new_user = [
          'Prenom' => $first_name,
          'Nom' => $last_name,
          'Adresse' => $address,
          'NumTel' => $phone,
          'Email' => $email,
          'MotDePasse' => $password,
          'est_admin' => $is_admin,
          'est_superadmin' => $is_superadmin
        ];
        // check if all fields are not empty
        if (!empty($first_name) && !empty($last_name) && !empty($phone)
            && !empty($address) && !empty($email) && !empty($password)) {
        
          // verify is the email is already taken (funciton is_email_already_exist is defined in super-car/php/utils.php)
          $is_email_already_exist = is_email_already_exist($email);
          if ($is_email_already_exist){
            $response = [
                'status' => 'error',
                'message' => 'Un compte avec cet email existe deja.'
                ];
          }else{
              //create new user(funciton create_uesr() is defined in super-car/php/utils.php)
              $result = create_user($first_name, $last_name, $address, $phone, $email, $password);
              if($result){
                  $response = [
                      'status' => 'success',
                      'message' => 'Votre compte a été crée avec succès.',
                  ];
              }else{
                  $response = [
                      'status' => 'error',
                      'message' => 'cannot create account: internal server error',
                  ];
              }
            }
        }else{
          $response = [
            'status' => 'error',
            'message' => 'tous les champs doivent être remplis'
          ];
        }
        break;
      
      case 'PUT':
        $user_id = $data['user_id'];
        break;
      
      case 'DELETE':
        $ids = $data['ids'];
        $delete_user = delete_rows("utilisateur", "IdUtilisateur", $ids);
        if($delete_user){
          $response = [
            'status' => 'success',
            'message' => 'Compte(s) supprimé avec succès'
          ];
          echo json_encode($response);
          exit();
        }else{
          $response = [
            'status' => 'error',
            'message' => 'erreur lors de la suppression du compte',
          ];
          echo json_encode($response);
          exit();
        }
        break;
      
      default:
        // HTTP method not allowed
        $response = [
          'status' => 'error',
          'message' => 'HTTP method not allowed'
        ];
        break;
    }
    echo json_encode($response);
    exit;
  }
  //https://pdtfvsz7-80.asse.devtunnels.ms/
?>
