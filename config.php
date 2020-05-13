<?php

if(!defined('MyConst')) {
   die('Direct access not permitted');
}

	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', 'mysqlroot');
	define('DB_NAME', 'rc');

	$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

	if($conn->connect_error){
		die('Connection failed: ' . $conn->connect_error);
	}

	// echo "Connected successfully";
?>
