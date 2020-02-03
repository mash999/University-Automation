
<?php 
	include_once ('../partials/admin-header.php');
	use Automation\admin;
?>


<form class="manage-students" method="post" action="../requires/add-functions.php" enctype="multipart/form-data" >

	<div class="personal-info manage-students-columns">
		
		<h2>Personal Information</h2>
	
		<div class="left">

			<section class="labels">

				<label>Full Name *</label>
				<label>Gender *</label>
				<label>Date of Birth *</label>
				<label>Citizenship *</label>
				<label>Blood Group *</label>
				<label>Marital Status</label>
				<label>Religion *</label>
				<label>Image *</label>

			</section>




			<section>
				
				<input type="text" name="name" placeholder="Full Legal Name" required>
				<select name="gender" required>
					<option>Select Gender</option>
					<option value="male">Male</option>
					<option value="female">Female</option>
				</select>


				<div class="birth-day">
					
					<select name="year" required>
						<option value="">Year</option>
						<?php 
						$year = date("Y");
						$start = $year - 40;
						for($i=$start;$i<=$year;$i++){ ?>
							<option value="<?php echo $i;?>"><?php echo $i;?></option>
						
						<?php } ?>
					</select>
					
					<select name="month" id="month-selection" required>
						<option value="">Month</option>
					</select>
					
					<select name="day" id="day-selection" required>
						<option value="">Day</option>
					</select>

				</div>

				<select name="citizenship" required>
					<option>Choose Citizenship</option>
					<?php 
					$countries = admin\country_list();
					foreach ($countries as $country) {
						echo "<option value = \"" . $country . "\" > $country </option>";
					}?>
				</select>

				<select name="blood-group" required>
					<option>Blood Group</option>
					<?php 
					$blood_group_list = array("A+","A-","B+","B-","AB+","AB-","O+","O-");
					foreach ($blood_group_list as $blood_type) {
						echo "<option value = \"" . $blood_type . "\" > $blood_type </option>";
					}?>
				</select>

				<select name="marital-status">
					<option>Marital Status</option>
					<option value="single">Single</option>
					<option value="married">Married</option>
				</select>

				<select name="religion" required>
					<option>Religion</option>
					<?php 
					$religions = array("Muslim","Hindu","Christian","Buddha","Other");
					foreach ($religions as $religion) {
						echo "<option value = \"" . $religion . "\" > $religion </option>";
					}?>
				</select>

				<input type="file" name="dp" required>


			</section>

		</div> <!-- /left -->




		




		<div class="right">
			
			<section class="labels">
				<label>Cell Number</label>
				<label>E-mail Address</label>
				<label>National Identification</label>
				<label>Mailing Address *</label>
				<br><br><br><br>
				<label>Permanent Address *</label>
			</section>




			<section>
				<input type="text" name="cell" placeholder="Cell Phone Number">
				<input type="email" name="email" placeholder="Valid E-mail Address">
				<input type="text" name="nid" placeholder="National ID (if available)">
				<textarea name="present-address" placeholder="Mailing Address" required></textarea>
				<textarea name="permanent-address" placeholder="Permanent Address" required></textarea>
			</section>


		</div> <!-- /right -->




	</div> <!--/personal-info -->



















	<div class="academic-info manage-students-columns">

		<h2>Academic Information</h2>
		
		<div class="left">
			
			<section class="labels">
				<label>ID *</label>
				<label>CGPA</label>
				<label>Degree *</label>
				<label>Faculty *</label>
				<label>Department *</label>
				<label>Program *</label>
			</section>


			<section>

				<input type="text" name="id" placeholder="NSU ID (MUST BE UNIQUE)" required>
				<input type="text" name="cgpa" value="0.00" required>

				<select name="degree" id="degree-selection" required>
					<option>Select Degree</option>
					<?php 
					$degrees = admin\get_distinct_rows('subjects','degree');
					foreach ($degrees as $degree) {
						echo "<option value = \"" . $degree->degree . "\"> $degree->degree </option>";
					}
					?>
				</select>

				<select name="faculty" id="faculty-selection" required>
					<option>Select Faculty</option>
					<?php 
					$faculties = admin\get_distinct_rows('subjects','faculty');
					foreach ($faculties as $faculty) {
						echo "<option value = \"" . $faculty->faculty . "\"> $faculty->faculty </option>";
					}
					?>
				</select>

				<select name="department" id="department-selection" required>
					<option>Select Department</option>
					<?php 
					$departments = admin\get_distinct_rows('subjects','department');
					foreach ($departments as $department) {
						echo "<option value = \"" . $department->department . "\"> $department->department </option>";
					}
					?>
				</select>

				<select name="program" id="program-selection" required>
					<option>Select Program</option>
					<?php 
					$programs = admin\get_distinct_rows('subjects','program');
					foreach ($programs as $program) {
						echo "<option value = \"" . $program->program . "\"> $program->program </option>";
					}
					?>
				</select>
			</section>

		</div>




		<div class="right">
			
			<section class="labels">
				
				<label>Test Pass# *</label>
				<label>Credit Required *</label>
				<label>Credit Completed</label>
				<label>Admitted Year</label>
				<label>Admitted Semester</label>

			</section>


			<section>
				<input type="text" name="test-pass" placeholder="Test Pass Number" required>
				<input type="text" name="credit-required" placeholder="Total Credit Needed" required>
				<input type="text" name="credit-completed" placeholder="Total Credit Completed">	
				<input type="text" name="admitted-year" placeholder="Admission Year">	
				<select name="admitted-semester">
					<option>Choose Semester</option>
					<option value="Spring">Spring</option>
					<option value="Summer">Summer</option>
					<option value="Fall">Fall</option>
				</select>
			</section>
			
		</div>
		

	</div> <!--/academic-info -->



















	<div class="parental-info">
		
		<h2>Parental Information</h2>

		<section>
			<label>Father Name *</label>
			<label>Mother Name *</label>
			<label>Guardian Name *</label>
			<label>Guardian Phone *</label>
		</section>




		<section>
			<input type="text" name="father-name" placeholder="Full Name" required>
			<input type="text" name="mother-name" placeholder="Full Name" required>
			<input type="text" name="guardian-name" placeholder="Guardian's Name" required>
			<input type="text" name="guardian-phone" placeholder="Guardian's Phone Number" required>
		</section>

	</div> <!-- /parental-info -->



















	<div class="documents manage-students-columns">

		<h2>Documents</h2>
		
		<div class="left">
			
			<section class="labels">
				<label>SSC/O Level Certificate</label>
				<label>HSC/A Level Certificate</label>
				<label>SSC/O Level Marksheet</label>
				<label>HSC/A Level Marksheet</label>
			</section>


			<section>
				<input type="file" name="ssc-cert">
				<input type="file" name="hsc-cert">
				<input type="file" name="ssc-mark">
				<input type="file" name="hsc-mark">
			</section>

		</div>




		<div class="right">
			
			<section class="labels">
				
				<label>ID Card Issued?</label>
				<label>Graduation Certificate Issued?</label>
				<br><br>
				<p class="text-primary">All Done? Submit The Form</p>

			</section>


			<section>
				<select name="id_issued">
					<option value="No">No</option>
					<option value="Yes">Yes</option>
				</select>

				<select name="grad_cert_issued">
					<option value="No">No</option>
					<option value="Yes">Yes</option>
				</select>

				<br><br>
				<button type="submit" name="add-new-student" class="btn btn-primary btn-sm">Submit</button>
			</section>
			
		</div>
		

	</div> <!--/documents -->



