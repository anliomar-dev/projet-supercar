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
?>
