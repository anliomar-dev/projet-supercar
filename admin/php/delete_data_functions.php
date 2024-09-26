<?php
  // Database connection
  include_once('../../php/connexionDB.php');
  include_once('../php/utils.php');

  function delete_rows(string $table_name, string $name_row_id, array $ids): bool {
    global $DB;
    
    // Create placeholders for each ID (e.g., ?, ?, ?)
    $placeholders = implode(',', array_fill(0, count($ids), '?'));

    // Prepare the SQL query with placeholders
    $sql = "DELETE FROM $table_name WHERE $name_row_id IN ($placeholders)";
    
    // Prepare the SQL statement
    $stmt = mysqli_prepare($DB, $sql);
    
    if ($stmt === false) {
        // If statement preparation fails, return false
        return false;
    }

    // Bind the parameters (IDs) to the prepared statement
    $types = str_repeat('i', count($ids));  // Assuming the IDs are integers
    mysqli_stmt_bind_param($stmt, $types, ...$ids);

    // Directly return the result of statement execution (true if successful, false otherwise)
    return mysqli_stmt_execute($stmt);
  }
?>
