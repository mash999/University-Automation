
<?php 

include '../partials/admin-header.php';
use Automation\admin;

$rows = admin\get_rows('studentsrequests');

?>


<div class="forms">

	<h2>Requests Analysis</h2>

	<div class="searchable-table col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Requests From Students</h3>
						<div class="panel-body" style="position: relative;">
							<input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Search Forms" />
						</div>
					</div>
				
					<table class="table table-striped table-bordered table-hover" id="dev-table">
						<thead>
							<tr>
								<th>#</th>
								<th>Title</th>
								<th>Requested By</th>
								<th>Date</th>
								<th>Status</th>
								<th>Analyze</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>

							<?php $i = 1;
							foreach ($rows as $row) { 
							$name = admin\get_row('studentprofile','id',$row->requested_by)[0];
							?>

							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $row->title;?></td>
								<td><?php echo $name->name;?></td>
								<td><?php echo date("M-d-y, h:m A",$row->requested_on);?></td>
								<td>
									<?php 
									if($row->status==0) $status = 'Pending';
									if($row->status==1) $status = 'Approved';
									if($row->status==-1) $status = 'Rejected';
									echo $status;
									?>
								</td>
								<td>
									<a href="<?php echo $row->file;?>" class="btn btn-primary btn-sm">View Request</a>
									<a target="blank" href="student-profile.php?id=<?php echo $row->requested_by;?>" class="btn btn-primary btn-sm">View Profile</a>
								</td>
								<td>
									<button class="btn btn-primary btn-sm process-req">Approve </button>
									<button class="btn btn-primary btn-sm process-req">Reject </button>
								</td>
							</tr>
							
							<?php $i++; } ?>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div> <!-- /searchable-table -->


</div> <!-- /forms -->



















<div id="add-form-modal">
	
	<div id="add-form-overlay"></div>

	<div class="add-form-content">
		
		<h2>Add a New Service Form</h2>

		<form action="../requires/add-functions.php" method="post" enctype="multipart/form-data">

			<input type="text" name="title" placeholder="Title of The Form">
			<br><br>
			<label>Upload Form (Doc file)</label>
			<input type="file" name="file">
			<br><br>
			<button type="submit" name="add-form" class="btn btn-primary btn-sm">Add Form</button>

		</form>


	</div> <!-- /add-form-content -->

</div> <!-- /add-form-modal -->




<div id="edit-form-modal">
	
	<div id="edit-form-overlay"></div>

	<div class="edit-form-content">
		
		<h2>Edit Form</h2>

		<form action="../requires/edit-functions.php" method="post" enctype="multipart/form-data">

			<input type="text" class="set-vals" name="title" value="">
			<input type="hidden" class="set-vals" name="image" value="">
			<input type="hidden" class="set-vals" name="id" value="">
			<br><br>
			<label>Upload Form (Doc file)</label>
			<input type="file" name="file">
			<br><br>
			<button type="submit" name="edit-form" class="btn btn-primary btn-sm">Edit Form</button>

		</form>


	</div> <!-- /edit-form-content -->

</div> <!-- /edit-form-modal -->









<?php
	if(isset($_GET['status'])){
		$status = $_GET['status'];
		if($status == 'success'){
			echo "<script>alert('Successfully Inserted');</script>";	
		}
	}


	if(isset($_GET['status'])){
		$edited = $_GET['status'];
		if($edited == 'edited'){
			echo "<script>alert('Successfully Edited');</script>";	
		}
	}
?>




<script>
	

	(function(){

		$('#bring-modal').on('click',function(){
			$('#add-form-modal').fadeIn();	
		});

		$('#add-form-overlay').on('click',function(){
			$('#add-form-modal').fadeOut();	
		});

		$('.bring-edit-modal').on('click',function(){
			$('#edit-form-modal').fadeIn();	
			var $this = $(this),
				setVals = $('.set-vals');
			$(setVals).first().val($this.data('title'));
			$(setVals).first().next().val($this.data('image'));
			$(setVals).first().next().next().val($this.data('id'));
		});

		$('#edit-form-overlay').on('click',function(){
			$('#edit-form-modal').fadeOut();	
		});


		$('.process-req').on('click',function(){
			var val = $(this).text();
			var sw;
			if(val=="Approve"){
				sw = 1;
				val = "Approved";
			}
			if(val=="Reject"){
				sw = -1;
				val = "Rejected";
			}
			$.ajax({
				
			})
		})
	
	})(); 

</script>







<?php include '../partials/admin-footer.php';?>