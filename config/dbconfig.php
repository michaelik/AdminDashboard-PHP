<?php
$server_name = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "admin_lone";
$connection = mysqli_connect($server_name, $db_username,"");
$dbconfig = mysqli_select_db($connection, $db_name);
if(!$dbconfig) 
{
 header("Location: ../dberror.php");
} 
?>