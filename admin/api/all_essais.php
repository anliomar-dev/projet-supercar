<?php

// Inclure le fichier de connexion à la base de données
include '../../php/connexionDB.php'; // Assurez-vous que le chemin est correct

// Préparer la requête SQL
$sql = "SELECT * FROM essais";
$result = mysqli_query($DB, $sql);

// Vérifier si des résultats ont été retournés
if (mysqli_num_rows($result) > 0) {
    // Créer un tableau pour stocker les données
    $essais = array();
    
    // Récupérer les données et les ajouter au tableau
    while ($row = mysqli_fetch_assoc($result)) {
        $essais[] = $row;
    }

    // Renvoyer les données au format JSON
    header('Content-Type: application/json');
    echo json_encode($essais);
} else {
    echo json_encode(array()); // Retourne un tableau vide si aucune donnée n'est trouvée
}

// Fermer la connexion
mysqli_close($DB);
?>
