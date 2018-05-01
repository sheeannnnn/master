<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>IoTURN Admin</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <!-- Modal Style Override Css -->
  <link rel="stylesheet" type="text/css" href="css/modal.css">
  <!-- Dropdown Style Override Css -->
  <link rel="stylesheet" type="text/css" href="css/dropdown.css">
  <link rel="icon" type="image/gif/png" href="img/logo.png">

</head>

<?php
include('connection/dbconnect.php');
 include('process/frequency.php');
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
            <i class="fa fa-fw fa-map-marker"></i>
            <span class="nav-link-text">Map</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Sensor Status">
          <a class="nav-link" href="feed.php">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Data Feed</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Data Logs">
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
  <!--content wrapper -->
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- info-->
      <div class="breadcrumb alert-info col-md-12 display-info">
          <a href="#">Analytics</a>
        </li>
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

      <div class="card mb-3" >
        <div id="container">
          <iframe width="800" height="500" style="border: 1px solid #cccccc;" src="https://thingspeak.com/channels/344468/charts/1?height=500&width=800&results=100&dynamic=true&type=line">
          </iframe> 
          <div class="card mb-3 col-md-3 pull-right">
            <div class="card-header">
              <i class="fa fa-automobile"></i>
               Car Count
            </div>
            <div class="card-body">
              <div class="text-muted small">
                Regular Vehicles: <?php echo $carcount;?>
              </div>
              <div class="text-muted small">
                Heavy Vehicles: <?php echo ($heavy);?>
              </div>
              <div class="text-muted small">
                Total Vehicles: <?php echo ($totalcar);?>
              </div>
            </div>
           
            
        </div>
     </div>
        <?php 
          date_default_timezone_set('Asia/Manila');
          $date = date('h:i A F d,o  ');
        ?>
        <div class="card-footer small text-muted">Last Updated at <?php echo $date;?>
        </div>
          <audio id="alertAudio">
              <source src="audio/alert.mp3" type="audio/mpeg">
          </audio>
    </div>
  </div> <!-- end content wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="controller.php?logout">Logout</a>
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
    <script type="text/javascript" src="js/_dataAlert.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
    <script type="text/javascript" src="js/moments.js"></script>
    <script type="text/javascript" src="js/moment-timezone-with-data.js"></script>
  </div>
</body>

</html>
