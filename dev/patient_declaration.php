<?php
  include "../include/header.php";
  include "../query/patient.php";

  $patient=new PATIENT();
  
  if(isset($_GET['id']))
    $_SESSION['pid']=$_GET['id'];
  $profile=$patient->getprofile_patient($db1,$_SESSION['pid']);
?>
<body class="theme-blue">   
<section class="content">
  <div class="container-fluid">
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
					<div class="header">
						<h3>PATIENT PROFILE</h3>
						<?php include "../include/patientmgmt_header.php"; ?>
					</div>
					<div class="body">
					<form>
						<div class="form-group form-float">
							<div class="form-line error">
								<input type="text" id="lname" class="form-control" value="<?php echo $profile['lname'];?>" disabled>
								<label class="form-label">Last Name</label>
							</div>
							<div class="form-line error">
								<input type="text" id="fname" class="form-control" value="<?php echo $profile['fname'];?>" disabled>
								<label class="form-label">First Name</label>
							</div>
							<div class="form-line error">
								<input type="text" id="mname" class="form-control" value="<?php echo $profile['mname'];?>" disabled>
								<label class="form-label">Middle Name</label>
							</div>
							<div class="form-line">
								<input type="text" id="relation" class="form-control">
								<label class="form-label">Relation</label>
							</div>
							<div class="form-line">
								<input type="text" id="occupation" class="form-control">
								<label class="form-label">Occupation</label>
							</div>
						</div>
						<h5>ACTIONS:</h5>
				 		<a button type = "button" class="btn btn-primary m-t-15 waves-effect" href="diseaselist.php">Update Patient Disease Record</a>	
						<a button type = "button" class="btn btn-primary m-t-15 waves-effect" href="checkupdetails.php">Set Appointment / Health Declaration</a>	
						<!-- Vaccine Status -->	
						<div class="form-group form-float">
							<div class="header">
								<h2>VACCINE STATUS</h2>
							</div>
							<div class="form-line">
								<input type="text" id="vaccinename" class="form-control">
								<label class="form-label">Vaccine Name</label>
							</div>
							<div class="form-line">
								<input type="text" id="dose" class="form-control">
								<label class="form-label">Dose</label>
							</div>
							<div class="form-line">
								<input type="text" id="location" class="form-control">
								<label class="form-label">Location</label>
							</div>
						</div>
						<!-- File Upload -->
						<div class="form-group form-float">
							<div class="row clearfix">
								<div class="header">
									<h2>VACCINATION CARD</h2>
									<ul class="header-dropdown m-r--5">
									<li class="dropdown">
								</div>
							</div>
							<div class="form-group form-float">
								<div class="form-line">
									<input type="text" id="vaccinationcard" class="form-control">
									<label class="form-label">Vaccine Card URL</label>
								</div>
							</div>
						</div>
					</form>
					</div>
                </div>
            </div>
            <!-- #END# File Upload -->
			</div>			
		</form>
	</div>
</section>
</body> 
<?php
  include "../include/footer.php";
?>  