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

  function insert_row(string $table_name, array $data): bool {
    global $DB;
  
    // Prepare column names and placeholders for the SQL statement
    $columns = implode(',', array_keys($data));
    $placeholders = implode(',', array_fill(0, count($data), '?'));
  
    // Prepare the SQL query
    $sql = "INSERT INTO $table_name ($columns) VALUES ($placeholders)";
  
    // Prepare the SQL statement
    $stmt = mysqli_prepare($DB, $sql);
    
    if ($stmt === false) {
        // If statement preparation fails, return false
        return false;
    }
  
    // Create a types string for binding parameters
    $types = '';
    foreach ($data as $value) {
        if (is_int($value)) {
            $types .= 'i'; // Integer
        } elseif (is_float($value)) {
            $types .= 'd'; // Double
        } else {
            $types .= 's'; // String (default)
        }
    }
  
    // Bind the parameters (values) to the prepared statement
    mysqli_stmt_bind_param($stmt, $types, ...array_values($data));
  
    // Execute the prepared statement and return the result
    return mysqli_stmt_execute($stmt);
  }


  /**
 * Updates a record in the specified table.
 *
 * @param string $table_name The name of the table.
 * @param int $id_row The ID of the row to update.
 * @param array $new_data An associative array of column names and their new values.
 *
 * @return bool Returns `true` on success, `false` on failure.
 */
function update_record($table_name, $id_row, $new_data) {
  global $DB;
  // Extract columns and values from the $new_data array
  $columns = [];
  $values = [];
  foreach ($new_data as $key => $value) {
    $columns[] = $key;
    $values[] = $value;
  }
  // Build the SQL query string
  $sql = "UPDATE $table_name SET ";
  $sql .= implode(', ', array_map(function($column) {
    return "$column = ?";
  }, $columns));
  $sql .= " WHERE id = ?"; // Assuming `id` is the primary key
  // Prepare the SQL statement
  $stmt = mysqli_prepare($DB, $sql);

  if ($stmt === false) {
    // If statement preparation fails, return false
    return false;
  }

  // Add the ID to the values array for binding
  $values[] = $id_row;  
  // Create a types string for binding parameters
  $types = '';
  foreach ($values as $value) {
    if (is_int($value)) {
      $types .= 'i'; // Integer
    } elseif (is_float($value)) {
      $types .= 'd'; // Double
    } else {
      $types .= 's'; // String (default)
    }
  }
  // Bind the parameters (values) to the prepared statement
  mysqli_stmt_bind_param($stmt, $types, ...array_values($values));
  // Execute the prepared statement
  $result = mysqli_stmt_execute($stmt);
  // Close the prepared statement
  mysqli_stmt_close($stmt);
  // Return the result of the query (true or false)
  return $result;
}
  
?>
