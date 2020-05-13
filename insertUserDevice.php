<?php

  session_start();
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

    define('MyConst', TRUE);

    require_once "config.php";
    require_once "interogariSQL.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
      // echo "<br>";
      // echo "<br>";

      // echo "<br>";
      // echo "<br>";
      // echo "<br>";

      $isMAC = 0;
      $isIP = 0;
      $deviceAdded = 0;

      $stmtMAC = $conn->prepare($sqlSelectDeviceMAC);
      if($stmtMAC)
      {
        $stmtMAC->bind_param("s", $_POST["deviceMAC"]);

        if($stmtMAC->execute()){
          $stmtMAC->store_result();

          if($stmtMAC->num_rows == 1){
            $isMAC = 1;
            $stmtMAC->free_result();
            $stmtMAC->close();
          } 
        } else{
          echo "Failed execute stmt...";
          printf("Error: %s.\n", $stmtMAC->error);
          $stmtMAC->free_result(); if($stmtMAC)
      {
        $stmtMAC->bind_param("s", $_POST["deviceMAC"]);

        if($stmtMAC->execute()){
          $stmtMAC->store_result();

          if($stmtMAC->num_rows == 1){
            $isMAC = 1;
            $stmtMAC->free_result();
            $stmtMAC->close();
          } 
        } else{
          echo "Failed execute stmt...";
          printf("Error: %s.\n", $stmtMAC->error);
          $stmtMAC->free_result();
          $stmtMAC->close();
        }
      } else{
        echo "Failed to execute statement...";
        printf("Error: %s.\n", htmlspecialchars($conn->error));
        $stmtMAC->free_result();
        $stmtMAC->close();
      }
          $stmtMAC->close();
        }
      } else{
        echo "Failed to execute statement...";
        printf("Error: %s.\n", htmlspecialchars($conn->error));
        $stmtMAC->free_result();
        $stmtMAC->close();

      }

      $stmtIP = $conn->prepare($sqlSelectDeviceIP);
      if($stmtIP)
      {
        $stmtIP->bind_param("s", $_POST["deviceIP"]);

        if($stmtIP->execute()){
          $stmtIP->store_result();

          if($stmtIP->num_rows == 1){
            $isIP = 1;
            $stmtIP->free_result();
            $stmtIP->close();
          } 
        } else{
          echo "Failed execute stmt...";
          printf("Error: %s.\n", $stmtIP->error);
          $stmtIP->free_result();
          $stmtIP->close();

        }
      } else{
        echo "Failed to execute statement...";
        printf("Error: %s.\n", htmlspecialchars($conn->error));
        $stmtIP->free_result();
        $stmtIP->close();
      }

      // echo($_POST["deviceMAC"]);
      // echo($_POST["deviceIP"]);
      // echo($_POST["deviceType"]);
      // echo($_POST["userOS"]);
      // echo($_SESSION["id"]);


      $stmt = $conn->prepare($sqlInsertDevice);

      $stmt->bind_param("ssssi", $_POST["deviceMAC"], $_POST["deviceIP"], $_POST["deviceType"], $_POST["userOS"], $_SESSION["id"]);

      if($stmt->execute())
      {
        $deviceAdded = 1;
      }

      $conn->close();
    }
?>



<!DOCTYPE HTML>
<html>
<head>
	<title>Welcome</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


    <style>

    body{
      height: 60%;
      width: 100%;
      padding-top: 60px;
          padding-bottom: 40px;
          margin-left: 0px;
    }

    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td, th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }


    .fixed-header, .fixed-footer{
      width: 100%;
          position: fixed;        
          background: #333;
          padding: 10px 0;
          color: #fff;
      }

      .fixed-header{
          top: 0;
      } 

/*      .fixed-footer{
          bottom: 0;
    }*/
/*
    .body-container{
          width: 90%;
          height: 80%;
          margin: 0 auto;
          margin-top: 8%;
        border: 15px solid #333;
        padding: 50px;
        background-color: white;
      }*/

      .body-container h1{
        color: #333;
      }

      nav h1{
          color: #fff;
          text-decoration: none;
          padding-right: 30%;
          padding-left: 10%;
          display: inline-block;
          font-size: 1rem;
      }

      nav a, table a{
          color: #fff;
          text-decoration: none!important;
          font-size: 1rem;
      }

      nav a:hover, table a:hover{
          color: #fff;
          text-decoration: none!important;
      }

      .fixed-footer > .container{
        text-align: center;
      }

      .fixed-header > .container > #home{
        text-align: center;
      }

      #fileForm{
        padding-top: 30px;
      }

      #content{
        background-color: #edf0f2;
        padding:1rem;
        border-radius: 0;
        border-top: 1px solid rgba(0, 0, 0, 0.225);
        border-left:1px solid rgba(0, 0, 0, 0.225); 
        border-bottom: 1px solid rgba(0, 0, 0, 0.225);
        border-right:1px solid rgba(0, 0, 0, 0.225); 
        margin-top:5%;
      }

      #content > h1{
        font-family: arial, sans-serif;
        color:#343a40;
      }
      .effect8
      {
          position:relative;
          -webkit-box-shadow:0 1px 4px rgba(0, 0, 0, 0.8), 0 0 40px rgba(0, 0, 0, 0.9) inset;
             -moz-box-shadow:0 1px 4px rgba(0, 0, 0, 0.8), 0 0 40px rgba(0, 0, 0, 0.9) inset;
                  box-shadow:0 1px 4px rgba(0, 0, 0, 0.8), 0 0 40px rgba(0, 0, 0, 0.9) inset;
      }

      .effect8:before, .effect8:after
      {
          content:"";
          position:absolute;
          z-index:-1;
          -webkit-box-shadow:0 0 20px rgba(0,0,0,0.8);
          -moz-box-shadow:0 0 20px rgba(0,0,0,0.8);
          box-shadow:0 0 20px rgba(0,0,0,0.8);
          top:10px;
          bottom:10px;
          left:0;
          right:0;
          -moz-border-radius:100px / 10px;
          border-radius:100px / 10px;
      }

      .effect8:after
      {
          right:10px;
          left:auto;
          -webkit-transform:skew(8deg) rotate(3deg);
             -moz-transform:skew(8deg) rotate(3deThisg);
              -ms-transform:skew(8deg) rotate(3deg);
               -o-transform:skew(8deg) rotate(3deg);
                  transform:skew(8deg) rotate(3deg);
      }

      .fade-2{
        border-width: 0 0 1px;
        color: $color;
        border-image: linear-gradient(
          90deg,
          rgba(0, 0, 0, 0),
          rgba(52, 58, 64, 0.325) 25%,
          rgba(52, 58, 64, 0.625) 50%,
          rgba(52, 58, 64, 0.325) 75%,
          rgba(0, 0, 0, 0) 100%) 0 0 100%;
        border-style: solid;
      }

