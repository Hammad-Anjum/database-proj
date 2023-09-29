<?php

include '../functions.inc.php';

if(isset($_POST["login"]))
{
    $email= $_POST["email"];
    $pass = $_POST["password"];

    if (EmptyLogin($email,$pass) === true)
    {
        header("location:./loginpage.php?error=empty");
        exit();
    }

    if(InvalidField($conn,$email,$pass) === false)
    {
        session_start();
        $_SESSION["logintype"] = 'user';
        $_SESSION["user_email"] = $email;
        header("location:../Website/profile/profile.php");
        exit();
    }
    else if(InvalidField2($conn,$email,$pass) === false)
    {
        session_start();
        $_SESSION["user_email"] = $email;
        $_SESSION["logintype"] = 'doctor';
        header("location:../Website/profile/profile.php");
        exit();
    }

    header("location:./loginpage.php?error=invalid");
}
else
{
    header("location:./loginpage.php");
}