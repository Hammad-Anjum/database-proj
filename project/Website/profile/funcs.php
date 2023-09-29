<?php

include ('../../conn.inc.php');


function GetName($v1,$email)
{
    global $conn;
    if($v1)
    {
        $q = "SELECT DoctorName FROM Doctors WHERE DoctorEmail = ?";
        $p = array($email);
        $stmt = sqlsrv_query($conn,$q,$p);

        if($stmt)
        {
        $res = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
        $name = $res['DoctorName'];
        return $name;
        }
        else 
        {
            echo sqlsrv_errors();
        }

    }
    else
    {
        $q = "SELECT UserName FROM Users WHERE UserEmail = ?";
        $p = array($email);
        $stmt = sqlsrv_query($conn,$q,$p);

        if($stmt)
        {
            $res = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
            $name = $res['UserName'];
            return $name;
        }
        else
        {
        echo sqlsrv_errors();
        }
    }
    
}

function GetAppointments($v1,$email)
{
    global $conn;
    if($v1)
    {
        $q = "SELECT COUNT(DoctorEmail) AS NoOfAppt FROM Appointment WHERE DoctorEmail = ?";
    }
    else
    {
        $q = "SELECT COUNT(UserEmail) AS NoOfAppt FROM Appointment WHERE UserEmail = ?";
    }

    $p = array($email);
    $stmt = sqlsrv_query($conn,$q,$p);

    if($stmt)
    {
        $res = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
        $n = $res['NoOfAppt'];
        return $n;
    }
    else
    {
        echo sqlsrv_errors();
    }

}


function GetPendingAppt($v1,$email)
{
    $currdatetime = date('Y-m-d H:i:s');
    global $conn;
    if($v1)
    {
        $q = "SELECT COUNT(DoctorEmail) AS NoOfAppt FROM Appointment WHERE DoctorEmail = ? AND StartTime > ?";
    }
    else
    {
        $q = "SELECT COUNT(UserEmail) AS NoOfAppt FROM Appointment WHERE UserEmail = ? AND StartTime > ?";
    }

    $p = array($email,$currdatetime);
    $stmt = sqlsrv_query($conn,$q,$p);

    if($stmt)
    {
        $res = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC);
        $n = $res['NoOfAppt'];
        return $n;
    }
    else
    {
        echo sqlsrv_errors();
    }

}



$functions  = [
    'GetName' => 'GetName',
    'GetAppointments' => 'GetAppointments',
    'GetPendingAppt'=> 'GetPendingAppt'
];
return $functions;

