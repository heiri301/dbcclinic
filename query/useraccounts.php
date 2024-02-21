<script src="../plugins/jquery/jquery.min.js"></script>
<?php
    /* 
      todo: (02/21/23)
      - fix sitewide session mechanism
    */
    class USERACCOUNTS{
      function verify_user($db,$username,$password)
      {
        $stmt1 = $db->prepare("SELECT * FROM `useraccounts` where `username`=? and `password`=?");
        $stmt1->execute(array($username,sha1($password)));
        return $stmt1->rowCount();
      }
      /*
      function trycount(){
        $stmt = $db->prepare("INSERT INTO `useraccounts` VALUES (?)")
      }
      */
      #function create_user(){}

      #function modify_user(){}

      function getinfo_user($db,$username,$password)
      {
        $stmt1 = $db->prepare("SELECT * FROM `useraccounts` where `username`=?");
        $stmt1->execute(array($username,sha1($password)));
        $data=$stmt1->fetch(PDO::FETCH_ASSOC);
        return $data;
      }
    }
?>