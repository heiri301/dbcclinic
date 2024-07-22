<?php
    require "../core/conn.ini.php";
    class UserAccounts {
        private $user_uid; 
        private $name;
        private $username;
        private $password;
        private $user_type; // Superuser, Admin, User
        private $user_email;  

    // Class constructor
    public function __construct($user_uid,$name,$username,$password,$user_type,$user_email) {
        $this->user_uid = $user_uid;
        $this->name = $name;
        $this->username = $username;
        $this->password = $password;
        $this->user_type = $user_type;
        $this->user_email = $user_email;
    }

    public function getUserAcct(){
        
    } 

    //User Creation - Superusers and admins are only allowed access to this function. Admins however are only allowed to create new ordinary users
    public function newUserAcct(){
        
    } 
    
    //Admin and user are not allowed access to modify user_type to avoid privilege escalation (IF statement). Existing Password is required before modifying user details (passdecodeHash())   
    public function modifyUseracct(){
        
    } 

    //hash a password on creating a new account and updating an already extisting account
    public function passwordHashFunc(){
        /*
            $encodestring = "yay";
            $encodeHash = password_hash($encodestring, PASSWORD_DEFAULT);
            $sql = "UPDATE `useraccounts` SET `pwhash` = ? WHERE `username` = 'admin'";
            $stmt = parent::conn()->prepare($sql);
            $stmt->execute(array($encodeHash));   
        */
    } 

    //Superuser accounts cannot be deleted!
    public function deleteUseracct(){
        
    } 
}
?>