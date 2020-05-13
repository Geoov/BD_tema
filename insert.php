<?php

  session_start();
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

    define('MyConst', TRUE);

    require_once "config.php";
    require_once "interogariSQL.php";

 if(!empty($_POST))  
 {  
      $output = '';  
      $message = '';  
      // $bssid = mysqli_real_escape_string($connect, $_POST["BSSID"]);  
      $speed = mysqli_real_escape_string($connect, $_POST["speed"]);  
      $secType = mysqli_real_escape_string($connect, $_POST["secType"]);  
      
      if($_POST["wifi_id"] != '')  
      {  
           $query = "  
           UPDATE access_point_details   
           SET speed='$speed',   
           security_type='$secType',   
           WHERE id='".$_POST["wifi_id"]."'";  
           $message = 'Data Updated';  
      }  
      // else  
      // {  
      //      $query = "  
      //      INSERT INTO tbl_employee(name, address, gender, designation, age)  
      //      VALUES('$name', '$address', '$gender', '$designation', '$age');  
      //      ";  
      //      $message = 'Data Inserted';  
      // }  
      if(mysqli_query($conn, $query))  
      {  
           $output .= '<label class="text-success">' . $message . '</label>';  
           $select_query = "SELECT * FROM access_point_details ORDER BY id DESC";  
           $result = mysqli_query($conn, $select_query);  
           $output .= '  
                <table class="table table-bordered">  
                     <tr>  
                          <th width="70%">Employee Name</th>  
                          <th width="15%">Edit</th>  
                          <th width="15%">View</th>  
                     </tr>  
           ';  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <tr>  
                          <td>' . $row["SSID"] . '</td>  
                          <td><input type="button" name="edit" value="Edit" id="'.$row["id"] .'" class="btn btn-info btn-xs edit_data" /></td>  
                          <td><input type="button" name="view" value="view" id="' . $row["id"] . '" class="btn btn-info btn-xs view_data" /></td>  
                     </tr>  
                ';  
           }  
           $output .= '</table>';  
      }  
      echo $output;  
 }  
 ?>