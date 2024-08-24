<?php
  include_once('connexionDB.php');

  function login($email, $password) {
    global $DB;

    // Prépare la requête SQL pour sélectionner l'utilisateur par email
    $query = "SELECT * FROM utilisateur WHERE Email = ?";

    // Prépare la requête
    $stmt = mysqli_prepare($DB, $query);

    // Lie les paramètres
    mysqli_stmt_bind_param($stmt, 's', $email);

    // Exécute la requête
    mysqli_stmt_execute($stmt);

    // Récupère le résultat de la requête
    $result = mysqli_stmt_get_result($stmt);

    // Vérifie si un utilisateur a été trouvé
    if ($user = mysqli_fetch_assoc($result)) {
        // Vérifie le mot de passe hashé
        if (password_verify($password, $user['MotDePasse'])) {
            // Le mot de passe est correct, authentification réussie

            // Démarre la session
            session_start();

            // Enregistre les informations de l'utilisateur dans la session
            $_SESSION['user_id'] = $user['IdUtilisateur'];
            $_SESSION['email'] = $user['Email'];
            $_SESSION['first_name'] = $user['Prenom'];
            $_SESSION['last_name'] = $user['Nom'];

            // Ferme la requête
            mysqli_stmt_close($stmt);

            return true;
        } else {
            // Mot de passe incorrect
            mysqli_stmt_close($stmt);
            return false;
        }
    } else {
        // Aucun utilisateur trouvé avec cet email
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
      global $DB; // Assurez-vous que la variable $DB est disponible ici
      
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
?>
