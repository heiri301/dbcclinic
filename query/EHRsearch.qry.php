<?php
    error_reporting(E_ALL & ~E_WARNING );
    include_once 'classes/patient.cls.php';

    $data = json_decode(file_get_contents("php://input"), true);
    
    if (isset($data["data"]) && $data["type"] == 'EHRQueryReq') {
        $patient = new Patient();
        $searchRes = $patient->getlist_patient($data);
        echo json_encode($searchRes);
    }

    if (isset($data["data"]) && $data["type"] == 'EHRDivReq') {
        $patient = new Patient();
        $searchRes = $patient->getprofile_patient($data["data"]);
        echo json_encode($searchRes);
    }

    if (isset($data["data"]) && $data["type"] == 'EHRGetDisList') {
        $patient = new Patient();
        $listDislist = $patient->getDiseaseListAndInfo($data);
        echo json_encode($listDislist);
    }

    if (isset($data["data"]) && $data["type"] == 'EHRSetDisList') { // set = update
        $patient = new Patient(); 
        $res = $patient->setDiseaseList($data["data"]);
        echo json_encode($res);
    }

    if (isset($data["data"]) && $data["type"] == 'importFromCSV') {
        $patient = new Patient();
        $successStatus = $patient->importPatientfromCSV($data["data"]);
        echo json_encode($successStatus);
    }

    if (isset($data["data"]) && $data["type"] == 'EHRUpdData') {
        $setAppt = new Patient();
        $sendResponse = $setAppt->setprofile_patient($data);
        echo json_encode($sendResponse);
    }
