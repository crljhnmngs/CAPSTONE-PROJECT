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
  <title>Client - View Feedbacks</title>
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
        <li>
          <a href="dashboard.php">
            <i class="fa fa-home"></i> <span>Dashboard</span>
          </a>
        </li>
        <li  class="active">
          <a href="viewvehicles.php">
            <i class="fa fa-cab"></i> <span>View Vehicles</span>
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

    <!-- Main content -->
    <section class="content-header">
      <h1 align="center">
        <i class="fa fa-cab"></i>Vehicle Feedbacks and Rating
        <small></small>
      </h1>
    </section>

    <!-- Main content -->
    
    <!-- Content Header (Page header) -->
    
    <section class="content">
    <div class="row" >
        <div class="col-xs-12">
          <div class="box">
             <div class="box-body">
                
               <?php 
                $vehicleid = $_GET['vehicleid'];

                $sql="SELECT * FROM vehicle
                INNER JOIN user ON vehicle.userid=user.userid
                 WHERE vehicleid = $vehicleid";
                $query=$dbh->prepare($sql);
                $query->execute();
                $results=$query->fetchALL(PDO::FETCH_OBJ);
              
                 
                  foreach ($results as $result) 
                  {
               
               ?>

                <div style="display:flex" >
                <img style="width: 50%; height: 500px; margin-left:20%" align="center" src="../owner/vehicle_images/<?php echo htmlentities($result->vehicleimage);?>">
                  <div class="vehicleinfo" style="display:50%;margin-left:20px"> 
                <div class="form-group">
                  <label for="exampleInputEmail1">Vehicle Model:</label>
                  <h5> <?php echo htmlentities($result->model);?> </h5> 
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Vehicle Brand:</label>
                  <h5> <?php echo htmlentities($result->brand);?> </h5> 
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Capacity:</label>
                  <h5> <?php echo htmlentities($result->capacity);?> Seater </h5> 
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Rate:</label>
                  <h5>  Php <?php echo htmlentities(number_format((float)$result->rate, 2, '.', ','));?>/Day  </h5> 
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Penalty Rate:</label>
                  <h5>  Php <?php echo htmlentities(number_format((float)$result->penaltyrate, 2, '.', ','));?>/Hour  </h5> 
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Vehicle Owner:</label>
                  <h5> <?php echo htmlentities($result->firstname);?> <?php echo htmlentities($result->lastname);?>  </h5> 
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Vehicle Owner Address:</label>
                  <h5>  <?php echo htmlentities($result->address);?>  </h5> 
                </div>
                <?php 
               $sql1="SELECT AVG(rating) as avg_rating FROM feedback WHERE vehicleid = $result->vehicleid";
               $query1=$dbh->prepare($sql1);
               $query1->execute();
               $results1=$query1->fetchALL(PDO::FETCH_OBJ);
               
               
                 foreach ($results1 as $result1) 
                 {
                 
               
               ?>
                <?php if (htmlentities($result1->avg_rating) >= 1  && htmlentities($result1->avg_rating) < 2 ) { ?>

                <div class="form-group">
                  <label for="exampleInputEmail1">Rating:</label>
                  <h5> <?php echo htmlentities(round($result1->avg_rating, 1));?> 
                         <i style=" color: #f9d71c;" class="fa fa-star"></i>
                         <i style=" color: #f9d71c;" class="far fa-star"></i>
                         <i style=" color: #f9d71c;" class="far fa-star"></i>
                         <i style=" color: #f9d71c;" class="far fa-star"></i>
                         <i style=" color: #f9d71c;" class="far fa-star"></i>
                         </h5> 
                </div>

                <?php } else if (htmlentities($result1->avg_rating) >= 2 && htmlentities($result1->avg_rating) < 3 )  {?>

                  <div class="form-group">
                  <label for="exampleInputEmail1">Rating:</label>
                  <h5> <?php echo htmlentities(round($result1->avg_rating, 1));?> 
                         <i style=" color: #f9d71c;" class="fa fa-star"></i>
                         <i style=" color: #f9d71c;" class="fa fa-star"></i>
                         <i style=" color: #f9d71c;" class="far fa-star"></i>
                         <i style=" color: #f9d71c;" class="far fa-star"></i>
                         <i style=" color: #f9d71c;" class="far fa-star"></i>
                         </h5> 
                </div>
                
                <?php } else if (htmlentities($result1->avg_rating) >= 3 && htmlentities($result1->avg_rating) < 4 )  {?>
                
                  <div class="form-group">
                  <label for="exampleInputEmail1">Rating:</label>
                  <h5> <?php echo htmlentities(round($result1->avg_rating, 1));?> 
                         <i style=" color: #f9d71c;" class="fa fa-star"></i>
                         <i style=" color: #f9d71c;" class="fa fa-star"></i>
                         <i style=" color: #f9d71c;" class="fa fa-star"></i>
                         <i style=" color: #f9d71c;" class="far fa-star"></i>
                         <i style=" color: #f9d71c;" class="far fa-star"></i>
                         </h5> 
                </div>
                
                <?php } else if (htmlentities($result1->avg_rating) >= 4 && htmlentities($result1->avg_rating) < 5 ) {?>

                  <div class="form-group">
                  <label for="exampleInputEmail1">Rating:</label>
                  <h5> <?php echo htmlentities(round($result1->avg_rating, 1));?> 
                         <i style=" color: #f9d71c;" class="fa fa-star"></i>
                         <i style=" color: #f9d71c;" class="fa fa-star"></i>
                         <i style=" color: #f9d71c;" class="fa fa-star"></i>
                         <i style=" color: #f9d71c;" class="fa fa-star"></i>
                         <i style=" color: #f9d71c;" class="far fa-star"></i>
                         </h5> 
                </div>

                <?php } else if (htmlentities($result1->avg_rating) >= 5) {?>

                  <div class="form-group">
                  <label for="exampleInputEmail1">Rating:</label>
                  <h5> <?php echo htmlentities(round($result1->avg_rating, 1));?> 
                         <i style=" color: #f9d71c;" class="fa fa-star"></i>
                         <i style=" color: #f9d71c;" class="fa fa-star"></i>
                         <i style=" color: #f9d71c;" class="fa fa-star"></i>
                         <i style=" color: #f9d71c;" class="fa fa-star"></i>
                         <i style=" color: #f9d71c;" class="fa fa-star"></i>
                         </h5> 
                </div>

                <?php } } 
     ?>
                  </div>
                </div>
                <div class="modal-footer">
                <a href="viewvehicles.php"><button style="margin-left:20%;" type="button" class="btn btn-danger pull-left" data-dismiss="modal"> <i class="fa fa-backward"></i>Back</button></a>
                <a style="margin-right:30%;" href="booking.php?vehicleid=<?php echo htmlentities($result->vehicleid)?>&ownerid=<?php echo htmlentities($result->userid)?>&rate=<?php echo htmlentities($result->rate)?>"><button type="submit" class="btn btn-primary">Book</button></a>
              </div>
          </div>
            
          <?php 
          } 
     ?>

                <?php 
                $vehicleid = $_GET['vehicleid'];

                $sql="SELECT * FROM feedback
                INNER JOIN user on feedback.renterid = user.userid 
                 WHERE vehicleid = $vehicleid";
                $query=$dbh->prepare($sql);
                $query->execute();
                $results=$query->fetchALL(PDO::FETCH_OBJ);
              
                if ($query->rowCount()>0) {
                  foreach ($results as $result) 
                  {
               
               ?>
              <div class="feedback-box-container">
                <!--- BOX -->
                <div class="feedback-box">
                    <!--- TOP -->
                  <div class="box-top">

                      <!--- Profile -->
                      <div class="profile">
                         <!--- Img -->
                         <div class="profile-img">
                           <img src="../../dist/img/userimage/<?php echo htmlentities($result->image)?>" />
                         </div>
                          <!--- Renter Name -->
                          <?php if(htmlentities($result->renterid)  != $id) {?>
                          <div class="name-renter">
                            <strong> <?php echo htmlentities($result->firstname)?> <?php echo htmlentities($result->lastname)?>  </strong>
                            <span> <?php echo htmlentities(date("F d, Y", strtotime($result->date)))?> </span>
                          </div>
                          <?php } else { ?>
                            <div class="name-renter">
                            <strong> <?php echo htmlentities($result->firstname)?> <?php echo htmlentities($result->lastname)?> (You)</strong>
                            <span> <?php echo htmlentities(date("F d, Y", strtotime($result->date)))?> </span>
                          </div>
                          <?php }  ?>
                      </div>
                       <!--- Reviews -->
                       <?php if(htmlentities($result->rating) == '1') {?>
                       <div class="reviews">
                         <i class="fa fa-star"></i>
                         <i class="far fa-star"></i>
                         <i class="far fa-star"></i>
                         <i class="far fa-star"></i>
                         <i class="far fa-star"></i>
                       </div>
                       <?php } else if(htmlentities($result->rating) == '2') {?>
                        <div class="reviews">
                         <i class="fa fa-star"></i>
                         <i class="fa fa-star"></i>
                         <i class="far fa-star"></i>
                         <i class="far fa-star"></i>
                         <i class="far fa-star"></i>
                       </div>
                       <?php } else if(htmlentities($result->rating) == '3') {?>
                        <div class="reviews">
                         <i class="fa fa-star"></i>
                         <i class="fa fa-star"></i>
                         <i class="fa fa-star"></i>
                         <i class="far fa-star"></i>
                         <i class="far fa-star"></i>
                       </div>
                       <?php } else if(htmlentities($result->rating) == '4') {?>
                        <div class="reviews">
                         <i class="fa fa-star"></i>
                         <i class="fa fa-star"></i>
                         <i class="fa fa-star"></i>
                         <i class="fa fa-star"></i>
                         <i class="far fa-star"></i>
                       </div>
                       <?php } else if(htmlentities($result->rating) == '5') {?>
                        <div class="reviews">
                         <i class="fa fa-star"></i>
                         <i class="fa fa-star"></i>
                         <i class="fa fa-star"></i>
                         <i class="fa fa-star"></i>
                         <i class="fa fa-star"></i>
                       </div>
                        <?php } ?>
                  </div>
                  <div class="renter-comments">
                    <p> <?php echo htmlentities($result->comment)?> </p>
                  </div>
                </div>
              </div> 
              <?php 
          } 
        }
        else {
     ?>
               <div class="feedback-box-container" >
                <!--- BOX -->
                <div class="feedback-box" style="height:100px;">
                   
                  <div class="renter-comments">
                    <p style="text-align:center; font-size:15px; font-weight:bold;"> No feedback </p>
                 </div>
                </div>
              </div> 
     <?php } ?>
    </div>
    </div>
    </div>
   
    </section>    
    <!-- /.content -->
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
