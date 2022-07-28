<?php

session_start();
include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\config.php');    

if(!isset($_SESSION['userid']))
  {
    echo "<script type ='text/javascript'> document.location.href='../login.php' </script>"; 
  } 
  else
  {
    $username=$_SESSION['firstname']."  ".$_SESSION['lastname'];
    $id = $_SESSION['userid'];
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin - Dashboard</title>
  <link rel = "icon" href = "../../dist/img/logo/favicon.ico" type = "image/x-icon">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
  <script src="https://kit.fontawesome.com/4eb9df22a3.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
  href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;1,200;1,300;1,400&display=swap" rel="stylesheet">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<?php  include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\adminheader.php');      ?>

      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Navigation Forms</li>
        <li class="active">
          <a href="dashboard.php">
            <i class="fa fa-home"></i> <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="viewvehicles.php">
            <i class="fa fa-cab"></i> <span>View Vehicles</span>
          </a>
        </li>
        <li>
          <a href="rentalhistory.php">
            <i class="fa fa-cab"></i> <span>Rental History</span>
          </a>
        </li>
        <li>
          <a href="feedbacks.php">
            <i class="fa fa-comment"></i> <span>Feedbacks</span>
          </a>
        </li>
        <li>
          <a href="report.php">
          <i class="fa-solid fa-message"></i> <span>User Complaints</span>
          </a>
        </li>
        <li>
          <a href="rentercredential.php">
            <i class="fa fa-users"></i> <span>Verify Client</span>
          </a>
        </li>
        <li>
          <a href="ownercredential.php">
            <i class="fa fa-users"></i> <span>Verify Vehicle Owner</span>
          </a>
        </li>
        <li>
          <a href="profile.php">
            <i class="fa fa-user"></i> <span>Profile</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user-secret"></i>
            <span>User Account</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="renter.php"><i class="fa fa-circle-o"></i> Client</a></li>
            <li><a href="owner.php"><i class="fa fa-circle-o"></i> Vehicle Owner</a></li>
          </ul>
        </li>
        

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 align="center">
        <i class="fa fa-cab"></i> Dashboard
        <small></small>
      </h1>
    </section>
    <div id="map"></div>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box"  style="background-color:#fff; height:160px">
            <div class="inner">
            <?php
               $sql="SELECT COUNT(*) AS total FROM vehicle";
               $query=$dbh->prepare($sql);
               $query->execute();
               $results=$query->fetchALL(PDO::FETCH_OBJ);
               $cnt=1;   
               if ($query->rowCount()>0) {
                 # code...
                 foreach ($results as $result) 
                 {
              ?>
              <h3 style="color:#000; margin-top:25px;"><?php echo htmlentities($result->total);?></h3>
              <?php } } ?>
              <p style="color:#000;"> Vehicles</p>
            </div>
            <div class="icon">
              <i class="fa fa-car" style="color:#68bb59; margin-top:30px;"></i>
            </div>
            <a href="viewvehicles.php" class="small-box-footer" style="background-color:rgb(31, 199, 212)" id="moreInfo">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box"  style="background-color:#fff; height:160px">
            <div class="inner">
            <?php
                $sql="SELECT COUNT(*) AS total FROM user
               WHERE usertype = 'Renter' OR usertype = 'Vehicle Owner'";
               $query=$dbh->prepare($sql);
               $query->execute();
               $results=$query->fetchALL(PDO::FETCH_OBJ);
               $cnt=1;   
               if ($query->rowCount()>0) {
                 # code...
                 foreach ($results as $result) 
                 {
              ?>
            <h3 style="color:#000; margin-top:25px;"><?php echo htmlentities($result->total);?></h3>
              <?php } } ?>

              <p style="color:#000;">Users</p>
            </div>
            <div class="icon">
              <i class="fa fa-user"  style="color:#4fc3f7; margin-top:30px;"></i>
            </div>
            <a href="renter.php" class="small-box-footer" style="background-color:rgb(31, 199, 212)" id="moreInfo">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box"  style="background-color:#fff; height:160px">
            <div class="inner">
            <?php
               $sql="SELECT COUNT(*) AS total FROM complaints";
               $query=$dbh->prepare($sql);
               $query->execute();
               $results=$query->fetchALL(PDO::FETCH_OBJ);
               $cnt=1;   
               if ($query->rowCount()>0) {
                 # code...
                 foreach ($results as $result) 
                 {
              ?>
              <h3 style="color:#000; margin-top:25px;"><?php echo htmlentities($result->total);?></h3>
              <?php } } ?>

              <p style="color:#000;">User Complaints</p>
            </div>
            <div class="icon">
              <i class="fa fa-message"  style="color:#e3242b; margin-top:30px;"></i>
            </div>
            <a href="report.php" class="small-box-footer" style="background-color:rgb(31, 199, 212)" id="moreInfo">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box"  style="background-color:#fff; height:160px">
            <div class="inner">
            <?php
               $sql="SELECT COUNT(*) AS total FROM bookinghistory ";
               $query=$dbh->prepare($sql);
               $query->execute();
               $results=$query->fetchALL(PDO::FETCH_OBJ);
               $cnt=1;   
               if ($query->rowCount()>0) {
                 # code...
                 foreach ($results as $result) 
                 {
              ?>
               <h3 style="color:#000; margin-top:25px;"><?php echo htmlentities($result->total);?></h3>
              <?php } } ?>

              <p style="color:#000;">Rental History</p>
            </div>
            <div class="icon">
              <i class="fa fa-history"  style="color:#fddc56; margin-top:30px;"></i>
            </div>
            <a href="rentalhistory.php" class="small-box-footer" style="background-color:rgb(31, 199, 212)" id="moreInfo">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
     

        </section>
       

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
    </div>
    <strong>Copyright &copy; 2021-2022 <a href="#">WeLift: Vehicle Rental System</a>.</strong> All rights
    reserved.
  </footer>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

</body>
</html>
