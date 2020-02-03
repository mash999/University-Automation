
<?php 

include '../partials/admin-header.php';
use Automation\admin;


if(isset($_GET['id'])){
	$id = htmlspecialchars($_GET['id']);
	$semester_name = admin\get_row('offeredcourses','id',$id);
	$this_semester = $semester_name[0]->semester . " " . $semester_name[0]->year;
}

else{
	header("Location:offered-courses.php");
}

?>



















<div class="offered-courses" id="add-offered-courses">
	
	<div class="row-select">
		<h2>Add Courses to <?php echo $this_semester;?></h2>
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

		<input type="text" value="">
		<input type="text" value="">
		<input type="text" value="">
		<input type="text" value="">
		<input type="text" value="">
		<input type="text" value="">
		<input type="text" value="">
		<input type="text" value="">
		<input type="text" value="">
		<input type="text" value="">
		<input type="text" value="">
		<input type="text" value="">
		<input type="text" value="">
		<input type="text" value="">
		<input type="text" value="">
		<input type="text" value="">
		<input type="text" value="">
		<input type="text" value="">
		<input type="text" value="">
		<input type="text" value="">
		<input type="text" value="">
		<input type="text" value="">
		<input type="text" value="">
		<input type="text" value="">
		<input type="text" value="">
		<input type="text" value="">
		<input type="text" value="">
		<input type="text" value="">


	</section>

	<br><button id="file-update" class="btn btn-primary">Save</button>



</div> <!-- /edit-offered-courses -->



















<script>
	
	(function(){

		$('#insert-rows').on('click',function(){
			var inputs = $('.inputs');
			var rowNumber = $('#row-number').val() * 7;
			for(var i = 1;  i <= rowNumber; i++){
				inputs.append("<input type=\"text\" value=\"\" style=\"margin-right:1.4%\">");
			}
		});
		// $('#file-update').on('click',function(){
		// 	var val, i=1, str= "1,";

		// 	$('.inputs input').each(function(){
		// 		if($(this).hasClass('add-line')){
		// 			i++;
		// 			str = str + $(this).val() + "\n" + i + ',';
		// 		}
		// 		else{
		// 			str = str + $(this).val() + ',';	
		// 		}
		// 	});

		// 	$.ajax({
		// 		url : '../requires/ajax.php',
		// 		method : 'post',
		// 		data : {fileContent : str, file:"<?php //echo $input_file;?>"},
		// 		success : function(context){
		// 			alert(context);
		// 		}
		// 	})

		// });


	})();

</script>








<?php include '../partials/admin-footer.php';?>