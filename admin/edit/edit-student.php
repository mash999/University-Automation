
<?php 

include_once ('../partials/admin-header.php');
use Automation\admin;

if(isset($_GET['id'])){
	$id = htmlspecialchars($_GET['id']);
	$rows = admin\get_row('studentprofile','id',$id);
	if($rows[0]){
		$row = $rows[0];	
	}
	else{
		header("Location:../views/student-list.php");
	}
	$docs = admin\get_row('documents','id',$id);
	$doc = $docs[0];
}
else{
	header("Location:../views/student-list.php");
}

?>









<form class="manage-students" method="post" action="../requires/edit-functions.php" enctype="multipart/form-data" >

	<div class="personal-info manage-students-columns">
		
		<h2>Personal Information</h2>
	
		<div class="left">

			<section class="labels">

				<label>Full Name</label>
				<label>Gender</label>
				<label>Date of Birth</label>
				<label>Citizenship</label>
				<label>Blood Group</label>
				<label>Marital Status</label>
				<label>Religion</label>
				<label>
					<br>
					Edit Image
					<input type="file" name="dp">
					<input type="hidden" name="image" value="<?php echo $row->picture;?>">
				</label>

			</section>




			<section>
				
				<input type="text" name="name" value="<?php echo $row->name;?>" required>
				<select name="gender" required>
					<option value="<?php echo $row->gender;?>"><?php echo $row->gender;?></option>
					<option value="male">Male</option>
					<option value="female">Female</option>
				</select>


				<div class="birth-day">
					
					<?php $date = explode('-',$row->date_of_birth);?>
					<select name="year" required>
						<option value="<?php echo $date[2];?>"><?php echo $date[2];?></option>
						<?php 
						$year = date("Y");
						$start = $year - 40;
						for($i=$start;$i<=$year;$i++){ ?>
							<option value="<?php echo $i;?>"><?php echo $i;?></option>
						
						<?php } ?>
					</select>
					
					<select name="month" id="month-selection" required>
						<option value="<?php echo $date[1];?>"><?php echo $date[1];?></option>
					</select>
					
					<select name="day" id="day-selection" required>
						<option value="<?php echo $date[0];?>"><?php echo $date[0];?></option>
					</select>

				</div>

				<select name="citizenship" required>
					<option value="<?php echo $row->citizenship;?>"><?php echo $row->citizenship;?></option>
					<?php 
					$countries = admin\country_list();
					foreach ($countries as $country) {
						echo "<option value = \"" . $country . "\" > $country </option>";
					}?>
				</select>

				<select name="blood-group" required>
					<option value="<?php echo $row->blood_group;?>"><?php echo $row->blood_group;?></option>
					<?php 
					$blood_group_list = array("A+","A-","B+","B-","AB+","AB-","O+","O-");
					foreach ($blood_group_list as $blood_type) {
						echo "<option value = \"" . $blood_type . "\" > $blood_type </option>";
					}?>
				</select>

				<select name="marital-status">
					<option value="<?php echo $row->marital_status;?>"> <?php echo $row->marital_status;?></option>
					<option value="single">Single</option>
					<option value="married">Married</option>
				</select>

				<select name="religion" required>
					<option value="<?php echo $row->religion;?>"> <?php echo $row->religion;?></option>
					<?php 
					$religions = array("Muslim","Hindu","Christian","Buddha","Other");
					foreach ($religions as $religion) {
						echo "<option value = \"" . $religion . "\" > $religion </option>";
					}?>
				</select>

				<img src="<?php echo $row->picture;?>" alt="Thumbnail">


			</section>

		</div> <!-- /left -->




		




		<div class="right">
			
			<section class="labels">
				<label>Cell Number</label>
				<label>E-mail Address</label>
				<label>National Identification</label>
				<label>Mailing Address</label>
				<br><br><br><br>
				<label>Permanent Address</label>
			</section>




			<section>
				<input type="text" name="cell"  value="<?php echo $row->phone;?>">
				<input type="email" name="email" value="<?php echo $row->mail;?>">
				<input type="text" name="nid" value="<?php echo $row->national_id_number;?>">
				<textarea name="present-address" required><?php echo $row->present_address;?></textarea>
				<textarea name="permanent-address" required><?php echo $row->permanent_address;?></textarea>
			</section>


		</div> <!-- /right -->




	</div> <!--/personal-info -->



















	<div class="academic-info manage-students-columns">

		<h2>Academic Information</h2>
		
		<div class="left">
			
			<section class="labels">
				<label>ID</label>
				<label>CGPA</label>
				<label>Degree</label>
				<label>Faculty</label>
				<label>Department</label>
				<label>Program</label>
			</section>


			<section>

				<input type="hidden" name="key-id" value="<?php echo $row->id;?>">
				<input type="text" name="id" value="<?php echo $row->id;?>" required>
				<input type="text" name="cgpa" value="<?php echo $row->cgpa;?>" required>

				<select name="degree" id="degree-selection" required>
					<option value="<?php echo $row->degree;?>"><?php echo $row->degree;?></option>
					<?php 
					$degrees = admin\get_distinct_rows('subjects','degree');
					foreach ($degrees as $degree) {
						echo "<option value = \"" . $degree->degree . "\"> $degree->degree </option>";
					}
					?>
				</select>

				<select name="faculty" id="faculty-selection" required>
					<option value="<?php echo $row->faculty;?>"><?php echo $row->faculty;?></option>
					<?php 
					$faculties = admin\get_distinct_rows('subjects','faculty');
					foreach ($faculties as $faculty) {
						echo "<option value = \"" . $faculty->faculty . "\"> $faculty->faculty </option>";
					}
					?>
				</select>

				<select name="department" id="department-selection" required>
					<option value="<?php echo $row->department;?>"><?php echo $row->department;?></option>
					<?php 
					$departments = admin\get_distinct_rows('subjects','department');
					foreach ($departments as $department) {
						echo "<option value = \"" . $department->department . "\"> $department->department </option>";
					}
					?>
				</select>

				<select name="program" id="program-selection" required>
					<option value="<?php echo $row->program;?>"><?php echo $row->program;?></option>
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
				
				<label>Test Pass#</label>
				<label>Credit Required</label>
				<label>Credit Completed</label>
				<label>Admitted Year</label>
				<label>Admitted Semester</label>

			</section>


			<section>
				<input type="text" name="test-pass" value="<?php echo $row->test_pass;?>" required>
				<input type="text" name="credit-required"  value="<?php echo $row->total_credit_required;?>" required>
				<input type="text" name="credit-completed" value="<?php echo $row->total_credit_completed;?>">	
				<input type="text" name="admitted-year"  value="<?php echo $row->admitted_year;?>">	
				<select name="admitted-semester">
					<option value="<?php echo $row->admitted_semester;?>"><?php echo $row->admitted_semester;?></option>
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
			<label>Father Name</label>
			<label>Mother Name</label>
			<label>Guardian Name</label>
			<label>Guardian Phone</label>
		</section>




		<section>
			<input type="text" name="father-name"  value="<?php echo $row->father_name;?>" required>
			<input type="text" name="mother-name"  value="<?php echo $row->mother_name;?>" required>
			<input type="text" name="guardian-name"  value="<?php echo $row->guardian_name;?>" required>
			<input type="text" name="guardian-phone"  value="<?php echo $row->guardian_phone;?>" required>
		</section>

	</div> <!-- /parental-info -->



















	<div class="documents manage-students-columns">

		<h2>Documents</h2>
		
		<div class="left">
			
			<section class="labels">
				<label>SSC/O Level Certificate</label>
				<label>SSC/O Level Marksheet</label>
			</section>


			<section>
				<input type="file" name="ssc-cert">
				<input type="file" name="ssc-mark">
				<input type="hidden" name="old-ssc-cert" value="<?php echo $doc->ssc_cert;?>">
				<input type="hidden" name="old-ssc-mark" value="<?php echo $doc->ssc_mark;?>">
			</section>

		</div>




		<div class="right">
			
			<section class="labels">
				
				<label>HSC/A Level Certificate</label>
				<label>HSC/A Level Marksheet</label>
				<br><br>
				<p class="text-primary">All Done? Submit The Form</p>

			</section>


			<section>
				
				<input type="file" name="hsc-cert">
				<input type="file" name="hsc-mark">
				<input type="hidden" name="old-hsc-cert" value="<?php echo $doc->hsc_cert;?>">
				<input type="hidden" name="old-hsc-mark" value="<?php echo $doc->hsc_mark;?>">

				<br><br>
				<button type="submit" name="edit-student-info" class="btn btn-primary btn-sm">Submit</button>
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


})();

</script>



<?php include_once ('../partials/admin-footer.php');?>