
<?php 

include_once '../partials/teacher-header.php';
include_once '../partials/teacher-sidebar.php';
use Automation\teacher;

$divs = teacher\get_distinct_row('semester','coursestaken','teacher',$_SESSION['User_id']);

?>

	
	<div class="courses">

		<h2>Courses</h2>
		
		<div class="tab-content">

			<?php 
			$i=1; 
			$arr = array();
			foreach ($divs as $div) { 
			if($i==1) echo "<div id=\"menu$i\" class=\"tab-pane fade in active\">";
			else echo "<div id=\"menu$i\" class=\"tab-pane fade\">"; 
			$i++;
			$stmt = $con->prepare("SELECT * FROM coursestaken WHERE teacher = :initial && semester = :sem");
			$stmt->execute(array(
				'initial' => $_SESSION['User_id'],
				'sem' => $div->semester
			));
			$rows = $stmt->fetchAll(\PDO::FETCH_OBJ);
			?>

			
			<h3>Courses of <?php echo $div->semester;?></h3>
			
			<table class="table table-striped table-bordered table-responsive">
				
				<thead>
					<tr>
						<th>Code</th>
						<th>Section</th>
						<th>Title</th>
						<th>Day</th>
						<th>Time</th>
						<th>Room</th>
						<th>Faculty</th>
						<th>courses</th>
					</tr>
				</thead>

				<tbody>
					<?php foreach ($rows as $row) { 
					$str = $div->semester.$row->course_code.$row->section;
					if(!in_array($str, $arr)){
					?>
					<tr>
						<td><?php echo $row->course_code;?></td>
						<td><?php echo $row->section;?></td>
						<td><?php echo $row->course_title;?></td>
						<td><?php echo $row->day;?></td>
						<td><?php echo $row->time;?></td>
						<td><?php echo $row->room;?></td>
						<td><?php echo $row->teacher;?></td>
						<td><a href="attendance-window.php?ref=<?php echo $row->class_name;?>" class="btn btn-sm btn-primary">Attendance</a></td>
					</tr>
					<?php }
						array_push($arr, $str);
					} 
					?>
				</tbody>
			
			</table>


			<p class="alert alert-success" style="text-transform: capitalize;">Please Provide Course Contents and materials in the corresponding classrooms.</p>
			
			
			</div> <!-- /tab-pane -->

			
			<?php } ?>

		</div> <!-- /tab-content -->


			
		<ul class="">
			<?php 
			$i = 1;
			foreach ($divs as $div) { 
				if($i==1)
					echo "<li class=\"active\"><a data-toggle=\"pill\" href=\"#menu$i\">$div->semester</a></li>";
				else
					echo "<li><a data-toggle=\"pill\" href=\"#menu$i\">$div->semester</a></li>";
				
				$i++; 
			} ?>
		</ul>


	</div> <!-- /courses -->


<?php include_once '../partials/teacher-footer.php';?>