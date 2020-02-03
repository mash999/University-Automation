
<?php 

include_once '../partials/students-header.php';
include_once '../partials/students-sidebar.php';
use Automation\students;

if(isset($_GET['ref'])){
	$id = "";
	if(isset($_GET['edit'])){
		$id = htmlspecialchars($_GET['edit']);
	}
	else{
		header("Location:courses.php");
	}
	
	$class_name = htmlspecialchars($_GET['ref']);
	$stmt = $con->prepare("SELECT DISTINCT student_id,teacher FROM coursestaken WHERE class_name = :class");
	$stmt->bindParam(':class',$class_name);
	$stmt->execute();
	$arr = $stmt->fetchAll();
	$authorized = array();
	
	array_push($authorized, strtolower($arr[0]['teacher']));
	foreach ($arr as $a) {
		array_push($authorized, $a['student_id']);
	}

	if(in_array(htmlspecialchars($_SESSION['User_id']), $authorized)){
		header("Location:courses.php");
	}
	else{
		$assignment = students\get_row('assignments','id',$id)[0];
	}
}

else{
	header("Location:courses.php");
}


?>




	
	<div class="classroom">

		<h2>
			<?php echo $assignment->assignment_title;?>
			<a href="classroom.php?ref=<?php echo $class_name;?>" class="btn btn-primary btn-sm pull-right" style="margin-left: 3px;">Go Back</a>
		</h2>
		
		<?php echo htmlspecialchars_decode($assignment->assignment_desc);?>
		<br><br>
		<pre class="pull-left">Uploaded on <?php echo $assignment->uploaded_on;?></pre>


		<?php $date_time = explode(" ", $assignment->expires_on);
		$time = strtotime($date_time[0]." ".$date_time[2]);
		if(time()<$time) { ?>
		<form method="post" action="../requires/add-functions.php" class="pull-right" enctype="multipart/form-data">
			<label>Submit Assignment</label>
			<input type="hidden" name="class-name" value="<?php echo $class_name;?>">
			<input type="hidden" name="assignment-id" value="<?php echo $id;?>">
			<input type="hidden" name="student-id" value="<?php echo $_SESSION['User_id'];?>">
			<input type="file" name="file">
			<br>
			<button type="submit" class="btn btn-primary btn-sm pull-left" name="upload-assignment">Submit</button>
			<br><br><br><br>	
		</form>
		<?php } ?>

	</div> <!-- /classroom -->







<?php include_once '../partials/students-footer.php';?>