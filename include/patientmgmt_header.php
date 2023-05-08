<!--JQuery script to highlight current page on header:-->
<!--Body header/navigator-->
<ul class="nav nav-tabs tab-nav-right" role="tablist-body">
	<li role="presentation"><a href="#">Add/Load Patient Profile</a></li>
	<li role="presentation"><a href="managepatient.php">Search Patient / Profile</a></li>
	<!-- <li role="presentation"><a href="mailer.php">Contact Patient</a></li> -->
	<li role="presentation"><a href="#">Consultation List</a></li>
</ul><br>



<!-- Miscellaneous Scripts -->

<script type = "text/javascript">
	$(function(){
	var pathname = (window.location.pathname.match(/[^\/]+$/)[0]);
	$("[role='tablist-body'] li a").each(function(){
			//alert($(this).attr("href"));
			if ($(this).attr("href") == pathname){	
				$(this).addClass('active');
			}
			if ($(this).attr("class") == 'active'){
				$(this).parents("li").addClass('active');
			}
		});
	});
</script>
