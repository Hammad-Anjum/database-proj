<?php

include './typecheck.php';

include '../conn.inc.php';

if(isset($_POST["delete"]))
{
    if($v1)
    {
        $q = "DELETE FROM Doctors WHERE DoctorEmail = ?";
    }
    else
    {
        $q = "DELETE FROM Users WHERE UserEmail = ?";   
    }

    $p = array($email);

    $stmt = sqlsrv_query($conn,$q,$p);

    if($stmt)
    {
        session_destroy();
        header("Location:../login/loginpage.php");
        exit();
    }

}