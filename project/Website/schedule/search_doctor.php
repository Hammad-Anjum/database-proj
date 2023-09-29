<?php
// Establish database connection

include '../../conn.inc.php';

// Check if connection was successful
if (!$conn) {
    die("Connection failed: " . sqlsrv_errors());
}

$docName = $_GET['search'];

// Construct SQL query to retrieve doctors for selected specialization
/*select *
from Doctors d
join DoctorType do on d.DoctorEmail = do.DoctorEmail
where Specialization = 'Psychiatrist';*/

$sql = "SELECT * 
FROM Doctors d
join DoctorType dt on d.DoctorEmail = dt.DoctorEmail  
join Hospital h on h.HospitalID = d.HospitalID
WHERE d.DoctorName = '$docName'";
$stmt = sqlsrv_query($conn, $sql);

// Check if query was successful
if ($stmt) {
    // Construct JSON response array
    $doctors = array();
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $doctors[] = array(
            "name" => $row['DoctorName'],
            "email" => $row['DoctorEmail'],
            "city" => $row['DoctorCity'],
            "phone" => $row['DoctorPhone'],
            "spec" => $row['Specialization'],
            "hosName" => $row['HospitalName'],
            "loc" => $row['Location'],
            "sHour" => $row['StartWorkHours']->format('h:i:sa'),
            "eHour" => $row['EndWorkHours']->format('h:i:sa')
        );
    }
    $response = array("status" => "success", "doctors" => $doctors);
    echo json_encode($response);
} else {
    $response = array("status" => "error", "message" => sqlsrv_errors());
    echo json_encode($response);
}


// Close database connection
?>
