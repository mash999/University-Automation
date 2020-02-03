<?php namespace Automation\edits;

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
if(isset($_POST['edit-student-info']))
	edit_student_info();

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

if(isset($_POST['edit-form']))
	edit_form();




function edit_student_info()
{
	global $con;
	$key_id = htmlspecialchars($_POST['key-id']);
	$name = htmlspecialchars($_POST['name']);
	$gender = htmlspecialchars($_POST['gender']);
	$date_of_birth = htmlspecialchars($_POST['day'].'-'.$_POST['month'].'-'.$_POST['year']);
	$religion = htmlspecialchars($_POST['religion']);
	$citizenship = htmlspecialchars($_POST['citizenship']);
	$blood_group = htmlspecialchars($_POST['blood-group']);
	$marital_status = htmlspecialchars($_POST['marital-status']);
	$national_id_number = htmlspecialchars($_POST['nid']);
	$phone = htmlspecialchars($_POST['cell']);
	$email = htmlspecialchars($_POST['email']);
	$present_address = htmlspecialchars($_POST['present-address']);
	$permanent_address = htmlspecialchars($_POST['permanent-address']);
	$id = htmlspecialchars($_POST['id']);
	$cgpa = htmlspecialchars($_POST['cgpa']);
	$degree = htmlspecialchars($_POST['degree']);
	$faculty = htmlspecialchars($_POST['faculty']);
	$department = htmlspecialchars($_POST['department']);
	$program = htmlspecialchars($_POST['program']);
	$test_pass = htmlspecialchars($_POST['test-pass']);
	$total_credit_required = htmlspecialchars($_POST['credit-required']);	
	$total_credit_completed = htmlspecialchars($_POST['credit-completed']);	
	$admitted_year = htmlspecialchars($_POST['admitted-year']);	
	$admitted_semester = htmlspecialchars($_POST['admitted-semester']);	
	$father_name = htmlspecialchars($_POST['father-name']);
	$mother_name = htmlspecialchars($_POST['mother-name']);
	$guardian_name = htmlspecialchars($_POST['guardian-name']);
	$guardian_phone = htmlspecialchars($_POST['guardian-phone']);


	$image = htmlspecialchars($_POST['image']);
	if(empty(basename($_FILES["dp"]["name"]))){
		$picture = $image;
	}
	else{
		$picture = edits\file_check($image,'dp','images/students','Image');
	}


	$stmt = $con->prepare("UPDATE studentprofile SET name = :name, gender = :gender, date_of_birth = :date_of_birth, religion = :religion, citizenship = :citizenship, blood_group = :blood_group, marital_status = :marital_status, national_id_number = :national_id_number, phone = :phone, mail = :mail, present_address = :present_address, permanent_address = :permanent_address, id = :id, cgpa = :cgpa, degree = :degree, faculty = :faculty, department = :department, program = :program, test_pass = :test_pass, picture = :picture, total_credit_required = :total_credit_required, total_credit_completed = :total_credit_completed, admitted_year = :admitted_year, admitted_semester = :admitted_semester, father_name = :father_name, mother_name = :mother_name, guardian_name = :guardian_name, guardian_phone = :guardian_phone WHERE id = :key_id");

	$success = $stmt->execute(array(
		'name' => $name,'gender' => $gender,'date_of_birth' => $date_of_birth,'religion' => $religion, 'citizenship' => $citizenship, 'blood_group' => $blood_group,'marital_status' => $marital_status,'national_id_number' => $national_id_number,'phone' => $phone, 'mail' => $email, 'present_address' => $present_address,'permanent_address' => $permanent_address, 'id' => $id, 'cgpa' => $cgpa, 'degree' => $degree, 'faculty' => $faculty, 'department' => $department, 'program' => $program, 'test_pass' => $test_pass, 'picture' => $picture, 'total_credit_required' => $total_credit_required, 'total_credit_completed' => $total_credit_completed, 'admitted_year' => $admitted_year, 'admitted_semester' => $admitted_semester, 'father_name' => $father_name,'mother_name' => $mother_name,'guardian_name' => $guardian_name,'guardian_phone' => $guardian_phone, 'key_id' => $key_id
		));



	$ssc_cert = htmlspecialchars($_POST['old-ssc-cert']);
	$hsc_cert = htmlspecialchars($_POST['old-hsc-cert']);
	$ssc_mark = htmlspecialchars($_POST['old-ssc-mark']);
	$hsc_mark = htmlspecialchars($_POST['old-hsc-mark']);
	if(!empty(basename($_FILES["ssc-cert"]["name"]))){
		$ssc_cert = edits\file_check($ssc_cert,'ssc-cert','docs/ssc_cert','SSC/O Level certificate');
	}
	if(!empty(basename($_FILES["hsc-cert"]["name"]))){
		$hsc_cert = edits\file_check($hsc_cert,'hsc-cert','docs/hsc_cert','HSC/A Level certificate');
	}
	if(!empty(basename($_FILES["ssc-mark"]["name"]))){
		$ssc_mark = edits\file_check($ssc_mark,'ssc-mark','docs/ssc_mark','SSC/O Level marksheet');
	}
	if(!empty(basename($_FILES["hsc-mark"]["name"]))){
		$hsc_mark = edits\file_check($hsc_mark,'hsc-mark','docs/hsc_mark','HSC/O Level marksheet');
	}

	$stmt = $con->prepare("UPDATE documents SET id = :id, ssc_cert = :ssc_cert, ssc_mark = :ssc_mark, hsc_cert = :hsc_cert, hsc_mark = :hsc_mark WHERE id = :key_id");

	$doc_submitted = $stmt->execute(array(
		'id' => $id,
		'ssc_cert' => $ssc_cert,
		'ssc_mark' => $ssc_mark,
		'hsc_cert' => $hsc_cert,
		'hsc_mark' => $hsc_mark,
		'key_id' => $key_id
		));

	if($success && $doc_submitted){
		header("Location:../views/student-profile.php?id=$id");
	}

}





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
		header("Location: ../views/teacher-profile.php?id=$id");
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
		header("Location: ../views/teacher-profile.php?id=$id");
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
		header("Location: ../views/teacher-profile.php?id=$id");
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
		header("Location: ../views/teacher-profile.php?id=$id");
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
		header("Location: ../views/teacher-profile.php?id=$id");
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
		header("Location: ../views/teacher-profile.php?id=$id");
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
		header("Location: ../views/teacher-profile.php?id=$id");
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
		header("Location: ../views/teacher-profile.php?id=$id");
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
		header("Location: ../views/teacher-profile.php?id=$id");
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
		header("Location: ../views/teacher-profile.php?id=$id");
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
		header("Location: ../views/teacher-profile.php?id=$id");
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
		header("Location: ../views/teacher-profile.php?id=$id");
	}
}





function edit_form(){

	global $con;
	$title = htmlspecialchars($_POST['title']);
	$image = htmlspecialchars($_POST['image']);
	$id = $_POST['id'];
	$image = edits\file_check($image,'file','docs/forms','Image');
	$stmt = $con->prepare("UPDATE forms SET title = :title, file = :file WHERE id = :id");
	$query = $stmt->execute(array(
		'title' => $title,
		'file' => $image,
		'id' => $id
	));
	if($query){
		header("Location:../views/forms.php?status=edited");
	}
}



?>