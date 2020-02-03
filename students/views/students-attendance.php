
<?php include_once '../partials/students-header.php';?>
<?php include_once '../partials/students-sidebar.php';?>

	
	<div class="attendance">

		<h2>Check Attendance</h2>
		
		<div class="tab-content">

			<div id="menu1" class="tab-pane fade in active">
				
				<h3>Class Attendance for Fall 2017</h3>
				<table class="table table-striped table-bordered table-responsive">
					<thead>
						<tr>
							<th>Code</th>
							<th>Section</th>
							<th>Title</th>
							<th>Day</th>
							<th>Start</th>
							<th>End</th>
							<th>Room</th>
							<th>Faculty</th>
							<th>Attendance</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>CEG413</td>
							<td>1</td>
							<td>Digital &amp; Microprocessor Design Laboratory</td>
							<td>A</td>
							<td>11:20 AM</td>
							<td>02:30 PM</td>
							<td>SAC507</td>
							<td>SFM</td>
							<td><a href="#" class="btn btn-sm btn-primary">Check</a></td>
						</tr>
						<tr>
							<td>CSE440</td>
							<td>1</td>
							<td>Artificial Intelligence</td>
							<td>ST</td>
							<td>2:40 PM</td>
							<td>4:10 PM</td>
							<td>SAC309</td>
							<td>MLE</td>
							<td><a href="#" class="btn btn-sm btn-primary">Check</a></td>
						</tr>
						<tr>
							<td>CSE482</td>
							<td>2</td>
							<td>Internet and Web Technology</td>
							<td>ST</td>
							<td>11:20 AM</td>
							<td>12:50 PM</td>
							<td>SAC308</td>
							<td>SZZ</td>
							<td><a href="#" class="btn btn-sm btn-primary">Check</a></td>
						</tr>
						<tr>
							<td>CSE482</td>
							<td>2</td>
							<td>Internet and Web Technology Lab</td>
							<td>T</td>
							<td>8:00 AM</td>
							<td>11:10 PM</td>
							<td>LIB605</td>
							<td>SZZ</td>
							<td><a href="#" class="btn btn-sm btn-primary">Check</a></td>
						</tr>
						<tr>
							<td>CSE499B</td>
							<td>3</td>
							<td>Senior Design Project II</td>
							<td>S</td>
							<td>11:20 AM</td>
							<td>2:30 PM</td>
							<td>SAC503</td>
							<td>KAS</td>
							<td><a href="#" class="btn btn-sm btn-primary">Check</a></td>
						</tr>
					</tbody>
				</table>
				<p class="alert alert-danger" style="text-transform: capitalize;">Note : Consecutive three days miss will put you in red zone.</p>
			</div>


		</div> <!-- /tab-content -->


			
		<ul>
			<li class="active"><a data-toggle="pill" href="#menu1"><i class="fa fa-caret-right"></i> &nbsp; Fall 2017</a></li>
			<li><a data-toggle="pill" href="#menu2"><i class="fa fa-caret-right"></i> &nbsp; Summer 2017</a></li>
			<li><a data-toggle="pill" href="#menu3"><i class="fa fa-caret-right"></i> &nbsp; Spring 2017</a></li>
			<li><a data-toggle="pill" href="#menu4"><i class="fa fa-caret-right"></i> &nbsp; Fall 2016</a></li>
			<li><a data-toggle="pill" href="#menu5"><i class="fa fa-caret-right"></i> &nbsp; Summer 2016</a></li>
			<li><a data-toggle="pill" href="#menu6"><i class="fa fa-caret-right"></i> &nbsp; Spring 2016</a></li>
			<li><a data-toggle="pill" href="#menu7"><i class="fa fa-caret-right"></i> &nbsp; Fall 2015</a></li>
			<li><a data-toggle="pill" href="#menu8"><i class="fa fa-caret-right"></i> &nbsp; Summer 2015</a></li>
			<li><a data-toggle="pill" href="#menu9"><i class="fa fa-caret-right"></i> &nbsp; Spring 2015</a></li>
			<li><a data-toggle="pill" href="#menu10"><i class="fa fa-caret-right"></i> &nbsp; Fall 2014</a></li>
			<li><a data-toggle="pill" href="#menu11"><i class="fa fa-caret-right"></i> &nbsp; Summer 2014</a></li>
			<li><a data-toggle="pill" href="#menu12"><i class="fa fa-caret-right"></i> &nbsp; Spring 2014</a></li>
			<li><a data-toggle="pill" href="#menu13"><i class="fa fa-caret-right"></i> &nbsp; Fall 2013</a></li>
		</ul>


		<div class="my-modal">
			
			<div class="modal-content">

				<h3>Fall 2017</h3>
				<table class="table table-responsive table-left">
					<tr>
						<th>Student Name</th>
						<td>Ruhul Mashbu</td>
					</tr>
					<tr>
						<th>Student ID</th>
						<td>1330104 0 42</td>
					</tr>
					<tr>
						<th>Course Code</th>
						<td>CEG413</td>
					</tr>
					<tr>
						<th>Total Number of Lectures</th>
						<td>10</td>
					</tr>
					<tr>
						<th>Lectures Attended</th>
						<td>8</td>
					</tr>
					<tr>
						<th>Lectures Missed</th>
						<td>2</td>
					</tr>
					<tr>
						<th>Consecutive 3 days Missed</th>
						<td>0</td>
					</tr>
					<tr>
						<td colspan="2">Consecutive three days miss will put you in red zone.</td>
					</tr>
				</table>


				<table class="table table-bordered table-responsive table-right">
					
					<thead>
						<th>Lecture No.</th>
						<th>Lecture Date</th>
						<th>Attended</th>	
					</thead>

					<tbody>
						<tr>
							<td>1</td>
							<td>2017-09-25</td>
							<td>YES</td>
						</tr>
						<tr>
							<td>2</td>
							<td>2017-09-27</td>
							<td>YES</td>
						</tr>
						<tr>
							<td>3</td>
							<td>2017-09-29</td>
							<td>YES</td>
						</tr>
						<tr>
							<td>4</td>
							<td>2017-10-02</td>
							<td>YES</td>
						</tr>
						<tr>
							<td>5</td>
							<td>2017-10-04</td>
							<td>YES</td>
						</tr>
						<tr>
							<td>6</td>
							<td>2017-10-09</td>
							<td>NO</td>
						</tr>
						<tr>
							<td>7</td>
							<td>2017-10-11</td>
							<td>YES</td>
						</tr>
						<tr>
							<td>8</td>
							<td>2017-10-16</td>
							<td>NO</td>
						</tr>
						<tr>
							<td>9</td>
							<td>2017-10-18</td>
							<td>YES</td>
						</tr>
						<tr>
							<td>10</td>
							<td>2017-10-20</td>
							<td>YES</td>
						</tr>
						<tr>
							<td>10</td>
							<td>2017-10-20</td>
							<td>YES</td>
						</tr>
						<tr>
							<td>10</td>
							<td>2017-10-20</td>
							<td>YES</td>
						</tr>
						<tr>
							<td>10</td>
							<td>2017-10-20</td>
							<td>YES</td>
						</tr>
						<tr>
							<td>10</td>
							<td>2017-10-20</td>
							<td>YES</td>
						</tr>
						<tr>
							<td>10</td>
							<td>2017-10-20</td>
							<td>YES</td>
						</tr>
						<tr>
							<td>10</td>
							<td>2017-10-20</td>
							<td>YES</td>
						</tr>
						<tr>
							<td>10</td>
							<td>2017-10-20</td>
							<td>YES</td>
						</tr>
						<tr>
							<td>10</td>
							<td>2017-10-20</td>
							<td>YES</td>
						</tr>
						<tr>
							<td>10</td>
							<td>2017-10-20</td>
							<td>YES</td>
						</tr>
						<tr>
							<td>10</td>
							<td>2017-10-20</td>
							<td>YES</td>
						</tr>
						<tr>
							<td>10</td>
							<td>2017-10-20</td>
							<td>YES</td>
						</tr>
						<tr>
							<td>10</td>
							<td>2017-10-20</td>
							<td>YES</td>
						</tr>
						<tr>
							<td>10</td>
							<td>2017-10-20</td>
							<td>YES</td>
						</tr>
						<tr>
							<td>10</td>
							<td>2017-10-20</td>
							<td>YES</td>
						</tr>
					</tbody>

				</table>

				<button class="btn">Dismiss Window</button>

			</div> <!-- /modal-content -->

		</div> <!-- /my-modal -->


	</div> <!-- /attendance -->


<?php include_once '../partials/students-footer.php';?>