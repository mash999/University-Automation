
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









<div class="student-profile">
	
	<section class="left">
		
		<div class="dp">
		
			<div class="dp-img">
				<img src="<?php echo $row->picture;?>" alt="Thumbnail">
				<a href="" class="edit-dp">Edit</a>
			</div>
		


			<div class="info-1">
				<h2>Academic Information</h2>
				<table>

					<tr>
						<td>NSU ID</td>
						<td>: &nbsp;&nbsp;<?php echo $row->id;?></td>
					</tr>
					
					<tr>
						<td>Entry Item</td>
						<td>: &nbsp;&nbsp;<?php echo $row->admitted_semester. ' '. $row->admitted_year;?></td>
					</tr>
					
					<tr>
						<td>Test Pass#</td>
						<td>: &nbsp;&nbsp;<?php echo $row->test_pass;?></td>
					</tr>
					
					<tr>
						<td>Credit Passed</td>
						<td><span><?php echo $row->total_credit_completed;?></span></td>
					</tr>
				
				</table>

			</div> <!-- /info-1 -->
			<hr>

			


			<p><?php echo $row->program;?></p>
			<p><?php echo $row->department;?>	</p>


		</div> <!-- /dp -->

	</section>



















	<section class="right">
		
		<h2><?php echo $row->name;?></h2>
		<h5>Student</h5>
		<div class="little-info">
			<span>Highlighted Point -></span>
			<p>CGPA : <?php echo $row->cgpa;?></p>
		</div>
		<hr>


		<br><br>
		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#menu1"><i class="fa fa-address-book-o" aria-hidden="true"></i> &nbsp;Personal Information</a></li>
			<li><a data-toggle="tab" href="#menu2"><i class="fa fa-users" aria-hidden="true"></i> &nbsp;Parent Information</a></li>
			<li><a data-toggle="tab" href="#menu3"><i class="fa fa-paperclip" aria-hidden="true"></i> &nbsp;Documents</a></li>
		</ul>




		<div class="tab-content">
			
			<div id="menu1" class="tab-pane fade in active">
				<h2>
					Personal Information 
					<a href="../edit/edit-student.php?id=<?php echo $row->id;?>" class="student-info-edit" data-edit="personal"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
				</h2>	
				

				<table class="left-table">
					<tr>
						<th>Full Name</th>
						<td>:</td>
						<td><?php echo $row->name;?></td>
					</tr>
					
					<tr>
						<th>Date of Birth</th>
						<td>:</td>
						<td><?php echo $row->date_of_birth;?></td>
					</tr>
					
					<tr>
						<th>Gender</th>
						<td>:</td>
						<td><?php echo $row->gender;?></td>
					</tr>
					
					<tr>
						<th>Citizenship</th>
						<td>:</td>
						<td><?php echo $row->citizenship;?></td>
					</tr>
					
					<tr>
						<th>Blood Group</th>
						<td>:</td>
						<td><?php echo $row->blood_group;?></td>
					</tr>
					
					<tr>
						<th>Marital Status</th>
						<td>:</td>
						<td><?php echo $row->marital_status;?></td>
					</tr>
					
					<tr>
						<th>Religion</th>
						<td>:</td>
						<td><?php echo $row->religion;?></td>
					</tr>

				</table>




				<table class="right-table">
					<tr>
						<th>Cell</th>
						<td>:</td>
						<td><?php echo $row->phone;?></td>
					</tr>
					
					<tr>
						<th>E-mail</th>
						<td>:</td>
						<td><?php echo $row->mail;?></td>
					</tr>
					
					<tr>
						<th>NID</th>
						<td>:</td>
						<td><?php echo $row->national_id_number;?></td>
					</tr>
					
					<tr>
						<th>Mailing Address</th>
						<td>:</td>
						<td><br><?php echo $row->present_address;?></td>
					</tr>
					
					<tr>
						<th>Permanent Address</th>
						<td>:</td>
						<td><br><?php echo $row->permanent_address;?></td>
					</tr>
				
				</table>

			</div>







			

			<div id="menu2" class="tab-pane fade">

				<h2>
					Guardian Information
					<a href="../edit/edit-student.php?id=<?php echo $row->id;?>" class="student-info-edit" data-edit="parental"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
				</h2>

				<table>

					<tr>
						<th>Father Name</th>
						<td>:</td>
						<td><?php echo $row->father_name;?></td>
					</tr>
					
					<tr>
						<th>Mother Name</th>
						<td>:</td>
						<td><?php echo $row->mother_name;?></td>
					</tr>
					
					<tr>
						<th>Guardian Name</th>
						<td>:</td>
						<td><?php echo $row->guardian_name;?></td>
					</tr>

					<tr>
						<th>Parent Address</th>
						<td>:</td>
						<td><?php echo $row->present_address;?></td>
					</tr>
					
					<tr>
						<th>Phone</th>
						<td>:</td>
						<td><?php echo $row->guardian_phone;?></td>
					</tr>

				</table>
				
			</div>









			<div id="menu3" class="tab-pane fade">

				<h2>Document Information</h2>

				<table class="left-table">
					<tr>
						<th>SSC/O'Level Certificate</th>
						<td>:</td>
						<?php if(empty($doc->ssc_cert)) { ?>
						<td>Not Submitted</td>
						<?php } else { ?>
						<td><a target = "_blank" href="<?php echo $doc->ssc_cert;?>">Submitted</a>
						<?php } ?>
					</tr>
					<tr>
						<th>HSC/A'Level Certificate</th>
						<td>:</td>
						<?php if(empty($doc->hsc_cert)) { ?>
						<td>Not Submitted</td>
						<?php } else { ?>
						<td><a target = "_blank" href="<?php echo $doc->ssc_cert;?>">Submitted</a>
						<?php } ?>
					</tr>
					<tr>
						<th>SSC/O'Level Mark Sheet</th>
						<td>:</td>
						<?php if(empty($doc->ssc_mark)) { ?>
						<td>Not Submitted</td>
						<?php } else { ?>
						<td><a target = "_blank" href="<?php echo $doc->ssc_cert;?>">Submitted</a>
						<?php } ?>
					</tr>
					
					<tr>
						<th>HSC/A Level Mark Sheet</th>
						<td>:</td>
						<?php if(empty($doc->hsc_mark)) { ?>
						<td>Not Submitted</td>
						<?php } else { ?>
						<td><a target = "_blank" href="<?php echo $doc->ssc_cert;?>">Submitted</a>
						<?php } ?>
					</tr>
				</table>

			
			</div>

		</div> <!-- /tab-content -->

	</section>


</div> <!-- /student-profile -->





<?php include_once ('../partials/admin-footer.php');?>