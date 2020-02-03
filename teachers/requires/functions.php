<?php namespace Automation\teacher;



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




function get_row($table,$param,$paramVal){
	global $con;
	$stmt = $con->prepare("SELECT * FROM $table WHERE $param=:paramVal");
	$stmt->bindParam(':paramVal',$paramVal);
	$stmt->execute();
	$row = $stmt->fetchAll(\PDO::FETCH_OBJ);
	return $row;
}




function get_distinct_row($distinct,$table,$param,$paramVal){
	global $con;
	$stmt = $con->prepare("SELECT DISTINCT $distinct FROM $table WHERE $param=:paramVal");
	$stmt->bindParam(':paramVal',$paramVal);
	$stmt->execute();
	$row = $stmt->fetchAll(\PDO::FETCH_OBJ);
	return $row;
}




function get_rows($table){
	global $con;
	$stmt = $con->prepare("SELECT * FROM $table");
	$stmt->execute();
	$rows = $stmt->fetchAll(\PDO::FETCH_OBJ);
	return $rows;
}




function get_distinct_rows($table,$param){
	global $con;
	$stmt = $con->prepare("SELECT distinct $param FROM $table");
	$stmt->execute();
	$row = $stmt->fetchAll(\PDO::FETCH_OBJ);
	return $row;
}



?>