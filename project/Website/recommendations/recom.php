<?php

include '../../conn.inc.php';

$sql = "SELECT DISTINCT specialization FROM DoctorType";
$sql2 = "SELECT DISTINCT DoctorCity FROM Doctors";
$res = sqlsrv_query($conn,$sql);
$res2 =  sqlsrv_query($conn,$sql2);
$query = "SELECT DoctorName,DoctorCity,specialization FROM Doctors join DoctorType on Doctors.DoctorEmail = DoctorType.DoctorEmail";
$result = sqlsrv_query($conn,$query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catlog-MedSoul</title>
    <script type ="text/javascript" src ="f.js"></script>
    <script src ="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../style2.css">
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
tr {


}

td {
  border-bottom: 1px solid #ddd;
}
#searchTerm {
        float: left;
    }

    #searchButton {
        float: left;
        margin-left: 10px;
    }

    </style>
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
                    <td><a href="index.html"><img src="../img/logo.png"alt="Logo" height="100px" style="padding: 10px"></a></td>

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
                                    <td>
                                        <form id="searchForm">
                                        <input type="text" id="searchTerm" placeholder="Search...">
                                        <button id="searchButton">Search</button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </nav>
                    </td>
                </tr>
            </table>
        </div>
    </Header>
    <b style= "color: white; text-align: center;">Search by city and specialization for doctor recommendations...</b>
  
          <table>
            
              <tbody id ="ans">
              </tbody>
          </table>
      </div>
     <script type ="text/javascript">
$(document).ready(function(){
    $("#searchForm").submit(function(event) {
        event.preventDefault();
        var value = $("#searchTerm").val().toLowerCase().trim();
        if (value.length > 0) {
            $.post("f.php", {id: value}, function(data){
                $("#ans").html(data);
            });
        }
    });
});
</script>
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
