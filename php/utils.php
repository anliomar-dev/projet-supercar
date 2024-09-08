<?php
    include_once('connexionDB.php');
    $LOGIN_URL = "/super-car/supercar/signin";
    $SESSION_EXPIRED_URL = "/super-car/supercar/session_expired";

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

    /**
     * check if the user is authenticated and redirect to login page if his is not or 
     * redirect to session expired page is the auth session is expired
     */
    function is_user_authenticated() {
        global $LOGIN_URL;
        global $SESSION_EXPIRED_URL;
        // session expire timestamp
        $tempsExpiration = 10 * 60; // 5 minutes

        // start new session if there is not a session
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // check if session is active
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $tempsExpiration)) {
            // logout user if the auth session is expired
            session_unset();
            session_destroy();
            // redirect to session expired page
            header("Location: $SESSION_EXPIRED_URL");
            exit();
        }

        // check if user is authenticated
        if (!isset($_SESSION['email'])) {
            // if user is not authenticated, redirect to signin page
            header("Location: $LOGIN_URL");
            exit();
        }
        // upgrade the timestamp of the last activity
        $_SESSION['last_activity'] = time();
    }

    function logout(){
        global $LOGIN_URL;
        if (isset($_POST["logout"])){
            session_unset();
            session_destroy();
            // redirect user to the signin page
            header("Location: $LOGIN_URL");
            exit();
        }
    }
?>
