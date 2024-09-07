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
    HAVING COUNT(Heure) >= 2;
  ";
  $stmt = mysqli_prepare($DB, $query);
  mysqli_stmt_bind_param($stmt, "s", $date);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  if($result){
    $horaires = [];
    while($row = mysqli_fetch_assoc($result)){
      $horaires[] = $row['Heure'];
        
    }
    if(count($horaires) > 0){
      $horaires_list = "'". implode("','", array_map(function($heure) use ($DB){
        return mysqli_real_escape_string($DB, $heure);
      }, $horaires)). "'";

      $query_horaires = "SELECT * FROM horaires WHERE Heure NOT IN ($horaires_list)";
      $stmt_horaires = mysqli_prepare($DB, $query_horaires);
      mysqli_stmt_execute($stmt_horaires);
      $result_horaires = mysqli_stmt_get_result($stmt_horaires);
      $horaires_disponible = [];
      while($row = mysqli_fetch_assoc($result_horaires)){
        $id = $row['IdHoraire'];
        $horaires_disponible[$id] = [
          'Heure' => $row['Heure'],
          ];
      }
      echo json_encode($horaires_disponible);
    }else{
      $query_horaires = "SELECT * FROM horaires";
      $stmt_horaires = mysqli_prepare($DB, $query_horaires);
      mysqli_stmt_execute($stmt_horaires);
      $result_horaires = mysqli_stmt_get_result($stmt_horaires);
      $horaires_disponible = [];
      while($row = mysqli_fetch_assoc($result_horaires)){
        $id = $row['IdHoraire'];
        $horaires_disponible[$id] = [
          'Heure' => $row['Heure'],
          ];
      }
      echo json_encode($horaires_disponible);
    }
  }
  // Close prepared statements and the database connection
  mysqli_stmt_close($stmt);
  mysqli_stmt_close($stmt_horaires);
  mysqli_close($DB);
  
?>
