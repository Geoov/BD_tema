<?php

session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}

define('MyConst', TRUE);

require_once "config.php";
require_once "interogariSQL.php";

$username = $password = "";
$username_err = $password_err = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){

	if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    if(empty($username_err) && empty($password_err)){
    	$stmt = $conn->prepare($sqlSelectUser);

    	if($stmt){
    		$stmt->bind_param("s", $param_username);

    		$param_username = $username;

    		if($stmt->execute()){

    			$stmt->store_result();

    			if($stmt->num_rows == 1){

    				$stmt->bind_result($id, $username, $hashed_password, $rol);
    				if($stmt->fetch()){
    					if(password_verify($password, $hashed_password)){
    						session_start();

    						$_SESSION["loggedin"] = true;
    						$_SESSION["id"] = $id;
    						$_SESSION["username"] = $username;
                            $_SESSION["rol"] = $rol;

                            if($rol == 2)
                                header("location: adminHome.php");
                            else
                                header("location: welcomeUser.php");
    					} else {
    						$password_err = "The password didn't match..";
    					}
    				}
    			} else{
    				echo "No account found with this username..";
    			}
    		} else{
    			echo "Failed execute...";
    			printf("Error: %s.\n", $stmt->error);
    		}
    	}
    	$stmt->close();
    } else{
    	header("location: login.php");
    	echo "Erori: ";
    	echo $username_err;
    	echo $password_err;
    }
    
     $conn->close();
}

?>

<!DOCTYPE html>
<html>
	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" type="text/css" href="style.css">

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	</head>

	<body>
	<div class="inline-container bg">
		<!-- <canvas id="nokey"> -->
<!-- 
			<canvas id="nokey">
			    Your Browser Don't Support Canvas, Please Download Chrome ^_^``
			</canvas> -->

	 		<div class="container" style="padding:20px;">
			 	<div class="row justify-content-center">

			 		<div class="card col-md-5 mt-5 px-0">

				 		<div class="fadeInDown">
				 			<div id="top-container" class="card-body text-center px-0 py-0 mx-2 my-2">

					 			<a href="login.php" class="active mt-5 mr-3"> Sign In </a>
							   	<a href="register.php" class="inactive  mt-5">Sign Up </a>

							    <form class="formContent mt-4" action="" method="POST">
							      	<input type="text" name="username" class="fadeIn first" placeholder="username">

							      	<input type="password" name="password" class="fadeIn second"  placeholder="password">
								    
								    <input type="submit" class="fadeIn third mt-3" value="Log In">
								</form>

						  	</div>
						</div>

					</div>
				</div>
			</div>

		<!-- </div> -->
	</div>

	</body>
 <!-- <script src="cursor.js"></script>  -->
</html>
