<?php
include 'libs/checklogin.php';
require 'libs/functions.php';
?>
<html>
	<head>
		<title>Pascal 4fun | Video bài giảng</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<link rel="stylesheet" type="text/css" href="css/main.css">

	</head>
	
	<body>
		<header>
			<a href='index.php' class='Link'></a>
		</header>
		<div id="content">
			<h2 class="tieude">VIDEO BÀI GIẢNG</h2>
			<?php
				echo list_videos();
			?>
		</div>

	</body>
</html>
