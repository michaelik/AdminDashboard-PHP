<?php
/*
   LOGIN: LOGIN WITH SESSION AND SECURITY ----------------------------------
*/
include('security.php');
if(isset($_POST['login_btn']))
{
	$email_login = $_POST['email'];
	$password_login = $_POST['password'];

	$query = "SELECT * FROM register WHERE email='$email_login' AND password='$password_login'";
	$query_run = mysqli_query($connection, $query);
	$usertypes = mysqli_fetch_array($query_run);

	if($usertypes['usertype'] === "admin")
	{
	  $_SESSION['username'] = $email_login;
	  header('Location: index.php');
	}
	else if($usertypes['usertype'] === "user")
	{
 	  $_SESSION['username'] = $email_login;
	  //link to user Homepage
	 header('Location: ok.php');
	  // echo "no now";
	}
	else
	{
	   $_SESSION['status'] = 'Email id / Password is Invalid';
	  header('Location: login.php');
	}
/*	$count = mysqli_num_rows($query_run);
	if($count > 0)
	{
		while($row = mysqli_fetch_assoc($query_run))
		  {
				$usertypes = $row['usertype'];
	      }  
			if($usertypes == "admin")
			{
			  $_SESSION['username'] = $email_login;
              header('Location: index.php');
			}
			else if($usertypes == "user")
			{
         	  $_SESSION['username'] = $email_login;
			  //link to user page
			 header('Location: ok.php');
			  // echo "no now"; 
			}
	}
	else
	{
      $_SESSION['status'] = 'Email id / Password is Invalid';
      header('Location: login.php');
	}*/
}
?>