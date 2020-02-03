
<?php 

include_once '../partials/teacher-header.php';
include_once '../partials/teacher-sidebar.php';
use Automation\teacher;

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

	if(!in_array(htmlspecialchars($_SESSION['User_id']), $authorized)){
		header("Location:courses.php");
	}
	else{
		$assignment = teacher\get_row('assignments','id',$id)[0];
	}
}

else{
	header("Location:courses.php");
}


?>



<link rel="stylesheet" type="text/css" href="../jquery-ui/jquery-ui.css">
<script src ="../../tinymce/js/tinymce/tinymce.min.js"></script>
<script src ="../../tinymce/js/tinymce/init.tinymce.js"></script>
<script src ="../jquery-ui/jquery-ui.js"></script>




	
	<div class="classroom">

		<h2>
			<?php echo $assignment->assignment_title;?>
			
			<a href="view-submissions.php?id=<?php echo $id;?>&ref=<?php echo $class_name;?>" class="btn btn-primary btn-sm pull-right" style="margin-left: 3px;">Submissions</a>
			
			<a href="classroom.php?ref=<?php echo $class_name;?>" class="btn btn-primary btn-sm pull-right" style="margin-left: 3px;">Go Back</a>

			<button id="edit-assignment" class="btn btn-primary btn-sm pull-right">Edit</button>
		</h2>
		
		<?php echo htmlspecialchars_decode($assignment->assignment_desc);?>
		<br><br>
		<pre class="pull-left">Uploaded on <?php echo $assignment->uploaded_on;?></pre>

	</div> <!-- /classroom -->



















	<!-- MODAL -->

	<div id="edit-assignment-modal">
		
		<div id="edit-assignment-overlay"></div>

		<div class="edit-assignment-content">
			
			<h2>Modify Assignment</h2>

			<form action="../requires/edit-functions.php" method="post" enctype="multipart/form-data">
	
				<input type="text" name="title" value="<?php echo $assignment->assignment_title;?>">

				<?php $date_time = explode(" ", $assignment->expires_on);?>
				<input id = "expire-datepicker" type="text" name="date" value="<?php echo $date_time[0];?>" readonly>

				<select name="time">
					<option value="<?php echo $date_time[2];?>"><?php echo $date_time[2];?></option>
					<?php 
						$hours = array('12.00','12.30','1:00','1:30','2:00','2:30','3:00','3:30','4:00','4:30','5:00','5:30','6:00','6:30','7:00','7:30','8:00','8:30','9:00','9:30','10:00','10:30','11:00','11:30');
						foreach ($hours as $hour){echo '<option value = "' . $hour . 'AM">' . $hour . "AM" . '</option>';}
						foreach ($hours as $hour){echo '<option value = "' . $hour . 'PM">' . $hour . "PM" . '</option>';}
					?>
				</select>
				<textarea class="tinymce" name="description"><?php echo $assignment->assignment_desc;?></textarea>
				<br>

				<?php $str = explode('_', $class_name);
					  $semester = $str[sizeof($str)-1]; ?>

				<input type="hidden" name="class-name" value="<?php echo $class_name;?>">
				<input type="hidden" name="semester" value="<?php echo $semester;?>">
				<input type="hidden" name="teacher" value="<?php echo $_SESSION['User_id'];?>">
				<input type="hidden" name="id" value="<?php echo $id;?>">

				<button type="submit" name="update-assignment" class="btn btn-primary btn-sm">Upload</button>
				<br><br>
	
			</form>


		</div> <!-- /edit-assignment-content -->


	</div> <!-- /edit-assignment-modal -->








	<script>
			
		$( "#expire-datepicker" ).datepicker({ minDate: 0, maxDate: "+2M" });



		// MODALS
		$('#edit-assignment').on('click',function(){
			$('#edit-assignment-modal').fadeIn();
		});


		$('#edit-assignment-overlay').on('click',function(){
			$('#edit-assignment-modal').fadeOut();
		});

	</script>


<?php include_once '../partials/teacher-footer.php';?>