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
					<h3>FORM TEMPLATE (Advanced)</h3>
					<p>note: for more info please refer to the design document</p>
				</div>
				<div class="body">
					<div class="form-group form-float">
						<p><b>Basic (form-float)</b></p>
						<div class="form-line">
							<input type="text" id="" class="form-control">
							<label class="form-label">Basic</label>
						</div>
						<div class="form-line error">
							<input type="text" id="" class="form-control" value="" disabled>
							<label class="form-label">Disabled (Red)</label>
						</div>
						<div class="form-line success">
							<input type="text" id="" class="form-control" value="">
							<label class="form-label">Success (Green)</label>
						</div>
						<div class="form-line warning">
							<input type="text" id="" class="form-control" value="">
							<label class="form-label">Warning (Yellow)</label>
						</div>
					</div><br>
					<p><b>Columnar (Classic Boostrap-like Label)</b></p>
					<div class="row-clearfix"><br>
						<div class="form-line col-sm-3">
							<label class="form-label">First Name</label>
							<input type="text" class="form-control"/>
						</div>
						<div class="form-line col-sm-3">
							<label class="form-label">Middle Name</label>
							<input type="text" class="form-control" placeholder=""/>
							
						</div>
						<div class="form-line col-sm-6">
							<label class="form-label">Surname</label>
							<input type="text" class="form-control" placeholder=""/>
						</div>
						<div class="form-line col-sm-10">
							<label class="form-label">Address</label>
							<input type="text" class="form-control " placeholder=""/>
						</div>
						<div class="form-line col-sm-2">
							<label class="form-label">Zip Code</label>
							<input type="text" class="form-control " placeholder=""/>
						</div>
						<div class="form-line col-sm-6">
							<label class="form-label">E-mail Address</label>
							<input type="text" class="form-control " placeholder=""/>
						</div>
						<div class="form-line col-sm-6">
							<label class="form-label">E-mail Address</label>
							<input type="text" class="form-control " placeholder="" >
						</div>
					</div>
					<p><b>Columnar w/ Floating Label (TODO)</b></p>
					<div class="row-clearfix form-group">
						<div class="form-line col-sm-6">
							<input type="text" class="form-control " placeholder=""/>
							<label class="form-label">OptA</label>
						</div>
						<div class="form-line col-sm-6">
							<input type="text" class="form-control " placeholder=""/>
							<label class="form-label">OptB</label>
						</div>
					</div>
					<h4>Dropdown Menus</h4>
					<p>ideal for sorting / multiple selection</p>	
					<div class="form-float">
						<p><b>Basic</b></p>
						<select class="form-line form-control show-tick">
							<option value = "1" title = "Mustard">Mustard</option>
							<option value = "2" title = "Ketchup">Ketchup</option>
							<option value = "3" title = "Gravy">Gravy</option>
						</select>
					</div><br>
					<div class="form-float">
						<p><b>Basic / Multiselect</b></p>
						<select class="form-line form-control show-tick">
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
			</div>			
		</form>
	</div>
</section>
</body> 
<?php
  include "../include/footer.php";
?>  