<?php
  include "../include/header.php";
  include "../query/mailer.php";

	$mail = new Mailer;

	if(isset($_POST['name']) && isset($_POST['email'])) {
		$mail->sendMail();
	}
?>
<body class="theme-blue"> 
<section class="content">
<div class="container-fluid">    
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header">
					<h3>CONTACT PATIENT</h3>
					<span>details here</span>
					<?php include "../include/patientmgmt_header.php"; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="row clearfix">
		<div class="col-lg-12">
			<div class="card">
				<div class = "header"><h4>Mailer</h4><small>contact patients</small></div>
				<form action = "mailer.php" method = "POST">
				<div class="body">
					<div class = "container">
					<div class = "form-group form-float col-md-6">
						<div class="form-line">
							<label for = "name" class = "form-label">Name</label>
							<input id = "name" class = "form-control" type="text">
						</div>
						<div class="form-line">
							<label for = "email" class = "form-label">E-mail</label>
							<input id = "email" class = "form-control" type="text">
						</div>
						<div class="form-line">
							<label for = "subject" class = "form-label">Subject</label>
							<input id = "subject" class = "form-control" type="text">
						</div>
						<label for = "mail_body" class = "form-label">Mail Body</label>
						<div class="form-line">
							<textarea id = "mail_body" class = "form-control" type="" style="resize:none"></textarea>
						</div>
						<a id = "submit" type = "button" class="btn btn-primary m-t-15 waves-effect" href="">Send</a>
					</div>
					</div>
					<script type = "text/javascript">
						$('#name').blur(function(){
							if( !$(this).val() ) {
								$(this).parents('p').addClass('warning');
							}
						});
					</script>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
</body> 
</section>
<?php
  include "../include/footer.php";
?>  