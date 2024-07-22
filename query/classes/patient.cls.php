<?php

//*================================== PATIENT SEARCH ==================================*       

include_once '../core/conn.ini.php';
class Patient extends db1 {
    function getlist_patient($searchdata){
        // Get page number
        $rowPerPagePaginate = 10; // 10 rows
        $sql= "SELECT * FROM `patient` WHERE `lname` LIKE ?";
        $stmt1 = parent::conn()->prepare($sql);
        $stmt1->execute(array('%'.$searchdata['data'].'%'));
        $data_rc = $stmt1->rowCount();

        // Pagination
        $pageNumPaginate = ceil($data_rc / $rowPerPagePaginate);
        $pagePaginateStart = ($searchdata['currPageSel'] - 1) * $rowPerPagePaginate; 

        // retrieve data
        $sql= "SELECT * FROM `patient` WHERE `lname` LIKE ? LIMIT {$pagePaginateStart},{$rowPerPagePaginate}";
        $stmt2 = parent::conn()->prepare($sql);
        $stmt2->execute(array('%'.$searchdata['data'].'%'));
        $data = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        // retrieve Department values

        $sendResponse = array ( 
            'searchRes'=>$data, 
            'queryData'=>$searchdata['data'], 
            'searchRC'=>$data_rc, 
            'rowPerPagePaginate'=>$rowPerPagePaginate,
            'pagePaginateStart'=>$pagePaginateStart,
            'pageNumPaginate'=>$pageNumPaginate,
            'currPageSel'=>$searchdata['currPageSel']
        );
        return $sendResponse;
    }

