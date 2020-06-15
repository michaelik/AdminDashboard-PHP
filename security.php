<?php
session_start();
include('config/dbconfig.php');
if(!$dbconfig) 
{
  header("Location: config/dbconfig.php");
} 
if(!$_SESSION['username'])
{
    header('Location: login.php');
}

?>