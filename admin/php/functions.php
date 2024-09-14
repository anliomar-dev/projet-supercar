<?php
  // Database connection
  include_once('../../php/connexionDB.php');

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
 * @return bool True if the user exists, false otherwise.
 */
  function is_user_exist($user_id) {
    global $DB; 
    $query = "SELECT * FROM utilisateur WHERE IdUtilisateur = ?";

    $stmt = mysqli_prepare($DB, $query);

    mysqli_stmt_bind_param($stmt, 'i', $user_id);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    return mysqli_num_rows($result) > 0;
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
          "first_name" => $row['Nom'],
          "prenom" => $row['Prenom'],
          "email" => $row['Email'],
          "address" => $row['Adresse'],
          "phone" => $row['NumTel'],
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

  function update_user_data($user_id, $user_data){
    global $DB;
  }

    /**
   * Delete a user from the database.
   *
   * @param int $user_id The ID of the user to delete.
   * @return bool True if the user was deleted successfully, false otherwise.
   */
  function delete_user($user_id) {
    global $DB;

    // Prepare the SQL query
    $query = "DELETE FROM utilisateur WHERE IdUtilisateur = ?";
    $stmt = mysqli_prepare($DB, $query);

    if ($stmt === false) {
        // Handle prepare error
        return false;
    }

    // Bind the parameter
    mysqli_stmt_bind_param($stmt, 'i', $user_id);

    // Execute the query
    $result = mysqli_stmt_execute($stmt);

    // Close the statement
    mysqli_stmt_close($stmt);

    return $result;
  }

?>
