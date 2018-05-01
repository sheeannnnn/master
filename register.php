<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">

 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Register</title>
  <!--  Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--    Custom fonts for this template -->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
 <!--   Custom styles for this template -->
  <link href="css/sb-admin.css" rel="stylesheet">
  <!-- Master Style -->
 <link rel="stylesheet" type="text/css" href="css/css.css">

</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">
        <div class="col-sm-auto col-sm-offset2">
          <?php 
            if(isset($_SESSION['msg'])){
                echo $_SESSION['msg'];
                session_unset();
          } else {
            $message = '<div class="alert">Register an Account.</div>';
            echo $message;
          }
        ?>
        </div>
       
      </div>
      <div class="card-body">

        <!--form starts here -->
        <form name="myform" action="process/registerprocess.php" method="post">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">First Name</label>
                <input class="form-control" id="firstname" type="text" name="firstname" 
                placeholder="Enter First Name">
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">Last Name</label>
                <input class="form-control" id="lastname" type="text" name="lastname"
                placeholder="Enter Last Name">
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <label for="exampleInputEmail">E-mail Address</label>
                <input class="form-control" id="email" type="email" aria-describedby="emailHelp" 
                      name="email" placeholder="Enter Valid E-mail Address">  
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputUsername">Username</label>
                <input class="form-control" id="username" type="text" name="username" placeholder="Enter Username">
              </div> 
            </div>

            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputPassword1">Password</label>
                <input class="form-control" id="password" type="password" name="password" placeholder="Password">
              </div>
              <div class="col-md-6">
                <label for="exampleConfirmPassword">Confirm password</label>
                <input class="form-control" id="password2" name="password2" type="password" placeholder="Confirm password">
              </div>
            </div>

          </div>
          <input class="btn btn-primary btn-block" type="submit" name="myform" value="Register">  
        </form>
       <!--  form ends here -->
        <div class="text-center">
          <a class="d-block small mt-3" href="index.php">Login Page</a>
        </div>
      </div>
    </div>
  </div>
<!--    Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!--   Core plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script> -->
</body> 
</html>

