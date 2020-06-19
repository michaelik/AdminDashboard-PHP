<?php
include('security.php');
/*
  	ADMIN PROFILE: REGISTER/ADD ADMIN DATA----------------------------------
*/
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
/*
  	ABOUT US : REGISTER/ADD ABOUTUS DATA----------------------------------
*/
if (isset($_POST['about_save'])) 
{
	$title = $_POST['title'];
	$subtitle = $_POST['subtitle'];
	$description = $_POST['description'];
	$links = $_POST['links'];

	$query = "INSERT INTO abouts(title, subtitle, description, links) VALUES ('$title', '$subtitle', '$description', '$links')";
    $query_run = mysqli_query($connection, $query);
    
    if ($query_run) 
    {
    	$_SESSION['success'] = "About Us Added";
    	header('Location: aboutus.php');
    }
    else
    {
    	$_SESSION['status'] = "About US Not Added";
    	header('Location: aboutus.php');
    }

}
/*
  	ABOUT US : EDIT/UPDATE ABOUTUS DATA ----------------------------------
*/
if (isset($_POST['update_btn'])) 
{
	$id = $_POST['edit_id'];
	$title = $_POST['edit_title'];
	$subtitle = $_POST['edit_subtitle'];
	$description = $_POST['edit_description'];
    $links = $_POST['edit_links'];

	$query = "UPDATE abouts SET title = '$title', subtitle = '$subtitle', description = '$description', links = '$links' WHERE id = '$id'";
	$query_run = mysqli_query($connection, $query);
	if ($query_run) 
	{
	  $_SESSION['success'] = "Your Data is Updated";
	  header('Location: aboutus.php');
	}
	else
	{
     $_SESSION['status'] = "Your Data is NOT Updated";
     header('Location: aboutus.php');
	}
}
/*
   	ABOUT US : DELETE ABOUTUS DATA -----------------------------------
*/
if (isset($_POST['about_delete_btn'])) 
{
	$id = $_POST['delete_id'];
	$query = "DELETE FROM abouts WHERE id='$id'";
	$query_run = mysqli_query($connection, $query);
	if ($query_run) 
	{
		$_SESSION['success'] = "Your Data is DELETE";
		header('Location: aboutus.php');
	}
	else
	{
		$_SESSION['status'] = "Your Data is NOT DELETE";
		header('Location: aboutus.php');     
	}
}
/*
  	FACULTY: REGISTER/ADD FACULTY DATA AND VALIDATE IMAGES EXTENSION----------------------------------
*/
if(isset($_POST['save_faculty']))
{
 $name = $_POST['faculty_name'];
 $designation = $_POST['faculty_designation'];
 $description = $_POST['faculty_description'];
 $images = $_FILES["faculty_image"]['name'];
 
 // $validate_img_extension = $_FILES["faculty_image"]['type']=="image/jpg" ||
 //      $_FILES["faculty_image"]['type']=="image/png" ||
 //      $_FILES["faculty_image"]['type']=="image/jpeg";
      $img_types = array('image/jpg', 'image/png','image/jpeg');
      $validate_img_extension = in_array($_FILES["faculty_image"]['type'], $img_types);

      if ($validate_img_extension) 
      {
		if(file_exists("upload/".$_FILES["faculty_image"]["name"]))
		{
		   $store = $_FILES["faculty_image"]["name"];
		   $_SESSION['status']= "Image already exists. '.$store.'";
		   header('Location: faculty.php');
		}
		else
		{	
		 $visible = 0;
		 $query = "INSERT INTO faculty(name, designation, description, images, visible) VALUES('$name', '$designation', '$description', '$images', '$visible')";
		 $query_run = mysqli_query($connection, $query);
			 if($query_run) 
			 {  
			 	move_uploaded_file($_FILES["faculty_image"]["tmp_name"], "upload/".$_FILES["faculty_image"]["name"]);
			 	$_SESSION['success'] = "Faculty Added";
			 	header('Location: faculty.php');
			 }
			else
			{
			 	$_SESSION['success'] = "Faculty Not Added";
			 	header('Location: faculty.php');
			}
		}	
      }
      else
      {
        $_SESSION['status'] = "Only PNG, JPG and JPEG Image are allowed";
        header('Location: faculty.php');
      }
}
/*
  	FACULTY: EDIT/UPDATE FACULTY DATA----------------------------------
*/
if (isset($_POST['faculty_update_btn'])) 
{
  $edit_id = $_POST['edit_id'];
  $edit_name = $_POST['edit_name'];
  $edit_designation = $_POST['edit_designation'];
  $edit_description = $_POST['edit_description'];
  $edit_faculty_image = $_FILES["faculty_image"]['name'];

  $img_types = array('image/jpg', 'image/png','image/jpeg');
  $validate_img_extension = in_array($_FILES["faculty_image"]['type'], $img_types);

  if ($validate_img_extension) 
  {
	  $faculty_query = "SELECT * FROM faculty WHERE id='$edit_id'";
	  $faculty_query_run = mysqli_query($connection, $faculty_query);
	  foreach($faculty_query_run as $faculty_row) 
	  { 
	      if($edit_faculty_image == NULL)
	      {
		  	//Update with existing Image
		  	$image_data = $faculty_row['images'];
		  }
		  else
		  {
		  	//Delete Old Image and Update with new image
		  	if ($image_path = "upload/".$faculty_row['images'])
		  	{
		  		unlink($image_path);
		  		$image_data = $edit_faculty_image;
		  	}
		  }
	  }

	  $query = "UPDATE faculty SET name='$edit_name', designation='$edit_designation', description='$edit_description', images='$image_data' WHERE id = '$edit_id'";
	  $query_run = mysqli_query($connection, $query);

	  if($query_run)
	  {
	      if($edit_faculty_image == NULL)
	      {
		 	$_SESSION['success'] = "Faculty Updated with existing image";
		 	header('Location: faculty.php');
		  }
		  else
		  {
		 	move_uploaded_file($_FILES["faculty_image"]["tmp_name"], "upload/".$_FILES["faculty_image"]["name"]);
		 	$_SESSION['success'] = "Faculty Updated";
		 	header('Location: faculty.php');
		  }  
	  }
	  else
	  {
		 	$_SESSION['success'] = "Faculty Not Updated";
		 	header('Location: faculty.php');
	  }
  }
  else
  {
    $_SESSION['status'] = "Only PNG, JPG and JPEG Image are allowed. Try Updating again";
    header('Location: faculty.php');
  }

}
/*
  	FACULTY: IDENTIFY IF EITHER THE CHECKBOX IS CHECKED OR NOT AND SET THE VALUE ONE(1)
  	IN RESPECT TO THE CHECKBOX BEING CHECKED OTHERWISE VALUE(0).----------------------------------
*/
  	if(isset($_POST['search_data']))
  	{
  		$id = $_POST['id'];
  		$visible = $_POST['visible'];

  		$query = "UPDATE faculty SET visible='$visible' WHERE id='$id' ";
  		$query_run = mysqli_query($connection, $query);
  	}
