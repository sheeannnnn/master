<!DOCTYPE html>
<?php
  include('connection/dbconnect.php');
  // global $connect;
    if(!(isset($_SESSION['username']))){
    header("location:index.php");
  }

  $first;
  $user = $_SESSION['username'];
  $query = "SELECT firstname FROM users WHERE username='$user'";
  $result = mysqli_query($connect, $query);
  $row = mysqli_fetch_row($result);
    $first=$row[0];
?>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>IoTURN Admin</title>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap core CSS-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">  <!-- Custom fonts for this template-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet"> <!-- Page level plugin CSS-->
  <link href="css/sb-admin.css" rel="stylesheet"> <!-- Custom styles for this template-->
  <link rel="stylesheet" type="text/css" href="css/modal.css"> 
<!-- Modal Style Override Css -->
  <link type="text/css" rel="stylesheet" href="https://api.mqcdn.com/sdk/mapquest-js/v1.3.0/mapquest.css"/>
  <link rel="icon" type="image/gif/png" href="img/logo.png">
</head>


<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="admin.php">IoTurn Dashboard</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="admin.php">
            <i class="fa fa-fw fa fa-map-marker"></i>
            <span class="nav-link-text">Map</span>
          </a>
        </li>
         <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Sensor Status">
          <a class="nav-link" href="feed.php">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Data Feed</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="History Logs">
          <a class="nav-link" href="history.php">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Trigger Logs</span>
          </a>
        </li>
      </ul>
      <!--end navigation side bar-->
      <!-- navigation bar -->
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <div class="input-group">
               <span  class="nav-link"><?= $first?></span>
            </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul> 
    </div>
  </nav>

  <!-- content wrapper -->
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Info-->
      <div class="breadcrumb alert-info col-md-12 display-info ">
       <div style="font-size: 30px; color: #0288d1;" class="fa fa-bell col-md-1"></div>
       <div style="line-height: 20px; padding-left: 10px;" class="col-md-8">
        <p style="font-size: 12px; color: #0288d1;">
          <strong>IoTurn sensor is not triggered.</strong>
           Roads are passable. 
        </p>
       </div>
       <div class="col-md-3 ">
            <button onclick="overrideActivate(this);" value="camel" class="btn pull-right btn-info">Activate Actuators</button>
        </div> 
      </div>
     <!--  Warning /Override Turn Off -->
      <div class="breadcrumb alert-danger col-md-12 display-warning d-md-none">
           <div style="font-size: 30px;" class="fa fa-exclamation-triangle col-md-1"></div>
           <div style="line-height: 20px; padding-left: 10px;" class="col-md-8 ">
                <p style="font-size: 12px; ">
                 <strong>WARNING!</strong> 
                  IoTurn sensor is triggered. Roads are impassable within the sensor area. Click the button to deactivate actuators.
                </p>
            </div>
            <div class="col-md-3 ">
                <button id="deac" onclick="overRide(this);" value="dog" class="btn pull-right btn-danger">Deactivate</button>
            </div> 
       </div>
      <!--  Reset -->
      <div class="breadcrumb alert-warning col-md-12 display-reset d-md-none">
           <div style="font-size: 30px;" class="fa fa-exclamation-triangle col-md-1"></div>
           <div style="line-height: 20px; padding-left: 10px;" class="col-md-8">
                <p style="font-size: 12px; ">
                 <strong>IMPORTANT!</strong> 
                   Admin has deactivated the actuators. Please reset the microcontroller.
                </p>
            </div>
            <div class="col-md-3 ">
                <button id="reset" onclick="reset()" class="btn pull-right btn-info">Reset</button>
            </div>
      </div>
    <!--   Admin Override Activate -->
       <div class="breadcrumb alert-danger col-md-12 display-activate d-md-none">
           <div style="font-size: 30px;" class="fa fa-exclamation-triangle col-md-1"></div>
           <div style="line-height: 20px; padding-left: 10px;" class="col-md-8 ">
                <p style="font-size: 12px; ">
                 <strong>WARNING!</strong> 
                 Admin has activated the actuators. Click the button to deactivate.
                </p>
            </div>
            <div class="col-md-3 ">
                <button id="admin" onclick="adminOverride(this);" value="dog" class="btn pull-right btn-danger">Deactivate</button>
            </div> 
       </div>
       <!-- container -->
     <div class="card mb-3" id="container">
        <div class="card-body">
          <div id="map" style="width:100%;height:500px">
          </div>
        </div>
          <?php 
            date_default_timezone_set('Asia/Manila');
            $date = date('h:i A F d,o  ');
          ?>
          <div class="card-footer small text-muted">Last Updated at <?php echo $date;?>
          </div>
     </div>
    </div>
      <audio id="alertAudio">
        <source src="audio/alert.mp3" type="audio/mpeg">
      </audio>
  </div> <!-- end content wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" data-backdrop="static" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-show modal-dialog" role="document" >
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title" id="exampleModalLabel">Logout</h6>
          </div>
          <div class="modal-body">Are you sure to end your current session?</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
            <a class="btn btn-primary" href="controller.php?logout">Yes</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
    <script type="text/javascript" src="js/moments.js"></script>
     <script type="text/javascript" src="js/moment-timezone-with-data.js"></script>
    <script type="text/javascript" src="js/_map.js"></script>
    <script src="https://api.mqcdn.com/sdk/mapquest-js/v1.3.0/mapquest.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5sBnkRAJGUCP9FpolArkt6yGLWdDx53A&callback=myMap"></script>
  </div>
</body>

</html>