/*      .popover{
    width:200px;
    height:250px;
    
}*/

    </style>
</head>

<body>

    <div class="fixed-header">
        <div class="flex-container">
            <nav>
                <div class="row col-md-12">

                    <div class="col-md-1 px-0"></div>
                    <div class="col-md-3 px-0 text-center">
                        <h1 class="px-0">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h1>
                    </div>
                    <div class="col-md-4 px-0 text-center">
                        <a href="welcomeUser.php" class="pr-4">Home</a>
                        <a href="insertUserDevice.php">Add Device</a>
                    </div>

                    <div class="col-md-3 px-0 text-center">
                        <a href="logout.php">Log Out</a>
                    </div>
                    <div class="col-md-1 px-0 text-center">
                        
                    </div>
                    
                </div>
            </nav>
        </div>
    </div>

    <div id="content" class="card card-body col-md-10 d-flex mx-auto justify-content-center" style="display: block;">
    	<h1 class="text-center mt-2">Add a new device: </h1>
    	<hr class="fade-2 mb-5">

        <form class="formContent" action="" method="POST">
          <table class="col-md-10 mx-auto justify-content-center table table-striped table-dark borderless effect-8 py-4">

            <thead>
                <tr class="text-center">
                  <th scope="col" class="col-md-3">MAC</th>
                  <th scope="col" class="col-md-3">IP</th>
                  <th scope="col" class="col-md-3">Device</th>
                  <th scope="col" class="col-md-3">Operating System</th>
                </tr>
            </thead>

            <tbody>
              <tr class="form-group">
                <td>

                  <input class="form-control" name="deviceMAC" placeholder="Enter MAC" type="text" pattern="^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$"required>

                    <div id="divMAC" class="text-center mt-2 mb-0 py-2 px-0 alert alert-warning" role="alert" style="display:none;">
                      This <strong>MAC</strong> already exists.
                     
                </td>
                            
                <td>
                  <input class="form-control" name="deviceIP" placeholder="Enter IP" type="text" pattern="^[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}$" required>

                  <div id="divIP" class="text-center mt-2 mb-0 py-2 px-0 alert alert-warning" role="alert" style="display:none;">
                    This <strong>IP</strong> already exists.
                </td>

                <td>

                  <select class="form-control" name="deviceType" required>
                    <option>Computer</option>
                    <option>Printer</option>
                    <option>Laptop</option>
                    <option>Smartphone</option>
                  </select>

                </td>

                <td>
                  <input class="form-control" name="userOS" placeholder="Enter OS" type="text" pattern="[a-zA-Z]+" required>
                </td>
                
              </tr>

              <tr>
 
                <td colspan="5">
                  <div id="divDeviceInserted" class="text-center mt-2 mb-0 py-2 px-0 alert alert-success col-md-4 mx-auto" role="alert" style="display:none;">
                    <strong>Device</strong> added successfully !!
                </td>

              </tr>


            
            </tbody>
        </table>

        <div class="form-group row col-md-12 mt-4">
          <div class="col-md-10 px-0">
            
          </div>

          <div class="col-md-1 px-0">
            <input type="submit" class="btn btn-lg btn-primary float-right" value="Add device"/>
          </div>

          <div class="col-md-1 px-0">
          </div>

          <div class="clearfix"></div>
        </div>

      </form>

    </div>

    <div class="fixed-bottom fixed-footer">
        <div class="container">Copyright &copy; 2019 Geov</div>      
    </div>


<!-- 
<script>

  // $("[data-toggle=popover]").popover({
    // html: true, 
  // content: function() {
          // return $('#popover-content').html();
        // }
// });
$('#mytext').popover();
</script> -->
<script type="text/javascript">
    var isMAC = <?php echo json_encode($isMAC); ?>;
    // console.log(isMAC);

    if(isMAC == 1)
    {
      divMAC = document.getElementById("divMAC").style.display = "block";
    }

    var isIP = <?php echo json_encode($isIP); ?>;
    // console.log(isIP);

    if(isIP == 1)
    {
      divIP = document.getElementById("divIP").style.display = "block";
    }

    var deviceAdded = <?php echo json_encode($deviceAdded); ?>;

    if(deviceAdded == 1)
    {
      divIP = document.getElementById("divDeviceInserted").style.display = "block";
    }

</script>
</body>

</html>