<?php
session_start();
require_once('../../Model/sql.php');



    if (isset($_REQUEST['mydata'])) {

        $data = json_decode($_REQUEST['mydata'], true);

  
        $id = $_SESSION['userid'];
        $postid = $data['post_id'];
        $reportType = $data['report'];
        $reportDetails = $data['textreport'];

        if (empty($reportType) && empty($reportDetails)) {
            echo json_encode(['success' => false, 'message' => 'Please select a report type or provide details.']);
            exit;
        }

        if (!empty($reportType)) {
            $check = report($postid, $reportType);
        } else if (!empty($reportDetails)) {
            $check = report($postid, $reportDetails);
        }

  
        if ($check) {
            echo json_encode(['success' => true, 'message' => 'Report submitted successfully.', 'redirectUrl' => $redirectUrl]);
        } else {
            echo json_encode(['success' => false, 'message' => 'There was an error submitting your report.']);
        }
    }

?>
