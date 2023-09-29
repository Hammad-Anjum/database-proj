<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="../style2.css">
    <script>
        function seeSchedule() {
        const doctorSelect = document.getElementById('doctor');
        const selectedDoctor = doctorSelect.options[doctorSelect.selectedIndex].value;
        window.location.href = `/project/website/schedule/schedule.php?doctor_name=${selectedDoctor}`;
        }

        </script>
</head>

<?php
include '../typecheck.php';
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
                                <td class="MenuButton"><a href="../profile/profile.php">Profile</a></td>
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
   
    <div class="wrapper">
    <div class="main-content">
        <div id="sub-content" style="background-color: rgba(255, 255, 255, 0.8); padding: 20px;">
            <form method="GET" action="schedule.php">
                <label for="search">Search doctor Schedule: </label>
                <input type="text" id="search" name="search">
                <button type="submit" onClick=getData()>Search</button>
            </form>
            <script>
                const searchForm = document.querySelector('form');
                const searchInput = document.getElementById('search');

                searchForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    const searchValue = searchInput.value.trim();

                    if (searchValue === '') {
                        alert('Please enter a search query');
                        return;
                    }

                    fetch(`search_doctor.php?search=${searchValue}`)
                        .then(response => response.json())
                        .then(response => {
                            if (response.status === 'success') {
                                const doctors = response.doctors;
                                console.log(doctors);

                                doctors.forEach(doctor => {
                                    console.log(doctor);

                                    const doctorsList = document.getElementById('sub-content');

                                    // Create a container element for each doctor
                                    const doctorContainer = document.createElement('div');

                                    // Create a hidden input element to store the DoctorEmail
                                    const doctorEmailInput = document.createElement('input');
                                    doctorEmailInput.type = 'hidden';
                                    doctorEmailInput.name = 'doctor_email';
                                    doctorEmailInput.value = doctor.email;
                                    doctorContainer.appendChild(doctorEmailInput);

                                    const doctorName = document.createElement('h2');
                                    doctorName.innerText = doctor.name;
                                    doctorContainer.appendChild(doctorName);

                                    const doctorDetails = document.createElement('h3');
                                    doctorDetails.innerText = `Email: ${doctor.email}\nCity: ${doctor.city}\nPhone: ${doctor.phone}\nSpecialization: ${doctor.spec}\nHospital Name: ${doctor.hosName}\nLocation: ${doctor.loc}\nStart Work Hours: ${doctor.sHour}\nEnd Work Hours: ${doctor.eHour}`;
                                    doctorContainer.appendChild(doctorDetails);

                                    doctorsList.appendChild(doctorContainer);
                                });
                            } else {
                                console.error(response.message);
                            }
                        })
                        .catch(error => console.error(error));
                });
            </script>
        </div>
    </div>
</div>

        </div>
        </div></div>

        <div class="wrapper">
    <div class="main-content">
        <div id="sub-content" style="background-color: rgba(255, 255, 255, 0.8); padding: 20px;">
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
                        .then((response) => {
                            return response.json();
                        })
                        .then((data) => {
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