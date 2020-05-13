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

      $stmtRouterInt = $conn->prepare($sqlSelectRouterINT0);

      if($stmtRouterInt)
      {

        $stmtRouterInt->bind_param("s", $_POST["int0"]);
           
        $stmtRouterInt->execute();

        $stmtRouterInt->bind_result($IP);
        $stmtRouterInt->fetch();

        $stmtRouterInt->free_result();
        $stmtRouterInt->close();

        if($_POST['int0'] != $IP) // daca avem o interfata IP noua
        {
          
          $stmtRouterNewInt = $conn->prepare($sqlUpdateRouterInt);
          if($stmtRouterNewInt)
          {

            $stmtRouterNewInt->bind_param("s", $_POST["int0"]);
            $stmtRouterNewInt->execute();
            $stmtRouterNewInt->close();

          } else{
            printf("Error: %s.\n", htmlspecialchars($conn->error));
            $stmtRouterNewInt->close();
          }
        }
      }else{

        echo "Failed to execute statement...";
        printf("Error: %s.\n", htmlspecialchars($conn->error));
        $stmtRouterInt->close();
            //   // $conn->close();
      }

      // if($_POST['int0'] != 
    }
?>


<!DOCTYPE HTML>
<html>

<head>
    <title>Welcome</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Panel</title>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" rel="stylesheet"  type='text/css'>

    <link href="css/aos.css" rel="stylesheet">
    <link href="css/ekko-lightbox.css" rel="stylesheet">


    <link href="styles/main.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- <link type="text/css" href="https://getbootstrap.com/1.0.0/assets/css/bootstrap-1.0.0.min.css"> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@0.7.4/dist/tailwind.min.css" rel="stylesheet"> -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style> 
        @import url(https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css););
    </style>
</head>

