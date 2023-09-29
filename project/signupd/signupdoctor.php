
<!doctype html>
<html lang = "en">
    <meta name = "viewport" content="width-device-width , initial-scale = 1.0"> 
    <meta charset="UTF-8">
    <link rel = "stylesheet" href = "./signupstylesd.css"/>

<body> 
  
  <form action = "./signupdoctor.inc.php" method = "post">
    <h1>Verification</h1>
    <div class = "text"> Enter your hospital ID for verification</div>

    <?php
    if(isset($_GET["error"]))
    {
      if($_GET["error"] == "emptyhospitalID")
      {
        echo "<p>Empty Hospital ID</p>";
      }  
      else if ($_GET["error"] == "invalidID")
      {
        echo "<p>sorry, your ID cannot verify by any organization</p>";
      }
     else if ($_GET["error"] == "sqlfail")
      {
        echo "<p>Server Error. Retry</p>";
      }
    }
    ?>

    <input type ="text"  name="hospital_id" placeholder ="Hospital ID">

    <button type = "submit" name = "verify" class = "signupbox" >VERIFY</button>  
    </form>

    

</body>
</html>


