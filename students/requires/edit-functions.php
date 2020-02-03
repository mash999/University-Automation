<?php namespace Automation\edits;




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
if(isset($_POST['submit-info']))
	edit_student_info();





function edit_student_info()
{
	global $con;
	$id = $_SESSION['User_id'];
	$name = htmlspecialchars($_POST['name']);
	$gender = htmlspecialchars($_POST['gender']);
	$date_of_birth = htmlspecialchars($_POST['day'].'-'.$_POST['month'].'-'.$_POST['year']);
	$religion = htmlspecialchars($_POST['religion']);
	$citizenship = htmlspecialchars($_POST['citizenship']);
	$blood_group = htmlspecialchars($_POST['blood-group']);
	$marital_status = htmlspecialchars($_POST['marital']);
	$national_id_number = htmlspecialchars($_POST['nid']);
	$phone = htmlspecialchars($_POST['phone']);
	$present_address = htmlspecialchars($_POST['mailing-address']);
	$permanent_address = htmlspecialchars($_POST['permanent-address']);
	$father_name = htmlspecialchars($_POST['father-name']);
	$mother_name = htmlspecialchars($_POST['mother-name']);
	$guardian_name = htmlspecialchars($_POST['guardian-name']);
	$guardian_phone = htmlspecialchars($_POST['guardian-phone']);	

	$stmt = $con->prepare("UPDATE `studentprofile` SET `name` = :name, `gender` = :gender, `date_of_birth` = :date_of_birth, `religion` = :religion, `citizenship` = :citizenship, `blood_group` = :blood_group, `marital_status` = :marital_status, `national_id_number` = :national_id_number, `phone` = :phone, `present_address` = :present_address, `permanent_address` = :permanent_address, `father_name` = :father_name, `mother_name` = :mother_name, `guardian_name` = :guardian_name, `guardian_phone` = :guardian_phone WHERE `id` = :id");

	$success = $stmt->execute(array(
		'name' => $name,'gender' => $gender,'date_of_birth' => $date_of_birth,'religion' => $religion, 'citizenship' => $citizenship, 'blood_group' => $blood_group,'marital_status' => $marital_status,'national_id_number' => $national_id_number,'phone' => $phone,'present_address' => $present_address,'permanent_address' => $permanent_address,'father_name' => $father_name,'mother_name' => $mother_name,'guardian_name' => $guardian_name,'guardian_phone' => $guardian_phone, 'id' => $id
		));
	if($success){
		header("Location:../views/students-profile.php");
	}

}



?>