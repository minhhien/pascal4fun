function clearContent(name){
	var item = document.getElementById(name);
	item.value = "";
}

function getExercises() {
	$.ajax({
		type: "GET",
		url: "exercises_listing.php",
		data: '',
		cache: false,
		success: function(html) {
			$("#exercise-pane").html(html);		
		}
	});

}

function updateMarks() {
	$.ajax({
		type: "GET",
		url: "update_marks.php",
		data: '',
		cache: false,
		success: function(html) {
			html = html.trim();
			$("#marks").html(html);		
		}
	});

}

function updateSkill() {
	$.ajax({
		type: "POST",
		url: "update_skill.php",
		data: '',
		cache: false,
		success: function(html) {
			html = html.trim();
			$("#skill").html(html);		
		}
	});

}

function compileFunct(filename, exerid) { // Ham bien dich
	//var code = document.getElementById("code").value;
	var code = editor.getValue(); // Bien code se chua code do nguoi dung nhap vao editor, getvalue la ham co san cua codemirror

	if (code == '') {
		$("#result").html('<span class=\'error\'>Please enter your code</span>');
	} else {
		// AJAX code to submit form.
		$.ajax({
			type: "POST",
			url: "compile.php",
			data: {
				code:code, 
				filename:filename, 
				exer_id:exerid
			      },
			cache: false,
			success: function(html) {
				$("#result").html(html);
				$( "#output" ).empty();
				if(html.indexOf("Error")<0){	
					$("#execute").removeAttr("disabled");
					$("#execute").css("background-color", "#FF6600");
					
				}else{
					$("#execute").attr("disabled", "disabled");
					$("#execute").prop('disabled', true);
					$("#execute").css("background-color", "#cdcdcd");
				}

				
			}

		});
		
	}
	return false;
}

function executeFunct(filename, exerid) {
	if (filename == '') {
		$("#output").html('<span class=\'error\'>Please compile your code</span>');
	} else {
		var code = document.getElementById("code").value;
		var dataString = 'code=' + code;
		$.ajax({
			type: "POST",
			url: "run.php?filename=" + filename + "&exerid=" + exerid,
			data: dataString,
			cache: false,
			success: function(html) {
				$("#output").html(html);
				$("#execute").attr("disabled", "disabled");
				$("#execute").prop('disabled', true);
				$("#execute").css("background-color", "#cdcdcd");
				getExercises();	
				updateMarks();
				updateSkill();
			}
		});
		
		
		
	}

	return false;
}

function confirm(){
	$("#dialog-confirm").dialog({
	      resizable: false,
	      height:140,
	      modal: true,
	      buttons: {
		"Delete all items": function() {
		  $( this ).dialog( "close" );
		},
		Cancel: function() {
		  $( this ).dialog( "close" );
		}
	      }
	  });
}

function nextExercise(exerid) {
      location.href = '?id=' + exerid;
}

function addVideoFunct(){
	var name = $("#name").val();
	var vid_embeded = $("#video").val();
	var check = false;
	
	name = name.trim();
	vid_embeded = vid_embeded.trim();
	if (name.length==0) {
		$("#result").text("Mời nhập tên bài giảng!");
		$("#result").css("color", "red");		
	}else{
		check = true;
	} 

	if (check && (vid_embeded.length==0 || vid_embeded=="// Dán mã nhúng video vào đây!")) {
		$("#result").text("Mời nhập mã nhúng video!");
		$("#result").css("color", "red");
		check = false;
	} 
	
	if(check) {
		// AJAX code to submit form.
		$.ajax({
			type: "POST",
			url: "add_video_process.php",
			data: {
				name:name,
				embededCode:vid_embeded
			      },
			cache: false,
			success: function(html) {
				$("#result").html(html);
				$("#result").css("color", "blue");

				$("#name").val(null);
				$("#video").val(null);
			}

		});
		
	}
	return false;
}

function addLectureFunct(){
	var name = document.getElementById("name").value;
	var embeded = document.getElementById("slide").value;
	var check = false;
	
	name = name.trim();
	embeded = embeded.trim();
	if (name.length==0) {
		$("#result").text("Mời nhập tên bài giảng!");
		$("#result").css("color", "red");		
	}else{
		check = true;
	} 

	if (check && (embeded.length==0 || embeded=="// Dán mã nhúng slide vào đây!")) {
		$("#result").text("Mời nhập mã nhúng slide!");
		$("#result").css("color", "red");
		check = false;
	} 
	
	if(check) {
		// AJAX code to submit form.
		$.ajax({
			type: "POST",
			url: "add_lecture_process.php",
			data: {
				name:name,
				embededCode:embeded
			      },
			cache: false,
			success: function(html) {
				$("#result").html(html);
				$("#result").css("color", "blue");

				$("#name").val(null);
				$("#slide").val(null);
			}

		});
		
	}
	return false;
}
