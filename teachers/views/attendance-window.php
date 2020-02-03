
<?php 

include_once '../partials/teacher-header.php';
include_once '../partials/teacher-sidebar.php';
use Automation\teacher;

if(isset($_GET['ref'])){
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
		header("Location:attendance.php");
	}
	else{
		$students = teacher\get_row('coursestaken','class_name',$class_name);

		$stmt = $con->prepare("SELECT DISTINCT date FROM attendances WHERE class_name = :class_name");
		$stmt->execute(array('class_name' => $class_name));
		$results = $stmt->fetchAll(\PDO::FETCH_OBJ);

		if($_GET['q']){
			$q = htmlspecialchars($_GET['q']);
			$stmt = $con->prepare("SELECT * FROM attendances WHERE class_name = :class_name && date=:date");
			$stmt->execute(array('class_name' => $class_name,'date'=>$q));
			$selected = $stmt->fetchAll(\PDO::FETCH_OBJ);
		}
	}
}

else{
	header("Location:courses.php");
}

?>


<div class="attendance-window">
	

	<h2>
		Online Attendance <em>Total class : 8</em>
		<br>
		<span>Course : 
			<?php $class = explode('_', $class_name);
			echo $class[0] . '.' . $class[1];?>
		</span>

		<em>Date : <?php echo date("d-M-Y",time());?></em>
		<form action="attendance-window.php?ref=<?php echo $class_name;?>&q=search" method="post">
			<button type="submit" class="btn btn-primary btn-sm">Go</button>
			<select name="select-attendance">
				<option value="">Choose Date</option>
				<?php 
				foreach ($results as $result) {
					echo "<option value =\"$result->date\">$result->date</option>";
				}?>
			</select>
		</form>	
	</h2>


	<table class="table table-bordered table-striped">
		
		<thead>
			<tr>
				<th>#</th>
				<th>ID</th>
				<th>Name</th>
				<th>Present/Absent</th>
			</tr>
		</thead>


		<tbody>

			<?php $i=1; if(isset($_GET['q'])) {
			foreach ($selected as $sl) { ?>
			<tr>
				<td><?php echo $i;?></td>
				<td><?php echo $sl->student_id;?></td>
				<td>
					<?php $name = teacher\get_row('studentprofile','id',$sl->student_id)[0]; 
					echo $name->name;?>
				</td>
				<td><input type="checkbox" name="attendance" checked></td>
			</tr>
			<?php $i++; } }?>

			<?php $i=1; foreach ($students as $s) { ?>
			<tr>
				<td><?php echo $i;?></td>
				<td><?php echo $s->student_id;?></td>
				<td>
					<?php $name = teacher\get_row('studentprofile','id',$s->student_id)[0]; 
					echo $name->name;?>
				</td>
				<td><input type="checkbox" name="attendance" checked></td>
			</tr>
			<?php $i++; }?>
		</tbody>

	</table>

	<button id="submit" class="btn btn-primary btn-sm">Submit Attendance</button>


	<script>
		
		$('#submit').on('click',function(){
			if(confirm("Are you sure that you want to submit attendance?")){
				var str = "",
					$this = "",
					input = $('input');
				
				$.each(input,function(){
					$this =  $(this);
					if($this.prop('checked')==true){
						str = str + $this.parent('td').prev().prev().text() + ',';	
					}
				});
				
				var thisClass = "<?php echo $class_name;?>" ;
				$.ajax({
					url : '../requires/edit-functions.php',
					method : 'get',
					data : {attendance : str, className : thisClass },
					success: function(context){
						window.location.replace("attendance.php");
					}
					
				});
			}
		});

	</script>


</div> <!-- /attendance-window -->
 

<?php include_once '../partials/teacher-footer.php';?>