<!--JQuery script to highlight current page on header:-->
<!--Body header/navigator-->
<ul class="nav nav-tabs tab-nav-right" role="tablist-body">
	<li role="presentation"><a href="#">Add/Load Patient Profile</a></li>
	<li role="presentation"><a href="managepatient.php">Search Patient / Profile</a></li>
	<!-- <li role="presentation"><a href="mailer.php">Contact Patient</a></li> -->
	<li role="presentation"><a href="#">Consultation List</a></li>
</ul><br>
<ul class="header-dropdown md-5">
	<li class="dropdown">
		<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			<i class="material-icons">more_vert</i>
		</a>
		<ul class="dropdown-menu pull-right">
			<li><a href="javascript:void(0);">Settings</a></li>
		</ul>
	</li>
</ul>
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
