<?php
  // Database connection
  include_once('../../php/connexionDB.php');
  include_once('../php/utils.php');

    /**
   * Returns all users in JSON format.
   *
   * @param int $page The page number for pagination.
   * @return json The JSON containing the list of users.
   */
  function get_all_users(int $page): string {
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
 * Returns the details of the user whose ID is passed as a parameter.
 *
 * @param int $user_id The ID of the user to retrieve.
 * @return string JSON encoded data containing user information.
 */
  function get_user_details(int  $user_id): string {

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

  /**
   * Returns all modeles in JSON format.
   *
   * @param int $brand_id The id brand we want to get all modeles.
   * @return json The JSON containing the list of modeles.
   */
  function get_all_models_by_brand(int $brand_id): string{
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

  /**
 * Returns the details of the modele which ID is passed as a parameter.
 *
 * @param int $modele_id The ID of the modele to retrieve.
 * @return string JSON encoded data containing modele information.
 */
  function get_modele_details(int $model_id): string{
    global $DB;
    $query = "SELECT * FROM modele WHERE IdModele = ?";
    $stmt = mysqli_prepare($DB, $query);
    mysqli_stmt_bind_param($stmt, "i", $model_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($result) {
      $model = mysqli_fetch_assoc($result);
      return json_encode($model);
    }else{
      echo json_encode(
        [
          'status' => 'error',
          'message' => 'modele non trouvé.'
        ]
      );
    }
  }


  /**
   * Returns all contacts in JSON format.
   *
   * @return json The JSON containing the list of contacts.
   */
  function get_all_contacts(): string {
    global $DB;
    
    // Préparer la requête SQL
    $query = "SELECT * FROM contacts";
    $stmt = mysqli_prepare($DB, $query);
    
    if ($stmt === false) {
        die('Erreur lors de la préparation de la requête : ' . mysqli_error($DB));
    }
    
    // Exécuter la requête
    mysqli_stmt_execute($stmt);
    
    // Obtenir le résultat
    $result = mysqli_stmt_get_result($stmt);
    
    $contacts = []; // Tableau pour stocker tous les contacts
    
    // Récupérer tous les contacts
    while ($row = mysqli_fetch_assoc($result)) {
        $contacts[] = $row;
    }
    
    // Vérifier si des contacts ont été trouvés
    if (!empty($contacts)) {
        return json_encode($contacts);
    } else {
        return json_encode([
            'status' => 'error',
            'message' => 'aucun contact trouvé'
        ]);
    }
}

  /**
 * Returns the details of the conhtact whose ID is passed as a parameter.
 *
 * @param int $contact_id The ID of the contact to retrieve.
 * @return string JSON encoded data containing contact information.
 */
  function get_contact_details(int $contact_id): string{
    global $DB;
    $query = "SELECT * FROM contacts WHERE IdContact = ?";
    $stmt = mysqli_prepare($DB, $query);
    mysqli_stmt_bind_param($stmt, "i", $contact_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
      $contact = mysqli_fetch_assoc($result);
      return json_encode($contact);
    }else{
      echo json_encode(
        [
          'status' => 'error',
          'message' => 'contact non trouvé'
        ]
      );
    }
  }

  /**
   * Returns all events(evennement: table evennements) in JSON format.
   *
   * @return json The JSON containing the list of events.
   */
  function get_all_events(): string{
    global $DB;
  }


  function get_event_details(int $event_id): string{
    global $DB;
  }

  function get_all_images_by_modele(int $modele_id): string{
    global $DB;
  }

  function get_image_details(int $image_id): string{
    global $DB;
  }


  function get_all_groupes(): string{
    global $DB;
  }

  function get_groupe_details(int $groupe_id): string{
    global $DB;
  }

  function get_all_permissions(): string{
    global $DB;
  }

  function get_permission_details(int $perm_id): string{
    global $DB;
  }

  function get_all_essais(): string{
    global $DB;
  }

  function get_essai_details(int $essai_id): string{
    global $DB;
  }

  function get_all_horaires(): string{
    global $DB;
  }

  function get_horaire_details(int $horaire_id): string{
    global $DB;
  }

  function get_all_visites(): string{
    global $DB;
  }

  function get_visite_details(int $visite_id): string{
    global $DB;
  }


  function get_all_newletter_members(): string{
    global $DB;
  }

?>
