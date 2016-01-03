<?php

include 'libs/checklogin.php';
	
$username = $_SESSION["username"];

?>
<html>
	<head>
		<title>Pascal 4fun | Thực hành</title>
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
			echo '<div id="exercise-pane"></div>';
			echo '<h2>Hãy viết một chương trình bạn thích và xem kết quả !!!</h2>';
			?>
			<div id="left">
			<table class="large">
			<tr>
				<td valign="top">
					Mã Pascal:
				</td>
				<td> 
					<textarea name="code" id="code">
program Excercise<?php echo $exerid; ?>;
begin
	(*  Viết mã Pascal ở đây *)
end.			
					</textarea>
				</td>	
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="button" onclick="compileFunct('<?php echo $filename; ?>.pas')" class="btn" value="Biên dịch" id="compile">
				</td>
			</tr>
			<tr>
				<td valign="top">
					Kết quả biên dịch:
				</td>
				<td>
					<div id="result"></div>
				</td>									
			</tr>
			</table>
			</div>

			<div id="right">
				<?php
				$btn_value = "Kiểm thử";

				$btn_value = "Chạy";
				
				?>
				<input type="button" onclick="executeFunct('<?php echo $filename; ?>', <?php echo $exerid; ?>)" class="btn btn2 btn-dis" value="<?php echo $btn_value; ?>" id="execute" disabled />
			 	<div id="output"></div>
			</div>
		</div>
	</body>

	<script>
	  var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
		lineNumbers: true,
		mode: "text/x-pascal"
	  });
	</script>
	<script>
	  getExercises();
	  updateMarks();
	  updateSkill();
	</script>
</html>
