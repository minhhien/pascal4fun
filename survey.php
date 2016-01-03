<?php

require 'libs/checklogin.php';
require 'libs/functions.php';
	
$username = $_SESSION["username"];
$exerid = 0;
			
if(!active_exercise($exerid, $username)){
	header('Location: practice.php');
}

?>
<html>
	<head>
		<title>Pascal 4fun | Khảo sát</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<link rel="stylesheet" type="text/css" href="css/style.css">

		<link rel="stylesheet" href="js/lib/codemirror.css">
		<script src="js/lib/codemirror.js"></script>
		<script src="js/mode/pascal/pascal.js"></script>

		<script src="js/jquery-1.11.3.js"></script>
		<script src="js/script.js"></script>
		
	</head>
	
	<body>
		<?php
			if($exerid==null || $exerid==''){
				$exerid = 0;
			}
			$filename = $username . '_exer_' . $exerid;
		?>

		<header>
			<a href='index.php' class='Link'></a>
			<span id="profile" >
				Xin chào <a href="#"><?php echo $username; ?></a>(<span id="marks" class="marks"></span>) | 
				<a href="index.php">Trang chủ</a> |		
				<a href="logout.php">Đăng xuất</a>
			</span>
			
		</header>
		<div id="content">
			<iframe src="https://docs.google.com/forms/d/17IyKND43-kVQ8k0sD2cssxmTNBUeXovfJrZDHP3M4PE/viewform?embedded=true#start=embed" width="700" height="1500" frameborder="0" marginheight="0" marginwidth="0" scrolling="no">Loading...</iframe>
		</div>
	</body>

	<script>
	  
	</script>
	<script>
	  updateMarks();
	</script>
	
</html>
