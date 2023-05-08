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
						<h3>FORM TEMPLATE (Basic)</h3>
					</div>
					<div class="body">
						<h4>Basic</h4><br>
						<div class="form-group form-float">
							<div class="form-line">
								<input type="text" id="basic" class="form-control">
								<label class="form-label">Basic</label>
							</div>
							<div class="form-line error">
								<input type="text" id="disabled" class="form-control" value="" disabled>
								<label class="form-label">Disabled (Red)</label>
							</div>
							<div class="form-line success">
								<input type="text" id="success" class="form-control" value="">
								<label class="form-label">Success (Green)</label>
							</div>
							<div class="form-line warning">
								<input type="text" id="warning" class="form-control" value="">
								<label class="form-label">Warning (Yellow)</label>
							</div>
						</div><br>
						<h4>Dropdown Menus</h4>
						<p>ideal for sorting / multiple selection</p>	
						<div class="row-clearfix form-group">
							<div class="form-float col-sm-3">
							<p><b>Basic</b></p>
								<select class="form-line form-control show-tick ">
									<option value = "1" title = "Mustard">Mustard</option>
									<option value = "2" title = "Ketchup">Ketchup</option>
									<option value = "3" title = "Gravy">Gravy</option>
								</select>
							</div>
							<div class="form-float col-sm-3">
								<p><b>Basic / Multiselect</b></p>
								<select class="form-line form-control show-tick ">
									<optgroup label = "Condiments">
										<option value = "0_1" title = "Mustard">Mustard</option>
										<option value = "0_2" title = "Ketchup">Ketchup</option>
										<option value = "0_3" title = "Gravy">Gravy</option>
									</optgroup>
									<optgroup label = "Fruits">
										<option value = "1_1" title = "Apple">Apple</option>
										<option value = "1_2" title = "Mango">Mango</option>
										<option value = "1_3" title = "Strawberry">Strawberry</option>
									</optgroup>
								</select>
							</div>
						</div>
						<div class="form-group"></div>
					</div>
				</div>
			</div>			
		</div>
</section>
</body> 
<?php
  include "../include/footer.php";
?>  