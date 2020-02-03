<?php namespace Automation\edits;

require 'functions.php';
use Automation\teacher;
use Automation\edits;


function connect(){
	try{
		$con = new \PDO('mysql:host=localhost;dbname=automation','root','');
		$con->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
		return $con;	
	}
	catch(\PDOException $e){
		echo "ERROR : ".$e->getMessage();
		return false;
	}
}
$con = connect();





//TRIGGERS
if(isset($_POST['edit-teacher-image']))
	edit_teacher_image();

if(isset($_POST['edit-teacher-contact']))
	edit_teacher_contact();

if(isset($_POST['edit-teacher-address']))
	edit_teacher_address();

if(isset($_POST['edit-teacher-biography']))
	edit_teacher_biography();

if(isset($_POST['edit-teacher-education']))
	edit_teacher_education();

if(isset($_POST['edit-teacher-research-areas']))
	edit_teacher_research_areas();

if(isset($_POST['edit-teacher-research-interests']))
	edit_teacher_research_interests();

if(isset($_POST['edit-teacher-teaching']))
	edit_teacher_teaching();

if(isset($_POST['edit-teacher-publications']))
	edit_teacher_publications();

if(isset($_POST['edit-teacher-grants']))
	edit_teacher_grants();

if(isset($_POST['edit-teacher-activity']))
	edit_teacher_activity();

if(isset($_POST['edit-teacher-office-hours']))
	edit_teacher_office_hours();

if(isset($_POST['update-assignment']))
	update_assignment();

if(isset($_POST['edit-lecture']))
	edit_lecture();

if(isset($_GET['attendance']) && isset($_GET['className']))
	update_attendance();




// FILE CHECKING
function file_check($file,$name,$dir,$fileof){

	$uploadOk = 1;
	$temp = $file;

	$temp_dir = "../../$dir/";
	$target_file = $temp_dir . uniqid() . basename($_FILES[$name]['name']);
	if ($_FILES[$name]["size"] > 25000000) {
	    echo "Sorry, $fileof file is too large.";
	    $uploadOk = 0;
	}
 
	if ($uploadOk == 0) {
	    echo  "Sorry, your file was not uploaded.";
	}
	else {
	    if (move_uploaded_file($_FILES[$name]["tmp_name"], $target_file)) {
	        $temp = $target_file;
	        unlink($file);
		}
	}
	

	return $temp;
}





function edit_teacher_contact(){

	global $con;
	$id = $_POST['id'];
	$phone = htmlspecialchars($_POST['phone']);
	$email = htmlspecialchars($_POST['email']);
	$website = htmlspecialchars($_POST['website']);
	$office = htmlspecialchars($_POST['office']);

	$stmt =  $con->prepare("UPDATE teachersprofile SET phone = :phone, email = :email, website = :website, office = :office Where id = :id");
	$success = $stmt->execute(array(
		'phone' => $phone,
		'email' => $email,
		'website' => $website,
		'office' => $office,
		'id' => $id
		));

	if($success){
		header("Location: ../views/edit-teacher-profile.php");
	}
}




function edit_teacher_office_hours(){

	global $con;
	$id = $_POST['id'];
	$office_hours = "Sunday###" . htmlspecialchars($_POST['sunday-time']) . "{{}}}{" . "Monday###" . htmlspecialchars($_POST['monday-time']) . "{{}}}{" . "Tuesday###" . htmlspecialchars($_POST['tuesday-time']) . "{{}}}{" . "Wednesday###" . htmlspecialchars($_POST['wednesday-time']) . "{{}}}{" . "Thursday###" . htmlspecialchars($_POST['thursday-time']) . "{{}}}{" . "Friday###" . htmlspecialchars($_POST['friday-time']) . "{{}}}{" . "Saturday###" . htmlspecialchars($_POST['saturday-time']);

	$stmt =  $con->prepare("UPDATE teachersprofile SET office_hours = :office_hours WHERE id = :id");
	$success = $stmt->execute(array(
		'office_hours' => $office_hours,
		'id' => $id
		));

	if($success){
		header("Location: ../views/edit-teacher-profile.php");
	}	
}




