<?php
  // Database connection
  include_once('../../php/connexionDB.php');

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
