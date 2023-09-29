<?php

include '../functions.inc.php';

session_start();

if (isset($_POST["verify"]))
{
   $_SESSION["hid"] =  $_POST["hospital_id"];

    if (Hospital_IDempty($_SESSION["hid"] ) === true)
    {
        header("location:./signupdoctor.php?error=emptyhospitalID");
        exit();
    }
    
    if (Invalid_hospitalid($conn,$_SESSION["hid"] ) === true)
    {
        header("location:./signupdoctor.php?error=invalidID");
        exit();
    }

    header("location:./signupdoctor1.php");    
}

if (isset($_POST["signup_doctor"]))
{
    $_SESSION["dname"] = $_POST["dname"];
    $_SESSION["demail"] = $_POST["demail"];
    $_SESSION["dphone"] =  $_POST["dphone"];
    $_SESSION["dcity"] = $_POST["dcity"];
    $_SESSION["dcnic"] = $_POST["dcnic"];
    $_SESSION["dpass"] =  $_POST["dpassword"];
    $_SESSION["dpassr"] =  $_POST["dpasswordr"];
   
    if (EmptyName($_SESSION["dname"]) === true)
    {
        header("location:./signupdoctor1.php?error=emptyname");
        exit();
    }

    if (EmptyEmail($_SESSION["demail"] ) === true)
    {
        header("location:./signupdoctor1.php?error=emptyemail");
        exit();
    }

    if (EmptyPass($_SESSION["dpass"],$_SESSION["dpassr"]  ) === true)
    {
        header("location:./signupdoctor1.php?error=emptypass");
        exit();
    }

    if (EmptyPhone($_SESSION["dphone"] ) === true)
    {
        header("location:./signupdoctor1.php?error=emptyphone");
        exit();
    }

    if (EmptyCNIC($_SESSION["dcnic"]) === true)
    {
        header("location:./signupdoctor1.php?error=emptycnic");
        exit();
    }

    if (EmptyCity($_SESSION["dcity"]) === true)
    {
        header("location:./signupdoctor1.php?error=emptycity");
        exit();
    }

    if (doctor_IfEmailExists($conn,$_SESSION["user_email"]) === true)
    {
        header("location:./signupdoctor1.php?error=emailexists");
        exit();   
    }

    if(PassNotMatch($_SESSION["dpass"], $_SESSION["dpassr"] ) === true)
    {
        header("location:./signupdoctor1.php?error=nomatch");
        exit();      
    }
    
    if(CNICCheck($_SESSION["dcnic"]) === true)
    {
        header("location:./signuppatient.php?error=incnic");
        exit();    
    }

    if(NumCheck($_SESSION["dphone"] ) === true)
    {
        header("location:./signuppatient.php?error=inphone");
        exit();    
    }
     
    header("location:./signupdoctor2.php");
}





if (isset($_POST["signup_doctor2"]))
    {
        $doctor_years =  $_POST["dyears"];
        $typedoctor =  $_POST["typedoctor"];
        $starthour = $_POST["start"];
        $endhour = $_POST["end"];
        $fees = $_POST["fees"];


    
    if (doctor_yearsofexperience($doctor_years) === true)
    {
        header("location:./signupdoctor2.php?error=doctor_experience");
        exit();
    }

    if(IncorrectFees($fees) === true)
    {
        header("location:./signupdoctor2.php?error=fees");
        exit();
    }
 
    CreateDoctor($conn,$_SESSION["dname"],$_SESSION["demail"] ,$_SESSION["dcity"] ,$typedoctor,$_SESSION["hid"],$_SESSION["dphone"],$_SESSION["dpass"] ,$doctor_years,$_SESSION["dcnic"],$starthour,$endhour,$fees);
    header("location:../login/loginpage.php");

}


