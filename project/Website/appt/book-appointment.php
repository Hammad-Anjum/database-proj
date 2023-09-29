<?php

include '../../conn.inc.php';
include '../typecheck.php';

// Retrieve the request data
$requestData = json_decode(file_get_contents('php://input'), true);

// Extract the appointment details
$doctorEmail = $requestData['doctor_email'];
$scheduleDate = $requestData['schedule_date'];
$scheduleTime = $requestData['schedule_time'];
$userPaymentMethod = $requestData['payment_method'];

if($userPaymentMethod === 'credit_card')
{
    $userPaymentMethod = 'Credit Card';
}
else if ($userPaymentMethod === 'debit_card')
{
    $userPaymentMethod = 'Debit Card';
}
else
{
    $userPaymentMethod = 'Cash';
}


// Prepare the SQL statement
$sql = "INSERT INTO Appointment (DoctorEmail, UserEmail, StartTime, EndTime, UserPaymentMethod) VALUES (?, ?, ?, ?, ?)";

// Calculate the start time based on the selected date and time
$startTime = date('Y-m-d H:i:s', strtotime("$scheduleDate $scheduleTime"));
// Calculate the end time based on the selected time slot (adjust the duration as needed)
$endTime = date('Y-m-d H:i:s', strtotime($scheduleTime . '+60 minutes'));

$p = array($doctorEmail,$email,$startTime,$endTime,$userPaymentMethod);

$stmt = sqlsrv_prepare($conn,$sql,$p);

// Execute the statement
if (sqlsrv_execute($stmt)) {
    // Appointment insertion successful
    $response = [
        'status' => 'success',
        'message' => 'Appointment booked successfully.'
    ];
} else {
    // Appointment insertion failed
    $response = [
        'status' => 'error',
        'message' => 'Failed to book appointment.'
    ];
}

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
