<?php

require_once 'connect2db.php';
require_once 'filelib.php';

function check_login($username, $password){
	$conn = get_connection();

	$sql = "SELECT * FROM Users WHERE username ='$username' AND password ='$password' AND active=1 LIMIT 0,30";
	$result =  mysqli_query($conn, $sql);

	if ($result->num_rows == 1) {
		$row =  mysqli_fetch_assoc($result);
		if($row['username'] == $username){
			return true;
		}
	}
	
	$conn->close();	

	return false;	
}

function validate_user($username){
	echo $username;
	if(strlen($username) > 0 && strlen(trim($username)) > 0){
		$conn = get_connection();
		$sql = "SELECT * FROM Users WHERE username ='$username' LIMIT 0,30";
		$result =  mysqli_query($conn, $sql);
		echo $sql;
		if ($result->num_rows == 0) {
			return true;
		}
	
		$conn->close();	
	}
	return false;
}


function create_user($username, $passwd, $fullname){
	if(strlen(trim($username)) > 0 && strlen(trim($passwd)) > 0){
		$conn = get_connection();

		$sql = "INSERT INTO Users(username, password, fullname, marks, active) VALUES('$username', '$passwd', '$fullname', 0, 0)";
		//if ($conn->query($sql) === TRUE) {
		if (mysqli_query($conn, $sql)){
			return true;
		}
	
		$conn->close();	
	}

	return false;
}

function get_exercise_marks($exer_id){
	return $exer_id*5; //Tinh diem don gian can cu vao ID cau bai hoc
}

function active_exercise($exer_id, $username){
	$conn = get_connection();
	$sql = "SELECT marks FROM Users WHERE username='$username' LIMIT 0,30";
	$result =  mysqli_query($conn, $sql);
	
	if ($result->num_rows == 1) {
		$row = $result->fetch_assoc();
		$marks = $row['marks'];
		if($marks >= get_exercise_marks($exer_id - 1)){
			return true;
		}
	}

	return false;
}

function list_exercises($username){ // Ham lay danh sach bai tap hien thi len dau trang
	$exercises = '';
	$conn = get_connection();

	$sql = "SELECT * FROM Exercise LIMIT 0,30";
	$result =  mysqli_query($conn, $sql);

	if ($result->num_rows > 0) {
		$exercises = '<ul id="exercise">';
		$exercises .= '<li>';
		$exercises .= 	'<a href="practice.php">Ôn tập</a>';	
				$exercises .= '<p>Tập lập trình</p>';	
		$exercises .= '</li>';

		while($row = $result->fetch_assoc()) {
			$exercises .= '<li>';
			if(active_exercise($row["exercise_id"], $username)){
				$exercises .= '<a href="do_exercise.php?id='.$row["exercise_id"].'">Bài số '.$row["exercise_id"].'</a>';	
				$exercises .= '<p>'.$row["name"].'</p>';
			}else{
				$exercises .= 'Bài số '.$row["exercise_id"];
				$exercises .= '<p>'.$row["name"].'</p>';
			}

			$exercises .= '</li>';		
		}
		$exercises .= '</ul>';
	}
	$conn->close();	
	
	return $exercises;
}

function check_valid_exercise($exerid){
	$conn = get_connection();
	$sql = "SELECT * FROM Exercise WHERE exercise_id=". $exerid ." LIMIT 0,30";
	$result =  mysqli_query($conn, $sql);
	
	if ($result->num_rows == 1) {
		return true;
	}
	$conn->close();	
	
	return false;
}

function get_question($exerid){
	$question = '';
	$conn = get_connection();
	$sql = "SELECT * FROM Exercise WHERE exercise_id=". $exerid ." LIMIT 0,30";
	$result =  mysqli_query($conn, $sql);
	
	if ($result->num_rows == 1) {
		$row = $result->fetch_assoc();
		$question = $row["question"];
	}
	$conn->close();	
	
	return $question;
}

