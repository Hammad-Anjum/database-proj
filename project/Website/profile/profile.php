<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src ="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <title>Profile</title>
    <link rel="stylesheet" href= "../style2.css">
</head>
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



<?php
include '../typecheck.php';
$functions = include './funcs.php';
?>


<body>
    <Header>
        <!-- Division for the Menu -->
        <div>
            <table cellspacing=20px>
                <tr>
                    <td><a href="index.html"><img src="../img/Logo.png"alt="Logo" height="100px" style="padding: 10px"></a></td>

                    <td>
                        <nav>
                            <table>
                                <tr>
                                    <td class="MenuButton"><a href="profile.php">Profile</a></td>
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
    <!-- Division for Center Items -->
    <div class="wrapper">
        <div class="main-content">   
            <?php 
            $name = ucwords($functions['GetName']($v1,$email));
            echo "<h1> Welcome $name <h1>" ;

            $n = $functions['GetAppointments']($v1,$email);
            echo "<h2> Total Appointments : $n  <h2>" ;

            $n2 = $functions['GetPendingAppt']($v1,$email);
            

            echo "<h2> Appointments pending : $n2 <h2>";

            echo '<button type = "submit"  id = "show2"> Show History</button>';

            if($n2 > 0)
            {
                echo '<button type = "submit"  id = "show"> Show Pending Appointments</button>';
            }
            ?>
            
            <table>
              <tbody id ="ans">
              </tbody>
          </table>
      </div>
     <script type ="text/javascript">
$(document).ready(function(){
    $("#show").click(function(event) {
        event.preventDefault();
        $.post("showlist.php", function(data){
            $("#ans").html(data);
        });
        
    });
});
</script>


<script type ="text/javascript">
$(document).ready(function(){
    $("#show2").click(function(event) {
        event.preventDefault();
        $.post("showlist2.php", function(data){
            $("#ans").html(data);
        });
        
    });
});
</script>
            
        </div>
    </div>
    

    <div>
        <footer>
            <p> FAST NUCES Lhr, Med Soul.co, Copyright 2023 </p>
            <form id="logoutForm" action="../logout.php" method="post">
  <button type="submit" name="logout">Logout</button>
</form>

<form id="DeleteForm" action="../delete.php" method="post">
  <button type="submit" name="delete">Delete Profile</button>
</form>

        </footer>
    </div>
</body>

</html>