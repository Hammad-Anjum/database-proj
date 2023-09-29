<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About-MedSoul</title>
    <link rel="stylesheet" href="style2.css">
     <style>
table {
  font-family: Arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  margin: 20px 0;
}

th, td {
  text-align: left;
  padding: 8px;

 
}

th {
  background-color: #4e4774;
  color: white;
}
tr:nth-child(odd) {
color: white;
} 

tr:nth-child(even) {
  background-color: #f2f2f2;
color: black; 
  
}

td {
  border-bottom: 1px solid #ddd;
}
.about-container {
  background-color: #f8f8f8;
  width: 70%;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 10px;
  margin: 0 auto;
  text-align: center;
}
    </style>
</head>

<?php
include './typecheck.php';
?>

<body>
    <Header>
        <!-- Division for the Menu -->
        <div>
            <table cellspacing=20px>
                <tr>
                    <td><a href="index.html"><img src="img/Logo.png"alt="Logo" height="100px" style="padding: 10px"></a></td>

                    <td>
                        <nav>
                            <table>
                                <tr>
                                <td class="MenuButton"><a href="./profile/profile.php">Profile</a></td>
                                <?php
                                    if(($v1 === false))
                                    {
                                        echo "
                                        <td class='MenuButton'><a href='./schedule/schedule.php'>Schedule</a></td>
                                        <td class='MenuButton'><a href='./appt/form.php'>form</a></td>
                                            <td class='MenuButton'><a href='./catalog/catalog.php'>Catalog</a></td>
                                            <td class='MenuButton'><a href='./recommendations/recom.php'>Recommendations</a></td>";
                                    }
                                    ?>
                                 <td class="MenuButton"><a href="About.php">About</a></td>

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
        <div class="main-content">
            <div class="about-container">
                <h2>Welcome to our project website!</h2>
                <p>We are a group of six students who embarked on this project as a learning experience to enhance our skills in web development. Our goal was to create a fully functional website that links to a database and provides users with a seamless experience.</p>
                <p>Through collaboration and hard work, we were able to create a website that we are proud of. Our website features a sleek design, intuitive user interface, and comprehensive functionalities. Users can easily navigate through the website and access information relevant to their needs.</p>
                <p>We utilized various web development tools and techniques to achieve our objectives. Our team members were responsible for different aspects of the project, from design to backend development. We worked tirelessly to ensure that every aspect of the website was well-designed, functional, and responsive.</p>
                <p>Our website's backlink to a database enables us to provide users with real-time updates and ensure that the website's content is always up-to-date. We believe that our website's seamless integration with the database sets us apart from other similar websites.</p>
                <p>Overall, we are thrilled with the outcome of this project and hope that you find our website both useful and informative. We look forward to continuously improving our website and providing users with the best experience possible.</p>
              </div>
              
                                </div>
    </div>

    <div>
        <footer>
            <p> FAST NUCES Lhr, Med Soul.co, Copyright 2023 </p>
            <form id="logoutForm" action="logout.php" method="post">
  <button type="submit" name="logout">Logout</button>
</form>
</script>
        </footer>
    </div>
</body>

</html>