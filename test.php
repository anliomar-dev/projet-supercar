<?php
include('php/connexionDB.php');
include_once('php/utils.php');
$date = "2024-09-12";
$heure = "12:30:00";
$idMarque = 4;
$idModele = 8;
$idUtilisateur = 7;

$new_essai = new_essai($date, $heure, $idMarque, $idModele, $idUtilisateur);

if($new_essai){
  echo "L'essai a été ajouté avec succès.";
}else{
  echo "L'essai n'a pas pu être ajouté.";
}

?>