/*
  	FACULTY: DELETE EITHER ONE OR MORE ROW IN RESPECT TO THE NUMBER OF CKECKBOX BEING CKECKED----------------------------------
*/
  	if (isset($_POST['delete_multiple_data'])) {
  		$id = 1;
  		$query = "DELETE FROM faculty WHERE visible='$id'";
  		$query_run = mysqli_query($connection, $query);

  		if ($query_run) 
  		{
  			$_SESSION['success'] = "Your Data is DELETED";
  			header('Location: faculty.php');
  		}
  		else
  		{
  			$_SESSION['status'] = "Your Data is NOT DELETED";
  			header('Location: faculty.php');	
  		}
  	}
/*
  	FACULTY: DELETE FACULTY DATA----------------------------------
*/
   if(isset($_POST['faculty_delete_btn'])) {
   	$id = $_POST['delete_id'];
   	$query = "DELETE FROM faculty WHERE id='$id'";
   	$query_run = mysqli_query($connection, $query);
   	if($query_run) 
   	{
   		$_SESSION['success'] = "Faculty Data is Deleted";
   		header('Location: faculty.php');
   	}
   	else
   	{
   		$_SESSION['status'] = "Faculty Data is NOT DELETED";
   		header('Location: faculty.php');
   	}
   }
?>