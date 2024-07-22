<?php
    class db1 {
        private $server1='localhost';
        private $database1='groupa';
        private $username1='groupa'; 
        private $password1='password';  
        protected function conn() {
            try {
                $db1 = new PDO('mysql:host='.$this->server1.';dbname='.$this->database1.';charset=utf8', $this->username1, $this->password1);
                return $db1;
            }
            catch(PDOException $ex) {
                echo "<b>There is an error connecting to the database. Please contact the Administrator to address this problem.</b>Reason:<br>".$ex; 
                die();
            }
        }
    }
?>