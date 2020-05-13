<?php

	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', 'mysqlroot');
	define('DB_NAME', 'antonio');

	$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

	$sql = "SELECT idnew_table, first from new_table";

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        echo "MAC: " . $row["idnew_table"]. " - IP: " . $row["first"] . "<br>";
	    }
	} else {
	    echo "0 results";
	}

	$conn->close();
?>