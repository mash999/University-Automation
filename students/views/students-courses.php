
<?php 

include_once '../partials/students-header.php';
include_once '../partials/students-sidebar.php';
use Automation\students;

$divs = students\get_distinct_row('semester','coursestaken','student_id',$_SESSION['User_id']);

?>

	
	<div class="courses">

		<h2>Courses</h2>
		
		<div class="tab-content">

			<?php 
			$i=1; 
			foreach ($divs as $div) { 
			if($i==1) echo "<div id=\"menu$i\" class=\"tab-pane fade in active\">";
			else echo "<div id=\"menu$i\" class=\"tab-pane fade\">"; 
			$i++;
			$stmt = $con->prepare("SELECT * FROM coursestaken WHERE student_id = :id && semester = :sem");
			$stmt->execute(array(
				'id' => $_SESSION['User_id'],
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
					<?php foreach ($rows as $row) { ?>
					<tr>
						<td><?php echo $row->course_code;?></td>
						<td><?php echo $row->section;?></td>
						<td><?php echo $row->course_title;?></td>
						<td><?php echo $row->day;?></td>
						<td><?php echo $row->time;?></td>
						<td><?php echo $row->room;?></td>
						<td><?php echo $row->teacher;?></td>
						<td><a href="classroom.php?ref=<?php echo $row->class_name;?>" class="btn btn-sm btn-primary">Classroom</a></td>
					</tr>
					<?php } ?>
				</tbody>
			
			</table>


			<p class="alert alert-success" style="text-transform: capitalize;">Course Contents and materials Are Provided in the corresponding classrooms.</p>
			
			
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


<?php include_once '../partials/students-footer.php';?>