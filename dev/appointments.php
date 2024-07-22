<?php
	include "../include/header.inc.php";
?>  
<script type = "text/javascript" src="../node_modules/tinymce/tinymce.js"></script>

<body class="theme-blue"> 
	<section class = "content">
 		<div class="container-fluid">
			<div class = "row">
				<!-- Appointments -->
				<div class = "card" id = "apptSearchDiv">
					<div class = "header">
						<h3>Patient Logs</h3>
						<ul class="nav">
							<li class=""><a class="nav-link" href="managepatient.php">Health Record</a></li>
							<li class=""><a class="nav-link" aria-current="page" href="#">Patient Logs</a></li>
							<li class=""><a class="nav-link" href="#">Other</a></li>
						</ul>
					</div>
					<!-- Appointments Quick actions-->
					<div class = "body" id = "apptQuickActions">
						<button type = "button" class = "btn btn-primary btn-lg mx-auto column-gap-2" id = "apptQASchedAppointmentBtn"><i class = "material-icons">post_add</i><span> Add Log</span></button>		
						<!-- <button type = "button" class = "btn btn-lg mx-auto column-gap-2 disabled" id = "apptQAQRCodeModal" style = "background-color: #6f42c1; color: white;" title = "ComingSoon(TM)"> <i class = "material-symbols-outlined">barcode_scanner</i><span>Add From Barcode</span></button>-->				
					</div>
					<!-- Appointments Query-->
					<div class = "body" id = "appointment_search">
						<form class="input-group mb-2 mt-2" id = "EHR_AppointmentSearch"> 
							<div class="input-group-prepend">
								<button type="button" class="btn dropdown-toggle dropdown-toggle-split btn-primary waves-effect" type = "submit" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="sr-only"><i class = "material-icons">filter_list</i></span>
								</button>
								<div class="dropdown-menu">
									<a class="dropdown-item" href="#">Search by Date</a>
									<a class="dropdown-item" href="#">Search by Name</a>
								</div>
							</div>
							<input type="text" class="form-control" name = "query" placeholder="Search for event records" aria-label="Search for event records">
							<div class="input-group-append">
								<button id = "EHR_apptsearchsubmit" class="btn btn-primary waves-effect" href = "#"><i class = "material-icons">search</i></button>
							</div>
						</form>
						<div class = "input-group mb-2 mt-5" id = "EHR_apptSearchRes">
							<table class="table table-striped table-bordered">
								<thead>
									<tr>
										<th class = "col-sm-7" scope="col">Subject</th>
										<th class = "col-sm-1" scope="col">Date/Time</th>
										<th class = "col-sm-1" scope="col">Type</th>
										<th class = "col-sm-1" scope="col">Action</th>
									</tr>
								</thead>
								<tbody id = "getApptSearchTableBody">
								</tbody>
								<thead>
									<tr>
										<th class = "col-sm-7" scope="col">Subject</th>
										<th class = "col-sm-1" scope="col">Date/Time</th>
										<th class = "col-sm-1" scope="col">Type</th>
										<th class = "col-sm-1" scope="col">Action</th>
									</tr>
								</thead>
							<small id = "searchApptShowStats" class = "text-center"></small> 
							</table>
						</div>
						<div class = "row">
							<nav aria-label="">
								<ul class = "pagination" id="ApptSearchPagination" hidden>
									<li class="page-item" id = "getApptSearchPaginatePrevBtn">
										<a class="page-link" role="button" aria-label="Previous">
											<span aria-hidden="true">&laquo;</span>
										</a>
									</li>
									<li class="page-item" id = "getApptSearchPaginateNextBtn">
										<a class="page-link" role="button" aria-label="Next">
											<span aria-hidden="true">&raquo;</span>
										</a>
									</li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
				<!-- Create / Update Appointment DIV -->
				<div id = "setApptDiv" class = "card" hidden>
					<div class = "header">
						<h4 id = "setApptDivHeader"></h4>
					</div>
					<div id = "setApptBody" class = "body">
						<div id = "setApptBodyDtlsShowAlert" class = "row">
						</div>
						<form id = "setApptForm">
							<div class = "form-group form-float my-3" id = "setApptForm">
								<div class = "row clearfix">
									<div class="col-sm-2">
										<label class="form-label" for="appointment_date">Date</label>
										<div class="form-line focused">
											<input class="form-control" id="appt_date" type="date" name="appt_date" min="01-01-2000" max="01-01-2096">
										</div>
									</div>
									<div class="col-sm-2">
										<label class="form-label" for="appointment_date">Time</label>
										<div class="form-line focused">
											<input class="form-control" id="appt_time" type="time" name="appt_time" step = "any">
										</div>
									</div>
									<div class="col-sm-2">
										<label class="form-label">Type</label>
										<div class="form-line">
											<select class="form-control" id = "appt_type" name = "appt_type">
												<option value = "1">Visitation</option>
												<option value = "2">Checkup</option>
												<option value = "3">Admission</option>
												<option value = "4">Other</option>
											</select>
										</div>
									</div>
									<div class = "row clearfix">
										<div class = "col-md-6">
											<label class = "form-label" for="appt_subject">Subject / Title</label>
											<div class="form-line">
												<input class = "form-control" id="appt_subject" name="appt_subject" required>
											</div>
										</div>
										<div class = "col-md-4"> 
											<div class = "col">
												<label class = "form-label" for="appt_pid">Patient</label>
												<div class="input-group mb-3 form-line">
													<input class = "form-control" id = "appt_pid" name="appt_pid" class="form-control" placeholder="Patient Name" readonly = "readonly" required>
													<button class = "btn btn-primary waves-effect" id="apptPatientSearchBtn"><i class = "material-icons">search</i></button>
												</div>
											</div>
										</div>
									</div>
									<div class = "col-md-12">
										<label class = "form-label" for="appt_notes">Notes</label>
										<small><i>(Optional)</i></small>
										<div class="form-line">
											<textarea class="form-control" type="text" id="appt_notes" name="appt_notes"></textarea>
										</div>
									</div>
									<div class = "row col-md-12">
										<label class="form-label">Attachments</label>
									</div>
								</div>
								<div class="d-flex justify-content-end">
									<button id = "setApptBodybtnClose" class="btn btn-danger waves-effect ms-2">Close</button>
									<button id = "setApptBodybtnSubmit" class="btn btn-success waves-effect ms-2">Submit Data</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- modals -->
		<!-- Search Patient Modal -->
		<div class="modal modal-xl fade" id="apptSearchPatientModal" tabindex="-1" role="dialog" style="display: none;" data-bs-keyboard="false" data-bs-backdrop="static">
			<div class="modal-dialog modal-content rounded">
				<div class="modal-header">
					<h4>Patient Search</h4>
				</div>
				<div class = "modal-body" id = "apptSearchPatientBody">
					<div class = "col">
						<form class="input-group mb-2 mt-2" id = "apptSearchPatientForm"> 
							<input type="text" class="form-control" name = "query" placeholder="Search for Patients by Surname">
							<div class="input-group-append">
								<button id = "apptSearchPatientSubmit" class="btn btn-primary waves-effect" type="submit"><i class = "material-icons">search</i></button>
							</div>
						</form>
					</div>
					<div class = "col table-sm">
						<div class = "input-group mb-2 mt-5" id = "apptSearchPatientResults">
							<table class="table table-striped table-bordered">
								<thead>
									<tr>
										<th class = "col-sm-6" scope="col">Full Name</th>
										<th class = "col-sm-3" scope="col">Department</th>
										<th class = "col-sm-1" scope="col">Action</th>
									</tr>
								</thead>
								<tbody id = "apptSearchPatientBodyInner">
								</tbody>
							</table>
							<span id = 'apptSearchPatientShowStats' class = "text-center"></span> 
						</div>
					</div>
					<div class = "col">
						<nav aria-label="">
							<ul class="pagination" id="pidSearchPagination" hidden>
								<li class="page-item" id = "paginatePrevBtn">
									<a class="page-link" role="button" aria-label="Previous">
										<span aria-hidden="true">&laquo;</span>
									</a>
								</li>
								<li class="page-item" id = "paginateNextBtn">
									<a class="page-link" role="button" aria-label="Next">
										<span aria-hidden="true">&raquo;</span>
									</a>
								</li>
							</ul>
						</nav>
					</div>
				</div>
				<div class = "modal-footer">
					<button id = "newApptBodybtnClose" class="btn btn-danger waves-effect" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</section>
	<div class = "apptModalPopUp"></div>
</body>
<script type="text/javascript" src="../js/appointments.js"></script>
<?php
  include "../include/footer.inc.php";
?> 
