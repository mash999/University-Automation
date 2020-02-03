	
<?php 

include '../partials/students-header.php';
include '../partials/students-sidebar.php';

use Automation\students;
$forms = students\get_rows('forms');
?>



<div class="forms">

	<h2>Service Forms</h2>	



	
	<table class="table table-bordered">
		
		<thead>
			<tr>
				<th>#</th>
				<th>Available Forms</th>
				<th>Download Forms</th>
				<th>Send requests</th>
			</tr>
		</thead>


		<tbody>			

			<?php $i = 1;
			foreach ($forms as $form) { ?>
			<tr>
				<td><?php echo $i;?></td>
				<td><?php echo $form->title;?></td>
				<td align="center"><a href="<?php echo $form->file;?>" class="btn btn-primary btn-sm">Download</a></td>
				<td align="center">
					<button class="bring-edit-modal btn btn-primary btn-sm" 
						data-image="<?php echo $form->file;?>" 
						data-title="<?php echo $form->title;?>" 
						data-id="<?php echo $form->id;?>">
						Upload
					</button>
				</td>
			</tr>
			
			<?php $i++; } ?>

		</tbody>

	</table>









	<?php
		$rows = students\get_rows('studentsrequests','requested_by',$_SESSION['User_id']);
		
		$pending = 0; $approved = 0; $rejected = 0;
		foreach ($rows as $row) {
			if($row->status == 0) $pending++;
			if($row->status == 1) $approved++;
			if($row->status == -1) $rejected++;
		}
		$total = $pending + $approved + $rejected;
	?>
	<div class="activity">
		
		<ul>
			<li>Total Requests : <?php echo $total;?> </li>
			<li>Approved Requests : <?php echo $approved;?> </li>
			<li>Pending Requests : <?php echo $pending;?> </li>
			<li>Rejected Requests : <?php echo $rejected;?> </li>
		</ul>

		<p class="text-primary">
			Download the form first. Please fill up all the fields of the forms. After submitting the form, it might take couple of days to be processed. Please wait while the form is being process. 
			<br><br>
			<span class="text-danger">If you don't get any updates within a week, contact with the registration office.</span>
		</p>

	</div> <!-- /activity -->



</div> <!-- /forms -->



















<div id="edit-form-modal">
	
	<div id="edit-form-overlay"></div>

	<div class="edit-form-content">
		
		<h2>Upload Form</h2>

		<form action="../requires/add-functions.php" method="post" enctype="multipart/form-data">

			<input type="text" class="set-vals" name="title" value="">
			
			<br>
			<label>Upload Form (Doc file)</label>
			<input type="file" name="docs">
			
			<br>
			<label>Picture of Bank Statement</label>
			<input type="file" name="image">
			<input type="hidden" name="user" value="<?php echo $_SESSION['User_id'];?>">
			
			<br>
			<button type="submit" name="upload-form" class="btn btn-primary btn-sm">Send Request</button>

		</form>


	</div> <!-- /edit-form-content -->

</div> <!-- /edit-form-modal -->









<?php 
if(isset($_GET['status'])){
	$status = $_GET['status'];
	if($status == 'success'){
		echo "<script>alert('Your request has been successfully sent. You will be hearing from us soon - NSU IT');</script>";
	}
}
?>









<script>
	

	(function(){

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




<?php include '../partials/students-footer.php';?>