<?php

  session_start();
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

    define('MyConst', TRUE);

    require_once "config.php";
    require_once "interogariSQL.php";

    if(isset($_POST["wifi_id"]))  
 {  
      $query = "SELECT * FROM access_point_details WHERE AP_ESSID = '".$_POST["wifi_id"]."'";  
      $result = mysqli_query($conn, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
?>