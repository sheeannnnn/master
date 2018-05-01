<!DOCTYPE html>
<html lang="en">
<link rel="icon" type="image/x-icon" href="favicon.ico">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>IoTurn</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <!-- Modal Style  -->
  <link rel="stylesheet" type="text/css" href="css/modal.css">
  <!-- Master Style -->
 <link rel="stylesheet" type="text/css" href="css/css.css">
</head>

<?php 
session_start();
if(isset($_SESSION['username'])){
 header("location:controller.php?home");
}
?>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">
        <div class="col-sm-auto col-sm-offset2">

         <?php 
          if(isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                session_unset();
          } else {
            $message = '<div class="alert"><center>IoTurn Login</center></div>';
            echo $message;
          }
          ?>
        </div>
      </div>
      
      <div class="card-body">
        <form action="auth.php" method="post" id="loginForm">
          <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input class="form-control" name="username" type="text" placeholder="Username">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" name="password" type="password" placeholder="Password">
          </div>
          <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox"> Remember Password</label>
            </div>
          </div>
          <input class="btn btn-primary btn-block" data-toggle="modal" data-target="#LoginModal" id="UserLogin" value="Login" type="submit">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="register.php">Register an Account</a>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="smallModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>This is a small modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  
</body>
</html>
