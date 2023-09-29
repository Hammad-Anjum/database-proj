<!doctype html>
<html lang = "en">
    <meta name = "viewport" content="width-device-width , initial-scale = 1.0"> 
    <meta charset="UTF-8">
    <link rel = "stylesheet" href = "./loginstyles.css"/>

<body> 

    <form action = "./login.inc.php" method = "post">
      <h1>Welcome</h1>

      <?php
    if(isset($_GET["error"]))
    {
      if($_GET["error"] == "empty")
      {
        echo "<p>Field is empty</p>";
      }  
      else if($_GET["error"] == "invalid") 
      {
        echo "<p>Invalid email or password</p>";
      }
      else if ($_GET["error"] == "sqlfail")
      {
        echo "<p>Server Error. Retry</p>";
      }

    }
    ?>
      <input type ="text" placeholder="Email Address" name = "email">
        
      <input type ="password" placeholder="Password" name = "password">

      <br>

      <button type = "submit" class = "loginbox" value = "Log In" name = "login">Log In</button>


      <div class  = "text"> Sign up as a <a href = "../signupp/signuppatient.php"> Patient</a>

      <br>
      OR
      <div class = "text"> Sign up as a <a href = "../signupd/signupdoctor.php">Doctor</a>

    </form>



</body>
</html>


