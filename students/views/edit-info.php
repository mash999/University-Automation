
<?php 
	require_once '../requires/functions.php';
	include_once '../partials/students-header.php';
	include_once '../partials/students-sidebar.php';
	
	use Automation\students;
	//$id = $_SESSION['User_id'];
	$row = students\get_row("studentprofile",'id',$id);


?>
	

	<form action="../requires/edit-functions.php" method="POST">

		<div id="personal-information" class="information">	
			<h2>Edit Informations</h2>
			<p class="text-danger bg-danger">
				It is expected that you will provide all the information
				truthfully. Any kind of fraud or providing fake information
				can and will lead to disciplinary action and in extreme
				case, expulsion from the university. 

			</p>	

			<table class="table table-left">	
				<tr>
					<td>Full Name</td>
					<td>:</td>
					<td><input type="text" name="name" value="<?php echo $row->name;?>"></td>
				</tr>
				<tr>
					<?php 
					$date_split = explode("-", $row->date_of_birth);?>
					<td>Date of Birth</td>
					<td>:</td>
					<td id="dob-select">
						<select id="month-selection" name="month">
							<option value="<?php echo $date_split[1];?>"><?php echo $date_split[1];?></option>
							<option value="Jan">Jan</option>
							<option value="Feb">Feb</option>
							<option value="Mar">Mar</option>
							<option value="Apr">Apr</option>
							<option value="May">May</option>
							<option value="Jun">Jun</option>
							<option value="Jul">Jul</option>
							<option value="Aug">Aug</option>
							<option value="Sep">Sep</option>
							<option value="Oct">Oct</option>
							<option value="Nov">Nov</option>
							<option value="Dec">Dec</option>
						</select>
						<select name="day" id="date-selection">
							<option value="<?php echo $date_split[0];?>"><?php echo $date_split[0];?></option>
							<script>
								var days31 = ["Jan","Mar","May","Jul","Aug","Oct","Dec"];
								var days30 = ["Apr","Jun","Sep","Nov"];
								var days;
								$("#month-selection").on('change',function(){
									var data = $(this).val();
									if(data=="Feb"){
										days = 29;
									}
									if($.inArray(data,days31)>=0){
										days = 31;
									}
									if($.inArray(data,days30)>=0){
										days = 30;
									}

									$("#date-selection").empty();
									for(var i = 1; i<=days; i++)
										$("#date-selection").append("<option value=" + i + ">" + i + "</option>");
								});
							</script>
						</select>
						<select name="year" id="year-selection">
							<option value="<?php echo $date_split[2];?>"><?php echo $date_split[2];?></option>
							<script>
								var curr_date = new Date();
								for(var i = 1980; i<=curr_date.getFullYear(); i++)
									$("#year-selection").append("<option value=" + i + ">" + i + "</option>");
							</script>
						</select>
					</td>
				</tr>	
				<tr>
					<td>Citizenship</td>
					<td>:</td>
					<td>
						<?php $countries = students\country_list();?>
						<select name="citizenship">
							<option value="<?php echo $row->citizenship;?>"><?php echo $row->citizenship;?></option>
							<?php 
							foreach ($countries as $country) {
								echo "<option value = $country>".$country."</option>";
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Phone</td>
					<td>:</td>
					<td><input type="text" name="phone" value="<?php echo $row->phone;?>"></td>
				</tr>
				<tr>
					<td>Religion</td>
					<td>:</td>
					<td>
						<select type="text" name="religion"">
							<option value="<?php echo $row->religion;?>"><?php echo $row->religion;?></option>
							<option value="Islam">Islam</option>
							<option value="Hindu">Hindu</option>
							<option value="Buddha">Buddha</option>
							<option value="Christian">Christian</option>
							<option value="Other">Other</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Mailing Address</td>
					<td>:</td>
					<td><textarea name="mailing-address"><?php echo $row->present_address;?></textarea></td>
				</tr>
			</table>

			<table class="table table-right">
				<tr>
					<td>Gender</td>
					<td>:</td>
					<td>
						<select name="gender">
							<option value="<?php echo $row->gender;?>"><?php echo $row->gender;?></option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Blood Group</td>
					<td>:</td>
					<td>
						<select name="blood-group">
							<option value="<?php echo $row->blood_group;?>"><?php echo $row->blood_group;?></option>
							<option value="A+">A+</option>
							<option value="A-">A-</option>
							<option value="B+">B+</option>
							<option value="B-">B-</option>
							<option value="AB+">AB+</option>
							<option value="AB-">AB-</option>
							<option value="O+">O+</option>
							<option value="O-">O-</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Marital Status</td>
					<td>:</td>
					<td>
						<select name="marital">
							<option value="<?php echo $row->marital_status;?>"><?php echo $row->marital_status;?></option>
							<option value="Single">Single</option>
							<option value="Married">Married</option>
							<option value="Seprated">Seprated</option>
							<option value="Widowed">Widowed</option>
							<option value="Divorced">Divorced</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>NID</td>
					<td>:</td>
					<td><input type="text" name="nid" value="<?php echo $row->national_id_number;?>"></td>
				</tr>
				<tr>
					<td>E-mail</td>
					<td>:</td>
					<td><input type="text" name="email" value="<?php echo $row->mail;?>"></td>
				</tr>
				<tr>
					<td>Permanent Address</td>
					<td>:</td>
					<td><textarea name="permanent-address"><?php echo $row->permanent_address;?></textarea></td>
				</tr>
			</table>

		</div> <!-- /information -->


		<div id="parental-information" class="information">	

			<h2>Parental Information</h2>
			<br><br>
			<table class="table">	
				<tr>
					<td>Father Name</td>
					<td>:</td>
					<td><input type="text" name="father-name" value="<?php echo $row->father_name;?>"></td>
				</tr>
				<tr>
					<td>Mother Name</td>
					<td>:</td>
					<td><input type="text" name="mother-name" value="<?php echo $row->mother_name;?>"></td>
				</tr>
				<tr>
					<td>Guardian Name</td>
					<td>:</td>
					<td><input type="text" name="guardian-name" value="<?php echo $row->guardian_name;?>"></td>
				</tr>
				<tr>
					<td>Phone</td>
					<td>:</td>
					<td><input type="text" name="guardian-phone" value="<?php echo $row->guardian_phone;?>"></td>
				</tr>
				<tr>
					<td>Parent's Address</td>
					<td>:</td>
					<td><textarea name="parent-address"><?php echo $row->present_address;?></textarea></td>
				</tr>
			</table>

			<input type="submit" name="submit-info" class="btn btn-primary" value="submit">

		</div> <!-- /information -->

	</form>


