<?php
    class PATIENT{
       function getlist_patient($db,$searchtext,$search_filter){
          if($search_filter==1){
            $data=array();
            $stmt1 = $db->prepare("SELECT * FROM `patient` where `lname` LIKE ?");
            $stmt1->execute(array($searchtext.'%'));
            for($i=0;$i<=$stmt1->rowCount()-1;$i++)
              $data[]=$stmt1->fetch(PDO::FETCH_ASSOC);
            return $data;
          }

          if($search_filter==2){
            $data=array();
            $stmt1 = $db->prepare("SELECT * FROM `patient` where `fname` LIKE ?");
            $stmt1->execute(array($searchtext.'%'));
            for($i=0;$i<=$stmt1->rowCount()-1;$i++)
              $data[]=$stmt1->fetch(PDO::FETCH_ASSOC);
            return $data;
          }
       }
	   
	   function getprofile_patient($db,$pid){
         $stmt1 = $db->prepare("SELECT * FROM `patient` where `pid` = ?");
         $stmt1->execute(array($pid));
		     $data=$stmt1->fetch(PDO::FETCH_ASSOC);
         return $data;
       }
    }

?>