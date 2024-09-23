<?php
// Détecter l'URL demandée et retirer la barre oblique finale
//$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '/';
// Récupérer le chemin exact de l'URL
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Afficher le chemin récupéré pour diagnostiquer

// Normaliser le chemin pour éviter les barres obliques finales
$path = rtrim($path, '/'); // Normaliser le chemin

// Utilisation de 'match' pour définir le routage
$callable = match($path) {
    "/super-car/admin" => function() {
        include_once __DIR__ . '/dashboard.php';  // Chemin vers le fichier dashboard
    },
    "/super-car/admin/utilisateurs" => function() {
        include_once __DIR__ . '/utilisateurs.php';  // Exemple pour une autre route
    },
    "/super-car/admin/marques" => function() {
        include_once __DIR__ . '/marques.php';  // Exemple pour une autre route
    },
    "/super-car/admin/modeles" => function() {
        include_once __DIR__ . '/modeles.php';  // Exemple pour une autre route
    },
    "/super-car/admin/essais" => function() {
        include_once __DIR__ . '/essais.php';  // Exemple pour une autre route
    },
    "/super-car/admin/contacts" => function() {
        include_once __DIR__ . '/contacts.php';  // Exemple pour une autre route
    },
    "/super-car/admin/evennements" => function() {
        include_once __DIR__ . '/evennements.php';  // Exemple pour une autre route
    },
    "/super-car/admin/dashboard" => function() {
        include_once __DIR__ . '/dashboard.php';  // Exemple pour une autre route
    },
    "/super-car/admin/visites" => function() {
        include_once __DIR__ . '/visites.php';  // Exemple pour une autre route
    },
    "/super-car/admin/groupes" => function() {
        include_once __DIR__ . '/groupes.php';  // Exemple pour une autre route
    },
    "/super-car/admin/permissions" => function() {
        include_once __DIR__ . '/permissions.php';  // Exemple pour une autre route
    },
    "/super-car/admin/horaires" => function() {
        include_once __DIR__ . '/horaires.php';  // Exemple pour une autre route
    },
    "/super-car/admin/newsletter" => function() {
        include_once __DIR__ . '/newsletter.php';  // Exemple pour une autre route
    },
    default => function() {
        echo "404 - Page non trouvée pour le chemin : " . htmlspecialchars($path);  // Gérer les URL non définies
    },
};

// Exécuter la fonction associée à la route
$callable();

?>
