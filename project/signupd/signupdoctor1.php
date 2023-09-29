<!doctype html>
<html lang = "en">
    <meta name = "viewport" content="width-device-width , initial-scale = 1.0"> 
    <meta charset="UTF-8">
    <link rel = "stylesheet" href = "./signupstylesd1.css"/>

<body> 

    <form action = "./signupdoctor.inc.php" method = "post">

    <h1>Sign Up</h1>

    <?php
    if(isset($_GET["error"]))
    {
      if($_GET["error"] == "emptyname")
      {
        echo "<p>Invalid Name</p>";
      }  
      else if ($_GET["error"] == "emptyemail")
      {
        echo "<p>Invalid Email</p>";
      }
      else if ($_GET["error"] == "emptypass")
      {
        echo "<p>Invalid Password</p>";
      }
      else if ($_GET["error"] == "nomatch")
      {
        echo "<p>Passwords dont match</p>";
      }
      else if ($_GET["error"] == "emptyphone")
      {
        echo "<p>Invalid Phone Number</p>";
      }
      else if ($_GET["error"] == "emailexists")
      {
        echo "<p>Email Already Exists</p>";
      }
      else if ($_GET["error"] == "sqlfail")
      {
        echo "<p>Server Error. Retry</p>";
      }
      else if($_GET["error"] == "incnic")
      {
        echo "<p>Incorrect CNIC</p>";
      }
      else if($_GET["error"] == "inphone")
      {
        echo "<p>Incorrect Phone Number</p>";
      }
    }
    ?>

        <input type ="text"  name="dname" placeholder ="Full Name"> 

        <input type ="email"  name="demail"  placeholder ="Email Address"> 

        <input type ="tel" name="dphone"  placeholder="Phone Number">

        <input type ="tel" name="dcnic"  placeholder="CNIC">
        
        <select id = "city" name="dcity">
          <option value = "none">City</option>
            <option value = "Lahore">Lahore</option>
            <option value = "Islamabad">Islamabad</option>
            <option value = "Karachi">Karachi</option>
            <option value = "Faisalabad">Faisalabad</option>
            <option value = "Multan">Multan</option>
            <option value = "Quetta">Quetta</option>

        </select>

        <input type ="password" name = "dpassword"  placeholder="Password">

        <input type ="password" name = "dpasswordr" placeholder="Repeat Password">

        <button type = "submit" name = "signup_doctor" class = "signupbox" >Sign Up</button> 
        
    </form>

</body>
</html>


