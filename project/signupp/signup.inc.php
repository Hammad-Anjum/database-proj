<?php

include '../functions.inc.php';

if (isset($_POST["signup"]))
{
    session_start();


    $name = $_POST["name"];
    $_SESSION["pemail"] = $_POST["email"];
    $pass = $_POST["password"];
    $city = $_POST["city"];
    $cnic = $_POST["cnic"];
    $passr = $_POST["passwordr"];
    $phone = $_POST["phone"];
    $dob = $_POST["dob"];

    if (EmptyName($name) === true)
    {
        header("location:./signuppatient.php?error=emptyname");
        exit();
    }

    if (EmptyEmail($_SESSION["pemail"]) === true)
    {
        header("location:./signuppatient.php?error=emptyemail");
        exit();
    }

    if (EmptyPass($pass,$passr) === true)
    {
        header("location:./signuppatient.php?error=emptypass");
        exit();
    }

    if (EmptyPhone($phone) === true)
    {
        header("location:./signuppatient.php?error=emptyphone");
        exit();
    }

    if (EmptyCNIC($cnic) === true)
    {
        header("location:./signuppatient.php?error=emptycnic");
        exit();
    }

    if (PassNotMatch($pass, $passr) === true)
    {
        header("location:./signuppatient.php?error=passmiss");
        exit();
    }

    if (IfEmailExists($conn,$_SESSION["pemail"]) === true)
    {
        header("location:./signuppatient.php?error=emailexists");
        exit();   
    }

    if(CNICCheck($cnic) === true)
    {
        header("location:./signuppatient.php?error=incnic");
        exit();    
    }

    if(NumCheck($phone) === true)
    {
        header("location:./signuppatient.php?error=inphone");
        exit();    
    }

    CreateUser($conn,$name,$_SESSION["pemail"],$city,$dob,$phone,$pass,$cnic);
    header("location:../login/loginpage.php");

}
else
{
    header("location:./signuppatient.php");
}
