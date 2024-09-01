<?php
// Détecter l'URL demandée
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '/';

// Afficher l'URL pour le débogage (optionnel)
echo "URL demandée : " . htmlspecialchars($url) . "<br>";

// Définir les routes (URL et page associée)
switch ($url) {
    case '':
    case '/':
        require 'supercar/home.php';
        break;
    case 'signin':
        require 'supercar/signin.php';
        break;
    case 'signup':
        require 'supercar/signup.php';
        break;
    case 'marques':
        require 'supercar/marques.php';
        break;
    case 'essai':
        require 'supercar/essai.php';
        break;
    case 'evenements':
        require 'supercar/evenements.php';
        break;
    case 'contact':
        require 'supercar/contact.php';
        break;
    default:
        // Page 404 si l'URL n'existe pas
        echo "404 - Page non trouvée pour l'URL : " . htmlspecialchars($url);
        break;
}
?>
