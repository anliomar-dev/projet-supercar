<?php
// Démarrer la session
session_start();

// Vérifier si les variables de session existent
if (isset($_SESSION['first_name']) && isset($_SESSION['last_name'])) {
    // Utiliser les variables de session
    echo 'Bienvenue ' . $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
} else {
    echo 'Aucune session active trouvée. Veuillez vous connecter.';
}
?>