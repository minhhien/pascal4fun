<?php
function get_connection(){
	$servername = "localhost";
	$username = "root";
	$password = "123456";
	$dbname = "pascal4fun";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);//Ket noi CSDL voi ten server...

	// Check connection
	if (mysqli_connect_errno())
	{
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();//loi msql may chu
	}	

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error); // ket noi loi
	}

	mysqli_set_charset($conn,"utf8"); // Ho tro tieng viet cho CSDL
	return $conn;
}
?> 
