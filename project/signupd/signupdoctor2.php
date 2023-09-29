
<!doctype html>
<html lang = "en">
    <meta name = "viewport" content="width-device-width , initial-scale = 1.0"> 
    <meta charset="UTF-8">
    <link rel = "stylesheet" href = "./signupstylesd2.css"/>

<body> 

    <form action = "./signupdoctor.inc.php" method = "post">

    <h1> Information</h1>

    <?php
    if(isset($_GET["error"]))
    {
       if ($_GET["error"] == "doctor_experience")
      {
        echo "<p>Enter your years of experience</p>";
      }

      else if ($_GET["error"] == "sqlfail")
      {
        echo "<p>Server Error. Retry</p>";
      }
    }
    ?>
    
    <div class="text"> Chose your specialization </div>

      <select id = "select" name="typedoctor">
            <option label=" "></option>
            <option value = "General Physician">General Physician</option>
            <option value = "Dentist">dentist</option>
            <option value = "Psychologist">Psychologist</option>
            <option value = "Neurologists">Neurologist</option>
            <option value = "Dermatologist">Dermatologist</option>
            <option value = "Psychiatrist">Psychiatrist</option>
            <option value = "Cardiologist">Cardiologist</option>
        </select>

        <div class="text"> Specify your Years of Experience </div>
        
        <input type ="number"  name="dyears"  placeholder ="Years of Experience"> 

        <div class="text"> Specify your working hours </div>

        <br>

        <div class = "text2"> Start time </div>
        <input type ="time"  name="start" >

        <div class = "text2"> End time </div>
        <input type ="time"  name="end"  >

        <div class = "text2"> Enter Fees</div>
        <input type ="text"  name="fees"  placeholder ="Fees"> 

        <button type = "submit" name = "signup_doctor2" class = "signupbox" >SUBMIT</button> 
        
    </form>

    

</body>
</html>


