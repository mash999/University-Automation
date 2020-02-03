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
if(isset($_POST['upload-assignment']))
	upload_assignment();

if(isset($_POST['upload-lecture']))
	upload_lecture();

if(isset($_POST['upload-marksheet']))
	upload_marksheet();





function upload_assignment(){

	global $con;
	
	$class_name = htmlspecialchars($_POST['class-name']);
	$semester = htmlspecialchars($_POST['semester']);
	$title = htmlspecialchars($_POST['title']);
	$description = htmlspecialchars($_POST['description']);
	$teacher = htmlspecialchars($_POST['teacher']);
	$uploaded_on = date("d-M-Y , h:i A",time()+5*60*60);
	$expires_on = htmlspecialchars($_POST['date']). " at " .htmlspecialchars($_POST['time']);

	$stmt = $con->prepare("INSERT INTO assignments (class_name,semester,assignment_title,assignment_desc,teacher,uploaded_on,expires_on) VALUES (:class_name,:semester,:assignment_title,:assignment_desc,:teacher,:uploaded_on,:expires_on)");
	$query = $stmt->execute(array(
		'class_name' => $class_name,
		'semester' => $semester,
		'assignment_title' => $title,
		'assignment_desc' => $description,
		'teacher' => $teacher,
		'uploaded_on' => $uploaded_on,
		'expires_on' => $expires_on
	));

	if($query){
		header("Location:../views/classroom.php?ref=$class_name");
	}
}





function upload_lecture(){

	global $con;
	
	$class_name = htmlspecialchars($_POST['class-name']);
	$title = htmlspecialchars($_POST['title']);
	$updated_on = date("d-M-Y , h:i A",time()+5*60*60);
	$file = file_check('lecture','docs/lectures','File');
	if(empty($file)){
		header("Location:../views/classroom.php?ref=$class_name&err_mode=noFile");
	}
	$stmt = $con->prepare("INSERT INTO lectures (updated_on,title,file,class_name) VALUES (:updated_on,:title,:file,:class_name)");
	$query = $stmt->execute(array(
		'updated_on' => $updated_on,
		'title' => $title,
		'file' => $file,
		'class_name' => $class_name,
	));
	if($query){
		header("Location:../views/classroom.php?ref=$class_name");
	}
}





function upload_marksheet(){

	global $con;
	
	$class_name = htmlspecialchars($_POST['class-name']);
	$marksheet = htmlspecialchars($_POST['marksheet-file']);
	$delete_id = htmlspecialchars($_POST['deletion-id']);
	$basename = basename($_FILES['marksheet']['name']); 
	
	if(!empty($basename)){
		$temp_dir = "../../docs/marksheets/";
		$info = pathinfo($basename);
		$ext = $info['extension'];
		$filename = $info['filename']; 
		if($ext !== 'csv'){
			if($ext !== 'xlsx' && $ext !== 'xls' ){
				header("Location:../views/classroom.php?ref=$class_name&err_mode=invalidFormat");
			}
			elseif($ext == 'xlsx' || $ext == 'xls' ){
				header("Location:../views/classroom.php?ref=$class_name&err_mode=conversionRequired");
			}
		}
		
		$file = $temp_dir . uniqid() . $filename . '.csv';
		if ($_FILES['marksheet']["size"] > 15000000) {
			header("Location:../views/classroom.php?ref=$class_name&err_mode=fileTooBig");
		}
		else {
		    if (move_uploaded_file($_FILES['marksheet']["tmp_name"], $file)) {	
		    	$stmt = $con->prepare("INSERT INTO marksheets (class_name,file) VALUES (:class_name,:file)");
				$query = $stmt->execute(array(
					'class_name' => $class_name,
					'file' => $file
				));
				if($query){
					unlink($marksheet);	        	
			    	$stmt = $con->prepare("DELETE FROM marksheets WHERE id = :delete_id");
					$query = $stmt->execute(array(
						'delete_id' => $delete_id
					)); 
					header("Location:../views/classroom.php?ref=$class_name");
				}
			}
			else{
				header("Location:../views/classroom.php?ref=$class_name&err_mode=unknown");
			}
		}
	}

	else{
		header("Location:../views/classroom.php?ref=$class_name&err_mode=noFile");
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
		if ($_FILES[$name]["size"] > 15000000) {
		    echo "<script>alert('Sorry, file is too large. Max size is 15MB')</script>";
		    $uploadOk = 0;
		}
	 
		if ($uploadOk == 0) {
		    echo  "<script>alert('Sorry, your file could not be uploaded.')</script>";
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



?>