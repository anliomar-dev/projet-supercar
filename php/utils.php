<?php
    include_once('connexionDB.php');

    function login($email, $password) {
        global $DB;
        $response = [
            'status' => 'error',
            'message' => 'invalid email and/or password'
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

                session_start();
                // session variables
                $_SESSION['user_id'] = $user['IdUtilisateur'];
                $_SESSION['email'] = $user['Email'];
                $_SESSION['first_name'] = $user['Prenom'];
                $_SESSION['last_name'] = $user['Nom'];

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


    function create_user(
        $firstname, 
        $lastname, 
        $address, 
        $phone, 
        $email, 
        $password
    ){
        global $DB;
        
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Prepare the SQL query
        $query = 'INSERT INTO utilisateur (Nom, Prenom, Adresse, NumTel, Email, MotDePasse)
                VALUES (?, ?, ?, ?, ?, ?)';
        
        // Prepare the statement
        if ($stmt = mysqli_prepare($DB, $query)) {
            // Bind the parameters
            mysqli_stmt_bind_param($stmt, 'ssssss', $firstname, $lastname, $address, $phone, $email, $hashed_password);
            
            // Execute the statement
            $result = mysqli_stmt_execute($stmt);
            // Close the statement
            mysqli_stmt_close($stmt);
            return $result;
        } else {
            // If the statement preparation failed, you might want to handle this case
            echo "Failed to prepare the SQL statement.";
            return false;
        }
    }

    function is_email_already_exist($email){
        global $DB;
        $check_email_query = "SELECT email FROM utilisateur WHERE email = ?";
        // prepare query
        $stmt = mysqli_prepare($DB, $check_email_query);

        mysqli_stmt_bind_param($stmt, 's', $email);

        // execute query
        mysqli_stmt_execute($stmt);

        // get the result of the query
        $result = mysqli_stmt_get_result($stmt);
        // Check if any row is returned
        $email_exists = mysqli_num_rows($result) > 0;

        // Close the statement
        mysqli_stmt_close($stmt);

        // Return true if email exists, false otherwise
        return $email_exists;
    }
?>
