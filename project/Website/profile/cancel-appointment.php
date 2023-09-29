<?php

include '../../conn.inc.php';
include '../typecheck.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userEmail = $_POST['userEmail'];
    $startTime = $_POST['startTime'];

    $q = "DELETE FROM Appointment WHERE (UserEmail = ? AND StartTime = ?) or (DoctorEmail = ? AND StartTime = ?)";
    $p = array($userEmail, $startTime, $userEmail, $startTime);
    $stmt = sqlsrv_query($conn, $q, $p);

    if ($stmt) {
        $rowsAffected = sqlsrv_rows_affected($stmt);
        if ($rowsAffected > 0) {
            echo "Appointment cancelled successfully.";
        } else {
            echo "No matching appointment found to cancel.";
        }
    } else {
        echo "Failed to cancel the appointment. Error: " . sqlsrv_errors()[0]['message'];
    }
    exit(); 
}

?>