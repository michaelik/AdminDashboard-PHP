<?php
include('security.php');
/*......verify Email and Output Error within textbox......*/
if (isset($_POST['check_submit_btn'])) 
{
	$id = $_POST['email_id'];
    
	$email_query = "SELECT * FROM register WHERE email='$id'";
	$email_query_run = mysqli_query($connection, $email_query);
	if (mysqli_num_rows($email_query_run) > 0) 
	{
       echo "Email Already Exists. Please Try Another One.";
	}
}
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

  $email_query = "SELECT * FROM register WHERE email='$email'";
  $email_query_run = mysqli_query($connection, $email_query);
  if (mysqli_num_rows($email_query_run) > 0) 
	{
	  	$_SESSION['status'] = "Email Already Taken. Please Try Another One.";
	  	$_SESSION['status_code'] = "error";
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
			  		$_SESSION['status_code'] = "success";
			  		header('Location: register.php');
			  	}
			  	else
			  	{
			  		$_SESSION['status'] = "Admin Profile Not Added";
			  		$_SESSION['status_code'] = "error";
			  		header('Location: register.php');
			  	}
			  }
			  else
			  {
			  	$_SESSION['status'] = "Password and Confirm Password Does Not Match";
			  	$_SESSION['status_code'] = "warning";
			  	header('Location: register.php');
			  }
		 }
		 else
		 {
		 		$_SESSION['status'] = "Admin Profile Not Added Please Fill All The Field";
		 		$_SESSION['status_code'] = "warning";
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
	  $_SESSION['status'] = " Your Data is Updated";
	  $_SESSION['status_code'] = "success";
	  header('Location: register.php');
	}
	else
	{
     $_SESSION['status'] = "Your Data is NOT Updated";
     $_SESSION['status_code'] = "error";
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
		$_SESSION['status'] = "Your Data is DELETED";
		$_SESSION['status_code'] = "success";
		header('Location: register.php');
	}
	else
	{
		$_SESSION['status'] = "Your Data is NOT DELETED";
		$_SESSION['status_code'] = "error";
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
    	$_SESSION['status'] = "About Us Added";
    	$_SESSION['status_code'] = "success";
    	header('Location: aboutus.php');
    }
    else
    {
    	$_SESSION['status'] = "About US Not Added";
    	$_SESSION['status_code'] = "error";
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
	  $_SESSION['status'] = "Your Data is Updated";
	  $_SESSION['status_code'] = "success";
	  header('Location: aboutus.php');
	}
	else
	{
     $_SESSION['status'] = "Your Data is NOT Updated";
     $_SESSION['status_code'] = "error";
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
		$_SESSION['status'] = "Your Data is DELETE";
		$_SESSION['status_code'] = "success";
		header('Location: aboutus.php');
	}
	else
	{
		$_SESSION['status'] = "Your Data is NOT DELETE";
		$_SESSION['status_code'] = "error";
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
      $img_types = array('image/jpe','image/jpg', 'image/png','image/jpeg');
      $validate_img_extension = in_array($_FILES["faculty_image"]['type'], $img_types);
      
      if ($validate_img_extension != true) 
      {
			$_SESSION['status'] = "Only JPE, PNG, JPG and JPEG Image are allowed";
			$_SESSION['status_code'] = "warning";
	        header('Location: faculty.php');	
      }
      else
      {
		    if(file_exists("upload/".$_FILES["faculty_image"]["name"]))
			{
			   $store = $_FILES["faculty_image"]["name"];
			   $_SESSION['status']= "Image already exists. '.$store.'";
			   $_SESSION['status_code'] = "warning";
			   header('Location: faculty.php');
			}
			else
			{	
			 $visible = 0;
			 $query = "INSERT INTO faculty(name, designation, description, images, visible) VALUES('$name', '$designation', '$description', '$images', '$visible')";
			 $query_run = mysqli_query($connection, $query);
			 var_dump($query_run);
				 if($query_run)
				 {
				 	$target_file =  "upload/".$_FILES["faculty_image"]["name"];
				 	 if (move_uploaded_file($_FILES["faculty_image"]["tmp_name"], $target_file)) 
				 	 {
				 	 	$_SESSION['status'] = "Faculty Added";
				 	 	$_SESSION['status_code'] = "success";
				 	    header('Location: faculty.php');
				 	 }
				 }
				else
				 {
				 	$_SESSION['status'] = "Faculty Not Added";
				 	$_SESSION['status_code'] = "error";
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

  $faculty_query = "SELECT * FROM faculty WHERE id='$edit_id'";
  $faculty_query_run = mysqli_query($connection, $faculty_query);
  $faculty_row=mysqli_fetch_assoc($faculty_query_run);
  if($edit_faculty_image == NULL)
  {
	  	//Update with existing Image
	  	$image_data = $faculty_row['images'];
	    $query = "UPDATE faculty SET name='$edit_name', designation='$edit_designation', description='$edit_description', images='$image_data' WHERE id = '$edit_id'";
        $query_run = mysqli_query($connection, $query);
	    if($query_run)
		{
		  	$target_file = "upload/".$_FILES["faculty_image"]["name"];
		 	move_uploaded_file($_FILES["faculty_image"]["tmp_name"], $target_file);
		 	$_SESSION['status'] = "Faculty Updated";
		 	$_SESSION['status_code'] = "success";
		 	header('Location: faculty.php'); 
		}
		else
	    {
            $_SESSION['status'] = "Faculty Not Updated";
	        $_SESSION['status_code'] = "error";
	    	header('Location: departments.php');
	    }
  }
  else
  {
       $img_types = array('image/jpe','image/jpg', 'image/png','image/jpeg');
	   $validate_img_extension = in_array($_FILES["faculty_image"]['type'], $img_types);
	   if ($validate_img_extension)
	   {    
	   	    //Delete Old Image and Update with new image
			if ($image_path = "upload/".$faculty_row['images'])
		  	{
		  		unlink($image_path);
			    $image_data = $edit_faculty_image;
			    $query = "UPDATE faculty SET name='$edit_name', designation='$edit_designation', description='$edit_description', images='$image_data' WHERE id = '$edit_id'";
	            $query_run = mysqli_query($connection, $query);
				if($query_run)
				  {
				  	$target_file = "upload/".$_FILES["faculty_image"]["name"];
				 	move_uploaded_file($_FILES["faculty_image"]["tmp_name"], $target_file);
				 	$_SESSION['status'] = "Faculty Updated";
				 	$_SESSION['status_code'] = "success";
				 	header('Location: faculty.php');

				  }
				else
				{
		            $_SESSION['status'] = "Faculty Not Updated";
			        $_SESSION['status_code'] = "error";
			    	header('Location: departments.php');
				}
		  	}
	   }
	   else
	   {
				 // function return_bytes($val) {
				 //    $val = trim($val);
				 //    $last = strtolower($val[strlen($val)-1]);
				 //    switch($last) {
				 //        // The 'G' modifier is available since PHP 5.1.0
				 //        case 'g':
				 //            $val *= 1024;
				 //        case 'm':
				 //            $val *= 1024;
				 //        case 'k':
				 //            $val *= 1024;
				 //    }
				 //    return $val;
				 //    }
				 //    echo 'post_max_size in bytes = ' . return_bytes(ini_get('post_max_size'))."\n";
	    $_SESSION['status'] = "Only PNG, JPG and JPEG Image are allowed. Try Updating again";
	    $_SESSION['status_code'] = "warning";
	    header('Location: faculty.php');
	   }
  }    
}
/*
  	FACULTY: IDENTIFY IF EITHER THE CHECKBOX IS CHECKED OR NOT AND SET THE VALUE ONE(1)
  	IN RESPECT TO THE CHECKBOX BEING CHECKED OTHERWISE VALUE(0).----------------------------------
*/
  	if(isset($_POST['checkbox_data']))
  	{
  	    $id = $_POST['id'];
  		$visible = $_POST['visible'];

  		$query = "UPDATE faculty SET visible='$visible' WHERE id='$id'";
  		$query_run = mysqli_query($connection, $query);
  	}
/*
  	FACULTY: DELETE EITHER ONE OR MORE ROW IN RESPECT TO THE NUMBER OF CKECKBOX BEING CKECKED----------------------------------
*/
  	if (isset($_POST['delete_multiple_data']))
  	{
  		$num = 1;
        $query_check = "SELECT * FROM faculty WHERE visible = '$num'";
        $query_check_run = mysqli_query($connection, $query_check);
        $row= mysqli_fetch_assoc($query_check_run);
        if($row['visible'] == $num)
        {
	   	   if($image_path = "upload/".$row['images'])
	  	    {  
		  		  // delete exact image from the directory.
			      unlink($image_path);
			      // delete exact image from database.
			      $visible = $row['visible'];
		          $query = "DELETE FROM faculty WHERE visible= '$visible'";
		  		  $query_run = mysqli_query($connection, $query);
			  		if ($query_run) 
			  		{
			  			$_SESSION['status'] = "Your Data is DELETED!";
			  			$_SESSION['status_code'] = "success";
			  			header('Location: faculty.php');
			  		}
			  		else
			  		{
			  			$_SESSION['status'] = "Your Data is NOT DELETED!";
			  			$_SESSION['status_code'] = "error";
			  			header('Location: faculty.php');	
			  		}
		  	}	
        }  
        else
	    {
		   $_SESSION['status'] = "No Box Was Checked!";
		   $_SESSION['status_code'] = "warning";
		   header('Location: faculty.php');	
	    }
  	}
/*
  	FACULTY: DELETE FACULTY DATA----------------------------------
*/
if(isset($_POST['faculty_delete_btn'])) 
{
   	$id = $_POST['delete_id'];
    $query_img = "SELECT * FROM faculty WHERE id='$id'";
	$query_img_run = mysqli_query($connection, $query_img);
	$img=mysqli_fetch_assoc($query_img_run);
   	if($query_img_run) 
   	{   
   		if($image_path = "upload/".$img['images'])
  		 {  
  		 	// delete exact image from the directory.
	        unlink($image_path);
	        // delete exact image from database.
	        $query = "DELETE FROM faculty WHERE id='$id'";
   	        $query_run = mysqli_query($connection, $query);
	    	if ($query_run) 
	    	{
		    	$_SESSION['status'] = "Your Data is DELETED!";
				$_SESSION['status_code'] = "success";
				header('Location: faculty.php');
	    	}
		   	else
		   	{
		   		$_SESSION['status'] = "Faculty Data is NOT DELETED";
		   		$_SESSION['status_code'] = "error";
		   		header('Location: faculty.php');
		   	}
	     }
   	}
}
/*
  	ACADEMICS - DEPARTMENTS (CATEGORY): REGISTER/ADD DEPARTMENT DATA----------------------------------
*/
  if (isset($_POST['dept_save'])) 
  {
  	$name = $_POST['name'];
  	$description = $_POST['description'];
  	$image = $_FILES["dept_image"]['name'];

    $img_types = array('image/jpe','image/jpg', 'image/png','image/jpeg');
    $validate_img_extension = in_array($_FILES["dept_image"]['type'], $img_types);

      if($validate_img_extension) 
      {
			if(file_exists("upload/departments/".$_FILES["dept_image"]["name"]))
			{
			   $store = $_FILES["dept_image"]["name"];
			   $_SESSION['status']= "Image already exists. '.$store.'";
			   $_SESSION['status_code'] = "warning";
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
							 	$_SESSION['status'] = "Department Category Added";
							 	$_SESSION['status_code'] = "success";
							 	header('Location: departments.php');
						        // echo "<P>FILE UPLOADED TO: $target_file</P>";
						 } 
						 // else {
						 //       echo "<P>MOVE UPLOADED FILE FAILED! OF PERHAPS THE </p>
						 //             <p>SIZE OF IMAGE IS LARGER THAN post_max_size setting in php.ini</P>
						 //             <p>OR</p>
						 //             <p>CREATE THE FORM THIS WAY BY SETTING MAX_FILE_SIZE:</p>
						 //             <p>form enctype=multipart/form-data method=POST</p>
						 //             <p>MAX_FILE_SIZE must precede the file input field</p>
						 //             <p>input type=hidden name=MAX_FILE_SIZE value=300000</p>
						 //             <p>Name of input element determines name in _FILES array</p>
						 //             <p>Send this file: input name=userfile type=file</p>
						 //             <p>input type=submit value=Send File</p>
						 //             <p>form</p>";
						 //       print_r(error_get_last());
						 //       } 
					 }
					 else
					 {
					 	$_SESSION['status'] = "Department Category Not Added";
					 	$_SESSION['status_code'] = "error";
					 	header('Location: departments.php');
					 }
			}
      }
      else
      {

        $_SESSION['status'] = "Only PNG, JPG and JPEG Image are Allowed";
        $_SESSION['status_code'] = "error";
        header('Location: departments.php');
      }
  }
/*
  	ACADEMICS - DEPARTMENTS (CATEGORY): UPDATE DEPARTMENT DATA----------------------------------
*/
  if (isset($_POST['dept_cate_update_btn'])) 
  {
  	$updating_id = $_POST['updating_id'];
  	$edit_name = $_POST['edit_name'];
  	$edit_description = $_POST['edit_description'];
  	$edit_dept_cate_image = $_FILES["dept_cate_image"]['name'];
    
    $dept_query = "SELECT * FROM dept_category WHERE id='$updating_id'";
    $dept_query_run = mysqli_query($connection, $dept_query);
    $dept_row=mysqli_fetch_assoc($dept_query_run);
    if ($edit_dept_cate_image == NULL) 
    {
    	$image_data = $dept_row['image'];
	    $query = "UPDATE dept_category SET name='$edit_name', description='$edit_description', image='$image_data' WHERE id = '$updating_id'";
        $query_run = mysqli_query($connection, $query);
        if($query_run)
		{
		  	$target_file = "upload/departments/".$_FILES["dept_cate_image"]['name'];
		 	move_uploaded_file($_FILES["dept_cate_image"]["tmp_name"], $target_file);
		 	$_SESSION['status'] = "Dept Category Updated with existing image";
		 	$_SESSION['status_code'] = "success";
		 	header('Location: departments.php');
		}
		else
		{
            $_SESSION['status'] = "Dept Category Not Updated";
	        $_SESSION['status_code'] = "error";
	    	header('Location: departments.php');
		}
    }
    else
    {
       $img_types = array('image/jpe','image/jpg', 'image/png','image/jpeg');
	   $validate_img_extension = in_array($_FILES["dept_cate_image"]['type'], $img_types);
	   if ($validate_img_extension)
	   {
          	//Delete Old Image and Update with new image
			if ($image_path = "upload/departments/".$dept_row['image'])
		  	{
		  		unlink($image_path);
			    $image_data = $edit_dept_cate_image;
			    $query = "UPDATE dept_category SET name='$edit_name', description='$edit_description', image='$image_data' WHERE id = '$updating_id'";
	            $query_run = mysqli_query($connection, $query);
				if($query_run)
				  {
				  	$target_file = "upload/departments/".$_FILES["dept_cate_image"]['name'];
				 	move_uploaded_file($_FILES["dept_cate_image"]["tmp_name"], $target_file);
				 	$_SESSION['status'] = "Dept Category Updated";
				 	$_SESSION['status_code'] = "success";
				 	header('Location: departments.php');
				  }
				  else
			      {
		            $_SESSION['status'] = "Dept Category Not Updated";
			        $_SESSION['status_code'] = "error";
			    	header('Location: departments.php');
				  }
			}
	    }
	    else
	    {
		    $_SESSION['status'] = "Only PNG, JPG and JPEG Image are allowed. Try Updating again";
		    $_SESSION['status_code'] = "warning";
		    header('Location: departments.php');
	    }
    }

  }

/*
  	ACADEMICS - DEPARTMENTS (CATEGORY): DELETE DEPARTMENT DATA----------------------------------
*/
 if (isset($_POST['dept_cate_deletebtn'])) 
 {
 	$delete_id = $_POST['delete_id'];
    $query_img = "SELECT * FROM dept_category WHERE id='$delete_id'";
    $query_img_run = mysqli_query($connection, $query_img);
    $img=mysqli_fetch_assoc($query_img_run);
    if($query_img_run) 
    {   
      if($image_path = "upload/departments/".$img['image'])
       {  
	        // delete exact image from the directory.
	        unlink($image_path);
	        // delete exact image from database.
		 	$query = "DELETE FROM dept_category WHERE id='$delete_id'";
		 	$query_run = mysqli_query($connection, $query);
		 	if ($query_run) 
		 	{
		 		$_SESSION['status'] = "Dept Category is Deleted";
		 		$_SESSION['status_code'] = "success";
		 		header("Location: departments.php");
		 	}
		 	else
		 	{
		 	 	$_SESSION['status'] = "Dept Category is Not Deleted";
		 	 	$_SESSION['status_code'] = "error";
		 		header("Location: departments.php");	
		 	}
		}
	}
 }
/*
  	ACADEMICS - DEPARTMENTS (CATEGORY-LIST): REGISTER/ADD DEPARTMENT LIST DATA----------------------------------
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
    	$_SESSION['status'] = "Dept Category-List is Added";
    	$_SESSION['status_code'] = "success";
    	header('Location: departments-list.php');
    }
    else
    {
    	$_SESSION['status'] = "Dept Category-List is Not Added";
    	$_SESSION['status_code'] = "error";
    	header('Location: departments-list.php');
    }
}
/*
  	ACADEMICS - DEPARTMENTS (CATEGORY-LIST): UPDATE DEPARTMENT LIST DATA----------------------------------
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
    	$_SESSION['status'] = "Dept Category-List is Updated";
    	$_SESSION['status_code'] = "success";
    	header('Location: departments-list.php');
    }
    else
    {
    	$_SESSION['status'] = "Dept Category-List is Not Updated";
    	$_SESSION['status_code'] = "error";
    	header('Location: departments-list.php');
    }

}
/*
  	ACADEMICS - DEPARTMENTS (CATEGORY-LIST): DELETE DEPARTMENT LIST DATA----------------------------------
*/
 if (isset($_POST['dept_catelist_deletebtn'])) 
 {
 	$delete_id = $_POST['delete_id'];

 	$query = "DELETE FROM dept_category_list WHERE id='$delete_id'";
 	$query_run = mysqli_query($connection, $query);

 	if ($query_run) 
 	{
 		$_SESSION['status'] = "Dept Category List is Deleted";
 		$_SESSION['status_code'] = "error";
 		header("Location: departments-list.php");
 	}
 	else
 	{
 	 	$_SESSION['status'] = "Dept Category List is Not Deleted";
 	 	$_SESSION['status_code'] = "error";
 		header("Location: departments-list.php");	
 	}
 }
?>