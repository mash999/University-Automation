
<?php 
include '../partials/admin-header.php';
use Automation\admin;

if(isset($_GET['search']) && isset($_POST['search'])){
	
	$year = $_POST['year'];
	$semester = $_POST['semester'];

	if(!empty($year) && !empty($semester)){
		$stmt = $con->prepare("select * from studentprofile where admitted_year = :year && admitted_semester = :semester");
		$stmt->execute(array(
			'year' => $year,
			'semester' => $semester
			));
		if($stmt){
			$result = $stmt->fetchAll(PDO::FETCH_OBJ);
		}
	}

	if(empty($year) && !empty($semester)){
		$result = admin\get_row('studentprofile','admitted_semester',$semester);
	}
	if(!empty($year) && empty($semester)){
		$result = admin\get_row('studentprofile','admitted_year',$year);
	}
	if(empty($year) && empty($semester)){
		$result = admin\get_rows('studentprofile');
	}

}

else{
	$result = admin\get_rows('studentprofile');
}

?>




















<div class="row">

	<form action="student-list.php?search=on" method="post" class="search-select col-lg-4 col-md-4 col-sm-4 col-xs-12">
		
		<h2>Help Narrowing Down The Search</h2>
		<select name="year">
			<option value="">Select Year</option>
			<?php 
			$year = date("Y");
			$range = $year - 1993;
			$yr = 1992;
			for($i=1;$i<=$range+1;$i++){ ?>
				<option value="<?php echo $yr+1;?>"><?php echo $yr+1;?></option>
			
			<?php $yr++; } ?>
		</select>




		<select name="semester">
			<option value="">Select Semester</option>
			<option value="Spring">Spring</option>
			<option value="Summer">Summer</option>
			<option value="Fall">Fall</option>
		</select>
		<br>
		<input type="submit" class="btn btn-primary btn-sm" name="search" value="Search">
	

	</form> <!-- /search-select -->



















	<div class="info col-lg-8 col-md-8 col-sm-8 col-xs-12">
		
		<p>
			Editing or deleting any information from any student's profile will
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
					<h3 class="panel-title">Students Listing</h3>
					<div class="panel-body" style="position: relative;">
						<input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Search Students" />
						<button onClick="location.href='../add/new-student.php';" class="btn btn-default">Create A New Student Profile</button>
					</div>
				</div>
			
				<table class="table table-striped table-bordered table-hover" id="dev-table">
					<thead>
						<tr>
							<th>#</th>
							<th>Student ID</th>
							<th>Name</th>
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
							<td><?php echo $row->id;?></td>
							<td><?php echo $row->name;?></td>
							<td><?php echo $row->department;?></td>
							<td><a href="student-profile.php?id=<?php echo $row->id;?>" class="btn btn-primary btn-sm">View Profile</a></td>
						</tr>
						<?php } if($i==0){echo "<tr style='background:white;'><td colspan='5'><h4>No Result Found</h4></td></tr>";}?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div> <!-- /searchable-table -->



















<?php include '../partials/admin-footer.php';?>