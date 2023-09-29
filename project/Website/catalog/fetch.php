<?php
include '../../conn.inc.php';

$k = $_POST['id'];
$k= trim($k);


if ($k == "All") {
    $sql = "SELECT DISTINCT DoctorName,DoctorCity,specialization FROM Doctors join DoctorType on DoctorType.DoctorEmail = Doctors.DoctorEmail";
} else {
$sql = "SELECT DISTINCT DoctorName,DoctorCity,specialization FROM Doctors join DoctorType on DoctorType.DoctorEmail = Doctors.DoctorEmail WHERE DoctorType.Specialization = '{$k}'";
}
$res = sqlsrv_query($conn,$sql);
while($row = sqlsrv_fetch_array($res)){
    ?>
  <tr>
  <td><img src="../img/u.png" width="30" height="30">&nbsp; &nbsp;<?php echo $row['DoctorName']; ?></td>
 <td><?php echo $row['DoctorCity']; ?></td>
 <td><?php echo $row['specialization']; ?></td>
     </tr>
     <?php
    
}
 echo $sql;
?>