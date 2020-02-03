
<?php 

include '../partials/admin-header.php';
use Automation\admin;

$forms = admin\get_rows('forms');

?>


<div class="forms">

	<h2>Available Service Forms</h2>

	<div class="searchable-table col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">List of Forms</h3>
						<div class="panel-body" style="position: relative;">
							<input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="Search Forms" />
						<button id = "bring-modal" class="btn btn-default">Add A New Form</button>
						</div>
					</div>
				
					<table class="table table-striped table-bordered table-hover" id="dev-table">
						<thead>
							<tr>
								<th>#</th>
								<th>Title</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>

							<?php $i = 1;
							foreach ($forms as $form) { ?>
							<tr>
								<td><?php echo $i;?></td>
								<td><?php echo $form->title;?></td>
								<td>
									<a href="<?php echo $form->file;?>" class="btn btn-primary btn-sm">View</a>
									
									<button class="bring-edit-modal btn btn-primary btn-sm" 
											data-image="<?php echo $form->file;?>" 
											data-title="<?php echo $form->title;?>" 
											data-id="<?php echo $form->id;?>">
											Edit
									</button>

									<a onclick="return confirm('ARE YOU SURE THAT YOU WANT TO DELETE THIS FORM FROM THE LIST?');" href="../requires/delete-functions.php?delete-form=true&id=<?php echo $form->id;?>&link=<?php echo $form->file;?>" class="btn btn-danger btn-sm">Delete</a>

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
	
	})(); 

</script>







<?php include '../partials/admin-footer.php';?>