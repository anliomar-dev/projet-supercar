<?php
  // Database connection
  include('../php/connexionDB.php');
  header('Content-Type: application/json; charset=utf-8');
  // get request body
  $input = file_get_contents('php://input');

  // Convert the received JSON data into an associative array
  $data = json_decode($input, true);
  $date = $data['date'];
  $query = "SELECT Heure, COUNT(Heure) as 'number_of_essai'
    FROM essais
    WHERE DateEssai = ?
    GROUP BY Heure
    HAVING Heure >= 2;
  ";
  $stmt = mysqli_prepare($DB, $query);
  mysqli_stmt_bind_param($stmt, "s", $date);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  if($result){
    $dates = array();
    while($row = mysqli_fetch_assoc($result)){
      $dates[] = $row;
    }
  }
  
?>
