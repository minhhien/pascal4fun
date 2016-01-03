<?php

require 'libs/checklogin.php';
require 'libs/functions.php';
	
$username = $_SESSION["username"];//Ky thuat luu tru thong tin bang _session
$exerid = $_GET['id'];		// Lay thong tin tu phuong thuc Get 
			
if(!active_exercise($exerid, $username)){ //Kiem tra da duoc lam bai tap co chi so exerid hay chua
	header('Location: practice.php');
}

?>
<html>
	<head>
		<title>Pascal 4fun | Thực hành</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<link rel="stylesheet" type="text/css" href="css/style.css">
		
		<!-- Nhung thu vien tao Editor -->
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
				Xin chào <a href="profile.php"><?php echo $username; ?></a>(<span id="marks" class="marks"></span> - <span id="skill" class="skill"></span>) | 
				<a href="index.php">Trang chủ</a> |
				<a href="survey.php">Đánh giá</a> |		
				<a href="logout.php">Đăng xuất</a>
			</span>
			
		</header>
		<div id="content">
			<?php

			echo '<div id="exercise-pane"></div>'; //Vung hien thi bai tap
			
			if($exerid == 0){
				echo '<h2>Tập viết chương trình</h2>';
			}else{
				$question = get_question($exerid);

				echo '<h2>Bài số '.$exerid.'</h2>';
				echo '<p class="question">'.$question.'</p>';
			}

			?>
			<div id="left">
			<table class="large">
			<tr>
				<td> 
					<textarea name="code" id="code">
<?php
echo get_code($exerid, $username);
?>					</textarea>
				</td>	
			</tr>
			<tr>
				<td>
					<input type="button" onclick="compileFunct('<?php echo $filename; ?>.pas', <?php echo $exerid; ?>)" class="btn" value="Biên dịch" id="compile">
				</td>
			</tr>
			<tr>
				<td>
					<div id="result"></div>
				</td>									
			</tr>
			
			</table>
			</div>

			<div id="right">
				<?php
				$btn_value = "Kiểm thử";

				if($exerid < 3){
					$btn_value = "Chạy";
				}

				if($exerid != 0){
				?>
				<input type="button" onclick="executeFunct('<?php echo $filename; ?>', <?php echo $exerid; ?>)" class="btn btn2 btn-dis" value="<?php echo $btn_value; ?>" id="execute" disabled />
			 	<div id="output"></div>
				<?php } ?>
			</div>
		</div>
		
	<!-- Nhung link Ly thuyet, video -->
		<div id="refer">
			<h4>Kiến thức tham khảo</h1>
			<ul>
			<?php
			if($exerid == 1){
				?>
				<li>
					<a href="#">Bài 1</a>
				</li>
				<li>
					<a href="video<?php echo $exerid ?>.php">Video về biến</a>
				</li>
				<?php
			} else if($exerid == 2){
				?>
				<li>
					<a href="#">Bài 2</a>
				</li>
				<li>
					<a href="video<?php echo $exerid ?>.php">Video về ham</a>
				</li>
				<?php
			} else if($exerid == 3){
				?>
				<li>
					<a href="#">...</a>
				</li>
				<li>
					<a href="video<?php echo $exerid ?>.php">....</a>
				</li>
				<?php
			} else if($exerid == 4){
				?>
				<li>
					<a href="#">...</a>
				</li>
				<li>
					<a href="video<?php echo $exerid ?>.php">....</a>
				</li>
				<?php
			} else if($exerid == 5){
				?>
				<li>
					<a href="#">...</a>
				</li>
				<li>
					<a href="video<?php echo $exerid ?>.php">....</a>
				</li>
				<?php
			} else if($exerid == 6){
				?>
				<li>
					<a href="#">...</a>
				</li>
				<li>
					<a href="video<?php echo $exerid ?>.php">....</a>
				</li>
				<?php
			}
			?>
			</ul>
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
