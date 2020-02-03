
<?php 

include '../partials/admin-header.php';
use Automation\admin;


if(isset($_GET['id'])){

	$id = $_GET['id'];
	$get_id = admin\get_row('offeredcourses','id',$id);	
	if($get_id){
		$this_semester = $get_id[0]->semester . " " . $get_id[0]->year;
		$input_file = $get_id[0]->course_list;
		$file = file_get_contents($input_file);
		$lines = explode("\n", $file);
	}
	else{
		header("Location:offered-courses.php");
	}
}

else{
	header("Location:offered-courses.php");
}

?>



















<div class="offered-courses" id="show-offered-course">
	
	<h2>Showing Courses of <?php echo $this_semester;?></h2>
	
	<section class="inputs">

		<table class="table table-bordered">
			<tr>
				<th>Course</th>
				<th>Section</th>
				<th>Teacher</th>
				<th>Time</th>
				<th>Room</th>
				<th>Filled</th>
				<th>Capacity</th>
			</tr>
			<?php
				if(sizeof($lines)>0){
					foreach ($lines as $line) {
						$cols = explode(',', $line);
						echo "<tr>
							<td>$cols[1]</td> 
							<td>$cols[2]</td>  
							<td>$cols[3]</td>  
							<td>$cols[4]</td>  
							<td>$cols[5]</td>  
							<td>$cols[6]</td>  
							<td>$cols[7]</td>
						</tr>";
					}
				}
			?>
		</table>

	</section>

	<br><button id="file-update" class="btn btn-primary">Update</button>



</div> <!-- /edit-offered-courses -->
























<?php include '../partials/admin-footer.php';?>