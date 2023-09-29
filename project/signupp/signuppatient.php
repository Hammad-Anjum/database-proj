<!doctype html>
<html lang = "en">
    <meta name = "viewport" content="width-device-width , initial-scale = 1.0"> 
    <meta charset="UTF-8">
    <link rel = "stylesheet" href = "./signupstyles.css"/>

<body> 

    <form action = "./signup.inc.php" method = "post">

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
      else if ($_GET["error"] == "emptyphone")
      {
        echo "<p>Invalid Phone Number</p>";
      }
      else if ($_GET["error"] == "emptypass")
      {
        echo "<p>Invalid Password</p>";
      }
      else if ($_GET["error"] == "passmiss")
      {
        echo "<p>Passwords' Dont Match</p>";
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

        <input type ="text"  name="name" placeholder ="Full Name"> 

        <input type ="email"  name="email"  placeholder ="Email Address"> 

        <input type ="date" name="dob" > 

        <input type ="tel" name="phone"  placeholder="Phone Number">

        <input type ="tel" name="cnic"  placeholder="CNIC" >
        
        <select id = "city" name="city">
          <option value = "none"></option>
            <option value = "Lahore">Lahore</option>
            <option value = "Islamabad">Islamabad</option>
            <option value = "Karachi">Karachi</option>
            <option value = "Faisalabad">Faisalabad</option>
            <option value = "Multan">Multan</option>
            <option value = "Quetta">Quetta</option>

        </select>

        <input type ="password" name = "password"  placeholder="Password">
        
        <input type ="password" name = "passwordr" placeholder="Repeat Password">

        <button type = "submit" name = "signup" class = "signupbox" >Sign Up</button> 
        
    </form>

</body>
</html>


