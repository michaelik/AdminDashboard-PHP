<?php
/*
  	ADMIN PROFILE: REGISTER/ADD ADMIN DATA----------------------------------
*/
include('security.php');
$connection = mysqli_connect("localhost","root","","admin_clone") or die(mysqli_error());

if(isset($_POST['registerbtn']))
{
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $cpassword = $_POST['confirmpassword'];
  $usertype = $_POST['usertype'];

if(!empty($username) && !empty($email) && !empty($password) && !empty($cpassword) && !empty($usertype))
 {	
	  if ($password === $cpassword) 
	  {
	  	$query = "INSERT INTO register(username, email, password, usertype) VALUES('$username', '$email', '$password', '$usertype')";
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
    $update_usertype = $_POST['update_usertype'];

	$query = "UPDATE register SET username = '$username', password = '$password', email = '$email', usertype = '$update_usertype' WHERE id = '$id'";
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