<?php
include 'libs/checklogin.php';

require 'libs/functions.php';

$username = $_SESSION["username"];

$name = $_POST["name"];
$embeded = $_POST["embededCode"];

if ($username==="admin"){
	if(add_video($name, $embeded)){
		echo 'Thành công!';
	}else{
		echo 'Gặp lỗi!!!';
	}	
} else {
	header('Location: index.php');
}

?>
