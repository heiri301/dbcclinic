<!-- DASHBOARD -->
<?php
	include "../include/header.inc.php";
?>
<script type = "text/javascript" src = "../node_modules/chart.js/dist/chart.umd.js"></script>
<script type = "text/javascript" src = "../node_modules/chart.js-plugin-labels-dv/dist/chartjs-plugin-labels.min.js"></script>  
<body class="theme-blue"> 
	<section class = "content">
 		<div class="container-fluid">
			<div class = "row d-flex justify-content-center gap-3">
				<div class = "row col">
					<div class = "card">
						<div class = "body">
							<div class = "row">
								<div class = "col-sm-3 align-items-center">
									<img src="../data/files/image/Don_Bosco_College_Logo.svg" class="rounded mx-auto d-block" style ="width:100%;" alt="DBC Logo">
								</div>
								<div class = "col ">
									<h1 class = "text-center">Welcome!</h1>
									<h3 class = "text-center">to <strong>DBC CMS-D</strong></h3>
									<p class = "text-center text-uppercase"><strong>Don Bosco College Clinic Management System - Dashboard</strong></p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class = "row col">
					<div class = "card">
						<div class = "body">
							<h1 class = "text-center" id = "dashBShowTime">CURRENT TIME</h1>
							<h3 class = "text-center" id = "dashBShowDate">CURRENT DATE</h3>
							<p class = "text-center fs-5" id = "dashBShowDate2">CURRENT DATE (WORD FORMAT)</p>
						</div>
					</div>
				</div>
			</div>
			<div class ="row ">
				<div class = "card">
					<div class = "header">
						<h3>Quick Actions</h3>
					</div>
					<div class = "body">
						<div class="row d-flex justify-content-center">
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<a class = "text-decoration-none" href = "./managepatient.php">
								<div role='button' class="info-box bg-primary rounded hover-expand-effect" style = "cursor: pointer;">
										<div class="icon">
											<i class="material-icons">person_add</i>
										</div>
										<div class="content">
											<div class="text text-white fw-bolder">Encode New</div>
											<div class="number count-to text-white fw-bolder">PATIENT DATA</div>
										</div>
									</div>
								</a>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<a class = "text-decoration-none" href = "./appointments.php">
								<div role='button' class="info-box bg-warning rounded hover-expand-effect" style = "cursor: pointer;">
									<div class="icon">
										<i class="material-icons">book</i>
									</div>
									<div class="content">
										<div class="text text-white fw-bolder" >Insert New</div>
										<div class="number text-white fw-bolder">LOGS / RECORDS</div>
									</div>
								</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class ="row d-flex justify-content-center gap-3"> 
				<div class = "col card">
					<div class = "header">
						<h3>Statistics</h3>
					</div>
					<div class = "body">
						<div class = "mb-4">
							<h4>Quick Glance</h4>
						</div>
						<div class="row d-flex justify-content-center">
							<div class="col-lg-6 col-md-6">
								<div class="info-box bg-primary hover-expand-effect rounded">
									<div class="icon">
										<i class="material-icons">person_add</i>
									</div>
									<div class="content">
										<div class="text text-white fw-bolder">Encoded Patients</div>
										<div class="number count-to text-white">125</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="info-box bg-primary hover-expand-effect rounded">
									<div class="icon">
										<i class="material-icons">description</i>
									</div>
									<div class="content">
										<div class="text text-white fw-bolder">Stored Records</div>
										<div class="number text-white">257</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="info-box bg-primary hover-expand-effect rounded">
									<div class="icon">
										<i class="material-icons">health_and_safety</i>
									</div>
									<div class="content">
										<div class="text text-white fw-bolder">Health Records Tallied</div>
										<div class="number text-white">16</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class ="col card">
					<div class = "header">
						<div class = "">
							<h3>Charts</h3>
						</div>
					</div>
					<div class = "body">
						<div class = "row d-flex justify-content-center">
						<div class = "fw-bolder h5" id = "mainpageChartTitle"></div>
							<div class = "d-flex row justify-content-center border my-3 rounded-2 border-2">
								<div class = "row" style = "width: 500px; height: 500px;">
									<canvas id = "mainpageChartDiv" ></canvas>
								</div>
								<div class = "my-3">
									<button type = "button" class = "btn waves-effect btn-secondary" id = "expandChartBtn"><i class = "material-symbols-outlined fw-strong ">open_run</i></button>
								</div>
							</div>
							<ul class="nav nav-pills d-flex justify-content-center">
								<li class="nav-item navListChart">
									<a id = "chartPatientData" class="nav-link" href="#">Patient Data</a>
								</li>
								<li class="nav-item navListChart">
									<a  id = "chartLogTypes" class="nav-link" href="#">Log Types</a>
								</li>
								<li class="nav-item navListChart">
									<a id = "chartPatientTypes" class="nav-link" href="#">Patient Types</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class = "row">
				<div id = "dashboardChangelog" class = "card">
					<div class = "header">
						<h3>Changelog</h3>
						<span>Recent changes of the system</span>
					</div>
					<div class = "body">
						<button type = "button" class = "btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#mainpageChangelog">View Changelog</button>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Modals -->
	<div class="modal fade" id="mainpageChangelog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="exampleModalLabel">Changelog (v0.1.0)</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<p class ="text-break word-wrap">
						<h5><strong>DBCCLinic</strong> Changelog v0.1.0</h5><br>
						<strong>Notable Changes</strong>
						<ul>
							<li>Added Patient Management System</li>
							<li>Added Dashboard</li>
							<ul>
								<li>Health Records Management</li>
							</ul>
							<li>Added Patient Logging System</li>
							<li>Added Login and Logout, Session Management Functions</li>
						</ul>  
						<strong>Minor Changes</strong>
						<ul>
							<li>Added Patient Logs to Health Records</li>
						</ul>  
						<strong>Bugfixes</strong> 
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

</body>
<script type = "text/javascript" src = "../js/dashboard.js"></script>
<?php
  include "../include/footer.inc.php";
?> 
