<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule</title>
    <link rel="stylesheet" href="../style2.css">
</head>

<?php
include '../typecheck.php';
include '../../conn.inc.php';
?>


<body>
    <Header>
        <!-- Division for the Menu -->
        <div>
            <table cellspacing=20px>
                <tr>
                    <td><a href="index.html"><img src="../img/Logo.png" alt="Logo" height="90px" style="padding: 10px"></a>
                    </td>

                    <td>
                        <nav>
                            <table>
                                <tr>
                                <td class="MenuButton"><a href="../profile.php">Profile</a></td>
                                <?php
                                    if(($v1 === false))
                                    {
                                        echo "
                                        <td class='MenuButton'><a href='../schedule/schedule.php'>Schedule</a></td>
                                        <td class='MenuButton'><a href='../appt/form.php'>form</a></td>
                                            <td class='MenuButton'><a href='../catalog/catalog.php'>Catalog</a></td>
                                            <td class='MenuButton'><a href='../recommendations/recom.php'>Recommendations</a></td>";
                                    }
                                    ?>
                                 <td class="MenuButton"><a href="../About.php">About</a></td>

                                </tr>
                            </table>
                        </nav>
                    </td>
                </tr>
            </table>
        </div>
    </Header>

    <?php
    if (isset($_GET['doc_email'])) {
        
        // Check if connection was successful
        if (!$conn) {
            die("Connection failed: " . sqlsrv_errors());
        }
        // Retrieve the selected doctor name from the URL parameter
        $doctorEmail = $_GET['doc_email'];

        // Construct the SQL query to retrieve the details of the selected doctor
        $sql = "SELECT * 
        FROM Doctors d
        join DoctorType dt on d.DoctorEmail = dt.DoctorEmail  
        join Hospital h on h.HospitalID = d.HospitalID
        WHERE d.DoctorEmail = '$doctorEmail'";

        // Execute the SQL query and retrieve the result
        $result = sqlsrv_query($conn, $sql);

        // Check if the query was successful
        if ($result) {
            // Retrieve the details of the selected doctor from the result
            $row = sqlsrv_fetch_array($result);
            
            echo '<div class="wrapper">
            <div class="main-content">';
            echo '<div id="sub-content" style="background-color: rgba(255, 255, 255, 0.8); padding: 20px;">';
            // Display the details of the selected doctor in the HTML
            echo "<h2> Name : $row[DoctorName]  </h2>";
            echo "<h3> Email :  $row[DoctorEmail]  </h3>";
            echo "<h3> City : $row[DoctorCity] </h3>";
            echo "<h3> Phone Number : $row[DoctorPhone] </h3>";
            echo "<h3> Specialization : $row[Specialization] </h3>";
            echo "<h3> Hospital : $row[HospitalName] </h3>";
            echo "<h3> Hospital location : $row[Location] </h3>";
            echo '<h3> Starting work Hours : ' . $row['StartWorkHours']->format('h:i:sa') . '</h3>';
            echo '<h3> Ending work hours : ' . $row['EndWorkHours']->format('h:i:sa') . '</h3>';
            
            echo '</div>';
            echo '</div></div>';



        } else {
            // Display an error message if the query failed
            echo '<p>Failed to retrieve details of selected doctor.</p>';
        }


    } else {
        header("Location: search_doctor_page.php");
        exit;

    }
    ?>

    <div class="wrapper">
        <div class="main-content">
            <div id="sub-content"  style="background-color: rgba(255, 255, 255, 0.8); padding: 5px;">
                <form method="GET" action="see-schedule.php" id="schedule-form">
                <input type="hidden" name="doctor_email" value="<?php echo $row['DoctorEmail']; ?>">
                <label for="schedule-date">Select a date:</label>
                <input type="date" id="schedule-date" name="schedule_date" min="<?php echo date('Y-m-d'); ?>">
                <button type="submit">Check Schedule</button>
                </form>

                <script>
                const form = document.getElementById('schedule-form');
                const select = document.createElement('select');
                select.name = 'schedule_slot';
                select.id = 'schedule-slot';
                select.disabled = true;
                const defaultOption = document.createElement('option');
                defaultOption.text = 'Available time slots';
                select.add(defaultOption);
                form.appendChild(select);

                form.addEventListener('submit', (event) => {
                    event.preventDefault();
                    const date = document.getElementById('schedule-date').value;
                    const doctorEmail = document.getElementsByName('doctor_email')[0].value;
                    const url = `see-schedule.php?doctor_email=${doctorEmail}&schedule_date=${date}`;
                    fetch(url)
                        .then((response) => 
                        {
                            return response.json();
                        })
                        .then((data) => 
                        {
                            select.innerHTML = '';
                            const options = data.time_slot.map((slot) => {
                                const option = document.createElement('option');
                                option.value = slot;
                                option.text = slot;
                                return option;
                            });
                            options.forEach((option) => {
                                select.add(option);
                            });
                            select.disabled = false;
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                });
                </script>

            </div>
        </div>
    </div>
    <div>
        <footer>
            <p> FAST NUCES Lhr, Med Soul.co, Copyright 2023 </p>
            <form id="logoutForm" action="../logout.php" method="post">
  <button type="submit" name="logout">Logout</button>
</form>
        </footer>
    </div>
</body>

</html>