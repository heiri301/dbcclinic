<?php
  include "../include/header.php";
  include "../query/patient.php";

  $patient=new PATIENT();
  
  if(isset($_POST['lname']) && $_POST['lname'] !== "" ){
	$search_filter = 1; 
    $patientlist=$patient->getlist_patient($db1,$_POST['lname'],$search_filter); 	
  }
  else
	//echo "Notice: no input";

  if(isset($_POST['fname']) && $_POST['fname'] !== "" ){
	$search_filter = 2; 
    $patientlist=$patient->getlist_patient($db1,$_POST['fname'],$search_filter); 	  
  }
  else
	//echo "Notice: no input";

	 
	//add new functions to simplify this
  	//enable recursive search for each field to make things easier during search
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
				</div>
			</div>
		</div>
		<div class = "row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class = "header"><h4>Patient Query</h4><small>Search for patients in the institutional database</small></div>
					<form action="managepatient.php" method="POST">
					<div class="body">
						<div class="form-line"><input id ='patient_search' type="text" name="lname" class="form-control" placeholder="Search by Last Name"></div>
						<button type="button" class="btn btn-primary m-t-15 waves-effect" value="search" method="POST">Submit</button>
						<button id = 'surname' type="button" class="btn btn-secondary m-t-15 waves-effect" value ="surname-mode">Search by Surname</button>
						<button id = 'firstname' type="button" class="btn btn-secondary m-t-15 waves-effect" value ="fname-mode" >Search by Firstname</button>
						<button type="button" class="btn btn-secondary m-t-15 waves-effect" value ="department-mode" disabled>Search by Department</button>
						<button type="button" class="btn btn-secondary m-t-15 waves-effect" value ="student/empid-mode" disabled>Student/Emp. ID</button>
						<span>TODO: put in dropdown later</span>
					</div>
					</form>
						<!--
						<div class="dropdown-menu">
							<a class="dropdown-item" href="#">Action</a>
							<a class="dropdown-item" href="#">Another action</a>
							<a class="dropdown-item" href="#">Something else here</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Separated link</a>
  						</div>
						-->
						<script>
							$("#surname").click(function(){
								$("#patient_search").attr("name","lname");
								$("#patient_search").attr("placeholder","Search by Last Name/Surname");
								//changes query to last name
							})
							$("#firstname").click(function(){
								$("#patient_search").attr("name","fname");
								$("#patient_search").attr("placeholder","Search by First Name");
								//changes query to first name 
							})
						</script>
					<?php
					if(isset($patientlist))
					{	  
						if(count($patientlist)!=0)
						{			
					?>					
					<div class = "row">
						<div class = "col-lg-12">
							<div class="body table-responsive">
							<span>Search Result(s)<br><small>List of patient(s) matching search query:</small></span>
								<table class="table table-striped">
									<thead>
										<tr>
											<th>#</th>
											<th>Name</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
											for($i=0;$i<=count($patientlist)-1;$i++)
											{
										?>		
											<tr>
												<th scope="row"><?php echo $patientlist[$i]['pid']?></th>
												<td><?php echo $patientlist[$i]['lname'].', '.$patientlist[$i]['fname'];?></td>
												<td><a href="patientprofile.php?id=<?php echo $patientlist[$i]['pid']?>">[View Profile]</a></td>
											</tr>
										<?php
											}
										?>
									
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
 	 	</div>
	<?php
			}
		}	
	?>
</section>
</body> 	
<?php
  include "../include/footer.php";
?>  