<?php
include('security.php');
include('inc/header.php');
include('inc/navbar.php');
?>

<div class="container-fluid">

<!--DataTables Example  -->
  <div class="card shadow mb-4">
		<div class="card-header py-3">	
		     <h6 class="m-0 font-weight-bold text-primary">Faculty Page Edit</h6>
		</div>
        <div class="card-body">
         <?php 
           if (isset($_POST['edit_data_btn'])) 
    		  	{
      				$id = $_POST['edit_id'];
      				$query = "SELECT * FROM faculty WHERE id='$id'";
      				$query_run = mysqli_query($connection, $query);
    				foreach ($query_run as $row) 
    				{
    		 ?>
         <form action="code.php" method="POST" enctype="multipart/form-data">
         	<input type="hidden" name="edit_id" value="<?php echo $row['id'];?>">

            <div class="form-group">
            	<label> Name </label>
            	<input type="text" name="edit_name" value="<?php echo $row['name']; ?>" class="form-control" placeholder="Enter Title">	
          	</div>

          	<div class="form-group">
            	<label> Designation </label>
            	<input type="text" name="edit_designation" value="<?php echo $row['designation']; ?>" class="form-control" placeholder="Enter Subtitle">
          	</div>

          	<div class="form-group">
            	<label> Description </label>
            	<textarea type="text" name="edit_description" value="<?php echo $row['description']; ?>" class="form-control" placeholder="Enter Description"><?php echo $row['description']; ?></textarea>	
            </div>

            <div class="form-group">
              <label> Upload Image </label>
              <input type="file" name="faculty_image" id="faculty_image" value="<?php echo $row['images']; ?>" class="form-control"> 
            </div>


            <a href="faculty.php" class="btn btn-danger">CANCEL</a>
            <button type="submit" name="faculty_update_btn" class="btn btn-primary">Update</button>
           </form>
          <?php 
    				}
    			}  

          ?>
        </div>
    </div>	
</div>

<?php
include('inc/scripts.php');
include('inc/footer.php');
?>