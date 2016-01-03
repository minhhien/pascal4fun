<?php

include 'libs/checklogin.php';
	
$username = $_SESSION["username"];

if($username !== "admin"){
	header('Location: index.php');
}
?>
<html>
	<head>
		<title>Pascal 4fun | Bổ sung Video</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<link rel="stylesheet" type="text/css" href="css/style.css">

		<script src="js/jquery-1.11.3.js"></script>
		<script src="js/script.js"></script>
		
		<style>
			#name{
				width: 400px;
			}
			#video{
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
			echo '<h2>Bổ sung video bài giảng</h2>';
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
					Video Youtube:
				</td>
				<td> 
					<textarea name="video" id="video" onclick="clearContent('video')">// Dán mã nhúng video vào đây!</textarea>
				</td>	
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="button" onclick="addVideoFunct()" class="btn" value="Chấp nhận" id="apply">
					<a href="video_listing.php" class="vid_link" style="margin-left:150px"><img src="images/video.png" />Danh sách video</a>
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
