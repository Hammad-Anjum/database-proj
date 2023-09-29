<?php
session_start();
if(isset($_SESSION["logintype"]))
{
    if($_SESSION["logintype"] === 'user')
    {
        $v1 = false;
    }
    else
    {
        $v1 = true;
    }
    $email = $_SESSION['user_email'];

}
else if(isset($_SESSION["demail"]))
{
    $v1 = true;
    $email = $_SESSION['demail'];
}
else if (isset($_SESSION["pemail"]))
{
    $v1 = false;
    $email = $_SESSION['pemail'];
}
?>
