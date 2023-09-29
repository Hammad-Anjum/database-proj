<?php
// Establish database connection
include '../../conn.inc.php';

// Check if connection was successful
if (!$conn) {
    die("Connection failed: " . sqlsrv_errors());
}

$docEmail = $_GET['doctor_email'];
$schedule_date = $_GET['schedule_date'];

$sql = "SELECT d.StartWorkHours, d.EndWorkHours, CAST(StartTime AS time) AS startTime, CAST(EndTime AS time) AS endTime 
FROM Doctors d 
JOIN Appointment a ON d.DoctorEmail = a.DoctorEmail 
WHERE a.DoctorEmail = '".$docEmail."' 
AND CAST(a.StartTime AS DATE) = '".$schedule_date."'";
$stmt = sqlsrv_query($conn, $sql);

// Check if the query was successful
if ($stmt) {
    $available_time_slots = array();
    $all_hours = array();

    // Create an array of all hours between StartWorkHours and EndWorkHours
    if ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $start_work_hour = strtotime($row['StartWorkHours']->format('H:i:s'));
        $end_work_hour = strtotime($row['EndWorkHours']->format('H:i:s'));

        $current_hour = $start_work_hour;

        while ($current_hour < $end_work_hour) {
            $all_hours[] = date('H:i:s', $current_hour);
            $current_hour = strtotime('+1 hour', $current_hour);
        }
    } else {
        // If no booked appointments, retrieve the doctor's working hours
        $sql = "SELECT StartWorkHours, EndWorkHours FROM Doctors WHERE DoctorEmail = '".$docEmail."'";
        $stmt = sqlsrv_query($conn, $sql);

        if ($stmt && $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $start_work_hour = strtotime($row['StartWorkHours']->format('H:i:s'));
            $end_work_hour = strtotime($row['EndWorkHours']->format('H:i:s'));

            $current_hour = $start_work_hour;

            while ($current_hour < $end_work_hour) {
                $all_hours[] = date('H:i:s', $current_hour);
                $current_hour = strtotime('+1 hour', $current_hour);
            }
        }
    }

    // Iterate through the fetched rows
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $start_time = strtotime($row['startTime']->format('H:i:s'));
        $end_time = strtotime($row['endTime']->format('H:i:s'));

        // Remove the booked hours from the all_hours array
        $booked_hours = range($start_time, $end_time - 3600, 3600); // Step is set to 3600 seconds (1 hour), subtract 3600 to exclude EndWorkHours
        $booked_hours = array_map(function ($hour) {
            return date('H:i:s', $hour);
        }, $booked_hours);
        $all_hours = array_diff($all_hours, $booked_hours);
    }

    // Create the available schedule list
    $available_schedule = array_values($all_hours);

    $response = array("status" => "success", "time_slot" => $available_schedule);
    echo json_encode($response);
} else {
    $response = array("status" => "error", "message" => sqlsrv_errors());
    echo json_encode($response);
}

?>
