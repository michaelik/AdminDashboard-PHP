<?php 
 session_start();
 include('inc/header.php');
 include('inc/navbar.php');
?>

<!-- addAdmin Modal -->
  <div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Admin Data</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="code.php" method="POST"> 
          <div class="modal-body">
          	<div class="form-group">
          	<label> Username </label>
          	<input type="text" name="username" class="form-control" placeholder="Enter Username">	
          	</div>
          	<div class="form-group">
          	<label> Email </label>
          	<input type="email" name="email" class="form-control" placeholder="Enter Email">	
          	</div>
          	<div class="form-group">
          	<label> Password </label>
          	<input type="Password" name="password" class="form-control" placeholder="Enter Password">	
          	</div>
          	<div class="form-group">
          	<label> Comfirm Password </label>
          	<input type="Password" name="confirmpassword" class="form-control" placeholder="Re-Enter Password">	
          	</div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="registerbtn" class="btn btn-primary">Save</button>	
          </div>	
        </form>
        
      </div>
    </div>
  </div>


<div class="container-fluid">
	<!--DataTables Example  -->
            <div class="card shadow mb-4">
			<div class="card-header py-3">	
			     <h6 class="m-0 font-weight-bold text-primary">Admin Profile
				   	<button type="button" class="btn btn-primary" data-toggle="modal" data-toggle="modal" data-target="#addadminprofile">
				   		Add Admin Profile
				   	</button>
			     </h6>
			</div>
            <div class="card-body">
            	<?php
                 if (isset($_SESSION['success']) && !empty($_SESSION['success'])) {
                 	echo '<h2>'.$_SESSION['success'].'</h2>';
                 	unset($_SESSION['success']);
                 }
                 if (isset($_SESSION['status']) && !empty($_SESSION['status'])) {
                 	echo '<h2 class="text-info">'.$_SESSION['status'].'</h2>';
                 	unset($_SESSION['status']);
                 }
            	?>
              <div class="table-responsive">
              	<?php 
                 $connection = mysqli_connect("localhost","root","","admin_clone");
                 $query = "SELECT * FROM register";
                 $query_run = mysqli_query($connection, $query);
              	?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Username</th>
                      <th>Email</th>
                      <th>Password</th>
                      <th>EDIT</th>
                      <th>DELETE</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Name</th>
                      <th>Position</th>
                      <th>Office</th>
                      <th>Age</th>
                      <th>Start date</th>
                      <th>Salary</th>
                    </tr>
                  </tfoot>
                  <tbody>
                  	<?php 
                     if (mysqli_num_rows($query_run) > 0) 
                     {
                     	while($row = mysqli_fetch_assoc($query_run))
                     	{
                     ?>
                    <tr>
                      <td><?php echo $row['id']; ?></td>
                      <td><?php echo $row['username']; ?></td>
                      <td><?php echo $row['email']; ?></td>
                      <td><?php echo $row['password']; ?></td>
                      <td>
                      	<form action="register_edit.php" method="POST">
                      	<input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                      	<button type="submit" name="edit_btn" class="btn btn-success">EDIT</button>
                        </form>
                      </td>
                      <td>
                      	<button type="submit" class="btn btn-danger">DELETE</button>
                      </td>
                    </tr>
                    <?php
                     	}
                     }
                     else
                     {
                     	echo "No Record Found";
                     }
                  	?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
 </div>


<?php   
include('inc/scripts.php');
include('inc/footer.php');
?>