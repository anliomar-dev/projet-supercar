<?php
// Database connection
include_once('../../php/connexionDB.php');
include_once('../php/utils.php');

/**
 * Check if a row exists in the database.
 *
 * @param int $id The ID to check.
 * @param string $table_name The name of the table to check in.
 * @param string $row_id The column name representing the ID in the table.
 * @return bool True if the row exists, false otherwise.
 */
function is_row_exist($id, $table_name, $row_id) {
    global $DB; // Use the database connection.

    // SQL query to check if the row exists.
    $query = "SELECT 1 FROM $table_name WHERE $row_id = ? LIMIT 1";
    $stmt = mysqli_prepare($DB, $query); // Prepare the SQL statement.

    if ($stmt === false) {
        die('Error preparing the query: ' . mysqli_error($DB)); // Handle errors in query preparation.
    }

    // Bind the ID parameter.
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt); // Execute the query.
    $result = mysqli_stmt_get_result($stmt); // Get the query result.

    // Check if any row exists.
    $exists = mysqli_num_rows($result) > 0;
    mysqli_stmt_close($stmt); // Close the prepared statement.

    return $exists; // Return true if the row exists, otherwise false.
}

/**
 * Check if a user exists in the database.
 *
 * @param int $user_id The ID of the user to check.
 * @return bool True if the user exists, false otherwise.
 */
function is_user_exist($user_id) {
    global $DB; // Use the database connection.

    // SQL query to check if the user exists by their ID.
    $query = "SELECT * FROM utilisateur WHERE IdUtilisateur = ?";

    $stmt = mysqli_prepare($DB, $query); // Prepare the SQL statement.
    mysqli_stmt_bind_param($stmt, 'i', $user_id); // Bind the user ID parameter.
    mysqli_stmt_execute($stmt); // Execute the query.
    $result = mysqli_stmt_get_result($stmt); // Get the result of the query.

    return mysqli_num_rows($result) > 0; // Return true if the user exists, otherwise false.
}


/**
 * Insert a new record into a specified table.
 *
 * @param string $table The name of the table to insert data into.
 * @param array $data The associative array of column names and values to insert.
 * @return bool True if the insertion was successful, false otherwise.
 */
function insertRecord($table, $data) {
    global $DB; // Use the database connection.

    // Generate column names and placeholders for the query.
    $columns = implode(", ", array_keys($data)); // Column names for the insert query.
    $placeholders = implode(", ", array_fill(0, count($data), '?')); // Placeholders for parameterized query.

    // Prepare the SQL insert query.
    $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
    $stmt = $DB->prepare($query); // Prepare the statement.

    if (!$stmt) {
        // Handle preparation errors.
        return false;
    }

    // Determine the data types for binding parameters.
    $types = '';
    $values = [];
    foreach ($data as $key => $value) {
        if (is_numeric($value)) {
            // Check if the value is a floating point or integer.
            if (strpos($value, '.') !== false) {
                $types .= 'd'; // Double type for floats.
                $values[] = (float)$value;
            } else {
                $types .= 'i'; // Integer type for integers.
                $values[] = (int)$value;
            }
        } elseif (is_string($value)) {
            $types .= 's'; // String type for strings.
            $values[] = $value;
        } elseif (is_null($value)) {
            $types .= 's'; // Handle null as a string.
            $values[] = null;
        } else {
            return false; // Unsupported data type.
        }
    }

    // Bind the parameters to the statement.
    $stmt->bind_param($types, ...$values); // Use parameter unpacking.

    // Execute the query and return whether it was successful.
    return $stmt->execute();
}

/**
 * Validate the CSRF token.
 *
 * @param string $csrf_client The CSRF token provided by the client.
 * @param string $csrf_session The CSRF token stored in the session.
 * @return bool True if the CSRF tokens match, false otherwise.
 */
function is_csrf_valid($csrf_client, $csrf_session){
    // Compare the client CSRF token with the session token.
    return $csrf_client == $csrf_session;
}

/**
 * Return a JSON response.
 *
 * @param string $status The status of the response (e.g., 'success', 'error').
 * @param string $message The message to include in the response.
 * @return array An associative array containing the status and message.
 */
function return_msg_json($status, $message){
    // Create an associative array to represent the response.
    return [
        'status' => $status,
        'message' => $message
    ];
}

function login_admin($email, $password) {
    global $DB;
    $response = [
        'status' => 'error',
        'message' => 'email et/ou mot de passe invalid'
    ];
    // query
    $query = "SELECT * FROM utilisateur WHERE Email = ?";
    // prepare query
    $stmt = mysqli_prepare($DB, $query);
    mysqli_stmt_bind_param($stmt, 's', $email);
    // execute query
    mysqli_stmt_execute($stmt);

    // get the result of the query
    $result = mysqli_stmt_get_result($stmt);

    // check if there a user registered with this email
    if ($user = mysqli_fetch_assoc($result)) {
        // check the password
        if (password_verify($password, $user['MotDePasse'])) {
            // the user is authenticated
            if($user['est_admin'] === 0){
                return false;
                exit();
            }
            session_start();
            // session variables
            $_SESSION['user_id'] = $user['IdUtilisateur'];
            $_SESSION['email'] = $user['Email'];
            $_SESSION['first_name'] = $user['Prenom'];
            $_SESSION['last_name'] = $user['Nom'];
            $_SESSION['is_admin'] = $user['est_admin'];
            $_SESSION['is_superadmin'] = $user['est_superadmin'];

            // generate CSRF token
            if (empty($_SESSION['csrf_token'])) {
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            }
            // close query
            mysqli_stmt_close($stmt);
            return true;
        } else {
            // incorrect password
            mysqli_stmt_close($stmt);
            return false;
        }
    } else {
        // no user found with this email
        mysqli_stmt_close($stmt);
        return false;
    }
}
?>
