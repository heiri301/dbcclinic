<?php
//error_reporting(E_ALL & ~E_WARNING );
include_once 'classes/appointments.cls.php';

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data["data"]) && $data["type"] == 'ApptDataSet') {
    $setAppt = new Appointment();
    $searchRes = $setAppt->setAppointmentData($data["data"]);
    echo json_encode($searchRes);
}

if (isset($data["data"]) && $data["type"] == 'ApptSearch') {
    $setAppt = new Appointment();
    $searchRes = $setAppt->getAppointmentData($data);
    echo json_encode($searchRes);
}

if (isset($data["data"]) && $data["type"] == 'ApptGetDataUUID') {
    $setAppt = new Appointment();
    $searchRes = $setAppt->getappt_UUID($data["data"]);
    echo json_encode($searchRes);
}

if (isset($data["data"]) && $data["type"] == 'ApptDataUpdate') {
    $setAppt = new Appointment();
    $searchRes = $setAppt->updateAppointmentData($data["data"]);
    echo json_encode($searchRes);
}

if (isset($data["data"]) && $data["type"] == 'ApptDataDelete') {
    $setAppt = new Appointment();
    $searchRes = $setAppt->deleteAppointmentData($data["data"]);
    echo json_encode($searchRes);
}