<?php
include('security.php');
/*
  	ADMIN PROFILE: REGISTER/ADD ADMIN DATA----------------------------------
*/
/*......verify Email and Output Error......*/
if (isset($_POST['check_submit_btn'])) 
{
	$email = $_POST['email_id'];
    
	$email_query = "SELECT * FROM register WHERE email='$email'";
	$email_query_run = mysqli_query($connection, $email_query);
	if (mysqli_num_rows($email_query_run) > 0) 
	{
       echo "Email Already Exists. Please Try Another One.";
	}
	else
	{
		 
	}

}

if(isset($_POST['registerbtn']))
{
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $cpassword = $_POST['confirmpassword'];
  $usertype = $_POST['usertype'];

$email_query = "SELECT * FROM register WHERE email='$email'";
$email_query_run = mysqli_query($connection, $email_query);
if (mysqli_num_rows($email_query_run) > 0) 
{
	  	$_SESSION['success'] = "Email Already Taken. Please Try Another One.";
		header('Location: register.php');
}
else
{
	if(!empty($username) && !empty($email) && !empty($password) && !empty($cpassword) && !empty($usertype))
	 {	
		  if ($password === $cpassword) 
		  {
		  	$query = "INSERT INTO register(username, email, password, usertype) VALUES('$username', '$email', '$password', '$usertype')";
		  	$query_run = mysqli_query($connection, $query);
		  	if($query_run)
		  	{
		  		$_SESSION['status'] = "Admin Profile Added";
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
      $img_types = array('gif','jpe','jpg', 'png','jpeg');
      $validate_img_extension = in_array($_FILES["faculty_image"]['type'], $img_types);

      if ($validate_img_extension) 
      {
			$_SESSION['status'] = "Only PNG, JPG and JPEG Image are allowed";
	        header('Location: faculty.php');	
      }
      else
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
			 	$target_file =  "upload/".$_FILES["faculty_image"]["name"];
			 	 if (move_uploaded_file($_FILES["faculty_image"]["tmp_name"], $target_file)) 
			 	 {
			 	 	$_SESSION['success'] = "Faculty Added";
			 	    header('Location: faculty.php');
				   // echo "<P>FILE UPLOADED TO: $target_file</P>";
				 } else {
			       echo "<P>MOVE UPLOADED FILE FAILED! OF PERHAPS THE SIZE OF IMAGE IS LARGER THAN post_max_size setting in php.ini</P>";
			       print_r(error_get_last());
				 } 
			 }
			else
			{
			 	$_SESSION['success'] = "Faculty Not Added";
			 	header('Location: faculty.php');
			}
		}
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
/*
  	DEPARTMENT: REGISTER/ADD DEPARTMENT DATA----------------------------------
*/
  if (isset($_POST['dept_save'])) 
  {
  	$name = $_POST['name'];
  	$description = $_POST['description'];
  	$image = $_FILES["dept_image"]['name'];

      $img_types = array('gif','jpe','jpg', 'png','jpeg');
      $validate_img_extension = in_array($_FILES["dept_image"]['type'], $img_types);
 
      if($validate_img_extension) 
      {
        $_SESSION['status'] = "Only PNG, JPG and JPEG Image are allowed";
        header('Location: departments.php');	
      }
      else
      {
		if(file_exists("upload/departments/".$_FILES["dept_image"]["name"]))
		{
		   $store = $_FILES["dept_image"]["name"];
		   $_SESSION['status']= "Image already exists. '.$store.'";
		   header('Location: departments.php');
		}
		else
		{	
		 $query = "INSERT INTO dept_category(name, description, image) VALUES('$name', '$description', '$image')";
		 $query_run = mysqli_query($connection, $query);
			 if($query_run) 
			 {  
			 	$target_file =  "upload/departments/".$_FILES["dept_image"]["name"];
			 	 if (move_uploaded_file($_FILES["dept_image"]["tmp_name"], $target_file)) 
			 	 {
					 	$_SESSION['success'] = "Department Category Added";
					 	header('Location: departments.php');
				        // echo "<P>FILE UPLOADED TO: $target_file</P>";
				 } else {
				       echo "<P>MOVE UPLOADED FILE FAILED! OF PERHAPS THE </p>
				             <p>SIZE OF IMAGE IS LARGER THAN post_max_size setting in php.ini</P>
				             <p>OR</p>
				             <p>CREATE THE FORM THIS WAY BY SETTING MAX_FILE_SIZE:</p>
				             <p>form enctype=multipart/form-data method=POST</p>
				             <p>MAX_FILE_SIZE must precede the file input field</p>
				             <p>input type=hidden name=MAX_FILE_SIZE value=300000</p>
				             <p>Name of input element determines name in _FILES array</p>
				             <p>Send this file: input name=userfile type=file</p>
				             <p>input type=submit value=Send File</p>
				             <p>form</p>";
				       print_r(error_get_last());
				 } 
			 }
			else
			{
			 	$_SESSION['status'] = "Department Category Not Added";
			 	header('Location: departments.php');
			}
		}
      }
  }
/*
  	DEPARTMENT: UPDATE DEPARTMENT DATA----------------------------------
*/
  if (isset($_POST['dept_cate_update_btn'])) 
  {
  	$updating_id = $_POST['updating_id'];
  	$edit_name = $_POST['edit_name'];
  	$edit_description = $_POST['edit_description'];
  	$edit_dept_cate_image = $_FILES["dept_cate_image"]['name'];

  	$query = "UPDATE dept_category SET name='$edit_name', description='$edit_description', image='$edit_dept_cate_image' WHERE id='$updating_id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run) 
    {
    	move_uploaded_file($_FILES["dept_cate_image"]["tmp_name"], "upload/departments/".$_FILES["dept_cate_image"]['name']);
    	$_SESSION['success'] = "Dept Category Updated";
    	header('Location: departments.php');
    }
    else
    {
        $_SESSION['status'] = "Dept Category Not Updated";
    	header('Location: departments.php');	
    }
  }
/*
  	DEPARTMENT: DELETE DEPARTMENT DATA----------------------------------
*/
 if (isset($_POST['dept_cate_deletebtn'])) 
 {
 	$delete_id = $_POST['delete_id'];

 	$query = "DELETE FROM dept_category WHERE id='$delete_id'";
 	$query_run = mysqli_query($connection, $query);

 	if ($query_run) 
 	{
 		$_SESSION['success'] = "Dept Category is Deleted";
 		header("Location: departments.php");
 	}
 	else
 	{
 	 	$_SESSION['status'] = "Dept Category is Not Deleted";
 		header("Location: departments.php");	
 	}
 }
/*
  	DEPARTMENT: REGISTER/ADD DEPARTMENT LIST DATA----------------------------------
*/
if (isset($_POST['dept_list_save'])) 
{
	$dept_cate_id = $_POST['dept_cate_id'];
	$name = $_POST['name'];
	$description = $_POST['description'];
	$section = $_POST['section'];

	$query = "INSERT INTO dept_category_list(dept_cate_id, name, descrip, section) VALUES ('$dept_cate_id', '$name', '$description', '$section')";
    $query_run = mysqli_query($connection, $query);
   
    if ($query_run) 
    {
    	$_SESSION['success'] = "Dept Category-List is Added";
    	header('Location: departments-list.php');
    }
    else
    {
    	$_SESSION['status'] = "Dept Category-List is Not Added";
    	header('Location: departments-list.php');
    }

}
/*
  	DEPARTMENT: UPDATE DEPARTMENT LIST DATA----------------------------------
*/
  	if (isset($_POST['dept_catelist_update_btn'])) 
{
	$updating_id = $_POST['updating_id'];
	$dept_cate_id = $_POST['dept_cate_id'];
	$name = $_POST['name'];
	$description = $_POST['description'];
	$section = $_POST['section'];

	$query = "UPDATE dept_category_list SET dept_cate_id='$dept_cate_id', name='$name', descrip='$description', section='$section' WHERE id='$updating_id'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) 
    {
    	$_SESSION['success'] = "Dept Category-List is Updated";
    	header('Location: departments-list.php');
    }
    else
    {
    	$_SESSION['status'] = "Dept Category-List is Not Updated";
    	header('Location: departments-list.php');
    }

}
/*
  	DEPARTMENT: DELETE DEPARTMENT LIST DATA----------------------------------
*/
 if (isset($_POST['dept_catelist_deletebtn'])) 
 {
 	$delete_id = $_POST['delete_id'];

 	$query = "DELETE FROM dept_category_list WHERE id='$delete_id'";
 	$query_run = mysqli_query($connection, $query);

 	if ($query_run) 
 	{
 		$_SESSION['success'] = "Dept Category List is Deleted";
 		header("Location: departments-list.php");
 	}
 	else
 	{
 	 	$_SESSION['status'] = "Dept Category List is Not Deleted";
 		header("Location: departments-list.php");	
 	}
 }
?>