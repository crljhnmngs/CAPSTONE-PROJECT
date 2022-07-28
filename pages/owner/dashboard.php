<?php

session_start();
include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\config.php');     

date_default_timezone_set('Asia/Singapore');
//$currentdate = date('2022-05-25 01:00:00');
 $currentdate = date('y-m-d H:i:s');
 $sql="SELECT * FROM booking
 INNER JOIN vehicle ON booking.vehicleid=vehicle.vehicleid
 INNER JOIN user ON vehicle.userid=user.userid
 WHERE booking.bookingstatus = 'RESERVED'";
 $query=$dbh->prepare($sql);
 $query->execute();
 $results=$query->fetchALL(PDO::FETCH_OBJ);
 foreach ($results as $result) 
 {
   $bookingid = htmlentities($result->bookingid);
   $returndate = htmlentities($result->returndate);
   $penaltyrate = htmlentities($result->penaltyrate);
   $date2 = date($returndate .= '23:59:59');
   $hours = floor((strtotime($currentdate) - strtotime($date2)) / 3600);
   
   if($hours > 0)
   {
   $penalty = $hours * $penaltyrate;
   if($currentdate > $date2)
   {
     $sql = "UPDATE booking SET penalty = $penalty WHERE bookingid = $bookingid";
     $query = $dbh->prepare($sql);
     $query->execute();
   }
 }
 }

