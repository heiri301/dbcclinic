<?php
  include "../include/header.php";
  include "../query/checkupdetails.php";
  include "../query/healthdeclaration.php";
	
  $checkupdtails=new CHECKUPDETAILS(); 
  if(isset($_POST['pid']))
  {
	$_SESSION['pid']=$_POST['pid'];
	$checkupdtails->addlist_checkupdtails($db1,$_SESSION['pid'],$_POST['date'],$_POST['time'],$_POST['diagnosis'],$_POST['actiontaken'],$_POST['prescription']);		
  }
?>
<body class="theme-blue">  
<section class="content">
	<div class="container-fluid">
		<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h3>PATIENT APPOINTMENT / SET HEALTH DECLARATION</h3>
							<?php include "../include/patientmgmt_header.php"; ?>
						</div>		 
					</div>
					<div class = "row clearfix">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="card">
								<div class = "header">
									<h4>Checkup Details</h4><small>Keep logs, set up schedules and appointments for clinic patients.</small>
								</div>
								<div class = "body">
								<div class = "container">
								<div class = "row">
									<h4>Set Appointment</h4>
									<form id = "checkup_details" action="checkupdetails.php" method="POST">
										<!--<input type="hidden" name="pid" value="1">-->
											<div class = "row clearfix">
												<div class="col-md-3">
													<label for="chkup_date">Date</label>
													<div class="form-line"><input type="date" id="chkup_date" name="chkup_date" class="form-control" min="01-01-2000" max="01-01-2025"></div>
												</div>
												<div class="col-md-2">
													<label for="chkup_time">Time</label>
													<div class="form-line"><input type="time" id="chkup_time" name="chkup_time" class="form-control" placeholder="Time" value="00:00"></div>
												</div>
											</div>
											<div class = "row clearfix">
												<div class = "form-group">
													<div class = "col-md-12">
													<label for="chkup_diagnosis">Diagnosis</label>
													<div class="form-line">
														<textarea class="form-control" type="text" id="chkup_diagnosis" name="chkup_diagnosis" class="form-control"></textarea>
													</div>
													<label for="chkup_action">Action taken</label>
													<div class="form-line">
														<textarea class="form-control" type="text" id="chkup_action" name="chkup_action" class="form-control"></textarea>
													</div>
													<label for = "form-label" for="chkup_meds">Prescription</label>
													<div class="form-line">
														<textarea class="form-control" type="text" id="chkup_meds" name="chkup_meds" class="form-control"></textarea>
													</div>
													</div>
												</div>	
											</div>
										<input type="submit" class="btn btn-primary m-t-15 waves-effect" value="Submit">
									</form>
								</div>
								<div class = 'row'>
									<h4>Health Declaration</h4>
									<form id = "health_declaration">
										<div class = "row clearfix">
											<div class="col-md-3">
												<label for="datemin">Date</label>
												<div class="form-line"><input type="date" id="datemin" name="date" class="form-control" min="01-01-2000" max="01-01-2025"></div>
											</div>
											<div class="col-md-2">
												<label for="time">Time</label>
												<div class="form-line"><input type="time" id="time" name="time" class="form-control" placeholder="Time" value="00:00"></div>
											</div>
											<div class="col-md-6">
													<label for="temp">Temperature</label>
													<div class = "form-line"><input type="number" id="temp" min="0" max="100" placeholder ="0-100"></div><br>
													<label for="temp">Degrees</label>
													<ul class = 'list-unstyled'>
													<li><input type="checkbox" id="temp1" name="temp" value="Celcius"><label for="temp1">Celcius</label></li>
													<li><input type="checkbox" id="temp2" name="temp" value="Fahrenheit"><label for="temp2">Fahrenheit</label></li>
													</ul>
											</div>	
										</div>
										<div class = "row clearfix">
												<div class = "form-group">
													<div class = "col-md-12">
													<div class="form-line">
														<textarea class = "form-control" type="text" id="comments" name="comments" class="form-control"></textarea>
														<label class = "form-label" for="comments">Other Remarks</label>
													</div>
													</div>
												</div>	
											</div>					
										<button type="button" class="btn btn-primary m-t-15 waves-effect">Generate</button>
									</form>
								</div>
								</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> 
 		</div>
	</div>
	</section>  
<?php
  include "../include/footer.php";
?> 
</body> 