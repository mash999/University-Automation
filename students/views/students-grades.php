
<?php include_once '../partials/students-header.php';?>
<?php include_once '../partials/students-sidebar.php';?>

	
	<div class="bordered-grades">
		
		<div class="grades">
			
			<h2>Semesters</h2>
			<ul class="nav nav-pills nav-stacked">
				<li class="active"><a data-toggle="pill" href="#menu1">Summer 2017</a></li>
				<li><a data-toggle="pill" href="#menu2">Spring 2017</a></li>
				<li><a data-toggle="pill" href="#menu3">Fall 2016</a></li>
				<li><a data-toggle="pill" href="#menu4">Spring 2016</a></li>
				<li><a data-toggle="pill" href="#menu5">Fall 2015</a></li>
				<li><a data-toggle="pill" href="#menu6">Summer 2016</a></li>
				<li><a data-toggle="pill" href="#menu7">Spring 2015</a></li>
			</ul>



			<div class="tab-content">
				
				<h2 align="center"><i class="fa fa-university" aria-hidden="true"></i> Grade Reports</h2>
				
				<div id="menu1" class="tab-pane fade in active">
					<h3>Summer 2017</h3>
					<table class="table table-striped table-bordered table-responsive">
						<thead>
							<tr>
								<th>Course Code</th>
								<th>Course Credit</th>
								<th>Course Title</th>
								<th>Course Grade</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>BIO103</td>
								<td>3.00</td>
								<td>Biology I</td>
								<td>A</td>
							</tr>
							<tr>
								<td>CSE326</td>
								<td>3.00</td>
								<td>Compiler Construction</td>
								<td>A-</td>
							</tr>
							<tr>
								<td>CSE435</td>
								<td>3.00</td>
								<td>Introduction to VLSI Design</td>
								<td>A</td>
							</tr>
							<tr>
								<td>CSE470</td>
								<td>3.00</td>
								<td>Theory of Fuzzy Systems</td>
								<td>A-</td>
							</tr>
							<tr>
								<td>CSE499A</td>
								<td>3.00</td>
								<td>Senior Design Project I</td>
								<td>A</td>
							</tr>
						</tbody>
					</table>
				</div>

				<div id="menu2" class="tab-pane fade in">
					<h3>Spring 2017</h3>
					<table class="table table-striped table-bordered table-responsive">
						<thead>
							<tr>
								<th>Course Code</th>
								<th>Course Credit</th>
								<th>Course Title</th>
								<th>Course Grade</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>CSE331</td>
								<td>3.00</td>
								<td>Microprocessor Interfacing &amp; Embedded System</td>
								<td>B+</td>
							</tr>
							<tr>
								<td>CSE418</td>
								<td>3.00</td>
								<td>Computer Graphics</td>
								<td>W</td>
							</tr>
							<tr>
								<td>CSE419</td>
								<td>3.00</td>
								<td>Data Mining</td>
								<td>C</td>
							</tr>
						</tbody>
					</table>
				</div>




				<div id="menu3" class="tab-pane fade in">
					<h3>Spring 2017</h3>
					<table class="table table-striped table-bordered table-responsive">
						<thead>
							<tr>
								<th>Course Code</th>
								<th>Course Credit</th>
								<th>Course Title</th>
								<th>Course Grade</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>CSE327</td>
								<td>3.00</td>
								<td>Software Engineering</td>
								<td>A</td>
							</tr>
							<tr>
								<td>CSE338</td>
								<td>3.00</td>
								<td>Computer Networks</td>
								<td>A-</td>
							</tr>
							<tr>
								<td>CSE467</td>
								<td>3.00</td>
								<td>Image Processing</td>
								<td>B</td>
							</tr>
							<tr>
								<td>EEE311</td>
								<td>3.00</td>
								<td>Analog Electronics II</td>
								<td>A</td>
							</tr>
							<tr>
								<td>EEE311L</td>
								<td>1.00</td>
								<td>Analog Electronics II Lab</td>
								<td>C+</td>
							</tr>
						</tbody>
					</table>
				</div>


				<div class="grade-calc">
					
					<p>Credit Completed : <strong>130.5</strong></p>
					<p>Total Grade Points : <strong>443.5</strong></p>
					<p>CGPA : <strong>3.49</strong></p>
					<p>Waived Courses : <strong>ENG102</strong></p>
					<p style="clear: both;">
						Major : Bachelor in Computer Science &amp; Engineering <br>
						Department of Electrical Electronics &amp; Computer Science
					</p>

				</div> <!-- /grade-calc -->


			</div> <!-- /tab-content -->

		</div> <!--/ grades -->

	</div> <!-- /bordered-grades -->


<?php include_once '../partials/students-footer.php';?>