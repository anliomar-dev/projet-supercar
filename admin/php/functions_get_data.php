<?php
  // Database connection
  include_once('../../php/connexionDB.php');
  include_once('../php/utils.php');

  function get_all_users(int $page) {
    global $DB;
    
    // Modify the query to fetch user details
    $count = "SELECT count(IdUtilisateur) AS total FROM utilisateur";
    
    // Execute the query
    $result = mysqli_query($DB, $count);
    $row = mysqli_fetch_assoc($result);
    $total = $row['total'];
    $limit = 2;
    $total_pages = ceil($total / $limit);
    $offset = ($page - 1) * $limit;
    if($page > $total_pages || $page <= 0 || !is_numeric($page)){
      // Initialize a default response
      $response = [
        'status' => 'error',
        'message' => 'invalid parameter page'
      ];
      return json_encode($response);
      mysqli_close($DB);
      exit;
    }

    $users = "SELECT * FROM utilisateur LIMIT ? OFFSET ?";
    $stmt = mysqli_prepare($DB, $users);
    mysqli_stmt_bind_param($stmt, "ii", $limit, $offset);
    mysqli_stmt_execute($stmt);
    $users_result = mysqli_stmt_get_result($stmt);
    if($users_result){
      // Initialize an array to hold all users
      $users = [];
      // Fetch each row and append to the $users array
      while ($row = mysqli_fetch_assoc($users_result)) {
        $users[] = [
          'id' => $row['IdUtilisateur'],
          'first_name' => $row['Prenom'],
          'last_name' => $row['Nom'],
          'email' => $row['Email']
        ];
      }
      
      // Return the array of users as JSON
      echo json_encode([
        'page' => $page,
        'total_pages' => $total_pages,
        'users' => $users
    ]);
    }
  }


    /**
   * Check if a user exists in the database.
   * 
   * @param int $user_id The ID of the user to check.
   * @return string JSON encoded data containing user information
   */
  function get_user($user_id){
    global $DB;
    if(is_numeric($user_id)){
      $user_id = intval($user_id);
      if(!is_user_exist($user_id)){
        $response = [
          'status' => 'error',
          'message' => 'Utilisateur non trouvé'
        ];
        echo json_encode($response);
        exit;
      }
      $user = "SELECT * FROM utilisateur WHERE IdUtilisateur = ?";
      $stmt = mysqli_prepare($DB, $user);
      mysqli_stmt_bind_param($stmt, "i", $user_id);
      mysqli_stmt_execute($stmt);

      $result = mysqli_stmt_get_result($stmt);
      if($row = mysqli_fetch_assoc($result)){
        $user = [
          "user_id" => $row['IdUtilisateur'],
          "first_name" => $row['Prenom'],
          "last_name" => $row['Nom'],
          "email" => $row['Email'],
          "address" => $row['Adresse'],
          "phone" => $row['NumTel'],
          "is_admin" => $row['est_admin'],
          "is_superuser" => $row['est_superadmin']
        ];
        return json_encode($user);
      }else{
        $response = [
          'status' => 'error',
          'message' => 'Utilisateur non trouvé'
        ];
        echo json_encode($response);
      }

    }else{
      $response = [
        'status' => 'error',
        'message' => 'l\'id de l\'utilisateur doit être un nombre entier'
      ];
      echo json_encode($response);
    }
  }


  function get_all_models(int $brand_id){
    global $DB;
    // Get total number of models for pagination
    $sql = "SELECT COUNT(*) AS total FROM modele WHERE IdMarque = ?";
    $stmt_sql = mysqli_prepare($DB, $sql);
    mysqli_stmt_bind_param($stmt_sql, "i", $brand_id);
    mysqli_stmt_execute($stmt_sql);
    $count = mysqli_stmt_get_result($stmt_sql);
    $total = mysqli_fetch_assoc($count)['total'];
    $limit = 2;
    $total_pages = ceil($total / $limit);

    // Current page
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    // Query to retrieve models with pagination
    $query = "SELECT modele.*, marque.*
            FROM modele
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
            // Add the model to the array
            if (!isset($models[$model_id])) {
                $models[$model_id] = [
                    'IdModele' => $row['IdModele'],
                    'NomModele' => $row['NomModele'] ? $row['NomModele'] : 'Name not available',
                    'IdMarque' => $row['IdMarque'],
                    'NomMarque' => $row['NomMarque'],
                    'Annee' => $row['Annee'],
                    'Prix' => $row['Prix'],
                    'TypeMoteur' => $row['TypeMoteur'],
                    'logo' => $row['logo'],
                ];
            }
        }

        // Convert data to JSON
        $data = array_values($models);
        if (empty($data)) {
            http_response_code(404);
            echo json_encode(['error' => 'aucun modèle trouvé.']);
        } else {
            echo json_encode([
                'page' => $page,
                'total_pages' => $total_pages,
                'models' => $data
            ]);
        }
    } else {
        http_response_code(500); // Server error
        echo json_encode(['error' => 'Error retrieving data.']);
    }
  }

  function get_modele_infos($model_id){
    global $DB;
    $query = "SELECT * FROM modele WHERE IdModele = ?";
    $stmt = mysqli_prepare($DB, $query);
    mysqli_stmt_bind_param($stmt, "i", $model_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($result) {
      $model = mysqli_fetch_assoc($result);
      return json_encode($model);
      }
  }

?>
