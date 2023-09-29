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
        const hiddenEmail = document.getElementById('docEmail');
        const selectedIndex = doctorSelect.selectedIndex;
        const selectedDoctorEmail = hiddenEmail.value.split(',')[selectedIndex];
        const selectedDoctor = doctorSelect.options[selectedIndex].value;
        console.log(doctorSelect.options[selectedIndex].value)
        window.location.href = `/project/website/schedule/schedule.php?doc_email=${selectedDoctorEmail}`;
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
                                        <td class='MenuButton'><a href='form.php'>form</a></td>
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
    <!-- Division for Center Items -->
    <div class="wrapper">
    <input type="hidden" id="docEmail"  value="abc@gmail.com">
        <div class="main-content">
            <!-- Your main content here -->
            <div style="background-color: rgba(255, 255, 255, 0.8); padding: 20px;">
                <h2>Book an Appointment</h2>

                    <label for="specialization">Choose a specialization:</label>
                    <select id="specialization" name="specialization">
                        <option value="General Physician">General Physician</option>
                        <option value="Dentist">Dentist</option>
                        <option value="Psychologist">Psychologist</option>
                        <option value="Neurologist">Neurologist</option>
                        <option value="Dermatologist">Dermatologist</option>
                        <option value="Psychiatrist">Psychiatrist</option>
                        <option value="Cardiologist">Cardiologist</option>
                    </select>
                    <br><br>

                                    
                <select id="doctor" name="doctor"></select>

                <input type="hidden" id="docEmail" name="doctor_email" value="">

                <script>
                    const hiddenEmail = document.getElementById('docEmail');
                    const specializationSelect = document.querySelector('#specialization');
                    const doctorSelect = document.querySelector('#doctor');
                    const doctorEmailList = [];

                    function initializeDoctorList(selectedSpecialization) {
                        doctorSelect.innerHTML = '';
                        doctorEmailList.length = 0;

                        fetch(`get-doctors.php?specialization=${selectedSpecialization}`)
                            .then(response => response.json())
                            .then(response => {
                                if (response.status === 'success') {
                                    const doctors = response.doctors;
                                    console.log(doctors);
                                    doctors.forEach(doctor => {
                                        console.log(doctor);
                                        const option = document.createElement('option');
                                        option.value = doctor.email;
                                        option.text = `${doctor.name}`;
                                        doctorSelect.appendChild(option);
                                        doctorEmailList.push(doctor.email); // Add the email to the list
                                    });
                                    hiddenEmail.value = doctorEmailList.join(','); // Convert the list to a comma-separated string and assign it to the hidden field
                                } else {
                                    console.error(response.message);
                                }
                            })
                            .catch(error => console.error(error));
                    }

                    specializationSelect.addEventListener('change', () => {
                        const selectedSpecialization = specializationSelect.value;
                        console.log("On event change");
                        initializeDoctorList(selectedSpecialization);
                    });

                    // Initial call to initialize the doctor list
                    const initialSpecialization = specializationSelect.value;
                    initializeDoctorList(initialSpecialization);
                </script>

                    <button type="submit" onclick=seeSchedule()>See Schedule</button>
                    <br><br>
                    <label for="date">Choose a date:</label>
                    <input type="date" id="date" name="date" min="<?php echo date('Y-m-d'); ?>">
                    <br><br>
                    <label for="time">Choose a time:</label>
                    <select id="time" name="time" disabled>
                    <option value="">Available time slots</option>
                    </select>
                    <br><br>
                    <label for="payment">Payment method:</label>
                    <select id="payment" name="payment">
                        <option value="credit_card">Credit Card</option>
                        <option value="debit_card">Debit Card</option>
                        <option value="cash">Cash</option>
                    </select>



                    <script>
                    const dateInput = document.getElementById('date');
                    const timeSelect = document.getElementById('time');
                    const doctorSelect_ = document.getElementById('doctor');
                    const doctorEmailInput = document.getElementById('docEmail');

                    dateInput.addEventListener('change', () => {
                        const selectedDate = dateInput.value;
                        const selectedIndex = doctorSelect_.selectedIndex;
                        const selectedDoctorEmail = doctorEmailInput.value.split(',')[selectedIndex];

                        fetch(`../schedule/see-schedule.php?doctor_email=${selectedDoctorEmail}&schedule_date=${selectedDate}`)
                            .then(response => response.json())
                            .then(data => {
                                const timeSlots = data.time_slot;

                                timeSelect.innerHTML = '';

                                if (timeSlots.length > 0) {
                                    timeSlots.forEach(slot => {
                                        const option = document.createElement('option');
                                        option.value = slot;
                                        option.textContent = slot;
                                        timeSelect.appendChild(option);
                                    });
                                    timeSelect.disabled = false;
                                } else {
                                    const option = document.createElement('option');
                                    option.value = '';
                                    option.textContent = 'No available time slots';
                                    timeSelect.appendChild(option);
                                    timeSelect.disabled = true;
                                }
                            })
                            .catch(error => {
                                console.error(error);
                                timeSelect.innerHTML = '';
                                timeSelect.disabled = true;
                            });
                    });

                    doctorSelect.addEventListener('change', () => {
                        resetTimeOptions();
                        resetPaymentMethod();
                        resetPhoneNumber();
                    });

                    function resetTimeOptions() {
                        timeSelect.innerHTML = '';
                        timeSelect.disabled = true;
                    }

                    function resetPaymentMethod() {
                        const paymentSelect = document.getElementById('payment');
                        paymentSelect.selectedIndex = 0;
                    }

                    function resetPhoneNumber() {
                        const phoneInput = document.getElementById('phone');
                       // phoneInput.value = '';
                    }
                    function bookAppointment() {
                        const selectedDate = dateInput.value;
                        const selectedIndex = doctorSelect.selectedIndex;
                        const selectedDoctorEmail = doctorEmailInput.value.split(',')[selectedIndex];
                        const selectedTime = timeSelect.value;
                        const paymentSelect = document.getElementById('payment');
                        const selectedPaymentMethod = paymentSelect.value;

                        if (selectedTime === '') {
                            alert('Please select a time slot.');
                            return;
                        }

                        const url = 'book-appointment.php';

                        const requestData = {
                            doctor_email: selectedDoctorEmail,
                            schedule_date: selectedDate,
                            schedule_time: selectedTime,
                            payment_method: selectedPaymentMethod
                        };

                        fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(requestData)
                        })
                            .then(response => response.json())
                            .then(data => {
                                // Handle the response from the server
                                console.log(data);
                                // Display success/error message on the same page
                                if (data.status === 'success') {
                                    // Show success message
                                    window.alert('Appointment booked successfully.');
                                    window.location.href = `/project/website/profile/profile.php`;
                                } else {
                                    // Show error message
                                    window.alert('Failed to book appointment.');
                                }
                            })
                            .catch(error => console.error(error));
                    }


                </script>
                    <br><br>
                    <button type="submit" onclick=bookAppointment()>Book Appointment</button>
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