<!DOCTYPE html>
<html>
<head>
	<?php 
		include 'include/header.php';
	?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>DBClinic - Patient Form</title>
</head>
<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href=" ">DBClinic - PATIENT FORM</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->
                    <!-- Notifications 
						TODO: make notifications 'importable'
					-->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                            <span class="label-count">X</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFICATIONS</li>
                            <li class="body">
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Notifications</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Notifications -->
                    <!-- Tasks -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">flag</i>
                            <span class="label-count">X</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">TASKS</li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Tasks -->
                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
	<!-- MAIN BODY -->
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>PATIENT FORM - ADD NEW PATIENT</h2>
            </div>
            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
				<div class="header">
					<h2>PATIENT FORM - ADD NEW PATIENT</h2>
				</div>
				<div class = "body">
				<form>
					<h4>Patient Name</h4>
						<div class="form-group form-float">
							<div class="form-line">
								<input type="text" id="lname" class="form-control" placeholder="Last Name">
							</div>
							<div class="form-line">
								<input type="text" id="fname" class="form-control" placeholder="First Name">
							</div>
							<div class="form-line">
								<input type="text" id="mname" class="form-control" placeholder="Middle Name">
							</div>
						</div>
					<h4>Address</h4>
						<div class="form-line">
							<input type="text" id="address" class="form-control" placeholder="Address">
						</div>
					<h4>Weight / Height</h4>
						<div class="form-line">
							<input type="text" id="weight" class="form-control" placeholder="Weight">
						</div>
						<div class="form-line">
							<input type="text" id="height" class="form-control" placeholder="Height">
						</div>
					<h4>Birthday</h4>
						<b>INSERT DATE BASED FORM HERE</B><br>
					<h4>Gender</h4>
						<input type="checkbox" id="gender_1" class="filled-in">
						<label for="gender_1">Male</label>
						<input type="checkbox" id="gender_2" class="filled-in">
						<label for="gender_2">Female</label>
						<input type="checkbox" id="gender_3" class="filled-in">
						<label for="gender_3">Other</label>
					<h4>Contact No.</h4>
						<div class="form-line">
							<input type="text" id="contactno" class="form-control" placeholder="Contact No.">
						</div>
					<button type="button" class="btn btn-primary m-t-15 waves-effect">Submit</button>
				</form>
				</div>
				</div>
				</div>
			</div>
		</div>
    </section>
	<?php 
		include 'include/footer.php';
	?>
</body>
</html>
