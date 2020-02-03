
<?php 

include_once '../partials/students-header.php';
include_once '../partials/students-sidebar.php';
use Automation\students;

if(isset($_GET['ref'])){
	$class_name = htmlspecialchars($_GET['ref']);
	$stmt = $con->prepare("SELECT DISTINCT student_id FROM coursestaken WHERE class_name = :class");
	$stmt->bindParam(':class',$class_name);
	$stmt->execute();
	$arr = $stmt->fetchAll();
	$authorized = array();
	
	//array_push($authorized, strtolower($arr[0]['teacher']));
	foreach ($arr as $a) {
		array_push($authorized, $a['student_id']);
	}

	if(in_array(htmlspecialchars($_SESSION['User_id']), $authorized)){
		header("Location:students-courses.php");
	}
	else{
		$assignments = students\get_row('assignments','class_name',$class_name);
		$lectures = students\get_row('lectures','class_name',$class_name);
		$marksheet = students\get_row('marksheets','class_name',$class_name)[0];
	}
}

else{
	header("Location:students-courses.php");
}

?>




	
	<div class="classroom">

		<h2>
			<?php echo $class_name;?>
			<span data-load="marksheet">Marksheet</span>
			<span data-load="assignments">Assignments</span>
			<span data-load="lectures">Lectures</span>
			<!-- <span data-load="discussion">Discussion</span> -->
		</h2>









		<!-- <div class="discussion">
			
			<h3>Discussion</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

		</div> /discussion --> 









		<div class="lectures">
			
			<h3>Lectures</h3>

			<table class="table table-bordered">
				
				<thead>
					<tr>
						<th>Lecture Number</th>
						<th>Upload Date</th>
						<th>Lecture Title</th>
						<th>Action</th>
					</tr>
				</thead>


				<tbody>
					<?php $i=1 ; 
					foreach ($lectures as $lecture) { ?>
					<tr>
						<td><?php echo $i;?></td>
						<td><?php echo $lecture->updated_on;?></td>
						<td><?php echo $lecture->title;?></td>
						<td>
							<a target="_blank" href="<?php echo $lecture->file;?>" class="btn btn-primary btn-sm">Download</a>
						</td>
					</tr>
					<?php $i++; } ?>
				</tbody>

			</table>

		</div> <!-- /lectures -->









		<div class="assignments">
			
			<h3>Assignments</h3>

			<?php foreach ($assignments as $assignment) { ?>
			<a href="assignment-detail.php?edit=<?php echo $assignment->id;?>&ref=<?php echo $class_name;?>">
				<section>
					<h4>
						<?php echo $assignment->assignment_title;?> <br>
						<span>Uploaded On <?php echo $assignment->uploaded_on;?></span> <br>
						<span>Expires On <?php echo $assignment->expires_on;?></span>
					</h4>

					<h5>
						Status <br>
						<?php $date_time = explode(" ", $assignment->expires_on);
						$time = strtotime($date_time[0]." ".$date_time[2]);
						if(time()<$time) echo "<span>Turned On</span>";
						else echo "<span>Turned Off</span>";
						?>
					</h5>

					<h6>
						<?php $date_time = explode(" ", $assignment->expires_on);
						$time = strtotime($date_time[0]." ".$date_time[2]);
						if(time()<$time) echo "<span>The assignment is live</span>";
						else echo "<span>The assignment is off</span>";?>
					</h6>

				</section>
			</a>
			<?php } ?>


		</div> <!-- /assignments -->









		<div class="marksheet">
			
			<h3 id="get-grade">Marksheet
				<span class="pull-right"></span>
				<span class="pull-right" style="margin-right: 1%"></span> 
			</h3>

			<table id="mark-table" class="table table-striped table-bordered table-responsive">
				<?php 
				$sheet = file_get_contents($marksheet->file);
				$rows = explode("\n", $sheet);
				$heads = explode(",",$rows[0]);

				for ($i=0; $i<sizeof($rows); $i++) {
					$cols = explode(",", $rows[$i]);
					if($cols[0] == $_SESSION['User_id']){
						for($j=0;$j<sizeof($cols);$j++){
							if($j==0){
								echo 
								"<tr> 
									<th>Tests</th>
									<th>Marks</th>
								</tr>";
							}
							else{
								echo 
								"<tr> 
									<td>$heads[$j]</td>
									<td>$cols[$j]</td>
								</tr>";
							}
						}
						break;
					}
				}
				?>
			</table>

		</div> <!-- /marksheet -->
		



	</div> <!-- /classroom -->



















		<script>
			

		var selector = $('.classroom h2 span');
		$('.classroom div').hide().first().show();
		
		$(selector).css('cursor','pointer');
		$(selector).last().addClass('activated');

		$(selector).on('click',function(){
			var $this = $(this),
				targetDiv = '.' + $this.data('load');

			$this.addClass('activated').siblings('span').removeClass('activated');
			$(targetDiv).siblings('div').hide();
			$(targetDiv).show(500);

		});

		var trgt = $("#mark-table").children('tbody').children('tr').last();
		$("#get-grade span").first().text("( " + trgt.children('td').last().text() + " )");
		$("#get-grade span").last().text(trgt.prev().children('td').last().text() + "%");


	</script>



<?php include_once '../partials/students-footer.php';?>