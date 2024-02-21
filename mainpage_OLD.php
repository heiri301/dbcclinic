<?php 
	include 'include/header.php';
	include 'core/connection.ini';
?>
<!DOCTYPE html>
<html>
<head>
    <title>DBClinic - MAIN PAGE</title>
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
    <!-- #Top Bar - MOVED TO FOOTER.INC-->
    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
			</div class = "header">
				<span class = "placeholder"><h2>Welcome!</h2></span>
			</div>
		</div>
    </section>
<?php 
	include 'include/footer.php';
?>
</body>
</html>