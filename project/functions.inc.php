<?php
include ('conn.inc.php');

function EmptyName($name)
{
    if (empty($name))
    {
        return true;
    }
    return false;
}


function EmptyEmail($email)
{
    if (empty($email))
    {
        return true;
    }
    return false;
}

function EmptyPhone($phone)
{
    if (empty($phone))
    {
        return true;
    }
    return false;
}

function EmptyCity($city)
{
    if (empty($city) || $city === "City")
    {
        return true;
    }
    return false;
}

function EmptyCNIC($cnic)
{
    if (empty($cnic))
    {
        return true;
    }
    return false;
}

function CNICCheck($cnic)
{
    if(strlen($cnic) === 13)
    {
        if(is_numeric($cnic))
        {
            return false;
        }
    }
    return true;
}

function NumCheck($phone)
{
    if(strlen($phone) === 11)
    {
        if(is_numeric($phone))
        {
            return false;
        }
    }
    return true;
}


function IncorrectFees($fees)
{
    if(strlen($fees) > 8)
    {
        if(is_numeric($fees))
        {
            return false;
        }
    }
    return true;
}

function EmptyPass($pass,$passr)
{
    if (empty($pass) || empty($passr))
    {
        return true;
    }
    return false;
}

function IfEmailExists($conn,$email)
{
    $q = "SELECT * FROM Users WHERE UserEmail = ?";
    $p = array($email);

    $stmt = sqlsrv_query($conn,$q,$p);

    if ($stmt === false)
    {
        header("location:./signuppatient.php?error=sqlfail");
        exit();
    }

    $result = sqlsrv_num_rows($stmt);

    if($result > 0)
    {
        return true;
    }

    return false;
}


function PassNotMatch($pass, $passr)
{
    if($pass !== $passr)
    {
        return true;
    }
    return false;

}

function CreateUser($conn, $name ,$email ,$city,$dob, $phone, $pass,$cnic)
{
    $q = "INSERT INTO Users(UserName,UserEmail,UserCity,UserDOB,UserPhone,UserPass,UserCNIC) VALUES (?,?,?,?,?,?,?)";
    $p = array($name, $email, $city,$dob,$phone,$pass,$cnic);

    $stmt = sqlsrv_query($conn,$q,$p);

    if ($stmt === false)
    {
        header("location:./signuppatient.php?error=sqlfail");
        exit();
    }
}

function EmptyLogin($email,$pass)
{
    if (empty($email) || empty($pass))
    {
        return true;
    }
    return false;
}

function InvalidField($conn,$email,$pass)
{
    $q = "SELECT * FROM Users WHERE UserEmail = ? and UserPass = ?";
    $p = array($email,$pass);

    $stmt = sqlsrv_query($conn,$q,$p);

    if ($stmt === false)
    {
        header("location:./loginpage.php?error=sqlfail");
        exit();
    }

    $result = sqlsrv_has_rows($stmt);

    if($result === true)
    {
        return false;
    }

    return true;
    
}

function InvalidField2($conn,$email,$pass)
{
    $q = "SELECT * FROM Doctors WHERE DoctorEmail = ? and DoctorPass = ?";
    $p = array($email,$pass);

    $stmt = sqlsrv_query($conn,$q,$p);

    if ($stmt === false)
    {
        header("location:./loginpage.php?error=sqlfail");
        exit();
    }

    $result = sqlsrv_has_rows($stmt);

    if($result === true)
    {
        return false;
    }
    return true;
}

function doctor_IfEmailExists($conn,$doctor_email)
{
    $q = "SELECT * FROM Doctors WHERE DoctorEmail = ?";
    $p = array($doctor_email);

    $stmt = sqlsrv_query($conn,$q,$p);

    if ($stmt === false)
    {
        header("location:./signupdoctor1.php?error=sqlfail");
        exit();
    }

    $result = sqlsrv_has_rows($stmt);

    if($result === true)
    {
        return true;
    }

    return false;
}

function doctor_yearsofexperience($doctor_years)
{
    if (empty($doctor_years))
    {
        return true;
    }
    return false;
}


function Hospital_IDempty($hospital_id)
{
    
   if (empty($hospital_id))
    {
        return true;
    }
    return false;

}

function Invalid_hospitalid($conn,$hospital_id)
{
    $q = "SELECT * FROM Hospital WHERE HospitalID = ?";
    $p = array($hospital_id);

    $stmt = sqlsrv_query($conn,$q,$p);

    if ($stmt === false)
    {
        header("location:./signupdoctor.php?error=sqlfail");
        exit();
    }

    $result = sqlsrv_has_rows($stmt);
    
    if($result === true)
    {
        return false;
    }

    return true;
}

function CreateDoctor($conn,$doctor_name,$doctor_email,$doctor_city,$typedoctor,$hospital_id,$doctor_phone,$doctor_pass,$doctor_years,$doctor_cnic,$starthour,$endhour,$fees)
{
    $q = "INSERT INTO Doctors(DoctorName,DoctorEmail,DoctorCity,DoctorPhone,DoctorPass,DoctorCNIC,StartWorkHours,EndWorkHours,HospitalID) VALUES (?,?,?,?,?,?,?,?,?)";
    $p = array($doctor_name,$doctor_email,$doctor_city,$doctor_phone,$doctor_pass,$doctor_cnic,$starthour,$endhour,$hospital_id);

    $stmt = sqlsrv_query($conn,$q,$p);

    if ($stmt === false)
    {
        header("location:./signupdoctor2.php?error=sqlfail");
        exit();
    }

    $q = "SELECT * from Doctors WHERE DoctorEmail = ?";
    $p = array($doctor_email);

    $stmt = sqlsrv_query($conn,$q,$p);

    if ($stmt === false)    
    {
        header("location:./signupdoctor2.php?error=sqlfail");
        exit();
    }

    $result = sqlsrv_fetch_array($stmt);

    $email = $result["DoctorEmail"];

    $q = "INSERT INTO DoctorType VALUES (?,?,?)";
    $p = array($email,$typedoctor,$doctor_years);

    $stmt = sqlsrv_query($conn,$q,$p);

    if ($stmt === false)
    {
        header("location:./signupdoctor2.php?error=sqlfail");
        exit();
    }


    $q = "INSERT INTO DoctorsFee VALUES (?,?)";
    $p = array($email,$fees);

    $stmt = sqlsrv_query($conn,$q,$p);

    if ($stmt === false)
    {
        header("location:./signupdoctor2.php?error=sqlfail");
        exit();
    }

}

