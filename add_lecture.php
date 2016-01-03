<?php

include 'libs/checklogin.php';
	
$username = $_SESSION["username"];

if($username !== "admin"){
	header('Location: index.php');
}
?>
<html>
	<head>
		<title>Pascal 4fun | Thêm tài liệu |</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<link rel="stylesheet" type="text/css" href="css/style.css">

		<script src="js/jquery-1.11.3.js"></script>
		<script src="js/script.js"></script>
		
		<style>
			#name{
				width: 400px;
			}
			#slide{
				width: 400px;
				height: 100px;
			}
			
			#result{
				border: 1px solid #f5f5f5;
				width: 390px;
			}
		</style>
	</head>
	
	<body>
		<?php
			$exerid = 0;
			$filename = $username . '_exer_' . $exerid;
		?>

		<header>
			<a href='index.php' class='Link'></a>
			<span id="profile" >
				Xin chào <a href="profile.php"><?php echo $username; ?></a>(<span id="marks" class="marks"></span> - <span id="skill" class="skill"></span>) | 
				<a href="index.php">Trang chủ</a> |
				<a href="survey.php">Đánh giá</a> |		
				<a href="logout.php">Đăng xuất</a>
			</span>
			
		</header>
		<div id="content">
			<?php
			echo '<h2>Bổ sung slide bài giảng</h2>';
			?>
			<table class="large">
			<tr>
				<td valign="top">
					Tên bài giảng:
				</td>
				<td> 
					<input type="text" name="name" id="name" />
				</td>	
			</tr>
			<tr>
				<td valign="top">
					Bài giảng
				</td>
				<td> 
					<textarea name="slide" id="slide" onclick="clearContent('slide')">// Dán mã nhúng slide vào đây!</textarea>
				</td>	
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="button" onclick="addLectureFunct()" class="btn" value="Chấp nhận" id="apply">
					<a href="lecture_listing.php" class="vid_link" style="margin-left:150px"><img src="images/slide.png" />Danh sách slide</a>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<div id="result"></div>
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
