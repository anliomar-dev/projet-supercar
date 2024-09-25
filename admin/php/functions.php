<?php
  // Database connection
  include_once('utils.php');
  function is_ressource_exists($db, $param, $table, $row_id_name){
    $page_404 = "/super-car/404.php";
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      if (isset($_GET[$param]) || !isset($_GET[$param])) {
        $param_value = $_GET[$param];
        if ($param_value == 'all') {
          $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
          
        } elseif (is_numeric($param)) {
          $id = intval($param);
          $row_exist = is_row_exist($id, $table, $row_id_name);
          if (!$row_exist) {
            header("location: $page_404");
          }
          
        }else{
          header("location: $page_404");
        }
      }
    }
  }
  
?>
