<?php
  include "../include/header.php";
  include "../query/disease.php";
  
  $dis=new DISEASE();
  
 if(isset($_POST['disid']))
 {
	$dis->deletelist_desease($db1,$_SESSION['pid']); 
	$disidlist=$_POST['disid'];
	for($j=0;$j<=count($disidlist)-1;$j++){	 
		$dis->addlist_desease($db1,$_SESSION['pid'],$disidlist[$j]);	
	} 	
 } 	

  $dislist=$dis->getlist_desease($db1);
  $activedislist=$dis->getpersonallist_desease($db1,$_SESSION['pid']); 
 
?>
<body class="theme-blue"> 
<section class="content">
 	<div class="container-fluid">    
 		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h3>PATIENT DISEASE LIST</h3>
							<span>TODO: set as pop up/modal via Ajax request or Jquery</span>
							<?php include "../include/patientmgmt_header.php"; ?>
						</div>		 
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<form action="diseaselist.php" method="POST">.
			<?php 	
				for($i=0;$i<=count($dislist)-1;$i++)
				{	
				if(in_array($dislist[$i]['disid'],$activedislist))
					echo '<input type="checkbox" id="dis'.$i.'" name="disid[]" value="'.$dislist[$i]['disid'].'" checked>';
				else 
					echo '<input type="checkbox" id="dis'.$i.'" name="disid[]" value="'.$dislist[$i]['disid'].'">';
				echo '<label for="dis'.$i.'">'.$dislist[$i]['disease'].'</label>'; 				
				echo '<br>';
				}
			?>	
			<div><input type="submit" button class="btn btn-primary m-t-15 waves-effect" data-type="success" value="Update"></div>
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
