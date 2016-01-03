<?php

require 'libs/checklogin.php';
require 'libs/functions.php';
	
$username = $_SESSION["username"];
$exerid = $_GET['id'];
			
if(!active_exercise($exerid, $username)){
	header('Location: practice.php');
}

?>
<html>
	<head>
		<title>Pascal 4fun | Hồ sơ học viên</title>
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
				Xin chào <a href="profile.php"><?php echo $username; ?></a> | 
				<a href="index.php">Trang chủ</a> |
				<a href="survey.php">Đánh giá</a> |		
				<a href="logout.php">Đăng xuất</a>
			</span>
			
		</header>
		<div id="content">
			<h2>Hồ sơ học viên</h2>
			<table border="0" cellpadding="2" cellspacing="2" class="profile" align="center">	
			<tr>
				<td>
					Tài khoản:
				</td>
				<td> 
					<?php echo $username; ?>
				</td>
			</tr>
			<tr>
				<td>
					Họ và tên:
				</td>
				<td>
					<?php echo get_fullname($username); ?>
				</td>
	
			</tr>
			<tr>
				<td>
					Bài tập đã hoàn thành:
				</td>
				<td>
					<?php echo get_passed_exercise($username); ?>
				</td>
			</tr>
			<tr>
				<td>
					Điểm:
				</td>
				<td>
					<?php echo get_marks($username); ?>
				</td>
			</tr>
			<tr>
				<td>
					Cấp độ kỹ năng:
				</td>
				<td>
					<?php echo get_skill($username); ?>
				</td>
			</tr>
			</table>
		</div>
	</body>

	<script>
	  updateMarks();
	  updateSkill();
	</script>
	
</html>
