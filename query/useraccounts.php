<?php
    class USERACCOUNTS{
        function verify_user($db,$username,$password)
        {
          $stmt1 = $db->prepare("SELECT * FROM `useraccounts` where `username`=? and `password`=?");
          $stmt1->execute(array($username,sha1($password)));
          return $stmt1->rowCount();
        }

        #function create_user(){}

        #function modify_user(){}

        function getinfo_user($db,$username,$password)
        {
          $stmt1 = $db->prepare("SELECT * FROM `useraccounts` where `username`=? and `password`=?");
          $stmt1->execute(array($username,sha1($password)));
          $data=$stmt1->fetch(PDO::FETCH_ASSOC);
          return $data;
        }
    }

?>