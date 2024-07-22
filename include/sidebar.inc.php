<aside id="leftsidebar" class="sidebar">
	<div class = "sidebar-brand">
		<span><h5>DBC-CMS-D</h5></span>
	</div>
	<div class="menu">
		<ul class="list">
			<li class="">
				<a href="mainpage.php">
					<i class="material-icons">home</i>
					<span>Dashboard</span>
				</a>
				<a ref="javascript:void(0);" class="menu-toggle">
					<i class="material-icons">local_hospital</i>
					<span>Manage EHR</span>
				</a>
				<ul class="ml-menu">
					<li><a href="managepatient.php"><span>Manage Patient</span></a></li>
					<li><a href="appointments.php"><span>Patient Logs</span></a></li>
				</ul>
			</li>
			<a href = "usersettings.php">
				<i class="material-icons">account_circle</i>
				<span>Manage User</span>
			</a>
			<!--
			<a href="javascript:void(0);">
				<i class="material-icons">help</i>
				<span>Help</span>
			</a>
			-->
		</ul>
	</div>

	<div class="left-sidebar-lower">
		<div class = "d-flex justify-content-between userinfo-wrapper">
			<a href = "#" class = "d-flex justify-content-start user-info-brief waves-effect" id="dropdownsidebaruserinfo" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
				<i class="material-icons">account_circle</i>
				<span id = "lsidebar-userinfo">Username</span>
			</a>
			<a href = "#" class = "settings-gear">
				<i class="material-icons waves-effect">settings</i>
			</a>
			<div class="dropdown-menu" aria-labelledby="dropdownsidebaruserinfo">
				<a class="dropdown-item" href="../dev/usersettings.php"><i class="material-icons">person</i>Profile</a>
				<div class="dropdown-divider"></div>
				<button class="dropdown-item" id = "sidebarLogoutBtn"><i class="material-icons">input</i>LogOut</button>
			</div>
		</div>
	</div>
</aside>
<!--
<div class="user-info-dropdown">
	<li><a href="javascript:void(0);" class=" waves-effect waves-block"><i class="material-icons">person</i>Profile</a></li>
	<li role="separator" class="divider"></li>
	<li><a href="javascript:void(0);" class=" waves-effect waves-block"><i class="material-icons">group</i>Followers</a></li>
	<li><a href="javascript:void(0);" class=" waves-effect waves-block"><i class="material-icons">shopping_cart</i>Sales</a></li>
	<li><a href="javascript:void(0);" class=" waves-effect waves-block"><i class="material-icons">favorite</i>Likes</a></li>
	<li role="separator" class="divider"></li>
	<li><a href="javascript:void(0);" class=" waves-effect waves-block"><i class="material-icons">input</i>Sign Out</a></li>
</div>
-->
