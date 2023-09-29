<?php
$Srv = "LAPTOP-0KB9K72M";
$info = array("Database" => "Project");
$conn = sqlsrv_connect($Srv, $info);

if ($conn === false)
{
    die( "Connection Failed :" .print_r(sqlsrv_errors(),true));
} 
