<?php

session_start();
include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\config.php');    


if(!isset($_SESSION['userid']))
  {
    echo "<script type ='text/javascript'> document.location.href='../login.php' </script>"; 
  } 
 else if(!isset($_GET['bookingid']))
  {
    echo "<script type ='text/javascript'> document.location.href='dashboard.php' </script>"; 
  } 
  else
  {
    $rentername=$_SESSION['firstname']." ".$_SESSION['lastname'];
    $id = $_SESSION['userid'];
  }

  if (isset($_POST['submit'])) {
    date_default_timezone_set('Asia/Singapore');
    $bookingid=intval($_GET['bookingid']);
    $ownerid=intval($_GET['ownerid']);
    $complainee=($_GET['complainee']);
    $description=($_POST['description']);
    $date = date('y-m-d H:i:s');
    $date1 = date('y-m-d');

    $sql = "INSERT INTO complaints(bookingid,complainantid,complaineeid,complainee,description,status,date)VALUES($bookingid,$id,$ownerid,'$complainee',:description,'PENDING','$date1')";
    $query = $dbh->prepare($sql);
    $query->bindParam(':description',$description,PDO::PARAM_STR);
    $query->execute();

    $sql3 = "INSERT INTO notification(receiverid,message,header,date)VALUES('1','$rentername submit a report','report', '$date')";
    $query3 = $dbh->prepare($sql3);  
    $query3->execute();

    echo '<script>alert("Success!")</script>'; 
    echo "<script type ='text/javascript'> document.location.href='rentedvehicles.php' </script>"; 
    
  }
  
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Client - Report Vehicle Owner</title>
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
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<?php  include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\renterheader.php');      ?>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Navigation Forms</li>
        <li  >
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
          <a href="vehiclerental.php">
            <i class="fa fa-cab"></i> <span>Vehicle Bookings</span>
          </a>
        </li>
        <li class="active">
          <a href="rentedvehicles.php">
            <i class="fa fa-cab"></i> <span>Reserved Vehicles</span>
          </a>
        </li>
        <li>
          <a href="history.php">
            <i class="fa fa-history"></i> <span>View Rental History</span>
          </a>
        </li>
        <li>
          <a href="profile.php">
            <i class="fa fa-user"></i> <span>Profile</span>
          </a>
        </li>
        <li>
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
        <i class="fa fa-comment"></i> Report
        <small></small>
      </h1>
    </section>

    <!-- Main content -->
    
    <!-- Content Header (Page header) -->
    <section class="content">
    <form role="form" method="post">
    <div class="row" >
        <div class="col-xs-12">
          <div class="box"  style="height: 60vh; ">

    <div class="rate" align="center">
        <h5 style="margin-top:0px; padding-top:50px;"> Submit a Report </h5>
    </div>

    

    <div class="comment"  align="center" style="margin-top:20px; ">
    <textarea placeholder="Description" name="description" cols="50" rows="10" required></textarea>
    </div>

    <div class="submitbutton"  align="center" style="margin-top:30px;">
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    <div class="skip" align="center" style="margin-top:15px;font-size: 17px;">
    <a href="rentedvehicles.php"> Cancel </a>
    </div>
    
    </div>

    </div>
    </div>
    </div>

    </form>
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
</body>
</html>
