<?php

if (isset($_POST['logout']))
{
    $email = null;
    $v1 = null;
    session_destroy();

header("location:../login/loginpage.php");
exit();
}

?>
