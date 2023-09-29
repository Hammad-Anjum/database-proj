<?php

include '../../conn.inc.php';

$sql = "SELECT DISTINCT specialization FROM DoctorType";
$sql2 = "SELECT DISTINCT DoctorCity FROM Doctors";
$res = sqlsrv_query($conn,$sql);
$res2 =  sqlsrv_query($conn,$sql2);
$query = "SELECT DoctorName,DoctorCity,specialization from Doctors join DoctorType on Doctors.DoctorEmail = DoctorType.DoctorEmail";
$result = sqlsrv_query($conn,$query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catlog-MedSoul</title>
    <script type ="text/javascript" src ="fetch.js"></script>
    <script src ="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../style2.css">
    <style>
 select::-ms-expand {
  display: none;
  background-color: white;
}

select {
  display: inline-block;
  box-sizing: border-box;
  padding: 0.5em 2em 0.5em 0.5em;
  border: 1px solid #eee;
  font: inherit;
  line-height: inherit;
  -webkit-appearance: none;
  -moz-appearance: none;
  -ms-appearance: none;
  appearance: none;
  background-repeat: no-repeat;
  background-image: linear-gradient(45deg, transparent 50%, currentColor 50%), linear-gradient(135deg, currentColor 50%, transparent 50%);
  background-position: right 15px top 1em, right 10px top 1em;
  background-size: 5px 5px, 5px 5px;
  background-color:  #4e4774;
}
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
                    <td><a href="index.html"><img src="../img/Logo.png"alt="Logo" height="100px" style="padding: 10px"></a></td>

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
                                    <input type="text" id ="myInput" name =""  placeholder="Search...">
                                </tr>
                            </table>
                        </nav>
                    </td>
                </tr>
            </table>
        </div>
    </Header>
    <!-- Division for Center Items -->
   

    <b style="color: white;"> Select Specialization:</b>
  
  <select  id="specialization" onchange="selectProduct()">
  
  <option value="All">All</option>
  
  <?php
  while($rows = sqlsrv_fetch_array($res)){
      ?>
      
      <option value="<?php echo $rows['specialization']; ?>"> 
      <?php echo $rows['specialization']; ?>
      </option>
      <?php
  }
  ?>
  
  </select>
  
   <b style="color: white;">Select City:</b>
  
  <select  id="DoctorCity" onchange="selectProduct2()">
  
  <option value="All">All</option>
  
  <?php
  while($rows2 = sqlsrv_fetch_array($res2)){
      ?>
      
      <option value="<?php echo $rows2['DoctorCity']; ?>"> 
      <?php echo $rows2['DoctorCity']; ?>
      </option>
      <?php
  }
  ?>
  
  </select>
  
  
          <table>
              <thead>
              <tr >
              
              <th>Name</th>
              <th>City</th>
              <th>Specialization</th>
              
              </tr>
              </thead>
              <tbody id ="ans">
              <tr>
              <?php
              
          while ($row = sqlsrv_fetch_array($result)) {
              ?>
             
                  <td><?php echo $row['DoctorName']; ?></td>
                  <td><?php echo $row['DoctorCity']; ?></td>
                  <td><?php echo $row['specialization']; ?></td>
               
              </tr>
              <?php
          }
          ?>
  
              </tbody>
          </table>
      </div>
      <script type ="text/javascript">
      $(document).ready(function(){
          $("#myInput").on("keyup",function(){
              var value = $(this).val().toLowerCase()
                 $("#ans tr").filter(function(){
                   $(this).toggle($(this).text().toLowerCase().indexOf(value)>-1);
  
                 });

             
  
          });
      });

    function selectProduct(){
   var x = document.getElementById("specialization").value;
   $.ajax({
    url:"fetch.php",
    method:"POST",
    data:{
        id: x
    },
    success:function(data){
        $("#ans").html(data);
    }
   })
}

    function selectProduct2(){
    var x = document.getElementById("DoctorCity").value;
    $.ajax({
     url:"fetch2.php",
     method:"POST",
     data:{
         id: x
     },
     success:function(data){
         $("#ans").html(data);
     }
    })
 }


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