<?php
    class HEALTHDECLARATION
	{
       function getlist_desease($db)
       {
	     $data=array();
         $stmt1 = $db->prepare("SELECT * FROM `illness`");
         $stmt1->execute();
		 for($i=0;$i<=$stmt1->rowCount()-1;$i++)
			$data[]=$stmt1->fetch(PDO::FETCH_ASSOC);
         return $data;
       }
	   
	   function addlist_desease($db,$pid,$disid)
       {
	     $stmt1 = $db->prepare("INSERT INTO `personaldiseaserecord` VALUES (?,?)");
         $stmt1->execute(array($pid,$disid)); 
       }
	}

?>