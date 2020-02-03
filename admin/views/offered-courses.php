
<?php 

include '../partials/admin-header.php';
use Automation\admin;


if(isset($_GET['search']) && isset($_POST['search'])){
	
	$year = $_POST['year'];
	$semester = $_POST['semester'];

	if(!empty($year) && !empty($semester)){
		$stmt = $con->prepare("select * from offeredcourses where year = :year && semester = :semester");
		$stmt->execute(array(
			'year' => $year,
			'semester' => $semester
			));
		if($stmt){
			$result = $stmt->fetchAll(PDO::FETCH_OBJ);
		}
	}

	if(empty($year) && !empty($semester)){
		$result = admin\get_row('offeredcourses','semester',$semester);
	}
	if(!empty($year) && empty($semester)){
		$result = admin\get_row('offeredcourses','year',$year);
	}
	if(empty($year) && empty($semester)){
		$result = admin\get_rows('offeredcourses');
	}

}

else{
	$result = admin\get_rows('offeredcourses');
}

?>




















<div class="row">

	<form action="offered-courses.php?search=on" method="post" class="search-select col-lg-4 col-md-4 col-sm-4 col-xs-12">
		
		<h2>Help Narrowing Down The Search</h2>
		<select name="year">
			<option value="">Select Year</option>
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
			Editing or deleting any information will result in modifying university database. 
			Be sure to double check any kind of modifications you make.
			<br><br>
			<i>Caution :</i> <b><i>DELETED ENTRIES CAN NOT BE RESTORED.</i></b>
		</p>

	</div> <!-- /info -->



</div> <!-- /row -->



















<div class="searchable-table col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">List of Offered Courses</h3>
					<div class="panel-body" style="position: relative;">
						<input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Search Students" />
						<button  id="bring-modal" class="btn btn-default">Add A New Semester</button>
					</div>
				</div>
			
				<table class="table table-striped table-bordered table-hover" id="dev-table">
					<thead>
						<tr>
							<th>#</th>
							<th>Semester</th>
							<th>Year</th>
							<th>Course List</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php 
						$i=0;
						foreach ($result as $row) { $i++;?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $row->semester;?></td>
							<td><?php echo $row->year;?></td>
							<td>
								<a href="../views/show-offered-courses.php?id=<?php echo $row->id;?>"><?php echo "Course List For ".$row->semester." ".$row->year;?>
								</a>
							</td>
							
							<td>
								<a href="../edit/edit-offered-courses.php?id=<?php echo $row->id;?>" class="btn btn-primary btn-sm">Edit</a>
								<a href="../edit/edit-offered-courses.php?id=<?php echo $row->id;?>" class="btn btn-primary btn-sm">Activate</a>
							</td>

						</tr>

						<?php } if($i==0){echo "<tr style='background:white;'><td colspan='5'><h4>No Result Found</h4></td></tr>";}?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div> <!-- /searchable-table -->



















<div id="create-semester-modal">
	
	<div id="create-semester-overlay"></div>

	<div class="create-semester-content">
		
		<h2>New Semester</h2>

		<form action="../requires/add-functions.php" method="post">

			<input type="text" name="new-year" placeholder=" Year in Full Form, e.g : 2017">

			<select name="new-semester">
				<option value="">Select Semester</option>
				<option value="Spring">Spring</option>
				<option value="Summer">Summer</option>
				<option value="Fall">Fall</option>
			</select>

			<button type="submit" name="create-new-semester" class="btn btn-primary btn-sm">Start Semester</button>

		</form>


	</div> <!-- /create-semester-content -->

</div> <!-- /create-semester-modal -->




















<script>
	
	(function(){

		$('#bring-modal').on('click',function(){
			$('#create-semester-modal').fadeIn();	
		});

		$('#create-semester-overlay').on('click',function(){
			$('#create-semester-modal').fadeOut();	
		});
	
	})(); 

</script>

















<?php include '../partials/admin-footer.php';?>