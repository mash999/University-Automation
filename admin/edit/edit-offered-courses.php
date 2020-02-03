
<?php 

include '../partials/admin-header.php';
use Automation\admin;


if(isset($_GET['id'])){

	$id = $_GET['id'];
	$get_id = admin\get_row('offeredcourses','id',$id);	
	if($get_id){
		$this_semester = $get_id[0]->semester . " " . $get_id[0]->year;
		$input_file = $get_id[0]->course_list;
		$file = file_get_contents($input_file);
		$lines = explode("\n", $file);
	}
	else{
		header("Location:offered-courses.php");
	}
}

else{
	header("Location:offered-courses.php");
}

?>



















<div class="offered-courses">
	
	<div class="row-select">
		<h2>Showing Courses of <?php echo $this_semester;?></h2>
		<button id="insert-rows" class="btn btn-primary btn-sm pull-right">Insert</button>
		<input type="text" value="" id="row-number">
		<h4>Insert More Rows</h4>
	</div>


	<section class="labels">

		<label>Course</label>
		<label>Section</label>
		<label>Teacher</label>
		<label>Time</label>
		<label>Room</label>
		<label>Filled</label>
		<label>Capacity</label>

	</section>








	<section class="inputs">

		<?php
			if(sizeof($lines)>0){
				foreach ($lines as $line) {
					$cols = explode(',', $line);
					echo "<textarea>$cols[1]</textarea> 
					<textarea>$cols[2]</textarea>  
					<textarea>$cols[3]</textarea>  
					<textarea>$cols[4]</textarea>  
					<textarea>$cols[5]</textarea>  
					<textarea>$cols[6]</textarea>  
					<textarea class=\"add-line\">$cols[7]</textarea>";
				}
			}
		?>

	</section>

	<br><button id="file-update" class="btn btn-primary">Update</button>



</div> <!-- /edit-offered-courses -->



















<script>
	
	(function(){

		$('#insert-rows').on('click',function(){
			var inputs = $('.inputs');
			var rowNumber = $('#row-number').val() * 7;
			for(var i = 1;  i <= rowNumber; i++){
				if(i%7==0){
					inputs.append("<textarea class=\"add-line\" style=\"margin-right:1.4%\"></textarea>");
				}
				else{
					inputs.append("<textarea style=\"margin-right:1.4%\"></textarea>");
				}
			}
		});
		
		$('#file-update').on('click',function(){
			var val, i=1, str= "1,";

			$('.inputs textarea').each(function(){
				if($(this).hasClass('add-line')){
					i++;
					str = str + $(this).val() + "\n" + i + ',';
				}
				else{
					str = str + $(this).val() + ',';	
				}
			});

			$.ajax({
				url : '../requires/ajax.php',
				method : 'post',
				data : {fileContent : str, file:"<?php echo $input_file;?>"},
				success : function(context){
					alert(context);
				}
			})

		});

	})();



</script>








<?php include '../partials/admin-footer.php';?>