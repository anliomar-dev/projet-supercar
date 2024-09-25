<?php
  // Database connection
  include_once('../../php/connexionDB.php');
  include_once('../php/utils.php');

    /**
   * Check if a row exists in the database.
   *
   * @param int $id The ID to check.
   * @param string $table_name The name of the table.
   * @param string $row_id The name of the column representing the ID.
   * @return bool True if the row exists, false otherwise.
   */
  function is_row_exist($id, $table_name, $row_id) {
    global $DB; 

    $query = "SELECT 1 FROM $table_name WHERE $row_id = ? LIMIT 1";
    $stmt = mysqli_prepare($DB, $query);

    if ($stmt === false) {
        die('Erreur lors de la préparation de la requête : ' . mysqli_error($DB));
    }
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $exists = mysqli_num_rows($result) > 0;
    mysqli_stmt_close($stmt);

    return $exists;
  }


  /**
 * Delete rows from the specified table based on the given IDs.
 *
 * @param array $ids Array of IDs to delete.
 * @param string $table_name Name of the table to delete from.
 * @param string $row_id Column name representing the ID.
 * @return bool True if the rows were deleted successfully, false otherwise.
 */
function delete_rows($ids, $table_name, $row_id) {
  global $DB;

  // Convert array of IDs into a comma-separated list of placeholders (?)
  $placeholders = implode(',', array_fill(0, count($ids), '?'));

  // Prepare the SQL query
  $query = "DELETE FROM $table_name WHERE $row_id IN ($placeholders)";
  $stmt = mysqli_prepare($DB, $query);

  if ($stmt === false) {
      // Handle errors in preparing the statement
      die('Erreur lors de la préparation de la requête : ' . mysqli_error($DB));
  }

  // Bind the array of IDs to the placeholders
  $types = str_repeat('i', count($ids)); // Assuming IDs are integers ('i' for integer types)
  mysqli_stmt_bind_param($stmt, $types, ...$ids);

  // Execute the query
  $result = mysqli_stmt_execute($stmt);

  // Close the statement
  mysqli_stmt_close($stmt);

  return $result;
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
