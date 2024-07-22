<?php
error_reporting(E_ALL & ~E_WARNING );
require_once "classes/login.cls.php";

$data = json_decode(file_get_contents("php://input"), true);

// Pass username and password to class  
$username = $data["username"];
$password = $data["password"];

$login_check = new Login($username,$password);

if (isset($data["username"]) && isset($data["password"])) {
    $data = $login_check->userLogin($username,$password); 
    $loginSuccessVal = $login_check->userloginVerify($data);

    if ($loginSuccessVal == 0) {
        $loginTryCountVal = $login_check->loginTryCountSetter($loginSuccessVal);
        $displayLoginAlertDivType = $login_check->showLoginAlerttoDiv(($loginSuccessVal));
        $_SESSION['loginSuccessful'] = 0;

    }
    if ($loginSuccessVal == 1) {
        $displayLoginAlertDivType = $login_check->showLoginAlerttoDiv(($loginSuccessVal));
        $_SESSION['loginSuccessful'] = 1;
    }

    $dataResponse = Array ( 'displayLoginAlertDivType' => $displayLoginAlertDivType, 'username' => $data['username'], 'userClass' => $data['user_type'], 'loginSuccessful' => $_SESSION['loginSuccessful']);

    echo json_encode($dataResponse);
}

