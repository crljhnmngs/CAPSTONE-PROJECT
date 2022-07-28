<?php
include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\config.php');    
session_start();

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
  <title>Admin - Manage Client</title>
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

<?php  include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\adminheader.php');      ?>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Navigation Forms</li>
        <li>
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
            <i class="fa fa-users"></i> <span>Verify Vehicle Owner </span>
          </a>
        </li>
        <li>
          <a href="profile.php">
            <i class="fa fa-user"></i> <span>Profile</span>
          </a>
        </li>
        
        <li>
        <li class="active">
          <a href="#">
            <i class="fa fa-user-secret"></i>
            <span>User Account</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           
            <li class="active"><a href="renter.php"><i class="fa fa-circle-o"></i> Client</a></li>
            <li ><a href="owner.php"><i class="fa fa-circle-o"></i> Vehicle Owner</a></li>
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
        <i class="fa fa-keyboard-o"></i> Manage Client
        <small></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-user"></i> Client </h3>
        <div class="modal fade" id="add">
          <div class="modal-dialog">
            <form role="form">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Renter</h4>
              </div>
              <div class="modal-body">
            <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Fill In : </h3>
            </div>
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Firstname</label>
                  <input type="text" class="form-control"  placeholder="Enter Renter firstname">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Middlename</label>
                  <input type="text" class="form-control"  placeholder="Enter Renter middlename">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Lastname</label>
                  <input type="text" class="form-control"  placeholder="Enter Renter lastname">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Contact</label>
                  <input type="text" class="form-control"  placeholder="Enter Renter Contact">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Address</label>
                  <input type="text" class="form-control"  placeholder="Enter Renter Address">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="text" class="form-control"  placeholder="Enter Renter Email">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Username</label>
                  <input type="text" class="form-control"  placeholder="Enter Renter Password">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" placeholder="Enter Renter Renter">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Profile Image</label>
                  <input type="file" id="exampleInputFile">
                </div>
              </div>
          </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
            </form>
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr style="background-color: #c5c5c5;">
                  <th style="width: 7%" align="center"><i class="fa fa-picture-o"></i></th>
                  <th style="width: 11%;color:#9A6AFF;">Client</th>
                  <th style="width: 5%;color:#9A6AFF;">Age</th>
                  <th style="width: 11%;color:#9A6AFF;">Contact</th>
                  <th style="width: 11%;color:#9A6AFF;">Address</th>
                  <th style="color:#9A6AFF;">Email</th>
                  <th style="color:#9A6AFF;">Gender</th>
                  <th style="color:#9A6AFF;">Email Status</th>
                  <th style="color:#9A6AFF;">Account Status</th>
                  <th style="width: 7.8%;color:#9A6AFF;"> Action </th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql="SELECT * FROM user WHERE usertype = 'Renter'";
                $query=$dbh->prepare($sql);
                $query->execute();
                $results=$query->fetchALL(PDO::FETCH_OBJ);

                $cnt=1;   
                if ($query->rowCount()>0) {
                foreach ($results as $result) 
                {


                ?>
                <tr>
                  <td style="height:70px;"><img src="../../dist/img/userimage/<?php echo htmlentities($result->image);?>" class="img-square" alt="User Image" style="width: 100%"></td>
                  <td><?php echo htmlentities($result->firstname);?> <?php echo htmlentities($result->lastname);?></td>
                  <td><?php echo htmlentities($result->age);?></td>
                  <td><?php echo htmlentities($result->contactno);?></td>
                  <td><?php echo htmlentities($result->address);?></td>
                  <td><?php echo htmlentities($result->email);?></td>
                  <td><?php echo htmlentities($result->gender);?></td>
                  <?php if(htmlentities($result->emailstatus) == 1){ ?>
                  <td>VERIFIED</td>
                  <?php } else { ?>
                    <td>NOT_VERIFIED</td>
                    <?php } ?>
                  <td><?php echo htmlentities($result->accountstatus);?></td>
                  <?php if(htmlentities($result->accountstatus) != 'DEACTIVATED') {?>
                  <td align="center"><a href="deactivate.php?userid=<?php echo htmlentities($result->userid)?>"><button class="btn btn-danger btn-xs" type="submit" name="verify" onclick="return confirm('Deactivate this Account ?')" style="font-size: 15px;font-weight: 500;margin-top:2px;">Deactivate</button></a></td>
                  <?php } else { ?>
                    <td align="center"><a href="activate.php?userid=<?php echo htmlentities($result->userid)?>"><button class="btn btn-success btn-xs" type="submit" name="verify" onclick="return confirm('Activate this Account ?')" style="font-size: 15px;font-weight: 500;margin-top:2px;">Activate</button></a></td>
                    <?php }  ?>
                </tr>
                <?php 
                $cnt = 0;
                $cnt=$cnt+1; 
                 }
                 }
                ?>
                </tbody>
              </table>
        <div class="modal fade" id="edit">
          <div class="modal-dialog">
           <form role="form">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update </h4>
              </div>
              <div class="modal-body">
            <div class="box box-warning">
            <div class="box-header with-border">
            </div>
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Costumer</label>
                  <input type="text" class="form-control"  placeholder="Enter Costumer Name">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Contact</label>
                  <input type="text" class="form-control"  placeholder="Enter Costumer Contact">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Address</label>
                  <input type="text" class="form-control"  placeholder="Enter Costumer Address">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Facebook Account</label>
                  <input type="text" class="form-control"  placeholder="Enter Costumer Facebook Account">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Username</label>
                  <input type="text" class="form-control"  placeholder="Enter Costumer Username">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" placeholder="Enter Costumer Password">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Status</label>
                  <input type="text" class="form-control" placeholder="Enter Costumer Status">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Profile Image</label>
                  <input type="file" id="exampleInputFile">
                </div>
              </div>
          </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
            </form>
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->            </div>
            <!-- /.box-body -->
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
