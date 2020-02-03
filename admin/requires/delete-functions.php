<?php namespace Automation\deletes;

use Automation\deletes;


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
if(isset($_GET['delete-form']) && isset($_GET['id']) && isset($_GET['link'])){
	$table = 'forms';
	$id = htmlspecialchars($_GET['id']);
	$link = htmlspecialchars($_GET['link']);
	delete_form($table,'id',$id,$link);
}






function delete_form($table,$param,$param_val,$link){
	global $con;

	$stmt = $con->prepare("DELETE FROM $table WHERE $param = :param_val");
	$stmt->bindParam(':param_val', $param_val);
	$query = $stmt->execute();
	if($query){
		unlink($link);
		header("Location:../views/forms.php");
	}

}




?>