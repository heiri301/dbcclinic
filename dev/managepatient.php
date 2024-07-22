<?php
	include "../include/header.inc.php";
?>  
<body class="theme-blue"> 
	<section class = "content">
 		<div class="container-fluid">
			<div class = "row">
				<!-- Manage Health Record-->
				<div class = "card">
					<div class = "header">
						<h3>Patient Profile and Health Record</h3>
						<ul class="nav">
							<li class=""><a class="nav-link" aria-current="page" href="#">Health Record</a></li>
							<li class=""><a class="nav-link" href="appointments.php">Patient Logs</a></li>
							<li class=""><a class="nav-link" href="#">Other</a></li>
						</ul>
					</div>
					<!-- EHR Search -->
					<div class = "body" id = "EHR_search">
						<form class = "input-group mb-2 mt-2" id = "EHRsearchPatient"> 
							<div class="input-group-prepend">
								<button type="button" class="btn dropdown-toggle dropdown-toggle-split btn-primary waves-effect" type = "submit" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-auto-close="outside">
									<span class="sr-only"><i class = "material-icons">filter_list</i></span>
								</button>
								<div class="dropdown-menu">
								</div>
							</div>
							<input type="text" class="form-control" name = "query" placeholder="Search for Patients by Surname" aria-label="Search for Health Records by Surname">
							<div class="input-group-append">
								<button id = "EHRsearchPatientSubmit" class="btn btn-primary waves-effect" type="submit"><i class = "material-icons">search</i></button>
							</div>
						</form>
						<div class = "input-group mb-2 mt-5" id = "EHRSearchPatientResults">
							<table class="table table-striped table-bordered mt-3 rounded overflow-hidden" id = "EHRSearchPatientTable">
								<thead>
									<tr>
										<th class = "col-sm-7" scope="col">Full Name</th>
										<th class = "col-sm-2" scope="col">Department</th>
										<th class = "col-sm-1" scope="col">Action</th>
									</tr>
								</thead>
								<tbody id = "EHRSearchPatientResTBody">
								</tbody>
								<thead>
									<tr>
										<th class = "col-sm-9" scope="col">Full Name</th>
										<th class = "col-sm-1" scope="col">Department</th>
										<th class = "col-sm-1" scope="col">Action</th>
									</tr>
								</thead>
							<small id = "EHRSearchPatientRC" class = "text-center"></small> 
							</table>
						</div>
						<div class = "row">
							<nav>
								<ul class="pagination" id = "EHRSearchPatientPagination" hidden>
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
						<!-- Buttons for EHR Import -->
						<div class = "btn-group float-end">
							<button id = "EHRImportCSVData" class="mx-auto btn btn-primary waves-effect column-gap-2" data-bs-toggle="modal" data-bs-target="#EHR_csvImportModal">
								<i class = 'material-icons'>upload</i>
								<span>Import CSV Data</span>
							</button>
						</div>
					</div>
				</div>
				<!-- EHR Search (Detailed) -->
				<div class = "card" id = "EHR_SearchShowDtls" hidden>
					<div class = "header">
						<h5>Health Record Details</h5>
						<p>showing health record details for <span id ="EHR_lnameGet_Head">lname</span>, <span id ="EHR_fnameGet_Head">fname</span>
					</div>
					<div class = "body">
						<div id = "EHR_SearchShowDtlsShowAlert" class = "row">
						</div>
						<form id = "EHR_dataAll">
							<div class = "row form-group form-float my-5">
								<div class = "row clearfix">
									<div class = "col-sm-5">
										<label class="form-label">First Name</label>
										<div class="form-line focused">
											<input type="text"id="fname"name = "fname" class="form-control" readonly="readonly">
										</div>
									</div>
									<div class = "col-sm-4">
										<label class="form-label ">Last Name</label>
										<div class="form-line focused">
											<input type="text" id="lname" name = "lname" class="form-control" readonly="readonly">
										</div>
									</div>
									<div class = "col-sm-3">
										<label class="form-label">Middle Name</label>
										<div class="form-line focused">
											<input type="text" id="mname" name = "mname" class="form-control" readonly="readonly">
										</div>
									</div>
								</div>
								<div class = "row clearfix">
									<div class = "col-sm-4">
										<label class="form-label">Department</label>
										<div class="form-line">
											<select type="text" id="dept" name = "dept" class="form-control">
												<option value = "1">College Department</option>
												<option value = "2">Junior High School Department</option>
												<option value = "3">Senior High School Department</option>
												<option value = "4">Elementary Department</option>
												<option value = "5">Institutional Staff / LAMPs</option>
											</select>
										</div>
									</div>
									<div class = "col-sm-5">
										<label class="form-label">Address</label>
										<div class="form-line">
											<input type="text" id="address" name = "address" class="form-control">
										</div>
									</div>
									<div class = "col-sm-3">
										<label class="form-label">Contact No.</label>
										<div class="col-mx-2 form-line">
											<input type="text" id="contactno" name = "contactno" class="form-control">
										</div>
									</div>
								</div>
								<div class = "row clearfix">
									<div class = "col-sm-4">
										<label class="form-label focused">Birthday</label>
										<div class = "form-line focused">
											<input type="date" id="bday" name = "bday" class="form-control">
										</div>
									</div>
									<div class = "col-sm-2">
										<label class="form-label focused">Age</label>
										<div class = "form-line focused">
											<input type="number" id="age" name = "age" class="form-control" readonly="readonly">
										</div>
									</div>
									<div class = "col-sm-4">
										<label class="form-label">Sex</label>
										<div class="form-line" >
											<select id = "gender" name = "gender" class="form-control">
												<option value = "1">Male</option>
												<option value = "2">Female</option>
											</select>
										</div>
									</div>
									<div class = "col-sm-1">
										<label class="form-label">Weight</label>
										<div class="form-line">
											<input type="number" id="weight" name = "weight" class="form-control" min = "0">
										</div>
										<small>in kilograms (kg)</small>	
									</div>
									<div class = "col-sm-1">
										<label class="form-label">Height</label>
										<div class="form-line">
											<input type="number" id="height" name = "height" class="form-control" min = "0">
										</div>
										<small>in centimeters (cm)</small>
									</div>
								</div>
								<div class = "row clearfix">
									<div class = "col-sm-2">
										<label class="form-label focused">Status</label>
										<div class = "form-line focused">
											<input type="text" id="status" name = "status" class="form-control" readonly="readonly">
										</div>		
									</div>							
								</div>
							</div>
							<div class ="row">
								<div class ="col float-left">			
									<button type = "button" id = "EHRShowMHBModalBtn" class="btn btn-primary waves-effect" data-bs-toggle="modal" data-bs-target="#EHR_dislistModal">Medical History</button>
								</div>
								<div class = "col float-right">
									<button type = "submit" id = "EHR_SubmitFullForm" class="btn btn-success waves-effect float-end">Update</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<!-- MODALS -->
				<!-- Medical History Modal -->
				<div class="modal fade" id="EHR_dislistModal" tabindex="-1" role="dialog" style="display: none;" data-bs-backdrop="static">
					<div class="modal-dialog modal-content rounded" style="max-width: 80%;">
						<div class="modal-header">
							<h4>Medical History</h4>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body row clearfix">
							<div class = "col-sm-4">
								<div class = "row clearfix">
									<div class = "float-end mb-3">
										<h5>Health Record</h5>
										<button id = "EHRMHDisListClear" class="btn btn-outline-secondary waves-effect">Clear All</button>
										<div class = "btn-group">
											<button type = "button" class="btn btn-secondary waves-effect dropdown-toggle float-end" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true">Year</button>
											<div class="dropdown-menu">
												<li><a class="dropdown-item" href="#">YEAR</a></li>
											</div>
										</div>
									</div>
									<div id = "EHRMHDislistBody"> 
									</div>
									<div class = "float-end">
										<button id = "EHRMHDisListDivSubmit" class="btn btn-success waves-effect float-end">Update</button>
									</div>
								</div>
								<!-- <div class = "row">
									<h5>Vaccine Details</h5>
								</div> -->
							</div>
							<div class="col">
								<h5>Patient History</h5>
								<div id = "EHRPatientLogs" class = "row clearfix"> 
									<strong>Patient Logs</strong>
									<form class = "input-group mb-2 mt-2" id = "EHRHMApptSearchSubmit"> 
										<div class="input-group-prepend">
											<button type="button" class="btn dropdown-toggle dropdown-toggle-split btn-primary waves-effect" type = "submit" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-auto-close="outside">
												<span class="sr-only"><i class = "material-icons">filter_list</i></span>
											</button>
											<div class="dropdown-menu">
											</div>
										</div>
										<input type="text" class="form-control" name = "query" placeholder="">
										<div class="input-group-append">
											<button class="btn btn-primary waves-effect" type="submit"><i class = "material-icons">search</i></button>
										</div>
									</form>
									<div class = "table-responsive rounded-2">
										<table class="table table-striped table-bordered table-sm rounded-2" id = "EHRMHPatientLogsTable">
											<thead>
												<tr>
													<th class = "col-sm-6" scope="col">Subject</th>
													<th class = "col-sm-2" scope="col">Type</th>
													<th class = "col-sm-1" scope="col">Date</th>
													<th class = "col-sm-1" scope="col">Action</th>
												</tr>
											</thead>
											<tbody id = "EHRMHPatientLogsTableBody">
											</tbody>
										</table>
										<small id = "EHRHMApptSearchStats"></small> 
									</div>
									<div class = "row">
										<nav>
											<ul class = "pagination" id="EHRHMApptSearchPagination" hidden>
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
						</div>
						<div class="modal-footer">
							<button id = "EHRMHModalCloseBtn" class="btn btn-danger waves-effect"  data-bs-dismiss="modal">Close</button>
							<!-- <button id = "EHRMHModalSubmitBtn" class="btn btn-success waves-effect">Update</button> -->
						</div>
					</div>
				</div>
				<!-- CSV File Upload Modal -->
				<div class = "modal fade modal-md" id="EHR_csvImportModal" tabindex="-1" role="dialog" style="display: none;" data-bs-backdrop="static">
					<div class = "modal-dialog modal-content rounded-2">
						<div class = "modal-header">
							<div class ="row">
								<h4>Health Record Importer</h4>
							</div>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class = "modal-body">
							<div class="row">
								<div class = "div">
									<label for="formFile" class="form-label">Upload File</label>
									<input class = "form-control" type="file" id="formFile">
									<small class = "mb-2" >CSV files are only supported.</small>
								</div>
								<div class = "div"> 
									<button id = "EHR_csvImportModalSubmitBtn" class="float-end btn btn-success waves-effect">Upload</button>
								</div>
							</div>
							<div id = "showAlertDivModal">
							</div>
						</div>
						<div class="modal-footer">
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
<?php
  include "../include/footer.inc.php";
?> 
<script type = "text/javascript" src = "../js/patientmanagement.js"></script>
