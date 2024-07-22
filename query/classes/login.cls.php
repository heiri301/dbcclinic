<?php 
require "../core/conn.ini.php";

class Login extends db1 {
    private $username;
    private $password;
    function __construct($username,$password){
        $this->username = $username;
        $this->password = $password;
    }

    //gets user login data from credentials.
    function userLogin($username,$password){        
        session_start();
        try { 
            $sql = "SELECT * FROM `useraccounts` WHERE `username` = ? ";
            $stmt = parent::conn()->prepare($sql);
            $stmt->execute(array($this->username)); 
            $loginData = $stmt->fetch(PDO::FETCH_ASSOC);
            return $loginData;
        }
        catch(PDOException $ex){
            echo '<b>There is an error connecting to the database.</b><br>';
            echo $ex;
            echo json_encode(array ('loginformAlert' => '4'));
        }           
        // send user data
        
    }

    //Login credential authentication logic
    function userloginVerify($loginData){
        $loginSuccessVal = 0;
        try {
            if(is_array($loginData) && isset($loginData)){
                $hashpassVal = password_verify($this->password,$loginData["pwhash"]);
                if($hashpassVal != true) {
                    $loginSuccessVal = 0;
                    return $loginSuccessVal;
                }
                else{
                    $loginSuccessVal = 1;
                    return $loginSuccessVal;
                }
            }
            else{
                $loginSuccessVal = 0;
                return $loginSuccessVal;
            }      
        }
        catch(PDOException $ex){
            echo '<b>There is an error connecting to the database.</b><br> '.$ex;
            echo json_encode(array ('loginformAlert' => '4'));
        }
    }

    // Logs the number of unsuccessful login attempts made by the user.
    function loginTryCountSetter ($loginSuccessVal) {
        if($loginSuccessVal != 1) {
            $_SESSION['loginTCVal'] = $_SESSION['loginTCVal'] + 1;
        }
        $loginTryCountVal = $_SESSION['loginTCVal'];

        return $loginTryCountVal;
    }

    function showLoginAlerttoDiv ($loginSuccessVal) {
        /*
            1 - login failure
            2 - login success 
            3 - login timeout
            4 - server error
        */
        if ($loginSuccessVal == 1) {
            $displayLoginAlertDivType = 2;
            return $displayLoginAlertDivType;
        }
        if ($loginSuccessVal == 0 && $_SESSION['loginTimeoutActive'] != 1) {
            $displayLoginAlertDivType = 1;
            return $displayLoginAlertDivType;
        }    
        if ($loginSuccessVal == 0) {
            $displayLoginAlertDivType = 3;
            return $displayLoginAlertDivType;
        }
        else {
            $displayLoginAlertDivType = 4;
            return $displayLoginAlertDivType;          
        }
    }

    function submitReq ($data) {
        echo json_encode($data);
        return $data; 
    }

// == WIP / Work In Progress ==

    // Times out the user if certain tries are reached for 30 seconds
    function timeoutUserLogin () {  
        $_SESSION['loginTCVal'] = 0;
        $_SESSION['loginTimeoutVal'] = $_SESSION['loginTimeoutVal'] + 1;
    }

    // The timeout token will be sent to the server so it can be accessed again even if the user decides to clear session
    function setTimeoutToken() {
        $username = $_SESSION['username'];
        $tokentype = 'userTimeout';
        $token = bin2hex(random_bytes(16));

        try { 
            $sql = "INSERT INTO usersession (token, username, tokentype) VALUES (?,?.?)";
            $stmt = parent::conn()->prepare($sql);
            $stmt->execute(array($token,$username,$tokentype)); 
            
            //$loginData = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        catch(PDOException $ex){
            echo '<b>There is an error connecting to the database.</b><br>';
            echo $ex;
        }          
    }

    // Get timeout token 
    /*
    function getTimeoutToken() {
        try { 
            $sql = "";
            $stmt = parent::conn()->prepare($sql);
            $stmt->execute(array()); 
            
            $timeoutTokenData = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        catch(PDOException $ex){
            echo '<b>There is an error connecting to the database.</b><br>';
            echo $ex;
        }         
    }
    */
}
  
