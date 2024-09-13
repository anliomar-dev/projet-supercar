<?php
// Détecter l'URL demandée
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '/';

// Définir les routes (URL et page associée)
switch ($url) {
    case '/':
        // Afficher une page d'accueil ou tableau de bord par défaut
        require 'dashboard.php';
        break;
    case 'dashboard':
        require 'dashboard.php';
        break;
    case 'utilisateurs':
        require 'utilisateurs.php';
        break;
    case 'marques':
        require 'marques.php';
        break;
    case 'modeles':
        require 'modeles.php';
        break;
    case 'contacts':
        require 'contacts.php';
        break;
    case 'visites':
        require 'visites.php';
        break;
    case 'groupes':
        require 'groupes.php';
        break;
    case 'permissions':
        require 'permissions.php';
        break;
    case 'evennements':
        require 'evennements.php';
        break;
    case 'essais':
        require 'essais.php';
        break;
    case 'newsletter':
        require 'newsletter.php';
        break;
    case 'login':
        require 'login.php';
        break;
    default:
        // Page 404 si l'URL n'existe pas
        echo "404 - Page non trouvée pour l'URL : " . htmlspecialchars($url);
        break;
}
?>