function edit_teacher_address(){

	global $con;
	$id = $_POST['id'];
	$present_address = htmlspecialchars($_POST['present-address']);
	$permanent_address = htmlspecialchars($_POST['permanent-address']);

	$stmt =  $con->prepare("UPDATE teachersprofile SET present_address = :present_address, permanent_address = :permanent_address WHERE id = :id");
	$success = $stmt->execute(array(
		'present_address' => $present_address,
		'permanent_address' => $permanent_address,
		'id' => $id
		));

	if($success){
		header("Location: ../views/edit-teacher-profile.php");
	}
}





function edit_teacher_image(){

	global $con;
	$id = $_POST['id'];
	$image = htmlspecialchars($_POST['image']);
	if(empty(basename($_FILES["teacher-image"]["name"]))){
		$picture = $image;
	}
	else{
		$picture = edits\file_check($image,'teacher-image','images/teachers','Image');
	}

	$stmt =  $con->prepare("UPDATE teachersprofile SET image = :picture WHERE id = :id");
	$success = $stmt->execute(array(
		'picture' => $picture,
		'id' => $id
		));

	if($success){
		header("Location: ../views/edit-teacher-profile.php");
	}
}





function edit_teacher_biography(){

	global $con;
	$id = $_POST['id'];
	$name = htmlspecialchars($_POST['name']);
	$initial = htmlspecialchars($_POST['initial']);
	$designation = htmlspecialchars($_POST['designation']);
	$biography = htmlspecialchars($_POST['biography']);

	$stmt =  $con->prepare("UPDATE teachersprofile SET name = :name, initial = :initial, designation = :designation, biography = :biography WHERE id = :id");
	$success = $stmt->execute(array(
		'name' => $name,
		'initial' => $initial,
		'designation' => $designation,
		'biography' => $biography,
		'id' => $id
		));

	if($success){
		header("Location: ../views/edit-teacher-profile.php");
	}
}





function edit_teacher_education(){

	global $con;
	$id = $_POST['id'];
	$educational_info = htmlspecialchars($_POST['educational_info']);

	$stmt =  $con->prepare("UPDATE teachersprofile SET educational_info = :educational_info WHERE id = :id");
	$success = $stmt->execute(array(
		'educational_info' => $educational_info,
		'id' => $id
		));

	if($success){
		header("Location: ../views/edit-teacher-profile.php");
	}
}





function edit_teacher_teaching(){

	global $con;
	$id = $_POST['id'];
	$teaching = htmlspecialchars($_POST['teaching']);

	$stmt =  $con->prepare("UPDATE teachersprofile SET teaching = :teaching WHERE id = :id");
	$success = $stmt->execute(array(
		'teaching' => $teaching,
		'id' => $id
		));

	if($success){
		header("Location: ../views/edit-teacher-profile.php");
	}
}





function edit_teacher_research_areas(){

	global $con;
	$id = $_POST['id'];
	$research_areas = htmlspecialchars($_POST['research-areas']);

	$stmt =  $con->prepare("UPDATE teachersprofile SET research_areas = :research_areas WHERE id = :id");
	$success = $stmt->execute(array(
		'research_areas' => $research_areas,
		'id' => $id
		));

	if($success){
		header("Location: ../views/edit-teacher-profile.php");
	}
}





function edit_teacher_research_interests(){

	global $con;
	$id = $_POST['id'];
	$research_interests = htmlspecialchars($_POST['research-interests']);

	$stmt =  $con->prepare("UPDATE teachersprofile SET research_interests = :research_interests WHERE id = :id");
	$success = $stmt->execute(array(
		'research_interests' => $research_interests,
		'id' => $id
		));

	if($success){
		header("Location: ../views/edit-teacher-profile.php");
	}
}





function edit_teacher_publications(){

	global $con;
	$id = $_POST['id'];
	$publications = htmlspecialchars($_POST['publications']);

	$stmt =  $con->prepare("UPDATE teachersprofile SET publications = :publications WHERE id = :id");
	$success = $stmt->execute(array(
		'publications' => $publications,
		'id' => $id
		));

	if($success){
		header("Location: ../views/edit-teacher-profile.php");
	}
}