if(!isset($_SESSION['userid']))
  {
    echo "<script type ='text/javascript'> document.location.href='../login.php' </script>"; 
  } 
  else{
    date_default_timezone_set('Asia/Singapore');
    $username=$_SESSION['firstname']." ".$_SESSION['lastname'];
    $id = $_SESSION['userid'];
    $currentdatetime = strtotime(date('y-m-d H:i:s'));
    //$currentdatetime = strtotime(date('2022-05-23 23:57:00'));
    $date = date('y-m-d H:i:s');

    $sql="SELECT * FROM booking
    INNER JOIN vehicle ON booking.vehicleid=vehicle.vehicleid
    INNER JOIN user ON vehicle.userid=user.userid
    WHERE booking.bookingstatus = 'PENDING'";
    $query=$dbh->prepare($sql);
    $query->execute();
    $results=$query->fetchALL(PDO::FETCH_OBJ);
    foreach ($results as $result) 
    {
      $oldDate = strtotime(date(htmlentities($result->datetime))) + 21600;
      $bookingid = htmlentities($result->bookingid);
      $vehicleid = htmlentities($result->vehicleid);
      $userid = htmlentities($result->userid);
      $renterid = htmlentities($result->renterid);

      if($oldDate < $currentdatetime)
      {
        $sql = "UPDATE booking SET bookingstatus = 'CANCELED' WHERE bookingid = $bookingid";
       $query = $dbh->prepare($sql);
       $query->execute();

       $sql2 = "UPDATE vehicle SET status = 'AVAILABLE' WHERE vehicleid = $vehicleid";
       $query2 = $dbh->prepare($sql2);
       $query2->execute();

       $sql3 = "INSERT INTO notification(receiverid,message,date)VALUES($userid,'Your vehicle booking is automatically cancelled', '$date')";
       $query3 = $dbh->prepare($sql3);  
       $query3->execute();

       $sql4 = "INSERT INTO notification(receiverid,message,date)VALUES($renterid,'Your vehicle booking is automatically cancelled', '$date')";
       $query4 = $dbh->prepare($sql4);  
       $query4->execute();
      }
    }
  }


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Vehicle Owner - Dashboard</title>
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
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
  href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;1,200;1,300;1,400&display=swap" rel="stylesheet">
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <?php  include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\ownerheader.php');      ?>

  
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Navigation Forms</li>
        <li class="active">
          <a href="dashboard.php">
            <i class="fa fa-home"></i> <span>Dashboard</span>
          </a>
        </li>
        <li >
          <a href="managevehicle.php">
            <i class="fa fa-cab"></i> <span>My Vehicles</span>
          </a>
        </li>
        <li>
        <a href="vehiclerental.php">
            <i class="fa fa-cab"></i> <span>Vehicle Bookings</span>
          </a>
        </li>
        <li>
        <a href="rentedvehicles.php">
            <i class="fa fa-cab"></i> <span>Reserved Vehicles</span>
          </a>
        </li>
        <li>
          <a href="requestreturn.php">
            <i class="fa fa-cab"></i> <span>Returned Vehicles</span>
          </a>
        </li>
        <li >
          <a href="rentalschedule.php">
            <i class="fa fa-calendar"></i> <span>Rental Schedule</span>
          </a>
        </li>
        <li>
          <a href="history.php">
            <i class="fa fa-history"></i> <span>Rental History</span>
          </a>
        </li>
        <li>
          <a href="profile.php">
            <i class="fa fa-user"></i> <span>Profile</span>
          </a>
        </li>
        <li >
          <a href="chat.php">
            <i class="fa fa-envelope"></i> <span>Message</span>
          </a>
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

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6" >
          <!-- small box -->
          <div class="small-box"  style="background-color:#fff; height:160px">
            <div class="inner">
            <?php
               $sql="SELECT COUNT(*) AS total FROM vehicle where userid = $id";
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
              <p style="color:#000;">Your Vehicles</p>
            </div>
            <div class="icon">
              <i class="fa fa-cab" style="color:#4fc3f7; margin-top:30px;"></i>
            </div>
            <a href="managevehicle.php" class="small-box-footer" style="background-color:rgb(31, 199, 212)" id="moreInfo">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box"  style="background-color:#fff; height:160px">
            <div class="inner">
            <?php
               $sql="SELECT COUNT(*) AS total FROM booking 
               INNER JOIN vehicle ON booking.vehicleid = vehicle.vehicleid  where vehicle.userid = $id AND booking.bookingstatus = 'PENDING'";
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

              <p style="color:#000;">Vehicle Bookings</p>
            </div>
            <div class="icon">
            <i class="fa fa-cab" style="color:#68bb59; margin-top:30px;"></i>
            </div>
            <a href="vehiclerental.php" class="small-box-footer" style="background-color:rgb(31, 199, 212)" id="moreInfo">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box"  style="background-color:#fff; height:160px">
            <div class="inner">
            <?php
               $sql="SELECT COUNT(*) AS total FROM vehicle 
               INNER JOIN booking ON booking.vehicleid = vehicle.vehicleid WHERE vehicle.userid = $id AND booking.bookingstatus = 'RESERVED'";
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

              <p style="color:#000;">Reserved Vehicles</p>
            </div>
            <div class="icon">
            <i class="fa fa-cab" style="color:#e3242b; margin-top:30px;"></i>
            </div>
            <a href="rentedvehicles.php" class="small-box-footer" style="background-color:rgb(31, 199, 212)" id="moreInfo">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box"  style="background-color:#fff; height:160px">
            <div class="inner">
            <?php
               $sql="SELECT COUNT(*) AS total FROM bookinghistory 
                 INNER JOIN vehicle ON bookinghistory.vehicleid = vehicle.vehicleid
                 INNER JOIN booking ON bookinghistory.bookingid = booking.bookingid
                 INNER JOIN rentercredentials ON bookinghistory.renterid = rentercredentials.renterid
                 INNER JOIN user ON rentercredentials.renterid = user.userid
                 WHERE vehicle.userid = $id ";
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
            <i class="fa fa-history" style="color:#fddc56; margin-top:30px;"></i>
            </div>
            <a href="history.php" class="small-box-footer" style="background-color:rgb(31, 199, 212)" id="moreInfo">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      

        </section>

        <div class="box-body">
           
           <table id="example1" class="table table-bordered table-striped">
             <thead>
             <tr style="background-color: #ffff;">
               <th style="width: 10%; color:#9A6AFF"></i>Vehicle Name</th>
               <th style="width: 20%; color:#9A6AFF">Renter</th>
               <th style="color:#9A6AFF" >Booking Date</th>
               <th style="color:#9A6AFF"  >Return Date</th>
               <th style="color:#9A6AFF" >Purpose</th>
               <th style="color:#9A6AFF" >Manpower</th>
               <th style="color:#9A6AFF"  >Rental Status</th>
               
             </tr>
             </thead>
             <tbody>
             <?php
               $sql= "SELECT * FROM booking 
               INNER JOIN vehicle ON booking.vehicleid = vehicle.vehicleid
               INNER JOIN rentercredentials ON booking.renterid = rentercredentials.renterid
               INNER JOIN user ON rentercredentials.renterid = user.userid
               WHERE vehicle.userid = $id AND booking.bookingstatus =  'RESERVED'";
             $query=$dbh->prepare($sql);
             $query->execute();
             $results=$query->fetchALL(PDO::FETCH_OBJ);

             $cnt=1;   
             if ($query->rowCount()>0) {
             foreach ($results as $result) 
             {


             ?>
             <tr>
              <td style="height:50px;"><?php echo htmlentities($result->vehiclename);?></td>
               <td style="height:50px;"><?php echo htmlentities($result->firstname);?> <?php echo htmlentities($result->lastname);?></td>
               <td style="height:50px;"><?php echo htmlentities(date("F d, Y", strtotime($result->bookingdate)));?></td>
               <td style="height:50px;"><?php echo htmlentities(date("F d, Y", strtotime($result->returndate)));?></td>
               <td style="height:50px;"><?php echo htmlentities($result->purpose);?></td>
               <?php if(htmlentities($result->manpower) == null) { ?>
                <td style="height:50px;">N/A</td>
                <?php } else{ ?>
                <td style="height:50px;"><?php echo htmlentities($result->manpower);?></td>
                <?php }  ?> 
               <td style="height:50px; color:red; font-weight:bold"><?php echo htmlentities($result->bookingstatus);?></td>
             </tr>
             <?php 
             $cnt = 0;
             $cnt=$cnt+1; 
              }
              }
             ?>
             </tbody>
             
           </table>
     
     </div>


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
</body>
</html>
