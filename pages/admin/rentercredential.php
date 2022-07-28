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
  <title>Admin - Verify Client</title>
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
        <li class="active">
          <a href="rentercredential.php">
            <i class="fa fa-users"></i> <span>Vetify Client</span>
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
        <i class="fa fa-cab"></i> Verify Client
        <small></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-cab"></i> Client</h3>
        <div class="modal fade" id="add">
          <div class="modal-dialog">
            <form role="form">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Car Owner Credential</h4>
              </div>
              <div class="modal-body">
            <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Fill In : </h3>
            </div>
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control"  placeholder="Enter Credential Name">
                </div>
                <div class="form-group">
                  <label>Select Car Owner</label>
                  <select class="form-control">
                    <option>Jericho</option>
                    <option>Data</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">File</label>
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
                 
                  <th style="width: 20%;color:#9A6AFF;";> Client</th>
                  <th style="width: 5%;color:#9A6AFF;"> Age</th>
                  <th style="width: 20%;color:#9A6AFF;"> Address</th>
                  <th style="color:#9A6AFF;"> Contact</th>
                  <th style="color:#9A6AFF;"> Gender</th>
                  <th style="color:#9A6AFF;"> Valid ID</th>
                  <th style="color:#9A6AFF;"> Valid ID</th>
                  <th style="width: 11.8%;color:#9A6AFF;"> Status</th>
                  
                </tr>
                </thead>
                <tbody>
                <?php
                $sql="SELECT * FROM user 
                INNER JOIN rentercredentials ON user.userid = rentercredentials.renterid
                WHERE usertype = 'Renter'";
                $query=$dbh->prepare($sql);
                $query->execute();
                $results=$query->fetchALL(PDO::FETCH_OBJ);

                $cnt=1;   
                if ($query->rowCount()>0) {
                foreach ($results as $result) 
                {


                ?>
                 <form role="form" method="post">
                <tr>

                  <td style="height:70px;"><?php echo htmlentities($result->firstname);?>  <?php echo htmlentities($result->lastname);?></td>
                  <td><?php echo htmlentities($result->age);?></td>
                  <td><?php echo htmlentities($result->address);?></td>
                  <td><?php echo htmlentities($result->contactno);?></td>
                  <td><?php echo htmlentities($result->gender);?></td>
                  <td><a href="../../dist/img/userid/<?php echo htmlentities($result->validid);?>"><?php echo htmlentities($result->validid);?><a></td>
                  <td><a href="../../dist/img/userid/<?php echo htmlentities($result->validid2);?>"><?php echo htmlentities($result->validid2);?><a></td>
                  <?php if(htmlentities($result->accountstatus) == 'PENDING') {?>
                    <td align="center">
                      <a href="verifyuser.php?userid=<?php echo htmlentities($result->userid)?>"><button class="btn btn-success btn-xs" type="submit" name="verify" onclick="return confirm('Verify this Account ?')" style="font-size: 15px;font-weight: 500;">Verify</button></a>
                      <a href="decline1.php?userid=<?php echo htmlentities($result->userid)?>&fileid=<?php echo htmlentities($result->fileid)?>"><button class="btn btn-danger btn-xs" type="submit" name="verify" onclick="return confirm('Decline this Account ?')" style="font-size: 15px;font-weight: 500;margin-top:2px;">Decline</button></a>
                    </td>
                   
                  <?php }else if(htmlentities($result->accountstatus) == 'NOT_VERIFIED') { ?>
                    <td align="center" style="font-size: 15px;font-weight: 500;">No ID Uploaded</td>
                    <?php }else if(htmlentities($result->accountstatus) == 'VERIFIED') { ?>
                    <td align="center" style="font-size: 15px;font-weight: 500;">VERIFIED</td>
                    <?php } ?>
                </tr>
                </form>
                <?php 
                $cnt = 0;
                $cnt=$cnt+1; 
                 }
                 }
                ?>
                </tbody>
                
              </table>
        <div class="modal fade" id="view1">
          <div class="modal-dialog" style="width: 800px">
                       <form role="form">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">View ID</h4>
              </div>
              <div class="modal-body">
            <div class="box box-warning">
            <div class="box-header with-border">
            </div>
              <div class="box-body">
                <div class="form-group">
                  <img  style="width:750px;height:500px" src="../../dist/img/userid/<?php echo htmlentities($result->validid);?>">
                </div>
              </div>
          </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-center" data-dismiss="modal">Close</button>
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