<body id="top">
    <header>

        <section class="mx-0" style="padding-top: 10rem;">

            <div class="flex-container row px-0">
                <div class="col-md-5 d-flex justify-content-center px-0 mx-0">
                    <div class="col-md-2 px-0 mx-0" ></div>
                    <div class="col-md-10 d-flex no-wrap mx-auto px-0">
                        <img class="position-absolute img-responsive mx-auto d-block mt-5 px-5" src="https://laracasts.com/images/journeys/journey-php.svg">

                    </div>
                </div>

                <div class="col-md-7 d-flex justify-content-center px-0">
                    <div class="col-md-12 d-flex no-wrap mx-auto px-0">

                        <div class="da-home-page-text col-md-12 mx-auto" data-aos="fade-left" data-aos-duration="1000">
                            <div class="container mx-auto">
                                <div class="col-md-10 px-0 mx-0">

                                    <h2 class="display-3 mb-3" style="margin-left:-6px;">Admin Control Panel</h2>
                                    <h3 class="h5">Here you can see the configuration of your computer network.</h3>
                                    <h3 class="h5 mb-4 pb-3">Access just for authorized personal !!</h3>
                                
                                    <div class="flex-wrap flex-row justify-content-center px-0 mx-2">

                                        <div class="d-inline-flex mx-1 customA">
                                            <a href="#switch" class="d-block smooth-scroll">
                                                <div class="bg-blue-dark bg-green-grd position-relative rounded-lg px-4 py-3 d-flex flex-column align-items-center justify-content-center">
                                                    <img src="images/switch.svg" alt="icon" class="mb-2" style="height: 63px;" width="63"> 
                                                    <h3 class="text-center-xs text-uppercase font-weight-light mb-0" style="font-size:.75rem;">switch</h3>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="d-inline-flex mx-1 customA">
                                            <a href="#wifi" class="d-block smooth-scroll">
                                                <div class="bg-blue-dark bg-red-grd position-relative rounded-lg px-4 py-3 d-inline-flex flex-column align-items-center justify-content-center">
                                                    <img src="images/access_point.webp" alt="icon" class="mb-2" style="height: 63px;" width="63"> 
                                                    <h3 class="text-center-xs text-uppercase font-weight-light mb-0" style="font-size:.75rem;">WiFi</h3>
                                                </div>
                                            </a>
                                        </div>


                                        <div class="d-inline-flex mx-1 customA">
                                            <a href="#server" class="d-block smooth-scroll">
                                                <div class="bg-blue-dark bg-blue-grd position-relative rounded-lg px-4 py-3 d-flex flex-column align-items-center justify-content-center">
                                                    <img src="images/server.webp" alt="icon" class="mb-2" style="height: 63px;" width="63"> 
                                                    <h3 class="text-center-xs text-uppercase font-weight-light mb-0" style="font-size:.75rem;">server</h3>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="d-inline-flex mx-1 customA">
                                            <a href="#router" class="d-block smooth-scroll">
                                                <div class="bg-blue-dark bg-yellow-grd position-relative rounded-lg px-4 py-3 d-flex flex-column align-items-center justify-content-center">
                                                    <img src="images/router.webp" alt="icon" class="mb-2" style="height: 63px;" width="63"> 
                                                    <h3 class="text-center-xs text-uppercase font-weight-light mb-0" style="font-size:.75rem;">router</h3>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="d-inline-flex mx-1 customA">
                                            <a href="adminWelcome.php" class="d-block smooth-scroll">
                                                <div class="bg-blue-dark bg-violet-grd position-relative rounded-lg px-4 py-3 d-flex flex-column align-items-center justify-content-center">
                                                    <img src="images/devices.webp" alt="icon" class="mb-2" style="height: 63px;" width="63"> 
                                                    <h3 class="text-center-xs text-uppercase font-weight-light mb-0" style="font-size:.75rem;">add device</h3>
                                                </div>
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>


        </section>

    </header>

    <div class="page-content">
        <div>

            <div class="da-section da-work" id="switch" style="padding-top: 10rem;">
                <div class="container">

                    <div class="h3 pb-3 text-center text-white" data-aos="fade-up">Switch Current State</div>
                    <p class="px-5 pb-5 text-center text-white" data-aos="fade-up">Lower, it is presented the situation of <strong>SWITCH</strong>. How much the device is full, with what kind of device and how much avaliable space do you have.</p>
                    <div class="row">

                        <div class="col-md-12">

                            <h3 class="h5 mb-5 text-white">Our Expertise</h3>

                            <?php

                            // $userId = $_SESSION["id"]; nu are sens sa verificam daca are rol de admin pentru ca doar adminii pot intra aici

                            if($stmt = $conn->prepare($sqlSelectDevicesSwitch))
                            {
                              $stmt->execute();
                              $res = $stmt->get_result();
                              $data = $res->fetch_all(MYSQLI_ASSOC);

                              $counterComp = 0;
                              $counterAP = 0;
                              $counterServer = 0;
                              $counterRouter = 0;


                              foreach ($data as $row) 
                              {
                                
                                if($row['device_type'] == "Computer")
                                  $counterComp++;
                                else if($row['device_type'] == "AccessPoint")
                                  $counterAP++;
                                else if($row['device_type'] == "Server")
                                  $counterServer++;
                                else if($row['device_type'] == "Router")
                                  $counterRouter++;
                                
                              }

                              // echo $counterComp;
                              // echo $counterAP;
                              // echo $counterServer;
                              // echo $counterRouter;

                              $procentComp = ($counterComp * 100) / 40;
                              // echo $procentComp;

                              $procentAP = ($counterAP * 100) / 4;
                              // echo $procentAP;

                              $procentServer = ($counterServer * 100) / 3;
                              // echo $procentServer;

                              $procentRouter = ($counterRouter * 100) / 1;
                              // echo $procentRouter;

                              $stmt->free_result();
                              $stmt->close();
                              
                            } else{
                              echo "Failed to execute statement...";
                              printf("Error: %s.\n", htmlspecialchars($conn->error));
                              $stmt->close();
                            }
                            // $conn->close();

                            ?>

                            <div class="col px-0 mb-4">
                              <p class="text-white">Devices <?php echo $procentComp; ?>%</p>
                              <div class="progress" style="height: 5px;">
                                <div class="progress-bar" data-aos="progress-full" data-aos-offset="10" data-aos-duration="2000" role="progressbar" style="width: <?php echo $procentComp; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>

                            <div class="col px-0 mb-4">
                              <p class="text-white">Access Points <?php echo $procentAP; ?>%</p>
                              <div class="progress" style="height: 5px; color:#26b7a0 !important">
                                <div class="progress-bar" data-aos="progress-full" data-aos-offset="10" data-aos-duration="2000" role="progressbar" style="width: <?php echo $procentAP; ?>%; color:#26b7a0 !important" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>

                            <div class="col px-0 mb-4">
                              <p class="text-white">Servers <?php echo $procentServer; ?>%</p>
                              <div class="progress" style="height: 5px;">
                                <div class="progress-bar" data-aos="progress-full" data-aos-offset="10" data-aos-duration="2000" role="progressbar" style="width: <?php echo $procentServer; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>

                            <div class="col px-0 mb-4">
                              <p class="text-white">Routers <?php echo $procentRouter; ?>%</p>
                              <div class="progress" style="height: 5px;">
                                <div class="progress-bar" data-aos="progress-full" data-aos-offset="10" data-aos-duration="2000" role="progressbar" style="width: <?php echo $procentRouter; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>

                            <div class = "col row justify-content-center">

                              <button type="button" class="btn btn-custom-color btn-lg" data-toggle="modal" data-target="#switchModal">
                                Show all details
                              </button>

                            </div>

                            <div class="modal fade bd-example-modal-xl" id="switchModal" tabindex="-1" role="dialog"aria-labelledby="switchModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-xl">
                                <div class="modal-content">

                                  <div class="modal-header justify-content-center">

                                    <h4 class="modal-title text center custom-text-primary" id="switchModalLabel">Devices Switch</h4>
                                  </div>

                                  <div class="modal-body">

                                    <table class="col-md-10 mx-auto justify-content-center table table-striped table-dark borderless effect-8">
                                      <thead>
                                          <tr class="text-center">
                                            <th scope="col">port_id</th>
                                            <th scope="col">VLAN</th>
                                            <th scope="col">MAC</th>
                                            <th scope="col">Device</th>
                                          </tr>
                                      </thead>

                                      <tbody>
                                      <?php

                                      foreach ($data as $row) 
                                      {
                                        
                                        echo "<tr class=\"text-center\">";
                                        echo "<td>" . $row['port_id'] . "</td>";
                                        echo "<td>" . $row['VLAN'] . "</td>";
                                        echo "<td>" . $row['MAC'] . "</td>";
                                        echo "<td>" . $row['device_type'] . "</td>";
                                        
                                      }

                                    ?>
                                      </tbody>
                                    </table>
                                  </div>
                                        
                                </div>
                              </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>

            <div class="da-section bg-light" id="wifi">

              <div class="da-services">
                <div class="container text-center">
                  <div class="h3 pb-5 text-center" data-aos="fade-up" style="color: #3d3f4c !important;">WiFi Details</div>
                  <div class="row">

                    <div class="col-lg-3 col-md-6">
                      <div class="card mb-3">
                        <div id="wifi_details" class="card-body py-5" data-aos="zoom-in" data-aos-duration="500">
                          <div class="custom-text-primary"><i class="pb-3 fas fa-wifi fa-3x"></i>

                            <?php

                              $stmtAP = $conn->prepare($sqlSelectApBSSID);

                              if($stmtAP)
                              {
                                // $stmtAP->bind_param("i", 1);
                                // echo "da";
                                $nrAP = 1;
                                $stmtAP->bind_param("i", $nrAP);

                                $stmtAP->execute();

                                $stmtAP->bind_result($BSSID);
                                $stmtAP->fetch();

                                // echo $BSSID;

                                $stmtAP->free_result();
                                $stmtAP->close();

                                $stmt2= $conn->prepare($sqlSelectWiFiDetails);
                                if($stmt2){

                                  $stmt2->bind_param("i", $nrAP); // folosim ap_essid salvat din interogarea de mai sus

                                  $stmt2->execute();

                                  $stmt2->bind_result($ApESSID, $SSID, $speed, $secType);
                                  $stmt2->fetch();

                                  if($SSID != "")
                                    echo"<p class=\"font-weight-bold mb-5\" >" . $SSID . "</p>";
                                      else
                                        echo"TP-LINK";

                                } else {
                                    echo "Failed to execute statement2...";
                                    printf("Error: %s.\n", htmlspecialchars($conn->error));
                                }

                                $stmt2->free_result();
                                $stmt2->close();

                              }else{
                                echo "Failed to execute statement...";
                                printf("Error: %s.\n", htmlspecialchars($conn->error));
                                $stmtAP->close();
                              //   // $conn->close();
                              }

                            ?>

                            <div class="row pb-4">
                              <i class="col-md-4 px-0 fab fa-500px fa-2x" style="color: #3d3f4c!important;"></i>
                              <div class="col-md-8 px-0 pt-1 pr-4 font-weight-bold" style="color: #3d3f4c!important;"><?php echo $BSSID ?></div>
                            </div>

                            <div class="row pb-4">

                              <i class="col-md-4 px-2 fas fa-tachometer-alt fa-2x"></i>

                               <div class="col-md-6 pt-1 font-weight-bold" style="color: #3d3f4c!important;"><?php echo $speed ?> mbps</div>
                            </div>

                            <div class="row pb-4">

                              <i class="col-md-4 px-2 fab fa-gripfire fa-2x" style="color:#ec600d !important;"></i>
                              <div class="col-md-6 pt-1 font-weight-bold" style="color: #3d3f4c!important;"><?php echo $secType ?></div>

                            </div>

                            <div class="row justify-content-center">

                              <button id="<?php echo $nrAP?>" type="button" value="edit" class="btn btn-sm view_data"><i class="col-md-8 px-2 mx-auto far fa-edit fa-3x"></i></button>
                                
                                <div id="editModal" class="modal fade">

                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">

                                        <h3 class="panel-title"><i class="fa fa-user"></i>
                                          <span class="font-weight-bold"><?php echo $SSID?></span>
                                        </h3>

                                      </div>

                                      <div class="modal-body">
                                        <form method="post" id="insert_form">

                                          <div class="input-group"><i class="fab fa-500px fa-2x"></i>
                                            <input type="text" name="MAC" id="MAC" class="form-control" placeholder="<?php echo $BSSID; ?>" required>
                                          </div>

                                          <div class="input-group"><i class="fas fa-tachometer-alt fa-2x"></i>
                                            <input type="text" name="speed" id="speed" class="form-control" placeholder="<?php echo $speed; ?>" required>
                                          </div>

                                          <div class="input-group"><i class="fab fa-gripfire fa-2x"></i>
                                            <input type="text" name="secType" id="secType" class="form-control" placeholder="<?php echo $secType ?>" required>
                                          </div>

                                          <input type="hidden" name="wifi_id" id="wifi_id" />  
                                          <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />
                                        </form>
                                      </div>
                                      <div class="modal-footer">  
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                                      </div>

                                      
                                    </div>
                                  </div>
                                </div>

                            </div>

                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                      <div class="card mb-3">
                        <div class="card-body py-5" data-aos="zoom-in" data-aos-duration="1000">
                          <div class="custom-text-primary"><i class="pb-3 fas fa-wifi fa-3x"></i>

                            <?php

                              $stmtAP = $conn->prepare($sqlSelectApBSSID);

                              if($stmtAP)
                              {
                                // $stmtAP->bind_param("i", 1);
                                // echo "da";
                                $nrAP = 2;
                                $stmtAP->bind_param("i", $nrAP);

                                $stmtAP->execute();

                                $stmtAP->bind_result($BSSID);
                                $stmtAP->fetch();

                                // echo $BSSID;

                                $stmtAP->free_result();
                                $stmtAP->close();

                                $stmt2= $conn->prepare($sqlSelectWiFiDetails);
                                if($stmt2){

                                  $stmt2->bind_param("i", $nrAP); // folosim ap_essid salvat din interogarea de mai sus

                                  $stmt2->execute();

                                  $stmt2->bind_result($ApESSID, $SSID, $speed, $secType);
                                  $stmt2->fetch();

                                  if($SSID != "")
                                    echo"<p class=\"font-weight-bold mb-5\" >" . $SSID . "</p>";
                                      else
                                        echo"TP-LINK";

                                } else {
                                    echo "Failed to execute statement2...";
                                    printf("Error: %s.\n", htmlspecialchars($conn->error));
                                }

                                $stmt2->free_result();
                                $stmt2->close();

                              }else{
                                echo "Failed to execute statement...";
                                printf("Error: %s.\n", htmlspecialchars($conn->error));
                                $stmtAP->close();
                              //   // $conn->close();
                              }

                            ?>

                            <div class="row pb-4">
                              <i class="col-md-4 px-0 fab fa-500px fa-2x" style="color: #3d3f4c!important;"></i>
                              <div class="col-md-8 px-0 pt-1 pr-4 font-weight-bold" style="color: #3d3f4c!important;"><?php echo $BSSID ?></div>
                            </div>

                            <div class="row pb-4">

                              <i class="col-md-4 px-2 fas fa-tachometer-alt fa-2x"></i>

                               <div class="col-md-6 pt-1 font-weight-bold" style="color: #3d3f4c!important;"><?php echo $speed ?> mbps</div>
                            </div>

                            <div class="row pb-4">

                              <i class="col-md-4 px-2 fab fa-gripfire fa-2x" style="color:#ec600d !important;"></i>
                              <div class="col-md-6 pt-1 font-weight-bold" style="color: #3d3f4c!important;"><?php echo $secType ?></div>

                            </div>

                            <div class="row justify-content-center">
                              <button type="button" class="btn btn-sm">
                                <i class="col-md-8 px-2 mx-auto far fa-edit fa-3x"></i>
                              </button>
                            </div>

                          </div>
                       </div>
                      </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                      <div class="card mb-3">
                        <div class="card-body py-5" data-aos="zoom-in" data-aos-duration="1500">
                          <div class="custom-text-primary"><i class="pb-3 fas fa-wifi fa-3x"></i>
                            <?php

                              $stmtAP = $conn->prepare($sqlSelectApBSSID);

                              if($stmtAP)
                              {
                                // $stmtAP->bind_param("i", 1);
                                // echo "da";
                                $nrAP = 3;
                                $stmtAP->bind_param("i", $nrAP);

                                $stmtAP->execute();

                                $stmtAP->bind_result($BSSID);
                                $stmtAP->fetch();

                                // echo $BSSID;

                                $stmtAP->free_result();
                                $stmtAP->close();

                                $stmt2= $conn->prepare($sqlSelectWiFiDetails);
                                if($stmt2){

                                  $stmt2->bind_param("i", $nrAP); // folosim ap_essid salvat din interogarea de mai sus

                                  $stmt2->execute();

                                  $stmt2->bind_result($ApESSID, $SSID, $speed, $secType);
                                  $stmt2->fetch();

                                  if($SSID != "")
                                    echo"<p class=\"font-weight-bold mb-5\" >" . $SSID . "</p>";
                                      else
                                        echo"<td>" . "TP-LINK" . "</td>";

                                } else {
                                    echo "Failed to execute statement2...";
                                    printf("Error: %s.\n", htmlspecialchars($conn->error));
                                }

                                $stmt2->free_result();
                                $stmt2->close();

                              }else{
                                echo "Failed to execute statement...";
                                printf("Error: %s.\n", htmlspecialchars($conn->error));
                                $stmtAP->close();
                              //   // $conn->close();
                              }

                            ?>

                            <div class="row pb-4">
                              <i class="col-md-4 px-0 fab fa-500px fa-2x" style="color: #3d3f4c!important;"></i>
                              <div class="col-md-8 px-0 pt-1 pr-4 font-weight-bold" style="color: #3d3f4c!important;"><?php echo $BSSID ?></div>
                            </div>

                            <div class="row pb-4">

                              <i class="col-md-4 px-2 fas fa-tachometer-alt fa-2x"></i>

                               <div class="col-md-6 pt-1 font-weight-bold" style="color: #3d3f4c!important;"><?php echo $speed ?> mbps</div>
                            </div>

                            <div class="row pb-4">

                              <i class="col-md-4 px-2 fab fa-gripfire fa-2x" style="color:#ec600d !important;"></i>
                              <div class="col-md-6 pt-1 font-weight-bold" style="color: #3d3f4c!important;"><?php echo $secType ?></div>

                            </div>

                            <div class="row justify-content-center">
                              <button type="button" class="btn btn-sm">
                                <i class="col-md-8 px-2 mx-auto far fa-edit fa-3x"></i>
                              </button>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                      <div class="card mb-3">
                        <div class="card-body py-5" data-aos="zoom-in" data-aos-duration="2000">
                          <div class="custom-text-primary"><i class="pb-3 fas fa-wifi fa-3x"></i>
                            <?php

                              $stmtAP = $conn->prepare($sqlSelectApBSSID);

                              if($stmtAP)
                              {
                                // $stmtAP->bind_param("i", 1);
                                // echo "da";
                                $nrAP = 4;
                                $stmtAP->bind_param("i", $nrAP);

                                $stmtAP->execute();

                                $stmtAP->bind_result($BSSID);
                                $stmtAP->fetch();

                                // echo $BSSID;

                                $stmtAP->free_result();
                                $stmtAP->close();

                                $stmt2= $conn->prepare($sqlSelectWiFiDetails);
                                if($stmt2){

                                  $stmt2->bind_param("i", $nrAP); // folosim ap_essid salvat din interogarea de mai sus

                                  $stmt2->execute();

                                  $stmt2->bind_result($ApESSID, $SSID, $speed, $secType);
                                  $stmt2->fetch();

                                  if($SSID != "")
                                    echo"<p class=\"font-weight-bold mb-5\" >" . $SSID . "</p>";
                                      else
                                        echo"TP-LINK";

                                } else {
                                    echo "Failed to execute statement2...";
                                    printf("Error: %s.\n", htmlspecialchars($conn->error));
                                }

                                $stmt2->free_result();
                                $stmt2->close();

                              }else{
                                echo "Failed to execute statement...";
                                printf("Error: %s.\n", htmlspecialchars($conn->error));
                                $stmtAP->close();
                              //   // $conn->close();
                              }

                            ?>

                            <div class="row pb-4">
                              <i class="col-md-4 px-0 fab fa-500px fa-2x" style="color: #3d3f4c!important;"></i>
                              <div class="col-md-8 px-0 pt-1 pr-4 font-weight-bold" style="color: #3d3f4c!important;"><?php echo $BSSID ?></div>
                            </div>

                            <div class="row pb-4">

                              <i class="col-md-4 px-2 fas fa-tachometer-alt fa-2x"></i>

                               <div class="col-md-6 pt-1 font-weight-bold" style="color: #3d3f4c!important;"><?php echo $speed ?> mbps</div>
                            </div>

                            <div class="row pb-4">

                              <i class="col-md-4 px-2 fab fa-gripfire fa-2x" style="color:#ec600d !important;"></i>
                              <div class="col-md-6 pt-1 font-weight-bold" style="color: #3d3f4c!important;"><?php echo $secType ?></div>

                            </div>

                            <div class="row justify-content-center">
                              <button type="button" class="btn btn-sm">
                                <i class="col-md-8 px-2 mx-auto far fa-edit fa-3x"></i>
                              </button>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>

            </div>

            <div class="da-projects" id="server">

              <div class="row mx-0">

                <div class="col-md-6 px-0 da-project-1 img-responsive" style="background-image: url('images/serverProxy.jpg');" data-aos="zoom-in">      
                </div>
                  
                <div class="col-md-6 pl-5 pt-5 pb-3">
                  <?php

                    $stmtServ = $conn->prepare($sqlSelectServerDetails);

                    if($stmtServ)
                    {
                     
                      $servType = "Proxy";
                      $stmtServ->bind_param("s", $servType);

                      $stmtServ->execute();

                      $stmtServ->bind_result($IP, $MAC, $servType, $servOS);
                      $stmtServ->fetch();

                      $stmtServ->free_result();
                      $stmtServ->close();


                    }else{
                      echo "Failed to execute statement...";
                      printf("Error: %s.\n", htmlspecialchars($conn->error));
                      $stmtServ->close();
                      //   // $conn->close();
                    }

                    ?>

                    <div class="row h3 justify-content-center" data-aos="fade-up" style="color: #3d3f4c !important;">

                      <?php echo"<span class=\"font-weight-bold mb-5\" >" . $servType . " Server" . "</span>";?> 
                    </div>

                    <div class="row mb-5">

                      <div class="col-2 da-project-icon text-center">
                        <i class="text-warning far fa-address-card fa-3x fa-fw"></i>
                      </div>

                      <div class="col-8 px-0 my-auto">
                        <div class="h4 font-weight-bold mb-0 text-center">
                          <span class="align-middle"><?php echo"$IP";?></span>
                        </div>
                      </div>

                    </div>

                    <div class="row mb-5">

                      <div class="col-2 da-project-icon text-center">
                        <i class="fab fa-500px fa-3x fa-fw "></i>
                      </div>

                      <div class="col-8 px-0 my-auto">
                        <div class="h4 font-weight-bold mb-0 text-center">
                          <span class="align-middle"><?php echo"$MAC";?></span>
                        </div>
                      </div>

                    </div>


                    <div class="row mb-5">

                      <div class="col-2 da-project-icon text-center">
                        <i class="fab fa-windows fa-3x fa-fw text-primary "></i>
                      </div>

                      <div class="col-8 px-0 my-auto">
                        <div class="h4 font-weight-bold mb-0 text-center">
                          <span class="align-middle"><?php echo"$servOS";?></span>
                        </div>
                      </div>

                    </div>

                </div>
              </div>

              <div class="row mx-0">

                <div class="col-md-6 pl-5 pt-5 pb-3">
                  <?php

                    $stmtServ = $conn->prepare($sqlSelectServerDetails);

                    if($stmtServ)
                    {
                     
                      $servType = "Mail";
                      $stmtServ->bind_param("s", $servType);

                      $stmtServ->execute();

                      $stmtServ->bind_result($IP, $MAC, $servType, $servOS);
                      $stmtServ->fetch();

                      $stmtServ->free_result();
                      $stmtServ->close();


                    }else{
                      echo "Failed to execute statement...";
                      printf("Error: %s.\n", htmlspecialchars($conn->error));
                      $stmtServ->close();
                      //   // $conn->close();
                    }

                    ?>

                    <div class="row h3 justify-content-center" data-aos="fade-up" style="color: #3d3f4c !important;">

                      <?php echo"<span class=\"font-weight-bold mb-5\" >" . $servType . " Server" . "</span>";?> 
                    </div>

                    <div class="row mb-5">

                      <div class="col-2 da-project-icon text-center">
                        <i class="text-warning far fa-address-card fa-3x fa-fw"></i>
                      </div>

                      <div class="col-8 px-0 my-auto">
                        <div class="h4 font-weight-bold mb-0 text-center">
                          <span class="align-middle"><?php echo"$IP";?></span>
                        </div>
                      </div>

                    </div>

                    <div class="row mb-5">

                      <div class="col-2 da-project-icon text-center">
                        <i class="fab fa-500px fa-3x fa-fw "></i>
                      </div>

                      <div class="col-8 px-0 my-auto">
                        <div class="h4 font-weight-bold mb-0 text-center">
                          <span class="align-middle"><?php echo"$MAC";?></span>
                        </div>
                      </div>

                    </div>


                    <div class="row mb-5">

                      <div class="col-2 da-project-icon text-center">
                        <i class="fas fa-user-secret fa-3x fa-fw text-danger "></i>
                      </div>

                      <div class="col-8 px-0 my-auto">
                        <div class="h4 font-weight-bold mb-0 text-center">
                          <span class="align-middle"><?php echo"$servOS";?></span>
                        </div>
                      </div>

                    </div>

                </div>

                <div class="col-md-6 px-0 da-project-2 img-responsive" style="background-image: url('images/serverFTP.jpg');" data-aos="zoom-in"></div>
              
              </div>

              
              <div class="row mx-0">
                <div class="col-md-6 px-0 da-exp-image img-responsive" style="background-image: url('images/serverMail.jpg');" data-aos="zoom-in"></div>

                <div class="col-md-6 pl-5 pt-5 pb-3">
                  <?php

                    $stmtServ = $conn->prepare($sqlSelectServerDetails);

                    if($stmtServ)
                    {
                     
                      $servType = "FTP";
                      $stmtServ->bind_param("s", $servType);

                      $stmtServ->execute();

                      $stmtServ->bind_result($IP, $MAC, $servType, $servOS);
                      $stmtServ->fetch();

                      $stmtServ->free_result();
                      $stmtServ->close();


                    }else{
                      echo "Failed to execute statement...";
                      printf("Error: %s.\n", htmlspecialchars($conn->error));
                      $stmtServ->close();
                      //   // $conn->close();
                    }

                    ?>

                    <div class="row h3 justify-content-center" data-aos="fade-up" style="color: #3d3f4c !important;">

                      <?php echo"<span class=\"font-weight-bold mb-5\" >" . $servType . " Server" . "</span>";?> 
                    </div>

                    <div class="row mb-5">

                      <div class="col-2 da-project-icon text-center">
                        <i class="text-warning far fa-address-card fa-3x fa-fw"></i>
                      </div>

                      <div class="col-8 px-0 my-auto">
                        <div class="h4 font-weight-bold mb-0 text-center">
                          <span class="align-middle"><?php echo"$IP";?></span>
                        </div>
                      </div>

                    </div>

                    <div class="row mb-5">

                      <div class="col-2 da-project-icon text-center">
                        <i class="fab fa-500px fa-3x fa-fw "></i>
                      </div>

                      <div class="col-8 px-0 my-auto">
                        <div class="h4 font-weight-bold mb-0 text-center">
                          <span class="align-middle"><?php echo"$MAC";?></span>
                        </div>
                      </div>

                    </div>


                    <div class="row mb-5">

                      <div class="col-2 da-project-icon text-center">
                        <i class="fab fa-apple fa-3x fa-fw text-success "></i>
                      </div>

                      <div class="col-8 px-0 my-auto">
                        <div class="h4 font-weight-bold mb-0 text-center">
                          <span class="align-middle"><?php echo"$servOS";?></span>
                        </div>
                      </div>

                    </div>

                </div>

              </div>
            </div>

            <div class="da-router" id="router">

              <div class="container">

                <div class="text-white pb-5" data-aos="fade-up">
                  <h1 class="custom-font font-weight-bold ">Router configuration</h1>
                </div>

                <?php

                $stmtRouter = $conn->prepare($sqlSelectRouterDetails);

                if($stmtRouter)
                {
                     
                  $stmtRouter->execute();

                  $stmtRouter->bind_result($MAC, $IP_INT0, $IP_INT1, $IP_INT2, $IP_INT3);
                  $stmtRouter->fetch();

                  $stmtRouter->free_result();
                  $stmtRouter->close();


                }else{

                  echo "Failed to execute statement...";
                  printf("Error: %s.\n", htmlspecialchars($conn->error));
                  $stmtRouter->close();
                      //   // $conn->close();
                }

              ?>

                <div class="row pb-5">

                  <div class="col-md-4"></div>
                  <div class="col-md-4">

                    <form id="router-formInt0" data-aos="zoom-in-up" class="col-md-12 focused" action="" method="POST">
                      <input id="router-inputInt0" type="text" name="int0" class="col-md-10 d-inline" value="<?php echo $IP_INT0; ?>" pattern="^[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}$" required>

                      <div class="col-md-2 px-0 d-inline">
                        <button type="submit" class="btn btn-sm">
                          <i class="mx-auto far fa-edit fa-2x"></i>
                        </button>
                      </div>

                    </form>

                  </div>
                  <div class="col-md-4"></div>

                </div>

                <div class="row pb-5">

                  <div class="col-md-4 mt-5" data-aos="zoom-in-up">

                    <form id="router-formInt1" class="col-md-10" action="" method="POST">

                      <input id="router-inputInt1" type="text" name="int0" class="col-md-10 d-inline" placeholder="<?php echo $IP_INT1; ?>" readonly>

                        <div class="col-md-2 px-0 d-inline">
                          <button type="button" class="btn btn-sm px-1">
                            <i class="mx-auto fas fa-lock fa-2x"></i>
                          </button>
                        </div>

                    </form>

                  </div>

                  <div class="col-md-4 mt-5 pt-5" data-aos="flip-right">

                    <form id="router-formInt2" class="col-md-10" action="" method="POST">

                      <input id="router-inputInt2" type="text" name="int0" class="col-md-10 d-inline" placeholder="<?php echo $IP_INT2; ?>" readonly>

                        <div class="col-md-2 px-0 d-inline">
                          <button type="button" class="btn btn-sm px-1">
                            <i class="mx-auto fas fa-lock fa-2x"></i>
                          </button>
                        </div>

                    </form>

                  </div>

                  <div class="col-md-4 mt-5" data-aos="flip-left">

                    <form id="router-formInt3" class="col-md-10" action="" method="POST">

                      <input id="router-inputInt3" type="text" name="int0" class="col-md-10 d-inline" placeholder="<?php echo $IP_INT3; ?>" readonly>

                        <div class="col-md-2 px-0 d-inline">
                          <button type="button" class="btn btn-sm px-1">
                            <i class="mx-auto fas fa-lock fa-2x"></i>
                          </button>
                        </div>

                    </form>

                  </div>

                </div>

              </div>
            </div>




        </div>
            <div id="scrolltop">
              <button class="btn btn-primary"><span class="icon"><i class="fas fa-angle-up fa-2x"></i></span></button>
            </div>
      </div>




    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/ekko-lightbox.min.js"></script>
    <script src="scripts/main.js"></script>