function edit_teacher_grants(){

	global $con;
	$id = $_POST['id'];
	$grants = htmlspecialchars($_POST['grants']);

	$stmt =  $con->prepare("UPDATE teachersprofile SET grants = :grants WHERE id = :id");
	$success = $stmt->execute(array(
		'grants' => $grants,
		'id' => $id
		));

	if($success){
		header("Location: ../views/edit-teacher-profile.php");
	}
}





function edit_teacher_activity(){

	global $con;
	$id = $_POST['id'];
	$activity = htmlspecialchars($_POST['activity']);

	$stmt =  $con->prepare("UPDATE teachersprofile SET activity = :activity WHERE id = :id");
	$success = $stmt->execute(array(
		'activity' => $activity,
		'id' => $id
		));

	if($success){
		header("Location: ../views/edit-teacher-profile.php");
	}
}





function update_assignment(){

	global $con;
	
	$id = htmlspecialchars($_POST['id']);
	$class_name = htmlspecialchars($_POST['class-name']);
	$semester = htmlspecialchars($_POST['semester']);
	$title = htmlspecialchars($_POST['title']);
	$description = htmlspecialchars($_POST['description']);
	$teacher = htmlspecialchars($_POST['teacher']);
	$uploaded_on = date("d-M-Y , h:i A",time()+5*60*60);
	$expires_on = htmlspecialchars($_POST['date']). " at " .htmlspecialchars($_POST['time']);

	$stmt = $con->prepare("UPDATE assignments SET class_name = :class_name, semester = :semester, assignment_title =:assignment_title, assignment_desc = :assignment_desc, teacher = :teacher, uploaded_on = :uploaded_on, expires_on = :expires_on WHERE id = :id");

	$query = $stmt->execute(array(
		'class_name' => $class_name,
		'semester' => $semester,
		'assignment_title' => $title,
		'assignment_desc' => $description,
		'teacher' => $teacher,
		'uploaded_on' => $uploaded_on,
		'expires_on' => $expires_on,
		'id' => $id
	));

	if($query){
		header("Location:../views/assignment-detail.php?edit=$id&ref=$class_name");
	}
}





function edit_lecture(){

	global $con;
	
	$id = htmlspecialchars($_POST['lecture-id']);
	$class_name = htmlspecialchars($_POST['class-name']);
	$title = htmlspecialchars($_POST['title']);
	$file =  htmlspecialchars($_POST['file-name']);
	$updated_on = date("d-M-Y , h:i A",time()+5*60*60);
	$file = file_check($file,'lecture','docs/lectures','File');
	if(empty($file)){
		header("Location:../views/classroom.php?ref=$class_name&err_mode=noFile");
	}
	$stmt = $con->prepare("UPDATE lectures SET updated_on = :updated_on, title = :title, file = :file, class_name = :class_name WHERE id = :id");
	$query = $stmt->execute(array(
		'updated_on' => $updated_on,
		'title' => $title,
		'file' => $file,
		'class_name' => $class_name,
		'id' => $id
	));
	if($query){
		header("Location:../views/classroom.php?ref=$class_name");
	}
}





function update_attendance(){

	global $con;
	$attended = htmlspecialchars($_GET['attendance']);
	$class_name = htmlspecialchars($_GET['className']);
	$date = date('d-M-Y',time());

	$stored_date = teacher\get_row('attendances','date',$date)[0];
	if(sizeof($stored_date)>0){
		$id = $stored_date->id;
		$stmt = $con->prepare("UPDATE attendances SET attended = :attended WHERE id = :id");
		$executed = $stmt->execute(array('attended' => $attended, 'id' => $id));
		if($executed){
			echo "success";
		}
	}
	else{
		$stmt = $con->prepare("INSERT INTO attendances (class_name,date,attended) VALUES (:class_name,:date,:attended)");
		$executed = $stmt->execute(array('class_name' => $class_name, 'date' => $date, 'attended' => $attended));
		if($executed){
			echo "success";
		}	
	}

}



?>