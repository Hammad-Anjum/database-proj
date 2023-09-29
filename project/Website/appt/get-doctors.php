<?php
// Establish database connection

include '../../conn.inc.php';

// Retrieve selected specialization from AJAX request
$selectedSpecialization = $_GET['specialization'];


$sql = "SELECT d.DoctorName, d.DoctorEmail, d.DoctorCity
FROM Doctors d JOIN DoctorType dt ON d.DoctorEmail = dt.DoctorEmail
WHERE dt.Specialization = '".$selectedSpecialization . "'";
$stmt = sqlsrv_query($conn, $sql);

// Check if query was successful
if ($stmt) {
    // Construct JSON response array
    $doctors = array();
    
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $doctors[] = array(
            "name" => $row['DoctorName'],
            "email" => $row['DoctorEmail'],
            "city" => $row['DoctorCity']
        );
    }
    $response = array("status" => "success", "doctors" => $doctors);
    echo json_encode($response);
} else {
    $response = array("status" => "error", "message" => sqlsrv_errors());
    echo json_encode($response);
}

?>
