<?php
require_once "../core/session.ini.php";
error_reporting(E_ALL & ~E_WARNING);
session_start();

if($_SESSION['loginSuccessful'] == 1) {

    unset($_SESSION['loginTCVal']); 
    unset($_SESSION['loginTimeoutVal']);
    unset($_SESSION['loginSuccessVal']);
 
    $newUsrSession = new userSession();
    $newUsrToken = $newUsrSession->generateUserToken();
    $newUsrDate = $newUsrSession->setSessionDate();
    $newUsrSession->setSessionToken($newUsrToken,$newUsrDate);

    unset($_SESSION['loginSuccessful']);
    
    $sendData = array( 'userToken' => $newUsrToken, ); 
    echo json_encode($sendData);
}
