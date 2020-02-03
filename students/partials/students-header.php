
<?php
	error_reporting(0);
	session_start();
	require_once '../requires/functions.php';
	require_once '../requires/edit-functions.php';
	if(!isset($_SESSION['User_id'])){
		header("Location:../index.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="https://fonts.googleapis.com/css?family=Taviraj" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css"> 
	<link rel="stylesheet" type="text/css" href="../../font-awesome/css/font-awesome.css"> 
	<link rel="stylesheet" type="text/css" href="../css/students-style.css">
	
	<script src="../js/jquery.js"></script>
	<script src="../js/bootstrap.js"></script>

</head>

<body>
	<div class="right-container">
		
		<nav>
			<p>Student Portal</p>
			<ul>
				<li id="recognize-user">Hi There</li>
				<li><a href="../partials/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-bell-o" aria-hidden="true"></i></a></li>
				<li><a href="#"><i class="fa fa-user-o" aria-hidden="true"></i></a></li>
			</ul>
		</nav>