function get_answer($exerid){
	$answer = '';
	$conn = get_connection();

	$sql = "SELECT * FROM Exercise WHERE exercise_id=". $exerid ." LIMIT 0,30";
	$result =  mysqli_query($conn, $sql);

	if ($result->num_rows == 1) {
		$row = $result->fetch_assoc();
		$answer = $row["answer"];
	}
	$conn->close();	
	
	return $answer;
}

function get_fullname($username){
	$conn = get_connection();
	$sql = "SELECT fullname FROM Users WHERE username='$username' LIMIT 0,30";
	$result =  mysqli_query($conn, $sql);
	
	if ($result->num_rows == 1) {
		$row = $result->fetch_assoc();//Lay tung dong
		$fullname = $row['fullname'];
		return $fullname;
	}

	return "N/A";
}


function get_marks($username){
	$conn = get_connection();
	$sql = "SELECT marks FROM Users WHERE username='$username' LIMIT 0,30";
	$result =  mysqli_query($conn, $sql);
	
	if ($result->num_rows == 1) {
		$row = $result->fetch_assoc();
		$marks = $row['marks'];
		return $marks;
	}

	return 0;
}

function set_marks($username, $exer_id){
	if(strlen($username) > 0 && strlen(trim($username, ' ')) > 0 
		&& $exer_id > 0 && get_marks($username) < $exer_id*5){
		$conn = get_connection();
		
		$marks = get_marks($username) + 5;
		$sql = "UPDATE Users SET marks=".$marks." WHERE username='".$username."'";
		
		if ($conn->query($sql)===TRUE) {
			return true;
		}
	
		$conn->close();	
	}

	return false;
}

function get_skill($username){
	$marks = get_marks($username);
	$conn = get_connection();
	$sql = "SELECT name FROM SkillLevel WHERE marks =".$marks." LIMIT 0,30";
	$result =  mysqli_query($conn, $sql);
	
	if ($result->num_rows == 1) {
		$row = $result->fetch_assoc();
		$skillName = $row['name'];
		return $skillName;
	}

	return "N/A";
}

function get_passed_exercise($username){
	$marks = get_marks($username);
	
	if ($marks > 0) {
		return $marks/5;
	}

	return "N/A";
}

function ranking(){
	$ranking_board = '';

	$conn = get_connection();

	$sql = "SELECT * FROM Users ORDER BY marks DESC LIMIT 0,10";
	$result =  mysqli_query($conn, $sql);

	if ($result->num_rows > 0) {
		$ranking_board .= '<table id="ranking-board">';
		$ranking_board .= '<tr>';
		$ranking_board .= '	<th>STT</th><th>Tài khoản</th><th>Điểm</th><th>Bậc kỹ năng</th>';
		$ranking_board .= '</tr>';
		$num = 1;
		while($row = $result->fetch_assoc()) {
			$ranking_board .= '<tr>';
			$ranking_board .= '	<td align="center">'.$num.'</td><td>'.$row['username'].'</td><td align="right">'.$row['marks'].'</td>';
			$ranking_board .= '	<td align="center">'.get_skill($row['username']).'</td>';			
			$ranking_board .= '</tr>';	
			$num++;	
		}
		$ranking_board .= '</table>';
	}
	$conn->close();		
	
	return $ranking_board;
}

function get_sample_code($exerid){
	$conn = get_connection();
	$sql = "SELECT sample_code FROM Exercise WHERE exercise_id='$exerid' LIMIT 0,30";
	$result =  mysqli_query($conn, $sql);
	
	if ($result->num_rows == 1) {
		$row = $result->fetch_assoc();
		$sample_code = $row['sample_code'];
		return trim($sample_code);
	}

	return '(* Sample code *)&#10;';
}