    function getprofile_patient($pid){
        $sql = "SELECT * FROM `patient` where `pid` = ?";
        $stmt1 = parent::conn()->prepare($sql);
        $stmt1->execute(array($pid));
        $data=$stmt1->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    function setprofile_patient($data){
        try {
            $sql = "UPDATE `patient` SET `weight`=?, `height`=? WHERE `pid`=?";
            $stmt1 = parent::conn()->prepare($sql);
            $stmt1->execute(array($data['data']['weight'],$data['data']['height'],$data['data']['pid']));

            $sendRes = array(   
                'alerttype' => 'EHRQueryUpdSuccess',
                'alertinfo' => [
                    'alertType' => 'alert-success',
                    'dataIcon' => 'check_circle',
                    'dataText' => 'Data updated successfully.',
                ],
                'data' => $data
            );
            return $sendRes;
        }
        catch (Exception $e) {
            $sendRes = array(   
                'alerttype' => 'EHRQueryUpdFail',
                'alertinfo' => [
                    'alertType' => 'alert-danger',
                    'dataIcon' => 'cancel',
                    'dataText' => 'Data update unsuccessful. Please inform the Administrator about this issue.',
                    'dataTextError' => $e,
                ],
            );
            return $sendRes;
        }
    }

    function getDiseaseListAndInfo($data){ 
        // get current / active disease list data
        $pid = $data['data'];
        $sqlPidCheck = "SELECT EXISTS(SELECT pid FROM `patient_disrecord` WHERE `pid` = {$pid})";
        $stmt2 = parent::conn()->prepare($sqlPidCheck);
        $stmt2->execute();
        $pidCheckData = $stmt2->fetch(PDO::FETCH_ASSOC);
        $pidCheckVal = array_values($pidCheckData);

        if ($pidCheckVal[0] == '0') {
            $sqlAddPid = "INSERT INTO `patient_disrecord` (`pid`) VALUES ({$pid})";
            $stmt3 = parent::conn()->prepare($sqlAddPid);
            $stmt3->execute();            
        }

        // Get List of Illnesses 
        $stmt1 = parent::conn()->prepare("SELECT * FROM patient_illnesstypes");
        $stmt1->execute();
        $dislistData = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        
        $sqlReadPid = "SELECT disid FROM `patient_disrecord` WHERE pid = {$pid}";
        $stmt5 = parent::conn()->prepare($sqlReadPid);
        $stmt5->execute();
        $getPidData = $stmt5->fetchAll(PDO::FETCH_ASSOC);
        
        $sendResponse = array (
            'disList'=>$dislistData, 
            'pidDisList'=>$getPidData['0']['disid']
        );
    
        return $sendResponse;
    }

    function setDiseaseList($data){
        try {
            $EHR_pid = $data['pid'];
            $EHR_piddislist = rtrim(implode(',', $data['dislistChecked']), ',');
            $set_dislistsql = "INSERT INTO `patient_disrecord` (`pid`,`disid`) VALUES ({$EHR_pid},'{$EHR_piddislist}') ON DUPLICATE KEY UPDATE `disid` = '{$EHR_piddislist}';";
            $stmt1 = parent::conn()->prepare($set_dislistsql);
            $stmt1->execute();
            $importStats = array(
                    'alertType' => 'alert-success',
                    'dataIcon' => 'check_circle',
                    'dataText' => 'Patient Health Record updated successfully.',
            );
        }
        catch (Exception $e) {
            $importStats = array(
                'alertText'=>"There is an error while processing the database. Please inform the Administrator about this issue.",
                'alertIcon'=>"cancel",
                'alertErrText'=>$e,
            );
            return $importStats;
        }

        return $importStats;
     }

    function importPatientfromCSV($data) {
        // check for sid match, if true then update else insert data into DB 
        $dataCount = count($data);
        try {
            for($i = 0;$i < $dataCount; $i++) {
                $sqlSidCheckStmt = "SELECT EXISTS(SELECT sid FROM `patient` WHERE sid = '{$data[$i]['sid']}')";
                $stmt1 = parent::conn()->prepare($sqlSidCheckStmt);
                $stmt1->execute();
                $sidCheckData = $stmt1->fetch(PDO::FETCH_ASSOC);
                $sidCheckVal[$i] = implode(array_values($sidCheckData));
                
                if ($sidCheckVal[$i] !== '1') {
                    $sqlInsertDataFromCSV = "INSERT INTO `patient` (`fname`,`lname`,`mname`,`address`,`birthday`,`gender`,`contactno`,`sid`,`dept`) VALUES (?,?,?,?,?,?,?,?,?)"; 
                    $stmt2 = parent::conn()->prepare($sqlInsertDataFromCSV);  
                    $stmt2->execute(array($data[$i]['fname'],$data[$i]['lname'],$data[$i]['mname'],$data[$i]['address'],$data[$i]['birthday'],$data[$i]['gender'],$data[$i]['contactno'],$data[$i]['sid'],$data[$i]['dept']));

                    $importValueHasMatchCnt++;
                }
                else {
                    $sqlUpdDataFromCSV = "UPDATE `patient` SET `fname`=?,`lname`=?,`mname`=?,`address`=?,`birthday`=?,`gender`=?,`contactno`=?,`dept`=? WHERE `sid`=?"; 
                    $stmt3 = parent::conn()->prepare($sqlUpdDataFromCSV);  
                    $stmt3->execute(array($data[$i]['fname'],$data[$i]['lname'],$data[$i]['mname'],$data[$i]['address'],$data[$i]['birthday'],$data[$i]['gender'],$data[$i]['contactno'],$data[$i]['dept'],$data[$i]['sid']));

                    $importValueHasNoMatchCnt++;
                }
            }
        }
        catch(Exception $e) {
            $importStats = array(
                'alertStatus'=>'danger',
                'alertText'=>"There is an error while processing the database. Please inform the Administrator about this issue.",
                'alertIcon'=>"cancel",
                'alertErrText'=>$e,
            );
        }
        
        $importStats = array(
            'alertStatus'=>'success',
            'alertText'=>"Encoding Successful.<br> Successfully processed ".$dataCount." entries",
            'alertIcon'=>"check_circle",
        );
        
        return $importStats;
    }

    function getApptDataFromPID ($pid) {
        // Get page number
        $query = '%'.$pid["data"]["query"].'%';
        //echo json_encode($query);
        $rowPerPagePaginate = 10; // 10 rows
        $sql= "SELECT * FROM `appointment` WHERE `appt_subject` LIKE ? AND `pid` LIKE ?";
        $stmt1 = parent::conn()->prepare($sql);
        $stmt1->execute(array($query,$pid["data"]["pid"]));
        $data_rc = $stmt1->rowCount();

        // Pagination
        $pageNumPaginate = ceil($data_rc / $rowPerPagePaginate);
        $pagePaginateStart = ($pid['currPageSel'] - 1) * $rowPerPagePaginate; 

        // retrieve data
        $sql= "SELECT * FROM `appointment` WHERE `appt_subject` LIKE ? AND `pid` LIKE ? LIMIT {$pagePaginateStart},{$rowPerPagePaginate}";
        $stmt2 = parent::conn()->prepare($sql);
        $stmt2->execute(array($query,$pid["data"]["pid"]));
        $data = $stmt2->fetchAll(PDO::FETCH_ASSOC);


        $sendResponse = array (
            'searchRC'=>$data_rc, 
            'searchRes'=>$data,
            'query'=>$pid["data"]['query'], 
            'pid'=>$pid["data"]['pid'], 
            'rowPerPagePaginate'=>$rowPerPagePaginate,
            'pagePaginateStart'=>$pagePaginateStart,
            'pageNumPaginate'=>$pageNumPaginate,
            'currPageSel'=>$pid['currPageSel']
        );   

        return $sendResponse;
    }


}