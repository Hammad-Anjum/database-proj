<?php

include '../../conn.inc.php';
include '../typecheck.php';


$email = $_SESSION["user_email"];

$currentDateTime = date('Y-m-d H:i:s');


if($v1)
{
    $q = "SELECT DISTINCT UserName,StartTime,EndTime,UserPaymentMethod FROM Appointment JOIN Users ON Users.UserEmail = Appointment.UserEmail WHERE DoctorEmail = ? AND Appointment.StartTime > ? ORDER BY Appointment.StartTime ";
    $p = array($email,$currentDateTime);
    $stmt = sqlsrv_query($conn,$q,$p);

    if($stmt)
    {
       ?>
       <table>
        <thead>
            <tr>
                <th>Patient </th>
                <th> Date </th>
                <th>Start Time</th>
                <th>End Time </th>
                <th>Payment </th>
            </tr>
        </thead>
        <tbody>
            <?php
        while($res = sqlsrv_fetch_array($stmt,  SQLSRV_FETCH_ASSOC))
        {
            $date = substr($res["StartTime"],0,10);
            $time1 = substr($res["StartTime"],11);
            $time2 = substr($res["EndTime"],11);
            ?>
            <tr>
            <td><?php echo ucwords($res["UserName"]); ?></td>
                <td><?php echo  $date ; ?></td>
                <td><?php echo $time1; ?></td>
                <td><?php echo $time2; ?></td>
                <td><?php echo $res["UserPaymentMethod"]; ?></td>
                <td>
                    <button onclick="cancelAppointment('<?php echo $email; ?>', '<?php echo $res["StartTime"]; ?>')">Cancel Appointment</button>
                </td>
        </tr>
        <?php        
        }
        ?>
        </tbody>
       </table>
       <?php
    }
}
else
{
    $q ="SELECT DISTINCT DoctorName,Specialization,StartTime,EndTime,UserPaymentMethod,DoctorFees FROM Appointment JOIN Doctors ON Doctors.DoctorEmail = Appointment.DoctorEmail JOIN DoctorsFee on Appointment.DoctorEmail = DoctorsFee.DoctorEmail JOIN DoctorType on Appointment.DoctorEmail = DoctorType.DoctorEmail WHERE UserEmail = ? AND Appointment.STartTime > ? ORDER BY Appointment.StartTime";
    $p = array($email,$currentDateTime);
    $stmt = sqlsrv_query($conn,$q,$p); 
    if($stmt)
    {
        ?>
        <table>
        <thead>
            <tr>
                <th>Doctor</th>
                <th> Specialization </th>
                <th> Date </th>
                <th>Start Time</th>
                <th>End Time </th>
                <th>Payment </th>
                <th> Fees </th>
            </tr>
        </thead>
        <tbody>
            <?php
        while($res = sqlsrv_fetch_array($stmt,  SQLSRV_FETCH_ASSOC))
        {
            $date = substr($res["StartTime"],0,10);
            $time1 = substr($res["StartTime"],11);
            $time2 = substr($res["EndTime"],11);
            ?>
            <tr>
                <td><?php echo $res["DoctorName"]; ?></td>
                <td><?php echo $res["Specialization"]; ?></td>
                <td><?php echo  $date ; ?></td>
                <td><?php echo $time1; ?></td>
                <td><?php echo $time2; ?></td>
                <td><?php echo $res["UserPaymentMethod"]; ?></td>
                <td><?php echo $res["DoctorFees"]; ?></td>
                <td>
                    <button onclick="cancelAppointment('<?php echo $email; ?>', '<?php echo $res["StartTime"]; ?>')">Cancel Appointment</button>
                </td>
        </tr>
        <?php 
        }  
        ?>
         </tbody>
    </table>
    <?php     
    }

}
?>

<script>
    function cancelAppointment(userEmail, startTime) {
        // Confirmation dialog to confirm the cancellation
        if (confirm("Are you sure you want to cancel this appointment?")) {
            // Send an AJAX request to cancel the appointment
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'cancel-appointment.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Reload the page after successful cancellation
                    location.reload();
                }
            };
            xhr.send("userEmail=" + userEmail + "&startTime=" + startTime);
        }
    }
</script>
