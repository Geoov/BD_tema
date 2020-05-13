<?php

  session_start();
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

    define('MyConst', TRUE);

    require_once "config.php";
    require_once "interogariSQL.php";

    if($_SERVER["REQUEST_METHOD"] == "GET"){
      echo "<br>";
      echo "<br>";

      echo "<br>";
      echo "<br>";
      echo "<br>";

      echo $_GET['id'];
      $stmt = $conn->prepare($sqlDeleteUserDevice);

      if($stmt){
        $stmt->bind_param("s", $_GET['id']);

        if($stmt->execute()){

        } else{
          echo "Failed execute...";
          printf("Error: %s.\n", $stmt->error);
        }
      } else{
        echo "Failed to execute statement1...";
        printf("Error: %s.\n", htmlspecialchars($conn->error));
      }

      $stmt->close();
      $conn->close();

    }

     header('location:adminWelcome.php');
?>