<script type="text/javascript">
  $(function() {
    $('[data-toggle="popover"]').popover({
      container: 'body'
    });
  });
</script>
<!-- 
<script>

$(document).ready(function(){
  $(document).on('click', '.edit_data', function(){
    var wifi_id = $(this).attr("id");
    $.ajax({
      url:"fetch.php",
      method:"POST",
      data:{wifi_id:wifi_id},
      dataType:"json",
      success:function(data){

        $('#BSSID').val(data.BSSID);
        $('#speed').val(data.speed);
        $('#secType').val(data.secType);
        $('#wifi_id').val(data.id);
        $('#insert').val("Update");
        $('EeditModal').modal('show');
      }
    });
  });

  $('#insert_form').on("submit", function(event){  
           event.preventDefault();  
           if($('#BSSID').val() == "")  
           {  
              alert("BSSID is required");  
           }  
           else if($('#speed').val() == '')  
           {  
              alert("Speed is required");  
           }  
           else if($('#secType').val() == '')  
           {  
              alert("A security type is required");  
           }  
           else
           {
              $.ajax({
                url:"insert.php".
                method: "POST",
                data:$('#insert_form').serialize(),
                beforeSend:function(){
                  $('#insert').val("Inserting");
                },
                success:function(data){
                  $('#insert_form')[0].reset();
                  $('#editModal').modal('hide');
                  $('#wifi_details').html(data);
                }

              });
           }
        });

      $(document).on('click', '.view_data', function(){  
           var wifi_id = $(this).attr("id");  
           if(wifi != '')  
           {  
                $.ajax({  
                     url:"select.php",  
                     method:"POST",  
                     data:{wifi_id:wifi_id},  
                     success:function(data){  
                          $('#wifi_details').html(data);  
                          // $('#dataModal').modal('show');  
                     }  
                });  
           }            
      });  
 });  

</script>
 -->
<script type="text/javascript">

  var input = document.getElementById('router-inputInt0'),
  div = document.getElementById('router-formInt0');

  console.log(input);
  console.log(div);

  input.addEventListener('focus', function() {
    div.classList.add('focused');
    // div.style.backgroundColor = "red";
  }, false);

  input.addEventListener('blur', function() {
    div.classList.remove('focused');
  }, false);


</script>
</body>

</html>