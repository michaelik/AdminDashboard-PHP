<?php 
include('security.php');
include('inc/header.php');
include('inc/navbar.php');
?>

<!-- addAboutUs Modal -->
  <div class="modal fade" id="addfaculty" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Faculty</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="code.php" method="POST" enctype="multipart/form-data"> 

          <div class="modal-body">
          	<div class="form-group">
          	<label> Name </label>
          	<input type="text" name="faculty_name" class="form-control" placeholder="Enter Name" required>	
          	</div>
          	<div class="form-group">
          	<label> Designation </label>
          	<input type="text" name="faculty_designation" class="form-control" placeholder="Enter Designation" required>	
          	</div>
          	<div class="form-group">
          	<label> Description </label>
          	<textarea type="text" name="faculty_description" class="form-control" placeholder="Enter Description" required></textarea>	
          	</div>
          	<div class="form-group">
          	<label> Upload Image </label>
          	<input type="file" name="faculty_image" id="faculty_image" class="form-control" required>	
          	</div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="save_faculty" class="btn btn-primary">Save</button>	
          </div>	
        </form>
        
      </div>
    </div>
  </div>



  <div class="container-fluid">
	<!--DataTables Example  -->
            <div class="card shadow mb-4">
			<div class="card-header py-3">	
			     <h6 class="m-0 font-weight-bold text-primary">Faculties &nbsp
            <form action="code.php" method="POST">
            <button type="submit" name="delete_multiple_data" class="btn btn-danger float-left">Delete Multiple Data</button>
				   	<button type="button" class="btn btn-primary float-right" data-toggle="modal"  data-toggle="modal" data-target="#addfaculty">
				   		Add
				   	</button>
            </form>
			     </h6>
			</div>
            <div class="card-body">          	
              <div class="table-responsive">
              <?php
               $query = "SELECT * FROM faculty";
               $query_run = mysqli_query($connection,$query);
               if(mysqli_num_rows($query_run) > 0) 
               {
               	?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Check</th>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Designation</th>
                      <th>Description</th>
                      <th>Image</th>
                      <th>EDIT</th>
                      <th>DELETE</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Check</th>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Designation</th>
                      <th>Description</th>
                      <th>Image</th>
                      <th>EDIT</th>
                      <th>DELETE</th>
                    </tr>
                  </tfoot>
                  <tbody>
                <?php  	
                $count = 1;
               	while($row = mysqli_fetch_assoc($query_run))
               	{ 
               		?>
                    <tr>
                      <td>
                        <input type="checkbox" value="<?php echo $row['id'] ?>" <?php echo $row['visible'] == 1 ? "Checked" : "" ?>>
                      </td>
                      <td> <?php echo $count++ ?> </td>
                      <td> <?php echo $row['name'] ?> </td>
                      <td> <?php echo $row['designation'] ?> </td>
                      <td> <?php echo $row['description'] ?> </td>
                      <td> <?php echo '<img src="upload/'.$row['images'].'" width="100px;" height="100px;" alt="image">'?> </td>

                      <td>
                      	<form action="falcuty_edit.php" method="POST">
                      	<input type="hidden" name="edit_id" value="<?php echo $row['id'] ?>">
                      	<button type="submit" name="edit_data_btn" class="btn btn-success">EDIT</button>
                      	</form>
                      </td>

                      <td>
                        <form action="code.php" method="POST">
                        <input type="hidden" name="delete_id" value="<?php echo $row['id'] ?>">
                      	<button type="submit" name="faculty_delete_btn" class="btn btn-danger">DELETE</button>
                        </form>
                      </td>
                    </tr>
               	<?php
               	}
               	?>
                  </tbody>
                </table>
              <?php 
               }
               else
               {
               	echo "No Record Found";
               }
               ?>
              </div>
            </div>
          </div>
 </div>


<?php include('inc/scripts.php');?>
<?php include('inc/footer.php');?>