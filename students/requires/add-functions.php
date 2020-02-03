<?php namespace Automation\inserts;

use Automation\inserts;


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
if(isset($_POST['upload-form']))
	upload_form();

if(isset($_POST['upload-assignment']))
	upload_assignment();





function upload_form(){

	global $con;

	$title = htmlspecialchars($_POST['title']);
	$file = inserts\file_check('docs','docs/requests','Form');
	$image = inserts\file_check('image','docs/requests','Image');
	$requested_on = time();
	$requested_by = htmlspecialchars($_POST['user']);

	$stmt = $con->prepare("INSERT INTO studentsrequests (title,file,image,requested_on,requested_by,status) VALUES (:title,:file,:image,:requested_on,:requested_by,:status)");

	$query = $stmt->execute(array(
		'title' => $title,
		'file' => $file,
		'image' => $image,
		'requested_on' => $requested_on,
		'requested_by' => $requested_by,
		'status' => 0
	));

	if($query){
		header("Location:../views/students-forms.php?status=success");
	}

}





function upload_assignment(){

	global $con;

	$class_name = htmlspecialchars($_POST['class-name']);
	$id = htmlspecialchars($_POST['assignment-id']);
	$file = inserts\file_check('file','docs/assignments','File');
	$student_id = htmlspecialchars($_POST['student-id']);

	$stmt = $con->prepare("INSERT INTO assignment_files (class_name,assignment_id,submitted_by,file) VALUES (:class_name,:assignment_id,:submitted_by,:file)");

	$query = $stmt->execute(array(
		'class_name' => $class_name,
		'assignment_id' => $id,
		'submitted_by' => $student_id,
		'file' => $file
	));

	if($query){
		header("Location:../views/classroom.php?ref=$class_name");
	}

}





// FILE CHECKING
function file_check($name,$dir,$fileof){

	$uploadOk = 1;
	$temp = "";
	if(!empty(basename($_FILES[$name]['name']))){
		$temp = "";
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
			}
			else{
				$temp = "";
			}
		}
	}

	return $temp;
}	