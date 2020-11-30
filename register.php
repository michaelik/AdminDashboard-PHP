<?php 
 include('security.php');
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
        <form id="form" action="code.php" method="POST"> 
          <div class="modal-body">
          	<div class="form-group">
          	<label> Username </label>
          	<input type="text" name="username" id="name" class="form-control" placeholder="Enter Username">	
          	</div>
          	<div class="form-group">
          	<label> Email </label>
          	<input type="email" name="email" id="email" class="form-control checking_email" placeholder="Enter Email">
             <small class="error_email" style="color: red;"></small>
          	</div>
          	<div class="form-group">
          	<label> Password </label>
          	<input type="Password" name="password" id="password" class="form-control" placeholder="Enter Password">	
          	</div>
          	<div class="form-group">
          	<label> Comfirm Password </label>
          	<input type="Password" name="confirmpassword" id="C_password" class="form-control" placeholder="Re-Enter Password">	
          	</div>
            <input type="hidden" name="usertype" value="admin">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="registerbtn" id="submit" class="btn btn-primary">Save</button>	
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
				   	<button type="button" class="btn btn-primary m-show" data-toggle="modal" data-toggle="modal" data-target="#addadminprofile">
				   		Add Admin Profile
				   	</button>
			     </h6>
			</div>
            <div class="card-body">
              <div class="table-responsive">
              	<?php 
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
                      <th>UserType</th>
                      <th>EDIT</th>
                      <th>DELETE</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Username</th>
                      <th>Email</th>
                      <th>Password</th>
                      <th>UserType</th>
                      <th>EDIT</th>
                      <th>DELETE</th>
                    </tr>
                  </tfoot>
                  <tbody>
                  	<?php 
                     if (mysqli_num_rows($query_run) > 0) 
                     {
                        $count = 1;
                       	while($row = mysqli_fetch_assoc($query_run))
                      	{
                     ?>
                    <tr>
                      <td><?php echo //$row['id'];
                           $count++ ?></td>
                      <td><?php echo $row['username']; ?></td>
                      <td><?php echo $row['email']; ?></td>
                      <td><?php echo $row['password']; ?></td>
                      <td><?php echo $row['usertype']; ?></td>
                      <td>
                      	<form action="register_edit.php" method="POST">
                      	<input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                      	<button type="submit" name="edit_btn" class="btn btn-success">EDIT</button>
                        </form>
                      </td>
                      <td>
                      	<form action="code.php" method="POST">
                      	<input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                      	<button type="submit" name="delete_btn" class="btn btn-danger">DELETE</button>
                      </form>
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