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
if(isset($_POST['add-new-student']))
	add_new_student();

if(isset($_POST['create-new-teacher']))
	create_new_teacher();

if(isset($_POST['create-new-semester']))
	create_new_semester();

if(isset($_POST['add-form']))
	add_form();





function add_new_student()
{
	global $con;
	$id = htmlspecialchars($_POST['id']);
	

	//FILE CHECKING
	$image = inserts\file_check('dp','images/students','Image');
	$ssc_cert = inserts\file_check('ssc-cert','docs/ssc_cert','SSC Certificate');
	$ssc_mark = inserts\file_check('ssc-mark','docs/ssc_mark','SSC Marksheet');
	$hsc_cert = inserts\file_check('hsc-cert','docs/hsc_cert','HSC Certificate');		
	$hsc_mark = inserts\file_check('hsc-mark','docs/hsc_mark','HSC Marksheet');



	//INSERT IN STUDENT PROFILE
	$stmt = $con->prepare("INSERT INTO studentprofile (id,name,gender,test_pass,picture,degree,faculty,department,program,total_credit_required,total_credit_completed,cgpa,admitted_semester,admitted_year,date_of_birth,religion,citizenship,blood_group,marital_status,national_id_number,phone,mail,present_address,permanent_address,father_name,mother_name,guardian_name,guardian_phone) VALUES (:id,:name,:gender,:test_pass,:picture,:degree,:faculty,:department,:program,:total_credit_required,:total_credit_completed,:cgpa,:admitted_semester,:admitted_year,:date_of_birth,:religion,:citizenship,:blood_group,:marital_status,:national_id_number,:phone,:mail,:present_address,:permanent_address,:father_name,:mother_name,:guardian_name,:guardian_phone)");
	
	$execute = $stmt->execute(array(
		'id' => $id,
		'name' => htmlspecialchars($_POST['name']),
		'gender' => htmlspecialchars($_POST['gender']),
		'test_pass' => htmlspecialchars($_POST['test-pass']),
		'picture' => htmlspecialchars($image),
		'degree' => htmlspecialchars($_POST['degree']),
		'faculty' => htmlspecialchars($_POST['faculty']),
		'department' => htmlspecialchars($_POST['department']),
		'program' => htmlspecialchars($_POST['program']),
		'total_credit_completed' => htmlspecialchars($_POST['credit-completed']),
		'total_credit_required' => htmlspecialchars($_POST['credit-required']),
		'cgpa' => htmlspecialchars($_POST['cgpa']),
		'admitted_semester' => htmlspecialchars($_POST['admitted-semester']),
		'admitted_year' => htmlspecialchars($_POST['admitted-year']),
		'date_of_birth' => htmlspecialchars($_POST['day']).htmlspecialchars($_POST['month']).htmlspecialchars($_POST['year']),
		'religion' => htmlspecialchars($_POST['religion']),
		'citizenship' => htmlspecialchars($_POST['citizenship']),
		'blood_group' => htmlspecialchars($_POST['blood-group']),
		'marital_status' => htmlspecialchars($_POST['marital-status']),
		'national_id_number' => htmlspecialchars($_POST['nid']),
		'phone' => htmlspecialchars($_POST['cell']),
		'mail' => htmlspecialchars($_POST['email']),
		'present_address' => htmlspecialchars($_POST['present-address']),
		'permanent_address' => htmlspecialchars($_POST['permanent-address']),
		'father_name' => htmlspecialchars($_POST['father-name']),
		'mother_name' => htmlspecialchars($_POST['mother-name']),
		'guardian_name' => htmlspecialchars($_POST['guardian-name']),
		'guardian_phone'=> htmlspecialchars($_POST['guardian-phone'])
		));


		// INSERT IN DOCUMENT
		$stmt = $con->prepare("INSERT INTO documents (id,ssc_cert,ssc_mark,hsc_cert,hsc_mark) VALUES (:id,:ssc_cert,:ssc_mark,:hsc_cert,:hsc_mark)");
		$doc_executed = $stmt->execute(array(
			'id' => $id,
			'ssc_cert' => htmlspecialchars($ssc_cert),
			'ssc_mark' => htmlspecialchars($ssc_mark),
			'hsc_cert' => htmlspecialchars($hsc_cert),
			'hsc_mark' => htmlspecialchars($hsc_mark)
			));


		// INSERT IN ACCOUNTS
		$stmt = $con->prepare("INSERT INTO accounts (username,password,status) VALUES (:username,:password,:status)");
		$doc_executed = $stmt->execute(array(
			'username' => $id,
			'password' => hash('sha256',$id),
			'status' => 'student'
			));	


		if($execute && $doc_executed){
			header("Location:../views/student-profile.php?id=$id");
		}
		else{
			echo "<script>alert('Sorry, Insertion failed');</script>";
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





function create_new_teacher(){

	global $con;
	$initial = htmlspecialchars($_POST['initial']);
	$initial = strtolower($initial);
	$faculty = htmlspecialchars($_POST['faculty']);
	$dept = htmlspecialchars($_POST['department']);
	$office_hour = htmlspecialchars($_POST['office-hour']);

	$stmt = $con->prepare("INSERT INTO teachersprofile (initial,faculty,department,office_hours) VALUES (:initial,:faculty,:dept,:office)");
	
	$stmt->bindParam(':initial',$initial);
	$stmt->bindParam(':faculty',$faculty);
	$stmt->bindParam(':dept',$dept);
	$stmt->bindParam(':office',$office_hour);
	
	$query = $stmt->execute();
	if($query){
		$stmt = $con->prepare("INSERT INTO accounts (username,password,status) VALUES (:user,:pass,:status)");
		$profile = $stmt->execute(array(
			'user' => $initial,
			'pass' => hash('sha256', $initial),
			'status' => 'teacher'
		));
		if($profile){
			header("Location:../views/teacher-list.php?status=success");	
		}
	}
}





function add_form(){

	global $con;
	$title = htmlspecialchars($_POST['title']);
	$image = inserts\file_check('file','docs/forms','Image');


	$stmt = $con->prepare("INSERT INTO forms (title,file) VALUES (:title,:file)");
	$stmt->bindParam(':title',$title);
	$stmt->bindParam(':file',$image);
	$query = $stmt->execute();
	if($query){
		header("Location:../views/forms.php?status=success");
	}
}





function create_new_semester(){

	global $con;
	$year = htmlspecialchars($_POST['new-year']);
	$semester = htmlspecialchars($_POST['new-semester']);

	$stmt = $con->prepare("INSERT INTO offeredcourses (year,semester,course_list) VALUES (:year,:semester,:course_list)");
	$query = $stmt->execute(array(
		'year' => $year,
		'semester' => $semester,
		'course_list' => '../../docs/offered_courses/'.$semester.'_'.$year.'_offered_courses.txt'
	));

	if($query){
		$query = $con->prepare("SELECT id FROM offeredcourses ORDER BY id desc");
		$query->execute();
		$id = $query->fetch()[0];
		header("Location:../edit/edit-offered-courses.php?id=$id");
	}

	else{
		echo "FAILED TO INSERT. CONTACT WITH IT";
	}
}



?>