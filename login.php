<?php
session_start();
include('inc/header.php');
?>

<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

  <div class="col-xl-6 col-lg-6 col-md-6">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Login Here!</h1>
                <?php
                  if(isset($_SESSION['status']) && $_SESSION['status'] != '') 
                   {
                     echo '<h2 class="bg-danger text-white">'.$_SESSION['status'].'</h2>';
                     unset($_SESSION['status']);
                   }
                ?>
              </div>
              <form class="user" action="login_handler.php" method="POST">

                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                </div>
                <button type="submit" name="login_btn" class="btn btn-primary btn-user btn-block text-white">Login</button>
                
                <hr>
                <a href="#" class="btn btn-google btn-user btn-block">
                  <i class="fab fa-google fa-fw"></i> Login with Google
                </a>
                <a href="#" class="btn btn-facebook btn-user btn-block">
                  <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                </a>

              </form>

              <hr>
              <div class="text-center">
                <a class="small" href="forgot-password.html">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="register.html">Create an Account!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>

</div>

<?php
include('inc/scripts.php');
?>
   </div>
</body>
</html>