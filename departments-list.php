<?php 
 include('security.php');
 include('inc/header.php');
 include('inc/navbar.php');
?>

<!-- departments Modal -->
  <div class="modal fade" id="adddepartment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Department</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="code.php" method="POST"> 
          <div class="modal-body">
            
            <?php 
              $department = "SELECT * FROM  dept_category";
              $dept_run = mysqli_query($connection, $department);
              if (mysqli_num_rows($dept_run) > 0) 
              {
            ?>
            <div class="form-group">
              <label> Dept Cate ID/Name </label>
              <select name="dept_cate_id" class="form-control" required>
                <option value="">Chose Your Department Category</option>
                    <?php 
                    foreach($dept_run as $row)
                    {    
                    ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                    <?php 
                    }
                    ?>
              </select>
            </div>
            <?php
              }
              else
              {
                 echo "No Date Available";
              }
            ?>

            <div class="form-group">
              <label> Dept List Name </label>            
            	<input type="text" name="name" class="form-control" placeholder="Enter Name" required>	
          	</div>

          	<div class="form-group">
            	<label> Description </label>
            	<textarea type="text" name="description" class="form-control" placeholder="Enter Description" required></textarea>	
          	</div>

            <div class="form-group">
              <label> Section </label>
              <input type="text" name="section" class="form-control" placeholder="Enter Section" required> 
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="dept_list_save" class="btn btn-primary">Save</button>	
          </div>	
        </form>
        
      </div>
    </div>
  </div>



  <div class="container-fluid">
	<!--DataTables Example  -->
            <div class="card shadow mb-4">
			<div class="card-header py-3">	
			     <h6 class="m-0 font-weight-bold text-primary">Academics - Departments (Category-LIST)&nbsp
				   	<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-toggle="modal" data-target="#adddepartment">
				   		ADD
				   	</button>
			     </h6>
			</div>
            <div class="card-body">
            	<?php
                 if(isset($_SESSION['success']) && !empty($_SESSION['success'])) {
                 	echo '<h2 class="text-primary">'.$_SESSION['success'].'</h2>';
                 	unset($_SESSION['success']);
                 }
                 if(isset($_SESSION['status']) && !empty($_SESSION['status'])) {
                 	echo '<h2 class="text-danger">'.$_SESSION['status'].'</h2>';
                 	unset($_SESSION['status']);
                 }
            	?>
              <div class="table-responsive">
              	<?php
                 $query = "SELECT * FROM dept_category_list";
                 $query_run = mysqli_query($connection, $query);
              	?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Dept-Cate-ID</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Section</th>
                      <th>EDIT</th>
                      <th>DELETE</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Dept-Cate-ID</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Section</th>
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
                        $dpt_cate_id =$row['dept_cate_id'];
                        $dpt_cate = "SELECT * FROM dept_category WHERE id = '$dpt_cate_id' ";
                        $dpt_cate_run = mysqli_query($connection, $dpt_cate);
                     ?>
                    <tr>
                      <td><?php echo $count++ ?></td>
                      <td>
                        <?php foreach($dpt_cate_run as $dpt_row) { echo $dpt_row['name']; } ?>
                      </td>
                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo $row['descrip']; ?></td>
                      <td><?php echo $row['section']; ?></td>
                      <td>
                      	<form action="depart_catelist_edit.php" method="POST">
                      	<input type="hidden" name="edit_id" value="<?php echo $row['id'];?>">
                      	<button type="submit" name="dept_catelist_editbtn" class="btn btn-success">EDIT</button>
                        </form>
                      </td>
                      <td>
                      	<form action="code.php" method="POST">
                      	<input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                      	<button type="submit" name="dept_catelist_deletebtn" class="btn btn-danger">DELETE</button>
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