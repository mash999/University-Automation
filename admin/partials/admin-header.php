
<?php 
	error_reporting(0);
	require '../requires/functions.php';
	require '../requires/edit-functions.php';
?>


<!DOCTYPE html>
<html>
<head>

	<title>Administration Portal</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Taviraj" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/admin-style.css">


	<script src="../js/jquery.js"></script>
	<script src="../js/bootstrap.js"></script>

</head>

<body>


	<div class="wrapper col-lg-12 col-md-12 col-sm-12 col-xs-12">
	

		<header class="top-bar col-lg-10 col-md-9 col-sm-8 col-xs-12">
				
			<div class="logo col-lg-3 col-md-3 col-sm-3 col-xs-6">
				<a href="home.php"><h3 align="center">Welcome To Administration Portal</h3></a>
			</div> <!-- /logo -->




			<div class="titles col-lg-7 col-md-7 col-sm-7 col-xs-6">
				<h1>North South University</h1>
				<h2>Center of Excellence in Higher Education</h2>
			</div> <!--/ titles -->




			<div class="account col-lg-2 col-md-2 col-sm-2 col-xs-6">
				
			</div> <!-- /account -->


		</header> <!-- /top-bar -->


















		<div class="sidebar col-lg-2 col-md-3 col-sm-4 hidden-xs">
			
			<h2>Control Panel<br>North South University</h2>
			<a href="index.php"><img src="../../images/logo.png" alt="Thumbnail"></a>
			<ul>
				<li>
					<a href="#" aria-hidden="true"><i class="fa fa-address-book"></i>Profiles</a>

					<ul>
						<li>
							<a href="http://localhost:8080/sites/automation/admin/views/student-list.php"><i class="fa fa-caret-right"></i>Student Profiles</a>
						</li>
						<li>
							<a href="http://localhost:8080/sites/automation/admin/views/teacher-list.php"><i class="fa fa-caret-right"></i>Teacher Profiles</a>
						</li>
					</ul>
				</li>

				<li><a href="http://localhost:8080/sites/automation/admin/views/requests-analysis.php"><i class="fa fa-search" aria-hidden="true"></i>Request Analysis</a></li>
				<li><a href="http://localhost:8080/sites/automation/admin/views/offered-courses.php"><i class="fa fa-list" aria-hidden="true"></i>Offered Courses</a></li>
				<li><a href="http://localhost:8080/sites/automation/admin/views/forms.php"><i class="fa fa-file-text-o" aria-hidden="true"></i>Forms</a></li>
				<li><a href="#"><i class="fa fa-cog" aria-hidden="true"></i>Settings</a></li>
			</ul>


		</div> <!-- /sidebar -->




		<div class="right-container col-lg-10 col-md-9 col-sm-8 col-xs-12">