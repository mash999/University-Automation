
<?php 

	include '../partials/admin-header.php';
	use Automation\admin;

	if(isset($_GET['id'])){
		
		$rows = admin\get_row('teachersprofile','id',htmlspecialchars($_GET['id']));
		
		if($rows){
			$row = $rows[0];
		}	
		else{	
			header("Location:teacher-list.php");
		}
	}

	else{
		header("Location:teacher-list.php");
	}

?>

<script src ="../../tinymce/js/tinymce/tinymce.min.js"></script>
<script src ="../../tinymce/js/tinymce/init.tinymce.js"></script>



<div class="teacher-profile">
	
	<aside>
		
		<div class="teacher-image">

			<?php if(empty($row->image)) {?>
			
				<a href="../../images/insert.png" target="blank"><img src="../../images/insert.png" alt="Thumbnail"></a>
			
			<?php } else{ ?>
			
				<a href="<?php echo $row->image;?>" target="blank"><img src="<?php echo $row->image;?>" alt="Thumbnail"></a>
			
			<?php } ?>
			
			<a class="open-edit-modal edit-teacher-button" href="#edit-teacher-modal" data-part="edit-teacher-image">Edit</a>
		
		</div>

		<h3>
			Contact Information &nbsp;
			<a class="open-edit-modal" href="#edit-teacher-modal" data-part="edit-teacher-contact"><i class="fa fa-pencil"></i></a>
		</h3>

		
		<section>
			<label>Phone:</label>
			<p><?php echo htmlspecialchars_decode($row->phone,ENT_NOQUOTES);?></p>
		</section>




		<section>
			<label>Email:</label>
			<p style="overflow-wrap: break-word;"><?php echo htmlspecialchars_decode($row->email,ENT_NOQUOTES);?></p>
		</section>




		<section>
			<label>Website:</label>
			<p><?php echo htmlspecialchars_decode($row->website,ENT_NOQUOTES);?></p>
		</section>




		<section>
			<label>Office:</label>
			<p><?php echo htmlspecialchars_decode($row->office,ENT_NOQUOTES);?></p>
		</section>




		<section>
			<br><br>
			<h4>Office Hours: &nbsp;
				<a class="open-edit-modal" href="#edit-teacher-modal" data-part="edit-teacher-office-hour"><i class="fa fa-pencil"></i></a>
			</h4>

			<table class="table table-bordered">
				<?php 
					$schedule = explode("{{}}}{", $row->office_hours);
					$days = array();
					$time = array();
					foreach ($schedule as $val) {
						$temp = explode("###", $val);
						array_push($days, $temp[0]);
						array_push($time, $temp[1]);
						$temp = array();
					}
					for($i = 0; $i<sizeof($time); $i++) {
						if(!empty($time[$i])){
							echo "<tr><td>$days[$i]</td><td>$time[$i]</td></tr>";
						}
					}
				?>
			</table>
		</section>









		<section class = "address">
			<br><br>
			<h4>
				Present Address: &nbsp;
				<a class="open-edit-modal" href="#edit-teacher-modal" data-part="edit-teacher-address"><i class="fa fa-pencil"></i></a>
			</h4>
			<p><?php echo $row->present_address;?></p>

			<br><br><br>

			<h4>
				Permanent Address:
			</h4>
			<p><?php echo $row->permanent_address;?></p>
		</section>









		<section class="departmental-info">
			<br><br>
			<p><?php echo $row->faculty;?></p>
			<p><?php echo $row->department;?></p>
			<p>North South University</p>
		</section>

	</aside>



















	<div class="teacher-info-content">
		
		<h1><?php echo $row->name . " (" . strtoupper($row->initial) . ")";?></h1>
		<h2><?php echo $row->designation;?></h2>

		<div class="biography">
		
			<h2>
				Biography &nbsp;
				<a class="open-edit-modal" href="#edit-teacher-modal" data-part="edit-teacher-biography"><i class="fa fa-pencil"></i></a>
			</h2>
			
			<p><?php echo htmlspecialchars_decode($row->biography,ENT_NOQUOTES);?></p>

		</div>









		<div class="education">

			<h2>Education &nbsp;
				<a class="open-edit-modal" href="#edit-teacher-modal" data-part="edit-teacher-education"><i class="fa fa-pencil"></i></a>
			</h2>
			<?php echo htmlspecialchars_decode($row->educational_info,ENT_NOQUOTES);?>

		</div> <!-- /education -->









		<div class="teaching">

			<h2>Teaching &nbsp;
				<a class="open-edit-modal" href="#edit-teacher-modal" data-part="edit-teacher-teaching"><i class="fa fa-pencil"></i></a>
			</h2>

			<?php echo htmlspecialchars_decode($row->teaching,ENT_NOQUOTES);?>

		</div> <!-- /teaching -->









		<div class="research-areas">

			<h2>Research Areas &nbsp;
				<a class="open-edit-modal" href="#edit-teacher-modal" data-part="edit-teacher-research-areas"><i class="fa fa-pencil"></i></a>
			</h2>

			<?php echo htmlspecialchars_decode($row->research_areas,ENT_NOQUOTES);?>

		</div> <!-- /research-areas -->









		<div class="research-interests">

			<h2>Research Interests &nbsp;
				<a class="open-edit-modal" href="#edit-teacher-modal" data-part="edit-teacher-research-interests"><i class="fa fa-pencil"></i></a>
			</h2>

			<?php echo htmlspecialchars_decode($row->research_interests,ENT_NOQUOTES);?>

		</div> <!-- /research-interests -->









		<div class="publications">

			<h2>Publications &nbsp;
				<a class="open-edit-modal" href="#edit-teacher-modal" data-part="edit-teacher-publications"><i class="fa fa-pencil"></i></a>
			</h2>

			<?php echo htmlspecialchars_decode($row->publications,ENT_NOQUOTES);?>

		</div> <!-- /publications -->









		<div class="grants">
			
			<h2>Research Projects &amp; Grants &nbsp;
				<a class="open-edit-modal" href="#edit-teacher-modal" data-part="edit-teacher-grants"><i class="fa fa-pencil"></i></a>
			</h2>

			<?php echo htmlspecialchars_decode($row->grants,ENT_NOQUOTES);?>

		</div> <!-- /grants -->









		<div class="activity">
			
			<h2>Professional Activity &nbsp;
				<a class="open-edit-modal" href="#edit-teacher-modal" data-part="edit-teacher-activity"><i class="fa fa-pencil"></i></a>
			</h2>

			<?php echo htmlspecialchars_decode($row->activity,ENT_NOQUOTES);?>

		</div> <!-- /activity -->





	</div> <!-- /teacher-info-content -->