</form>



















<script> 

(function(){

	// MONTH
	var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
	for(var i=0; i<months.length; i++){ 
		$("#month-selection").append("<option value = " + months[i] + ">" + months[i] + "</option>");
		console.log(months[i]);
	}

	


	// DAY
	var months31 = ['Jan','Mar','May','Jul','Aug','Oct','Dec'];
	$('#month-selection').on('change',function(){
		var current_month = $("#month-selection").val();
		$('#day-selection').empty();
		if(current_month === "Feb"){
			for(var i=1;i<=28;i++){
				$('#day-selection').append("<option value = " + i + ">" + i + "</option>");
			}
		}

		else{
			if($.inArray(current_month,months31) !== -1){
				for(var i=1;i<=31;i++){
					$('#day-selection').append("<option value = " + i + ">" + i + "</option>");
				}
			}

			else{
				for(var i=1;i<=30;i++){
					$('#day-selection').append("<option value = " + i + ">" + i + "</option>");
				}
			}
		}

	});




	// AJAX REQUESTS
	// $('#degree-selection').on('change',function(){
	// 	var val = $(this).val();
	// 	var element = $('#faculty-selection');
	// 	$.ajax({
	// 		url : '../requires/ajax.php',
	// 		data : {degree : val, fetch : 'faculty'},
	// 		success : function(context){
	// 			var options = context.split("#");
	// 			element.empty();
	// 			element.append("<option>Select Faculty</option>");
	// 			for(var i=0; i<options.length-1; i++){
	// 				element.append("<option value = \"" + options[i] + "\">" + options[i] + "</options>");
	// 			}
	// 		}
	// 	})
	// });




	// $('#faculty-selection').on('change',function(){
	// 	var val = $(this).val();
	// 	var element = $('#department-selection');
	// 	$.ajax({
	// 		url : '../requires/ajax.php',
	// 		data : {faculty : val, fetch : 'department'},
	// 		success : function(context){
	// 			var options = context.split("#");
	// 			element.empty();
	// 			element.append("<option>Select Department</option>");
	// 			for(var i=0; i<options.length-1; i++){
	// 				element.append("<option value = \"" + options[i] + "\">" + options[i] + "</options>");
	// 			}
	// 		}
	// 	})
	// });




	// $('#department-selection').on('change',function(){
	// 	var val = $(this).val();
	// 	var element = $('#program-selection');
	// 	$.ajax({
	// 		url : '../requires/ajax.php',
	// 		data : {department : val, fetch : 'program'},
	// 		success : function(data){
	// 			var options = context.split("#");
	// 			element.empty();
	// 			element.append("<option>Select Program</option>");
	// 			for(var i=0; i<options.length-1; i++){
	// 				element.append("<option value = \"" + options[i] + "\">" + options[i] + "</options>");
	// 			}
	// 		}
	// 	})
	// });


})();

</script>



<?php include_once ('../partials/admin-footer.php');?>