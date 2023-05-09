<?php
  include "../include/header.php";
  include "../query/patient.php";
  
  $patient=new PATIENT();
  
  if(isset($_GET['id']))
    $_SESSION['pid']=$_GET['id'];
  $profile=$patient->getprofile_patient($db1,$_SESSION['pid']);
?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#ajaxBtn').click(function(){
			$.ajax('files/test.php', {
				success: function (data,status,xhr){
					$('#display').append(data);
					alert('Success.');
				}
			});
		});
	});
</script>
<body class="theme-blue">   
<section class="content">
  <div class="container-fluid">
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
					<div class="header">
						<h3>ajaxtest</h3>
					</div>
					<p id ="display"></p>
					<div class="body">
						<a button type = "button" class="btn btn-primary m-t-15 waves-effect" id ="ajaxBtn" >Test</a>		
					</div>
				</div>
			</div>			
		</div>
</section>
</body> 
<?php
  include "../include/footer.php";
?>  