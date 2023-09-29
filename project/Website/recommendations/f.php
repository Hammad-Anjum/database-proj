<?php

include '../../conn.inc.php';

$k = $_POST['id'];
$k = trim($k);

$sql = "SELECT DoctorName,DoctorCity, specialization, rating FROM (Doctors JOIN DoctorType ON DoctorType.DoctorEmail = Doctors.DoctorEmail) JOIN DocRating ON Docrating.DoctorEmail = Doctors.DoctorEmail WHERE DoctorType.Specialization LIKE '%$k%' OR Doctors.DoctorCity LIKE '%$k%' ORDER BY Docrating.rating DESC ";

$res = sqlsrv_query($conn, $sql);
if (sqlsrv_has_rows($res) === true) {
    ?>
    <table>
        <thead>
            <tr>
                <th>Doctor Name</th>
                <th>Specialization</th>
                <th> City </th>
                <th>Rating</th>
            </tr>
        </thead>
        <tbody>
        <?php
            while ($row = sqlsrv_fetch_array($res)) {
                ?>
                <tr>
                    <td><img src="../img/u.png" alt="Doctor"  width="30" height="30"> &nbsp; &nbsp;<?php echo $row['DoctorName']; ?></td>
                    <td><?php echo $row['specialization']; ?></td>
                    <td><?php echo $row['DoctorCity']; ?></td>
                    <td>
                        <?php
                        $rating = intval($row['rating']);
                        for ($i = 0; $i < $rating; $i++) {
                            echo '<img src="../img/oo.png" width="25" height="25">';
                        }
                        for ($i = $rating; $i < 5; $i++) {
                            echo '';
                        }
                        echo ' ('.$rating.'/10)';
                        ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <?php
} 
else {
    echo "<p>No results found.</p>";
}
?>
