<?php
    class DISEASE{
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
	   
	   function getpersonallist_desease($db,$pid)
       {
            $data=array();  
            $stmt1 = $db->prepare("SELECT * FROM `personaldiseaserecord` WHERE `pid`=?");
            $stmt1->execute(array($pid)); 
            for($i=0;$i<=$stmt1->rowCount()-1;$i++)
            {	 
               $d=$stmt1->fetch(PDO::FETCH_ASSOC);
               $data[]=$d['disid'];
            }	
		    return $data;
       }
	   
	   function deletelist_desease($db,$pid)
       {
	         $stmt1 = $db->prepare("DELETE FROM `personaldiseaserecord` WHERE `pid`=?");
            $stmt1->execute(array($pid)); 
            //include provisions when pid has only one value - preventing the record to be deleted completely.
       }
    }
?>