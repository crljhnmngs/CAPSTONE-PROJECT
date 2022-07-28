<?php
session_start();
include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\config.php');    

if(!isset($_SESSION['userid']))
  {
    echo "<script type ='text/javascript'> document.location.href='../login.php' </script>"; 
  } 
  else{
    $username=$_SESSION['firstname']."  ".$_SESSION['lastname'];
    $id = $_SESSION['userid'];
  }  
 
if (isset($_POST['submit'])) {

   
    
    $id = $_SESSION['userid'];
    $vehiclename=($_POST['vehiclename']);
    $color=($_POST['color']);
    $model=($_POST['model']);
    $brand=($_POST['brand']);
    $vehicletype=($_POST['vehicletype']);
    $capacity=($_POST['capacity']);
    $platenumber=($_POST['platenumber']);
    $officialreceipt=($_POST['officialreceipt']);
    $certofregistration=($_POST['certofregistration']);
    $rate=($_POST['rate']);
    $penaltyrate=($_POST['penaltyrate']);
    $status=($_POST['status']);


    //$name = $_FILES['image']['name'];
    $temp = explode(".", $_FILES["vehicleimage"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);
    $target_dir = "vehicle_images/";
    $target_file = $target_dir . basename($_FILES["vehicleimage"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $extensions_arr = array("jpg","jpeg","png","gif");

  $sql = "SELECT * FROM vehicle WHERE userid = $id  AND vehiclename = '".$vehiclename."'";
  $query = $dbh->prepare($sql);
  $query->execute();
  
  if($query->rowCount()>0)
  {
          echo '<script>alert("Please select other vehicle name")</script>'; 
  }
  else if(in_array($imageFileType,$extensions_arr) ){
    if(move_uploaded_file($_FILES['vehicleimage']['tmp_name'],$target_dir.$newfilename))
    {
      
       $sql = "INSERT INTO vehicle(userid,vehiclename,color,model,brand,vehicletype,capacity,platenumber,officialreceipt,certofregistration,rate,penaltyrate,vehicleimage,status)
       VALUES($id, :vehiclename,:color,:model,:brand,:vehicletype,:capacity,:platenumber,:officialreceipt,:certofregistration,:rate,:penaltyrate,'".$newfilename."',:status)";
           $query = $dbh->prepare($sql);
           $query->bindParam(':vehiclename',$vehiclename,PDO::PARAM_STR);
           $query->bindParam(':color',$color,PDO::PARAM_STR);
           $query->bindParam(':model',$model,PDO::PARAM_STR);
           $query->bindParam(':brand',$brand,PDO::PARAM_STR);
           $query->bindParam(':vehicletype',$vehicletype,PDO::PARAM_STR);
           $query->bindParam(':capacity',$capacity,PDO::PARAM_STR);
           $query->bindParam(':platenumber',$platenumber,PDO::PARAM_STR);
           $query->bindParam(':officialreceipt',$officialreceipt,PDO::PARAM_STR);
           $query->bindParam(':certofregistration',$certofregistration,PDO::PARAM_STR);
           $query->bindParam(':rate',$rate,PDO::PARAM_STR);
           $query->bindParam(':penaltyrate',$penaltyrate,PDO::PARAM_STR);
           $query->bindParam(':status',$status,PDO::PARAM_STR);
           $query->execute();
           echo '<script>alert("Added Successfully!")</script>'; 
           echo "<script type ='text/javascript'> document.location.href='managevehicle.php' </script>"; 
    }
 }
    else{
      echo '<script>alert("Invalid Image Type!")</script>'; 
    }
       
     
    
}   
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Vehicle Owner - Add Vehicle</title>
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

    <?php  include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\ownerheader.php');      ?>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Navigation Forms</li>
        <li >
          <a href="dashboard.php">
            <i class="fa fa-home"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="active">
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
        <i class="fa fa-car"></i> Add Vehicle
        <small></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <form role="form" method="post" enctype="multipart/form-data">
            <div class="modal-content">
              <div class="modal-header"><a href="managevehicle.php"><button type="button" class="btn btn-danger btn-sm" >
               <i class="fa fa-backward"></i> Back
              </button></a>
              <a href="managevehicle.php"><button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                  <span aria-hidden="true">&times;</span></button> </a>
              </div>
              <div class="modal-body">
            <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Fill In : </h3>
            </div>
              <div class="box-body">
              <div class="form-group">
                  <label for="exampleInputEmail1">Vehicle Name</label>
                  <input type="text" class="form-control" name="vehiclename"  placeholder="Enter Vehicle Name" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Color</label>
                  <input type="text" class="form-control" name="color"  placeholder="Enter Vehicle Color" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Model</label>
                  <input type="text" class="form-control" name="model"  placeholder="Enter Vehicle Model" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Brand</label>
                  <input type="text" class="form-control" name="brand"  placeholder="Enter Vehicle Brand" required>
                </div>
                <div class="form-group">
                  <label>Vehicle Type</label>
                  <select class="form-control" name="vehicletype">
                    <option>Motorcycle</option>
                    <option>Multicab</option>
                    <option>Sedan</option>
                    <option>Van</option>
                    <option>Mini Van</option>
                    <option>Truck</option>
                    <option>Pickup</option>
                    <option>Bus</option>
                    <option>Mini Bus</option>
                    <option>SUV</option>
                    <option>Hatchback</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Capacity</label>
                  <input type="number" class="form-control" name="capacity"  placeholder="Enter Vehicle Capacity" required>
                </div>
                
                <div class="form-group">
                  <label for="exampleInputPassword1">Plate Number</label>
                  <input type="text" class="form-control" name="platenumber" placeholder="Enter Vehicle Plate Number" required>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Official Receipt no.</label>
                  <input type="text" class="form-control" name="officialreceipt" placeholder="Enter Vehicle Official Receipt no." required>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Certificate of Registration no.</label>
                  <input type="text" class="form-control" name="certofregistration" placeholder="Enter Vehicle Certificate of Registration no." required>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Rate per Day</label>
                  <input type="number" step="any" class="form-control" name="rate" placeholder="Enter Vehicle Rate/Day" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Penalty Rate per Hour</label>
                  <input type="number" step="any" class="form-control" name="penaltyrate" placeholder="Enter Vehicle Penalty Rate/Hour" required>
                </div>
                <div class="form-group">
                  <label>Vehicle Status</label>
                  <select class="form-control" name="status">
                    <option>AVAILABLE</option>
                    <option>NOT_AVAILABLE</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Vehicle Image</label>
                  <input type="file" name="vehicleimage" id="exampleInputFile" required>
                </div>
              </div>
          </div>
              </div>
              <div class="modal-footer">
              <a href="managevehicle.php"> <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button> </a>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
            </form>
        <!-- /.modal -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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
