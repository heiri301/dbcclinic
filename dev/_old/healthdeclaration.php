<?php
  include "../include/header.php";
?>
<body class="theme-blue">  
<section class="content">
	<div class="container-fluid">
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2>Health Declaration</h2>
						<ul class="header-dropdown m-r--5">
							<li class="dropdown">
								<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
									<i class="material-icons">more_vert</i>
								</a>
								<ul class="dropdown-menu pull-right">
									<li><a href="javascript:void(0);">Action</a></li>
									<li><a href="javascript:void(0);">Another action</a></li>
									<li><a href="javascript:void(0);">Something else here</a></li>
								</ul>
							</li>
						</ul>
					</div>
					<div class="body">
						<form>
							<div class="form-group form-float">
								<div class="form-line">
										<form>
											<label for="datemin">Enter a date:</label>
											<input type="date" id="datemin" name="datemin" min="01-01-2000" max="07-10-2022"><br><br>
										</form>
								</div>
							</div>
							
							<div class="form-group form-float">
								<div class="form-line">
									<label for="time">Time</label>
									<input type="time" id="time" placeholder="Time" value="00:00">
									
								</div>
							</div>
							<div class="form-group form-float">
								<div class="form-line">
									<label for="temp">Temperature</label>
									<input type="number" id="temp" min="0" max="100">
									<label for="temp">degrees</label><br>
									<input type="checkbox" id="temp1" name="temp" value="Celcius">
									<label for="temp1">Celcius</label><br>
									<input type="checkbox" id="temp2" name="temp" value="Celcius">
									<label for="temp2">Fahrenheit</label><br>
								</div>
							</div>						
							<br>
							<button type="button" class="btn btn-primary m-t-15 waves-effect">Submit</button>
						</form>
					</div>
				</div>
			</div>
		</div> 
	</div>
</section>  
<?php
  include "../include/footer.php";
?>
</body> 