<?php
include('php/connexionDB.php');
$query = "SELECT Heure, COUNT(Heure) as 'number_of_essai'
FROM essais
WHERE DateEssai = ?
GROUP BY Heure
HAVING Heure >= 2;
";
$date = '2024-09-13';
  $stmt = mysqli_prepare($DB, $query);
  mysqli_stmt_bind_param($stmt, "s", $date);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  if($result){
  $dates = array();
  while($row = mysqli_fetch_assoc($result)){
    $dates[] = $row;
  }
  ;
  }
// Fermer la déclaration préparée
mysqli_stmt_close($stmt);

// Fermer la connexion à la base de données
mysqli_close($DB);
?>