</div> <!-- /teacher-profile -->





























<!-- TEACHER INFORMATION EDIT MODALS -->

<div id="edit-teacher-modal">
	
	<div id="edit-teacher-overlay"></div>

	<div class="edit-teacher-content">




		<form class="edit-teacher-image hide" action="../requires/edit-functions.php" method="post" enctype="multipart/form-data">
			
			<h2>Update Profile Picture</h2>

			<section>
				<?php if(empty($row->image)) {?>
				<img id="new-img" src="../../images/insert.png" alt="Thumbnail">
				<?php } else{ ?>
				<img id="new-img" src="<?php echo $row->image;?>" alt="Thumbnail">
				<?php } ?>
			
			</section>

			<section>
				<label>Upload Image <span>:</span></label><br><br>
				<input id="img-inp" type="file" name="teacher-image"><br><br>
				<input type="hidden" name="id" value="<?php echo $row->id;?>">
				<input type="hidden" name="image" value="<?php echo $row->image;?>">
				<button type="submit" name="edit-teacher-image" class="btn btn-primary btn-sm">Submit</button>
			</section>


		</form> <!-- /edit-teacher-image -->









		<form class="edit-teacher-contact hide" action="../requires/edit-functions.php" method="post">
			
			<h2>Conact Information</h2>
			<section>
				<label>Phone <span>:</span></label>
				<input type="text" name="phone" value="<?php echo $row->phone;?>">
			</section>
			
			<section>
				<label>Email <span>:</span></label>
				<input type="email" name="email" value="<?php echo $row->email;?>">
			</section>
			
			<section>
				<label>Website <span>:</span></label>
				<input type="text" name="website" value="<?php echo $row->website;?>">
			</section>
			
			<section>
				<label>Office <span>:</span></label>
				<input type="text" name="office" value="<?php echo $row->office;?>">
			</section>

			<section>
				<input type="hidden" name="id" value="<?php echo $row->id;?>">
				<button type="submit" name="edit-teacher-contact" class="btn btn-primary btn-sm pull-right">Submit</button>
			</section>


		</form> <!-- /edit-teacher-contact -->









		<form class="edit-teacher-office-hour hide" action="../requires/edit-functions.php" method="post">
			
			<h2>Office Hours</h2>

			<section>				

				<table class="table">
					<?php 
						$schedule = explode("{{}}}{", $row->office_hours);
						$days = array();
						$time = array();
						foreach ($schedule as $val) {
							$temp = explode("###", $val);
							array_push($days, $temp[0]);
							array_push($time, $temp[1]);
							$temp = array();
						}
						for($i = 0; $i<sizeof($time); $i++) {
							$name_modifier = strtolower($days[$i]);
							echo "<tr>
									<td>$days[$i]</td>
									<td><input type=\"text\" value=\"$time[$i]\" name=\"$name_modifier-time\"></td>
								  </tr>";
						}
					?>

					<tr>
						<td><input type="hidden" name="id" value="<?php echo $row->id;?>"></td>
						<td><button type="submit" name="edit-teacher-office-hours" class="btn btn-primary btn-sm pull-right">Submit</button></td>
					</tr>

				</table>

			</section>


		</form> <!-- /edit-teacher-office-hour -->









		<form class="edit-teacher-address hide" action="../requires/edit-functions.php" method="post">
			
			<h2>Address</h2>

			<section>
				<label>Present Address</label>
				<textarea class="simple-textarea" name="present-address"><?php echo $row->present_address;?></textarea>
				<br><br>
			</section>




			<section>
				<label>Permanent Address</label>
				<textarea class="simple-textarea" name="permanent-address"><?php echo $row->permanent_address;?></textarea>
			</section>




			<section>
				<br>
				<input type="hidden" name="id" value="<?php echo $row->id;?>">
				<button type="submit" name="edit-teacher-address" class="btn btn-primary btn-sm pull-right">Submit</button>
			</section>



		</form> <!-- /edit-teacher-office-hour -->









		<form class="edit-teacher-biography hide" action="../requires/edit-functions.php" method="post">
			
			<h2>Biography</h2>

			<section>
				<input type="text" name="name" value="<?php echo $row->name;?>" placeholder="Full Name"><br><br>
				<input type="text" name="initial" value="<?php echo $row->initial;?>" placeholder="Faculty Initial"><br><br>
				<input type="text" name="designation" value="<?php echo $row->designation;?>" placeholder="Designation"><br><br>

				<textarea class="tinymce" name="biography"><?php echo $row->biography;?></textarea>
				<br><br>

				<input type="hidden" name="id" value="<?php echo $row->id;?>">
				<button type="submit" name="edit-teacher-biography" class="btn btn-primary btn-sm">Submit</button>
				<br><br>
			</section>


		</form> <!-- /edit-teacher-biography -->









		<form class="edit-teacher-education hide" action="../requires/edit-functions.php" method="post">
			
			<h2>Education</h2>

			<section>
				<textarea class="tinymce" name="educational_info"><?php echo $row->educational_info;?></textarea>
				<br><br>

				<input type="hidden" name="id" value="<?php echo $row->id;?>">
				<button type="submit" name="edit-teacher-education" class="btn btn-primary btn-sm">Submit</button>
				<br><br>
			</section>


		</form> <!-- /edit-teacher-education -->









		<form class="edit-teacher-teaching hide" action="../requires/edit-functions.php" method="post">
			
			<h2>Teaching</h2>

			<section>
				<textarea class="tinymce" name="teaching"><?php echo $row->teaching;?></textarea>
				<br><br>

				<input type="hidden" name="id" value="<?php echo $row->id;?>">
				<button type="submit" name="edit-teacher-teaching" class="btn btn-primary btn-sm">Submit</button>
				<br><br>
			</section>


		</form> <!-- /edit-teacher-teaching -->









		<form class="edit-teacher-research-areas hide" action="../requires/edit-functions.php" method="post">
			
			<h2>Research Areas</h2>

			<section>
				<textarea class="tinymce" name="research-areas"><?php echo $row->research_areas;?></textarea>
				<br><br>

				<input type="hidden" name="id" value="<?php echo $row->id;?>">
				<button type="submit" name="edit-teacher-research-areas" class="btn btn-primary btn-sm">Submit</button>
				<br><br>
			</section>


		</form> <!-- /edit-teacher-research-areas -->









		<form class="edit-teacher-research-interests hide" action="../requires/edit-functions.php" method="post">
			
			<h2>Research Interests</h2>

			<section>
				<textarea class="tinymce" name="research-interests"><?php echo $row->research_interests;?></textarea>
				<br><br>

				<input type="hidden" name="id" value="<?php echo $row->id;?>">
				<button type="submit" name="edit-teacher-research-interests" class="btn btn-primary btn-sm">Submit</button>
				<br><br>
			</section>


		</form> <!-- /edit-teacher-research-interests -->









		<form class="edit-teacher-publications hide" action="../requires/edit-functions.php" method="post">
			
			<h2>Publications</h2>

			<section>
				<textarea class="tinymce" name="publications"><?php echo $row->publications;?></textarea>
				<br><br>

				<input type="hidden" name="id" value="<?php echo $row->id;?>">
				<button type="submit" name="edit-teacher-publications" class="btn btn-primary btn-sm">Submit</button>
				<br><br>
			</section>


		</form> <!-- /edit-teacher-publications -->









		<form class="edit-teacher-grants hide" action="../requires/edit-functions.php" method="post">
			
			<h2>Grants</h2>

			<section>
				<textarea class="tinymce" name="grants"><?php echo $row->grants;?></textarea>
				<br><br>

				<input type="hidden" name="id" value="<?php echo $row->id;?>">
				<button type="submit" name="edit-teacher-grants" class="btn btn-primary btn-sm">Submit</button>
				<br><br>
			</section>


		</form> <!-- /edit-teacher-grants -->









		<form class="edit-teacher-activity hide" action="../requires/edit-functions.php" method="post">
			
			<h2>Activity</h2>

			<section>
				<textarea class="tinymce" name="activity"><?php echo $row->activity;?></textarea>
				<br><br>

				<input type="hidden" name="id" value="<?php echo $row->id;?>">
				<button type="submit" name="edit-teacher-activity" class="btn btn-primary btn-sm">Submit</button>
				<br><br>
			</section>


		</form> <!-- /edit-teacher-activity -->



	</div> <!-- /edit-teacher-content -->



</div> <!-- /edit-teacher-modal -->

















<!--  -->

<script>
	
	(function(){

		$('.open-edit-modal').on('click',function(e){
			e.preventDefault();
			var loadDiv = '.' + $(this).data('part');
			$('#edit-teacher-modal').fadeIn();
			$(loadDiv).removeClass('hide').addClass('visible');
		});


		$('#edit-teacher-overlay').on('click',function(){
			var findDiv = $('#edit-teacher-modal');
			$(findDiv).fadeOut();
			findDiv.find('form.visible').addClass('hide').removeClass('visible');
		});


		$("#img-inp").change(function(){
			var input = this;
			if (input.files && input.files[0]){
				var reader = new FileReader();
			    reader.onload = function(e){
			    	$('#new-img').attr('src', e.target.result);
			    }
				reader.readAsDataURL(input.files[0]);
			}
		});

	})();

</script>



<?php include '../partials/admin-footer.php';?>