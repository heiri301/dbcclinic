<?php
require "session.ini.php";
error_reporting(E_ALL & ~E_WARNING);
$data = json_decode(file_get_contents("php://input"), true);

session_start();
//check session
//echo json_encode($data['storedLoginSession']);

if (isset($data)) {
    $checkUsrSession = new userSession();
    $sessionTokenData = $checkUsrSession->getSessionToken($data['storedLoginSession']);
    $tokenAuthenticatedValue = $checkUsrSession->checkCurrentSession($sessionTokenData['tokenData']['token'], $data['storedLoginSession']);
    echo json_encode($tokenAuthenticatedValue);
}
else {
    json_encode("data is not set for this session!");
}

