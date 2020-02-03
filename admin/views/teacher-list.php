
<?php 

include '../partials/admin-header.php';
use Automation\admin;

if(isset($_GET['search']) && isset($_POST['search'])){
	
	$faculty = htmlspecialchars($_POST['faculty']);
	$department = htmlspecialchars($_POST['department']);

	if(!empty($faculty) && !empty($department)){
		$stmt = $con->prepare("select * from teachersprofile where faculty = :faculty && department = :department");
		$stmt->execute(array(
			'faculty' => $faculty,
			'department' => $department
			));
		if($stmt){
			$result = $stmt->fetchAll(PDO::FETCH_OBJ);
		}
	}

	if(empty($faculty) && !empty($department)){
		$result = admin\get_row('teachersprofile','department',$department);
	}
	if(!empty($faculty) && empty($department)){
		$result = admin\get_row('teachersprofile','faculty',$faculty);
	}
	if(empty($faculty) && empty($department)){
		$result = admin\get_rows('teachersprofile');
	}

}

else{
	$result = admin\get_rows('teachersprofile');
}

?>




















<div class="row">

	<form action="teacher-list.php?search=on" method="post" class="search-select col-lg-4 col-md-4 col-sm-4 col-xs-12">
		
		<h2>Help Narrowing Down The Search</h2>
		<select name="faculty">
			<option value="">Select Faculty</option>
			<?php 
			$faculties = admin\get_distinct_rows('subjects','faculty');
			foreach ($faculties as $faculty) {
				echo "<option value = \"$faculty->faculty\">$faculty->faculty</option>";
			}
			?>
		</select>




		<select name="department">
			<option value="">Select Department</option>
			<?php 
			$departments = admin\get_distinct_rows('subjects','department');
			foreach ($departments as $department) {
				echo "<option value = \"$department->department\">$department->department</option>";
			}
			?>
		</select>
		<br>
		<input type="submit" class="btn btn-primary btn-sm" name="search" value="Search">
	

	</form> <!-- /search-select -->



















	<div class="info col-lg-8 col-md-8 col-sm-8 col-xs-12">
		
		<p>
			Editing or deleting any information from any teacher's profile will
			result in modifying university database. Be sure to double
			check any kind of modifications you make.
			<br><br>
			<i>Caution :</i> <b><i>Deleted profiles can not be restored.</i></b>
		</p>

	</div> <!-- /info -->



</div> <!-- /row -->



















<div class="searchable-table col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Teacher Listing</h3>
					<div class="panel-body" style="position: relative;">
						<input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Search Teacher" />
						<button id = "bring-modal" class="btn btn-default">Create A New Teacher Profile</button>
					</div>
				</div>
			
				<table class="table table-striped table-bordered table-hover" id="dev-table">
					<thead>
						<tr>
							<th>#</th>
							<th>Initials</th>
							<th>Name</th>
							<th>Faculty</th>
							<th>Department</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php 
						$i=0;
						foreach ($result as $row) { $i++;?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo strtoupper($row->initial);?></td>
							<td><?php echo $row->name;?></td>
							<td><?php echo $row->faculty;?></td>
							<td><?php echo $row->department;?></td>
							<td><a href="teacher-profile.php?id=<?php echo $row->id;?>" class="btn btn-primary btn-sm">View Profile</a></td>
						</tr>
						<?php } if($i==0){echo "<tr style='background:white;'><td colspan='6'><h4>No Result Found</h4></td></tr>";}?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div> <!-- /searchable-table -->



















<div id="create-teacher-modal">
	
	<div id="create-teacher-overlay"></div>

	<div class="create-teacher-content">
		
		<h2>Teacher Profile Approval</h2>

		<form action="../requires/add-functions.php" method="post">

			<input type="text" name="initial" placeholder="Faculty Initial (MUST BE UNIQUE)" required>

			<input type="hidden" name="office-hour" value="Sunday###{{}}}{Monday###{{}}}{Tuesday###{{}}}{Wednesday###{{}}}{Thursday###{{}}}{Friday###{{}}}{Saturday###">


			<select name="faculty" required>
				<option>Select Faculty</option>
				<?php 
				$faculties = admin\get_distinct_rows('subjects','faculty');
				foreach ($faculties as $faculty) {
					echo "<option value = \"" . $faculty->faculty . "\"> $faculty->faculty </option>";
				}
				?>
			</select>

			<select name="department" required>
				<option>Select Department</option>
				<?php 
				$departments = admin\get_distinct_rows('subjects','department');
				foreach ($departments as $department) {
					echo "<option value = \"" . $department->department . "\"> $department->department </option>";
				}
				?>
			</select>

			<br><br>
			<button type="submit" name="create-new-teacher" class="btn btn-primary btn-sm">Approve Profile</button>

		</form>


	</div> <!-- /create-teacher-content -->

</div> <!-- /create-teacher-modal -->









<?php
	if(isset($_GET['status'])){
		$status = $_GET['status'];
		if($status == 'success'){
			echo "<script>alert('Successfully Inserted');</script>";	
		}
	}
?>




<script>
	

	(function(){

		$('#bring-modal').on('click',function(){
			$('#create-teacher-modal').fadeIn();	
		});

		$('#create-teacher-overlay').on('click',function(){
			$('#create-teacher-modal').fadeOut();	
		});
	
	})(); 

</script>







<?php include '../partials/admin-footer.php';?>