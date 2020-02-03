
<?php 

include '../partials/admin-header.php';
use Automation\admin;

?>




















<div class="row">

	<form action="offered-courses.php?search=on" method="post" class="search-select col-lg-4 col-md-4 col-sm-4 col-xs-12">
		
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
					<h3 class="panel-title">Showing Courses For Fall 2013</h3>
					<div class="panel-body" style="position: relative;">
						<input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Search Students" />
						<button onClick="location.href='../add/new-student.php';" class="btn btn-default">Add A New Semester</button>
					</div>
				</div>
			
				<table class="table table-striped table-bordered table-hover" id="dev-table">
					<thead>
						<tr>
							<th>#</th>
							<th>Course Code</th>
							<th>Section</th>
							<th>Faculty</th>
							<th>Time</th>
							<th>Room</th>
							<th>Capacity</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php 
						$i=0;
						foreach ($result as $row) { $i++;?>
						<tr>
							<td><?php echo $i;?></td>
							<td><?php echo $row->code;?></td>
							<td><?php echo $row->section;?></td>
							<td><?php echo $row->teacher;?></td>
							<td><?php echo $row->class_time;?></td>
							<td><?php echo $row->room;?></td>
							<td><?php echo $row->filled . " (" . $row->capacity . ")";?></td>
							<td><a href="" class="btn btn-primary btn-sm">Edit</a></td>
						</tr>
						<?php } if($i==0){echo "<tr style='background:white;'><td colspan='5'><h4>No Result Found</h4></td></tr>";}?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div> <!-- /searchable-table -->



















<?php include '../partials/admin-footer.php';?>