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
  
 
if (isset($_POST['update'])) {

    $vehicleid=($_POST['vehicleid']);
    $userid=($_POST['userid']);
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
    $oldimage = ($_POST['oldimage']);
    $editid=intval($_GET['editid']);

    $name = $_FILES['vehicleimage']['name'];
    $temp = explode(".", $_FILES["vehicleimage"]["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp); //New Image var name
    $target_dir = "vehicle_images/";
    $target_file = $target_dir . basename($_FILES["vehicleimage"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $extensions_arr = array("jpg","jpeg","png","gif");

    
    if($name == '')
    {
      $update_filename = $oldimage;

      $sql = "UPDATE vehicle SET vehicleid=:vehicleid, userid=:userid,vehiclename=:vehiclename,color=:color,model=:model,brand=:brand,vehicletype=:vehicletype,capacity=:capacity,
          platenumber=:platenumber,officialreceipt=:officialreceipt,certofregistration=:certofregistration,rate=:rate,penaltyrate=:penaltyrate,vehicleimage='".$update_filename."', status=:status WHERE vehicleid=:editid";
          
          $query = $dbh->prepare($sql);  
          $query->bindParam(':vehicleid',$vehicleid,PDO::PARAM_STR);
          $query->bindParam(':userid',$userid,PDO::PARAM_STR);
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
          $query->bindParam(':editid',$editid,PDO::PARAM_STR);
          if($query->execute())
          {
          if($_FILES['vehicleimage']['name'] != '')
          {
            move_uploaded_file($_FILES['vehicleimage']['tmp_name'],$target_dir.$update_filename);
            unlink("vehicle_images/".$oldimage);  
            
          }
          echo '<script>alert("Updated Successfully!")</script>'; 
          echo "<script type ='text/javascript'> document.location.href='managevehicle.php' </script>"; 
        } 
    }
    else
    {
      $update_filename = $newfilename;
      if(!in_array($imageFileType,$extensions_arr))
        {
         echo '<script>alert("Invalid File Type!")</script>'; 
        }
        else{
          $sql = "UPDATE vehicle SET vehicleid=:vehicleid, userid=:userid,vehiclename=:vehiclename,color=:color,model=:model,brand=:brand,vehicletype=:vehicletype,capacity=:capacity,
          platenumber=:platenumber,officialreceipt=:officialreceipt,certofregistration=:certofregistration,rate=:rate,penaltyrate=:penaltyrate,vehicleimage='".$update_filename."', status=:status WHERE vehicleid=:editid";
          
          $query = $dbh->prepare($sql);  
          $query->bindParam(':vehicleid',$vehicleid,PDO::PARAM_STR);
          $query->bindParam(':userid',$userid,PDO::PARAM_STR);
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
          $query->bindParam(':editid',$editid,PDO::PARAM_STR);
          if($query->execute())
          {
          if($_FILES['vehicleimage']['name'] != '')
          {
            move_uploaded_file($_FILES['vehicleimage']['tmp_name'],$target_dir.$update_filename);
            unlink("vehicle_images/".$oldimage);  
            
          }
          echo '<script>alert("Updated Successfully!")</script>'; 
          echo "<script type ='text/javascript'> document.location.href='managevehicle.php' </script>"; 
        }    
      }
    }        
   }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Vehicle Owner - Update Vehicle</title>
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
  <link rel="stylesheet" href="../../dist/css/managevehicle.css">

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
        <i class="fa fa-car"></i> Update Vehicle
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


                <?php
                $editid=intval($_GET['editid']);
                $sql="SELECT * from vehicle where vehicleid=:editid";
                $query = $dbh->prepare($sql);
                $query->bindParam(':editid', $editid,PDO::PARAM_STR);
                $query->execute();
                $result=$query->fetchAll(PDo::FETCH_OBJ);
                $cnt=1;
                if($query->rowCount()>0)
                {
                 foreach ($result as $result) {
        
    
                ?>
                <input type="hidden" name="vehicleid" value="<?php echo htmlentities($result->vehicleid); ?>" required="required" class="form-control" id="success">
                <input type="hidden" name="userid" value="<?php echo htmlentities($result->userid); ?>" required="required" class="form-control" id="success">
              <div class="box-body">
              <div class="form-group">
                  <label for="exampleInputEmail1">Vehicle Name</label>
                  <input type="text" class="form-control" name="vehiclename" value="<?php echo htmlentities($result->vehiclename); ?>"  placeholder="Enter Vehicle Name" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Color</label>
                  <input type="text" class="form-control" name="color" value="<?php echo htmlentities($result->color); ?>"  placeholder="Enter Vehicle Color" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Model</label>
                  <input type="text" class="form-control" name="model" value="<?php echo htmlentities($result->model); ?>"  placeholder="Enter Vehicle Model" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Brand</label>
                  <input type="text" class="form-control" name="brand" value="<?php echo htmlentities($result->brand); ?>"  placeholder="Enter Vehicle Brand" required>
                </div>
                <div class="form-group">
                  <label>Vehicle Type</label>
                  <select class="form-control" name="vehicletype" value="<?php echo htmlentities($result->vehicletype); ?>">
                  <?php
                    
                     if(htmlentities($result->vehicletype) == 'Motorcycle') { ?>
                    <option selected>Motorcycle</option>
                    <option>Car</option>
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
                    <?php } else if(htmlentities($result->vehicletype) == 'Sedan') {?>
                    <option>Motorcycle</option>
                    <option>Multicab</option>
                    <option selected>Sedan</option>
                    <option>Van</option>
                    <option>Mini Van</option>
                    <option>Truck</option>
                    <option>Pickup</option>
                    <option>Bus</option>
                    <option>Mini Bus</option>
                    <option>SUV</option>
                    <option>Hatchback</option>
                    <?php } else if(htmlentities($result->vehicletype) == 'Multicab') {?>
                    <option>Motorcycle</option>
                    <option selected>Multicab</option>
                    <option >Sedan</option>
                    <option>Van</option>
                    <option>Mini Van</option>
                    <option>Truck</option>
                    <option>Pickup</option>
                    <option>Bus</option>
                    <option>Mini Bus</option>
                    <option>SUV</option>
                    <option>Hatchback</option>
                    <?php } else if(htmlentities($result->vehicletype) == 'Van') {?>
                    <option>Motorcycle</option>
                    <option >Multicab</option>
                    <option >Sedan</option>
                    <option selected>Van</option>
                    <option>Mini Van</option>
                    <option>Truck</option>
                    <option>Pickup</option>
                    <option>Bus</option>
                    <option>Mini Bus</option>
                    <option>Truck</option>
                    <option>SUV</option>
                    <option>Hatchback</option>
                    <?php } else if(htmlentities($result->vehicletype) == 'Mini Van') {?>
                      <option>Motorcycle</option>
                    <option >Multicab</option>
                    <option >Sedan</option>
                    <option >Van</option>
                    <option selected>Mini Van</option>
                    <option>Truck</option>
                    <option>Pickup</option>
                    <option>Bus</option>
                    <option>Mini Bus</option>
                    <option>SUV</option>
                    <option>Hatchback</option>
                    <?php } else if(htmlentities($result->vehicletype) == 'Truck') {?>
                    <option>Motorcycle</option>
                    <option >Multicab</option>
                    <option >Sedan</option>
                    <option >Van</option>
                    <option >Mini Van</option>
                    <option selected>Truck</option>
                    <option>Pickup</option>
                    <option>Bus</option>
                    <option>Mini Bus</option>
                    <option>SUV</option>
                    <option>Hatchback</option>
                    <?php } else if(htmlentities($result->vehicletype) == 'Pickup') {?>
                    <option>Motorcycle</option>
                    <option >Multicab</option>
                    <option >Sedan</option>
                    <option >Van</option>
                    <option >Mini Van</option>
                    <option >Truck</option>
                    <option selected>Pickup</option>
                    <option>Bus</option>
                    <option>Mini Bus</option>
                    <option>SUV</option>
                    <option>Hatchback</option>
                    <?php } else if(htmlentities($result->vehicletype) == 'Bus') {?>
                    <option>Motorcycle</option>
                    <option >Multicab</option>
                    <option >Sedan</option>
                    <option >Van</option>
                    <option >Mini Van</option>
                    <option >Truck</option>
                    <option >Pickup</option>
                    <option selected>Bus</option>
                    <option>Mini Bus</option>
                    <option>SUV</option>
                    <option>Hatchback</option>
                    <?php } else if(htmlentities($result->vehicletype) == 'Mini Bus') {?>
                    <option>Motorcycle</option>
                    <option >Multicab</option>
                    <option >Sedan</option>
                    <option >Van</option>
                    <option >Mini Van</option>
                    <option >Truck</option>
                    <option >Pickup</option>
                    <option >Bus</option>
                    <option selected>Mini Bus</option>
                    <option>SUV</option>
                    <option>Hatchback</option>
                    <?php } else if(htmlentities($result->vehicletype) == 'SUV') {?>
                    <option>Motorcycle</option>
                    <option >Multicab</option>
                    <option >Sedan</option>
                    <option >Van</option>
                    <option >Mini Van</option>
                    <option >Truck</option>
                    <option >Pickup</option>
                    <option >Bus</option>
                    <option >Mini Bus</option>
                    <option selected>SUV</option>
                    <option>Hatchback</option>
                    <?php } else { ?>
                      <option>Motorcycle</option>
                    <option >Multicab</option>
                    <option >Sedan</option>
                    <option >Van</option>
                    <option >Mini Van</option>
                    <option >Truck</option>
                    <option >Pickup</option>
                    <option >Bus</option>
                    <option >Mini Bus</option>
                    <option >SUV</option>
                    <option selected>Hatchback</option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Capacity</label>
                  <input type="number" class="form-control" name="capacity" value="<?php echo htmlentities($result->capacity); ?>"  placeholder="Enter Vehicle Capacity" required>
                </div>
                
                <div class="form-group">
                  <label for="exampleInputPassword1">Plate Number</label>
                  <input type="text" class="form-control" name="platenumber"  value="<?php echo htmlentities($result->platenumber); ?>" placeholder="Enter Vehicle Plate Number" required>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Official Receipt no.</label>
                  <input type="text" class="form-control" name="officialreceipt" value="<?php echo htmlentities($result->officialreceipt); ?>" placeholder="Enter Vehicle Official Receipt" required>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Certificate of Registration no.</label>
                  <input type="text" class="form-control" name="certofregistration" value="<?php echo htmlentities($result->certofregistration); ?>" placeholder="Enter Vehicle Certificate of Registration" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Rate per Day</label>
                  <input type="number" step="any" class="form-control" name="rate" value="<?php echo htmlentities($result->rate); ?>" placeholder="Enter Vehicle Rate/Day" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Penalty Rate per Hour</label>
                  <input type="number" step="any" class="form-control" name="penaltyrate" value="<?php echo htmlentities($result->penaltyrate); ?>" placeholder="Enter Vehicle Penalty Rate/Hour" required>
                </div>
                <div class="form-group">
                  <label>Vehicle Status</label>
                  <select class="form-control" name="status" >
                    <?php
                    
                     if(htmlentities($result->status) == 'NOT_AVAILABLE') { ?>
                    <option>AVAILABLE</option>
                    <option selected>NOT_AVAILABLE</option>
                    <?php } 
                    else if(htmlentities($result->status) == 'AVAILABLE'){?>
                    <option selected>AVAILABLE</option>
                    <option >NOT_AVAILABLE</option>
                    <?php } else { ?>
                    <option ><?php echo htmlentities($result->status); ?></option>
                      <?php } ?>
                  </select>
                </div>
                <div class="updateimage">
                <img src="vehicle_images/<?php echo htmlentities($result->vehicleimage);?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Vehicle Image</label>
                  <input type="file" name="vehicleimage" id="exampleInputFile"  >
                  <input type="hidden" name="oldimage" value="<?php echo htmlentities($result->vehicleimage);?>">
                </div>
              </div>
          </div>
          <?php }} ?>
              </div>
              <div class="modal-footer">
              <a href="managevehicle.php"> <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button> </a>
                <button type="submit" name="update" class="btn btn-primary">Submit</button>
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
