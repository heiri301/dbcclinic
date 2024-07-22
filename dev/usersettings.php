<!-- USER SETTINGS -->
<?php
	include "../include/header.inc.php";
?>  
<body class="theme-blue"> 
	<section class = "content">
 		<div class="container-fluid">
			<div class = "row">
				<div class = "card">
					<div class = "header">
						<h3>User Information and Settings</h3>
					</div>
					<div class = "body ">
						<div class = "row clearfix d-flex justify-content-center">
							<div class="col-sm-2" ></div>
							<div class="col-sm-2">
								<div class = "menu inner-sidebar">
									<ul class = "list">
										<a href="javascript:void(0);"><span>User Information</span></a>
										<a href="javascript:void(0);"><span>Site-Specific Settings</span></a>
										<a class = "danger" id = "userInfoLogoutBtn"><span class = "text-white">Log Out</span></a>
									</ul>
								</div>
							</div>
							<div  class="col-lg" id = "page_usr_settings_information">
								<h4>User Information</h4>
								<p><strong>Username: </strong><span id = 'get_usr_settings_UserName'></span></p>
								<p><strong>Class: </strong><span id = 'get_usr_settings_UserClass'></span></p>
								<p><strong>E-mail Address: </strong><span id = 'get_usr_settings_Email'>Email</span></p>
							</div>
							<div class="col-sm-2" ></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
<script type = "text/javascript" src = "../js/usermanagment.js"></script>
<?php
  include "../include/footer.inc.php";
?> 
