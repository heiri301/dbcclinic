<?php
// DO NOT REMOVE!!!!
   include "../core/connection.ini";
   session_start();
// DO NOT REMOVE!!!!

?>   
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<!-- Favicon-->
<link rel="../icon" href="favicon.ico.temp" type="image/x-icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

<!-- Bootstrap Core Css -->
<link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

<!-- Waves Effect Css -->
<link href="../plugins/node-waves/waves.css" rel="stylesheet" />

<!-- Animation Css -->
<link href="../plugins/animate-css/animate.css" rel="stylesheet" />

<!-- Morris Chart Css-->
<link href="../plugins/morrisjs/morris.css" rel="stylesheet" />

<!-- Custom Css -->
<link href="../css/style.css" rel="stylesheet">

<!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
<link href="../css/themes/all-themes.css" rel="stylesheet" />

<script src="../plugins/jquery/jquery.min.js"></script>
</head>

<!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="Search...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
<!-- ====NAVBAR / TOPBAR==== -->
<nav class="navbar">
	<div class="container-fluid">
		<div class="navbar-header">
			<a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
			<a href="javascript:void(0);" class="bars"></a>
			<a class="navbar-brand" href=" "><strong>DBCClinic</strong></a>
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
	
<!-- ==== RIGHT SIDEBAR ==== -->
<section>
	<aside id="rightsidebar" class="right-sidebar">
		<ul class="nav nav-tabs tab-nav-right" role="tablist">
			<li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
			<li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
		</ul>
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane fade in active in active" id="skins">
			</div>
			<div role="tabpanel" class="tab-pane fade" id="settings">
				<div class="demo-settings">
					<p>GENERAL SETTINGS</p>
					<ul class="setting-list">
						<li>
							<span>Toggle Dark Mode</span>
							<div class="switch">
								<label><input type="checkbox" checked><span class="lever"></span></label>
							</div>
						</li>
					</ul>
					<p>MISCELLANEOUS SETTINGS</p>
					<ul class="setting-list">
						<li>
							<span>Contact Administrator</span>
							<div class="switch">
								<label><input type="checkbox" checked><span class="lever"></span></label>
							</div>
						</li>
					</ul>
					<p>ACCOUNT SETTINGS</p>
					<ul class="setting-list">
					</ul>
				</div>
			</div>
		</div>
	</aside>
</section>
<!--==== END OF RIGHT SIDEBAR ====-->