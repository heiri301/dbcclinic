<?php
  class CHECKUPDETAILS
	{
       function getlist_checkupdtails($db)
       {
	      $data=array();
        $stmt1 = $db->prepare("SELECT * FROM `checkupdtails`");
        $stmt1->execute();
		    for($i=0;$i<=$stmt1->rowCount()-1;$i++)
          $data[]=$stmt1->fetch(PDO::FETCH_ASSOC);
        return $data;
       }
  
	     function addlist_checkupdtails($db,$pid,$date,$time,$diagnosis,$actiontaken,$prescription)
       {
	        $stmt1 = $db->prepare("INSERT INTO `checkupdtails` VALUES (?,?,?,?,?,?)");
          $stmt1->execute(array($pid,$date,$time,$diagnosis,$actiontaken,$prescription)); 
       }
	}
?>
