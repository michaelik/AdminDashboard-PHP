<?php
session_start();
$connection = mysqli_connect("localhost","root","","admin_clone") or die(mysqli_error());

if(isset($_POST['registerbtn']))
{
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $cpassword = $_POST['confirmpassword'];
if(!empty($username) && !empty($email) && !empty($password) && !empty($cpassword))
 {	
	  if ($password === $cpassword) 
	  {
	  	$query = "INSERT INTO register(username, password, email) VALUES('$username', '$password', '$email')";
	  	$query_run = mysqli_query($connection, $query);
	  	if($query_run)
	  	{
	  		$_SESSION['success'] = "Admin Profile Added";
	  		header('Location: register.php');
	  	}
	  	else
	  	{
	  		$_SESSION['status'] = "Admin Profile Not Added";
	  		header('Location: register.php');
	  	}
	  }
	  else
	  {
	  	$_SESSION['status'] = "Password and Confirm Password Does Not Match";
	  	header('Location: register.php');
	  }
 }
 else
 {
 		$_SESSION['status'] = "Admin Profile Not Added Please Fill All The Field";
	  	header('Location: register.php');
 }
}
/*
  	ADMIN PROFILE: EDIT/UPDATE ADMIN DATA----------------------------------
*/
if (isset($_POST['updatebtn'])) 
{
	$id = $_POST['edit_id'];
	$username = $_POST['edit_username'];
	$email = $_POST['edit_email'];
	$password = $_POST['edit_password'];

	$query = "UPDATE register SET username = '$username', password = '$password', email = '$email' WHERE id = '$id'";
	$query_run = mysqli_query($connection, $query);
	if ($query_run) 
	{
	  $_SESSION['success'] = " Your Data is Updated";
	  header('Location: register.php');
	}
	else
	{
     $_SESSION['status'] = "Your Data is NOT Updated";
     header('Location: register.php');
	}
}
/*
   ADMIN PROFILE: DELETE ADMIN DATA ----------------------------------
*/
if (isset($_POST['delete_btn'])) 
{
	$id = $_POST['delete_id'];
	$query = "DELETE FROM register WHERE id='$id'";
	$query_run = mysqli_query($connection, $query);
	if ($query_run) 
	{
		$_SESSION['success'] = "Your Data is DELETE";
		header('Location: register.php');
	}
	else
	{
		$_SESSION['status'] = "Your Data is NOT DELETE";
		header('Location: register.php');     
	}
}



?>