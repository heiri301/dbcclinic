<?php
//*================================== APPOINTMENTS QUERY ==================================*       
 include_once '../core/conn.ini.php';
 class Appointment extends db1 {
    function getAppointmentData ($searchdata) {
        // Get page number
        $rowPerPagePaginate = 10; // 10 rows
        $sql= "SELECT * FROM `appointment` WHERE `appt_subject` LIKE ?";
        $stmt1 = parent::conn()->prepare($sql);
        $stmt1->execute(array('%'.$searchdata['data'].'%'));
        $data_rc = $stmt1->rowCount();

        // Pagination
        $pageNumPaginate = ceil($data_rc / $rowPerPagePaginate);
        $pagePaginateStart = ($searchdata['currPageSel'] - 1) * $rowPerPagePaginate; 

        // retrieve data
        $sql= "SELECT * FROM `appointment` WHERE `appt_subject` LIKE ? LIMIT {$pagePaginateStart},{$rowPerPagePaginate}";
        $stmt2 = parent::conn()->prepare($sql);
        $stmt2->execute(array('%'.$searchdata['data'].'%'));
        $data = $stmt2->fetchAll(PDO::FETCH_ASSOC);


        $sendResponse = array (
            'searchRC'=>$data_rc, 
            'searchRes'=>$data,
            'queryData'=>$searchdata['data'], 
            'rowPerPagePaginate'=>$rowPerPagePaginate,
            'pagePaginateStart'=>$pagePaginateStart,
            'pageNumPaginate'=>$pageNumPaginate,
            'currPageSel'=>$searchdata['currPageSel']
        );   

        return $sendResponse;
    }
    function setAppointmentData ($data) {
        try { 
            $appt_uuid = bin2hex(random_bytes(4)); //random generated string
            $sql = "INSERT INTO `appointment` (`appt_uuid`, `appt_datetime`, appt_subject, `appt_type`, `appt_notes`, `pid`) VALUES (?,?,?,?,?,?)";
            $stmt1 = parent::conn()->prepare($sql);
            $stmt1->execute(array($appt_uuid, $data['appt_datetime'],$data['appt_subject'],$data['appt_type'],$data['appt_notes'],$data['appt_pid']));
            $sendRes = array(   
                'alerttype' => 'apptSetSuccess',
                'alertinfo' => [
                    'alertType' => 'alert-success',
                    'dataIcon' => 'check_circle',
                    'dataText' => 'Log created successfully.',
                ],
            );
            return $sendRes;
        }
        catch (Exception $e) {
            $sendRes = array(   
                'alerttype' => 'apptSetFail',
                'alertinfo' => [
                    'alertType' => 'alert-danger',
                    'dataIcon' => 'cancel',
                    'dataText' => 'Log creation failed. Please inform the Administrator about this issue.',
                    'dataTextError' => $e,
                ],
            );
            return $sendRes;
        }
    }

    function getappt_UUID($uuid){
        $sql = "SELECT * FROM appointment where appt_uuid = ?";
        $stmt1 = parent::conn()->prepare($sql);
        $stmt1->execute(array($uuid));
        $data=$stmt1->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    function updateAppointmentData($data){
        try { 
            $sql = "UPDATE appointment SET appt_type=?, appt_subject=?, appt_notes=? WHERE appt_uuid=?";
            $stmt1 = parent::conn()->prepare($sql);
            $stmt1->execute(array($data['appt_type'],$data['appt_subject'],$data['appt_notes'],$data['appt_uuid']));
            $sendRes = array(   
                'alerttype' => 'apptUpdSuccess',
                'alertinfo' => [
                    'alertType' => 'alert-success',
                    'dataIcon' => 'check_circle',
                    'dataText' => 'Patient log updated successfully.',
                ],
            );
            return $sendRes;
        }
        catch (Exception $e) {
            $sendRes = array(   
                'alerttype' => 'apptUpdFail',
                'alertinfo' => [
                    'alertType' => 'alert-danger',
                    'dataIcon' => 'cancel',
                    'dataText' => 'Patient log creation failed.<br>Please inform the Administrator about this issue.',
                    'dataTextError' => $e,
                ],
            );
            return $sendRes;
        }
    }

    function deleteAppointmentData($data) {
        try { 
            $sql = "DELETE FROM appointment WHERE appt_uuid = ?";
            $stmt1 = parent::conn()->prepare($sql);
            $stmt1->execute(array($data));
            $sendRes = array(   
                'alerttype' => 'apptDelSuccessModal',
                'alertinfo' => [
                    'dataText' => 'Patient log deleted',
                ],
            );
            return $sendRes;
        }
        catch (Exception $e) {
            $sendRes = array(   
                'alerttype' => 'apptDelFailModal',
                'alertinfo' => [
                    'dataText' => 'Patient log deletion failed.<br>Please inform the Administrator about this issue.',
                    'dataTextError' => $e,
                ],
            );
            return $sendRes;
        }
    }
}