function get_passed_code($exerid,  $username){
	$file_name = $username . '_exer_' . $exerid .'.pas';

	if(exist($file_name) === FALSE){
		return '';
	}
	
	$code = read_src_file($file_name);
	
	$passcode = '';
	if($exerid > 2){
		$pos1= stripos($code, '(*---*)');
		$pos2= strrpos($code, '(*---*)');
		$passcode =  substr($code, 0, $pos2);
		$passcode =  substr($passcode, $pos1 + 8);
	}else{
		$passcode = $code;
	}

	return $passcode;
}

function get_code($exerid, $username){
	$code = '';

	if(get_marks($username) >= $exerid * 5){
		$code = get_passed_code($exerid,  $username);
	}
	if(strlen($code) == 0 || strcmp($code, 'Unable to open file!') == 0){
		$code = get_sample_code($exerid);
	}
	
	return $code;	
}

function code_to_compile($code){
	$new_code = 
'program Exercise;
(*---*)
' . $code . '
(*---*)
begin
end.';
	return $new_code;
}

function code_to_test($exer_id, $code,  $filename){
	$new_code = '';
		
	if($exer_id == 3 || $exer_id == 4 || $exer_id == 5 || $exer_id == 6 ){
		$patt0 = '/function( ){1,}[a-z0-9_]{1,}/i';
		$check = preg_match($patt0, $code, $arr);
		$function_name = $arr[0];
		$pos = strpos($function_name, 'function');
		$function_name = str_replace('function', '', $function_name);
		$function_name = trim($function_name);
		$new_code = 'program TestProgram;
(*---*)
'.$code.'
(*---*)
begin
	writeln('.$function_name.'(#NUM));
end.';	
	}

	return $new_code;
}

function add_video($name, $embeded){
	if(strlen(trim($name)) > 0 && strlen(trim($embeded)) > 0){
		$conn = get_connection();
		
		$sql = "INSERT INTO LectureVideo(name, embeded) VALUES('$name', '$embeded')";
		if (mysqli_query($conn, $sql)){
			return true;
		}
	
		$conn->close();	
	}

	return false;
}

function list_videos(){
	$videos = '';
	$conn = get_connection();

	$sql = "SELECT * FROM LectureVideo LIMIT 0,30";
	$result =  mysqli_query($conn, $sql);

	if ($result->num_rows > 0) {
		$videos = '';

		while($row = $result->fetch_assoc()) {
			if($row["embeded"]!=''){
				$videos .= '<div class="vid">';
				$videos .= '<h4 class="vid_title">'.$row["name"].'</h4>';
				$videos .= $row["embeded"];
				$videos .= '</div>';		
			}				
		}
		
		$videos .= '<div class="vid">';
		
		$videos .= '<a href="add_video.php" title="Thêm video!" style="margin-top: 90px; display: inline-block;"><img src="images/add_video.png" width="100" /></a>';
		$videos .= '</div>';
	}
	
	$conn->close();

	return $videos;
}

function add_lecture($name, $embeded){
	if(strlen(trim($name)) > 0 && strlen(trim($embeded)) > 0){
		$conn = get_connection();
		
		$sql = "INSERT INTO Library(name, embeded) VALUES('$name', '$embeded')";
		if (mysqli_query($conn, $sql)){
			return true;
		}
	
		$conn->close();	
	}

	return false;
}

function list_lectures(){
	$lectures = '';
	$conn = get_connection();

	$sql = "SELECT * FROM Library LIMIT 0,30";
	$result =  mysqli_query($conn, $sql);

	if ($result->num_rows > 0) {
		$lectures = '';

		while($row = $result->fetch_assoc()) {
			if($row["embeded"]!=''){
				$lectures .= '<div class="vid">';
				$lectures .= '<h4 class="vid_title">'.$row["name"].'</h4>';
				$lectures .= $row["embeded"];
				$lectures .= '</div>';		
			}				
		}
		
		$lectures .= '<div class="vid">';
		
		$lectures .= '<a href="add_lecture.php" title="Thêm slide!" style="margin-top: 100px; display: inline-block;"><img src="images/add_slide.png" width="100" /></a>';
		$lectures .= '</div>';
	}
	
	$conn->close();

	return $lectures;
}
?>

