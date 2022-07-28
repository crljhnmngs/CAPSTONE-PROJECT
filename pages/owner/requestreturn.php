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


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Vehicle Owner - Returned Vehicles</title>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
        <li >
        <a href="rentedvehicles.php">
            <i class="fa fa-cab"></i> <span>Reserved Vehicles</span>
          </a>
        </li>
        <li class="active">
          <a href="requestreturn.php">
            <i class="fa fa-cab"></i> <span>Returned Vehicles</span>
          </a>
        </li>
        <li >
          <a href="rentalschedule.php">
            <i class="fa fa-calendar"></i> <span>Rental Schedule</span>
          </a>
        </li>
        <li >
          <a href="history.php">
            <i class="fa fa-history"></i> <span>Rental History</span>
          </a>
        </li>
        <li >
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
        <i class="fa fa-car"></i> View Returned Vehicles
        <small></small>
      </h1>
    
    </section>
    
    
    <?php
              $sql="SELECT COUNT(*) AS total FROM booking 
              INNER JOIN vehicle ON booking.vehicleid = vehicle.vehicleid  where vehicle.userid = $id AND bookingstatus = 'TO_CONFIRM'";
               $query=$dbh->prepare($sql);
               $query->execute();
               $results=$query->fetchALL(PDO::FETCH_OBJ);
              
               
                 foreach ($results as $result) 
                 {

                  if(htmlentities($result->total) >= 1)
                  {
              ?>
    <!-- Main content -->
    <section class="content" >
      <div class="row" >
        <div class="col-xs-12" >
         
          <div class="box" style="min-height: 78vh;" >
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-cab"></i>Returned Vehicles </h3>
            </div>
            <!-- /.box-header -->
            
            <li class="dropdown user user-menu" style="margin-left:50px;margin-top:20px;list-style:none;display:inline-block;">
            <a href="#" class="dropdown-toggle" style="color:#000;font-size:17px;" data-toggle="dropdown">
            
              <span class="hidden-xs" > Filter  </span><i class="fa-solid fa-caret-down"></i>
              
            </a>
            <ul class="dropdown-menu" style="width:300px; height:350px;">
              
             <!-- /.Filter -->
             <div class="main">
            <form action="" method="GET">
            <div style="display:inline-block;" class="form-group">
           <label class="box-title" style="margin-top:10px;"> Filter by vehicle type: </label>
            <select style="width:200px;"  class="form-control" name="selector" value="<?php if(isset($_GET['selector']))?>" >
            <option value="" disabled selected="" hidden >Select Filter</option>
                    <option>Motorcycle</option>
                    <option >Multicab</option>
                    <option >Sedan</option>
                    <option >Van</option>
                    <option >Mini Van</option>
                    <option >Truck</option>
                    <option >Pickup</option>
                    <option >Bus</option>
                    <option>Mini Bus</option>
                    <option>SUV</option>
                    <option>Hatchback</option>
                
              </select>
              
                  </div>
                  <div class="form-group">
                  <label for="exampleInputEmail1">Start Rate</label>
                  <input type="number" name="start_price" value="<?php if(isset($_GET['start_price'])){echo $_GET['start_price'];}else{ echo "0"; } ?>" class="form-control">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">End Rate</label>
                  <input type="number" name="end_price" value="<?php if(isset($_GET['end_price'])){echo $_GET['end_price'];}else{ echo "9999"; } ?>" class="form-control" >
                </div>
                  <div>
                  <button style="margin-bottom:5px;width:150px; margin-left:25px; "  type="submit" class="btn btn-primary px-4">Filter</button>
                  </div>
              </form>
              <div>
              <a href="requestreturn.php"><button style="margin-bottom:5px;width:150px; "  type="sumbit" name="clear" class="btn btn-primary px-4">Clear Filter</button></a>
                </div>
                 <!-- /.Filter -->

            </ul>
          </li>
         
          <div class="search"  style="display:inline-block;float:right;margin-right: 16px; margin-top:10px;">
          <form action="" method="GET">
          <div class="searchbox" style="display:inline-block;float:right;">
             <input style="width:270px;" type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];} ?>"  placeholder="Search by Vehicle Model or Name or Brand">
          </div>
          </form>       
          </div>
           
              <div  class="card-content" style="display: none"> 
                
              <?php
                   if(isset($_GET['start_price']) && isset($_GET['end_price']) && isset($_GET['selector'])){

                    $selector = $_GET['selector'];
                    $startprice = $_GET['start_price'];
                    $endprice = $_GET['end_price'];
                    
                    $sql= "SELECT * FROM booking 
              INNER JOIN vehicle ON booking.vehicleid = vehicle.vehicleid
              INNER JOIN rentercredentials ON booking.renterid = rentercredentials.renterid
              INNER JOIN user ON rentercredentials.renterid = user.userid
              WHERE vehicle.userid = $id AND booking.bookingstatus =  'TO_CONFIRM' AND  vehicle.rate  BETWEEN $startprice AND $endprice AND vehicle.vehicletype = '".$selector."'";
                    $query=$dbh->prepare($sql);
                    $query->execute();
                    $results=$query->fetchALL(PDO::FETCH_OBJ);
                  }
               else if(isset($_GET['selector']))

                {
                $selector = $_GET['selector'];

                
                $sql= "SELECT * FROM booking 
                INNER JOIN vehicle ON booking.vehicleid = vehicle.vehicleid
                INNER JOIN rentercredentials ON booking.renterid = rentercredentials.renterid
                INNER JOIN user ON rentercredentials.renterid = user.userid
                WHERE vehicle.userid = $id AND booking.bookingstatus =  'TO_CONFIRM' AND vehicle.vehicletype = '".$selector."'";
                $query=$dbh->prepare($sql);
                $query->execute();
                $results=$query->fetchALL(PDO::FETCH_OBJ);
                
                }
                else if(isset($_GET['search']))
                {
                $search = $_GET['search'];

                if($search == null)
                {
                  echo "<script type ='text/javascript'> document.location.href='requestreturn.php' </script>"; 
                }
                else{
                  $sql= "SELECT * FROM booking 
                  INNER JOIN vehicle ON booking.vehicleid = vehicle.vehicleid
                  INNER JOIN rentercredentials ON booking.renterid = rentercredentials.renterid
                  INNER JOIN user ON rentercredentials.renterid = user.userid
                  WHERE vehicle.userid = $id AND booking.bookingstatus =  'TO_CONFIRM' AND  (vehicle.model LIKE '%$search%' OR vehicle.brand LIKE '%$search%' OR vehicle.vehiclename LIKE '%$search%') ";
                $query=$dbh->prepare($sql);
                $query->execute();
                $results=$query->fetchALL(PDO::FETCH_OBJ);
                }
                }

                else if(isset($_GET['start_price']) && isset($_GET['end_price'])){
                  $startprice = $_GET['start_price'];
                  $endprice = $_GET['end_price'];

                  if($startprice != null && $endprice == null )
                  {
                    echo '<script>alert("Please input End Rate!")</script>'; 
                    echo "<script type ='text/javascript'> document.location.href='requestreturn.php' </script>"; 
                  }
                  else if($endprice != null && $startprice == null )
                  {
                    echo '<script>alert("Please input Start Rate!")</script>'; 
                    echo "<script type ='text/javascript'> document.location.href='requestreturn.php' </script>"; 
                  }
                  else if($endprice == null && $startprice == null )
                  {
                    echo '<script>alert("Please Select Filter!")</script>'; 
                    echo "<script type ='text/javascript'> document.location.href='requestreturn.php' </script>"; 
                  }
                  else if($endprice == null || $startprice == null )
                  {
                    echo '<script>alert("Invalid Rate!")</script>'; 
                    echo "<script type ='text/javascript'> document.location.href='requestreturn.php' </script>"; 
                  }
                  else if($endprice < $startprice )
                  {
                    echo '<script>alert("Invalid Rate!")</script>'; 
                    echo "<script type ='text/javascript'> document.location.href='requestreturn.php' </script>"; 
                  }
                  
                  else{

                    $sql= "SELECT * FROM booking 
              INNER JOIN vehicle ON booking.vehicleid = vehicle.vehicleid
              INNER JOIN rentercredentials ON booking.renterid = rentercredentials.renterid
              INNER JOIN user ON rentercredentials.renterid = user.userid
              WHERE vehicle.userid = $id AND booking.bookingstatus =  'TO_CONFIRM' AND vehicle.rate  BETWEEN $startprice AND $endprice ";
                 $query=$dbh->prepare($sql);
                 $query->execute();
                 $results=$query->fetchALL(PDO::FETCH_OBJ);
                  }
                }
              
                else
                {
                  $sql= "SELECT * FROM booking 
              INNER JOIN vehicle ON booking.vehicleid = vehicle.vehicleid
              INNER JOIN rentercredentials ON booking.renterid = rentercredentials.renterid
              INNER JOIN user ON rentercredentials.renterid = user.userid
              WHERE vehicle.userid = $id AND booking.bookingstatus =  'TO_CONFIRM'";
                     $query=$dbh->prepare($sql);
                     $query->execute();
                     $results=$query->fetchALL(PDO::FETCH_OBJ);
                }
                $cnt=1;   
                if ($query->rowCount()<=0) {
                  echo "No Record Found";
                }
                else{
                  foreach ($results as $result) 
                  {
                
              ?>
 <!--cards -->
 
    <div class="card">
        <div class="image2">
        
        <a href="#edit_<?php echo htmlentities($result->bookingid);?>" data-toggle="modal">      
          <img  src="vehicle_images/<?php echo htmlentities($result->vehicleimage);?>">
          </a>
    </div>
    <div class="title"> 
        <p style="margin-top:10px;"> <b>Model:</b> <?php echo htmlentities($result->model);?> </p>
        <p> <b>Brand:</b> <?php echo htmlentities($result->brand);?> </p>
        <p> <b>Rate:</b> Php <?php echo htmlentities(number_format((float)$result->rate, 2, '.', ','));?> </p>
    </div>
    </div>
    <?php include('returninfo.php'); ?>              
<!--cards -->

  <?php } 
    } ?>
       
     </div>
     <div class="paginations">
      <!-- <li class="page-item previous-pages disable"><a class="page-link" href="#">Prev</a></li>
       <li class="page-item current-pages active"><a class="page-link" href="#">1</a></li>
       <li class="page-item dots"><a class="page-link" href="#">...</a></li>
       <li class="page-item current-pages"><a class="page-link" href="#">5</a></li>
       <li class="page-item current-pages"><a class="page-link" href="#">6</a></li>
       <li class="page-item dots"><a clas="page-link" href="#">...</a></li>
       <li class="page-item current-pages"><a class="page-link" href="#">10</a></li>
       <li class="page-item next-pages"><a class="page-link" href="#">Next</a></li> -->
  </div> 
</div> 
            
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      
      <!-- /.row -->
    </section>
    <?php } else {
     ?>
     </section>
      <section class="content" >
      <div class="row" >
        <div class="col-xs-12" >
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-cab"></i> Rented Vehicles </h3>
    
            </div>
            <!-- /.box-header -->
            <div class="main" style="min-height: 65vh;">
              

            <h3 style="text-align:center; margin-top:10%;"> No Data Available <h3>
           
 
     
          </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <?php }
    } ?>
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
<script src="jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- page script -->
<script type="text/javascript">
function getPageList(totalPages, page, maxLength){
  function range(start, end){
    return Array.from(Array(end - start + 1), (_, i) => i + start);
  }

  var sideWidth = maxLength < 9 ? 1 : 2;
  var leftWidth = (maxLength - sideWidth * 2 - 3) >> 1;
  var rightWidth = (maxLength - sideWidth * 2 - 3) >> 1;

  if(totalPages <= maxLength){
    return range(1, totalPages);
  }

  if(page <= maxLength - sideWidth - 1 - rightWidth){
    return range(1, maxLength - sideWidth - 1).concat(0, range(totalPages - sideWidth + 1, totalPages));
  }

  if(page >= totalPages - sideWidth - 1 - rightWidth){
    return range(1, sideWidth).concat(0, range(totalPages- sideWidth - 1 - rightWidth - leftWidth, totalPages));
  }

  return range(1, sideWidth).concat(0, range(page - leftWidth, page + rightWidth), 0, range(totalPages - sideWidth + 1, totalPages));
}

$(function(){
  var numberOfItems = $(".card-content .card").length;
  var limitPerPage = 12; 
  var totalPages = Math.ceil(numberOfItems / limitPerPage);
  var paginationSize = 7; 
  var currentPage;

  function showPage(whichPage){
    if(whichPage < 1 || whichPage > totalPages) return false;

    currentPage = whichPage;

    $(".card-content .card").hide().slice((currentPage - 1) * limitPerPage, currentPage * limitPerPage).show();

    $(".paginations li").slice(1, -1).remove();

    getPageList(totalPages, currentPage, paginationSize).forEach(item => {
      $("<li>").addClass("page-item").addClass(item ? "current-pages" : "dots")
      .toggleClass("active", item === currentPage).append($("<a>").addClass("page-link")
      .attr({href: "javascript:void(0)"}).text(item || "...")).insertBefore(".next-pages");
    });

    $(".previous-pages").toggleClass("disable", currentPage === 1);
    $(".next-pages").toggleClass("disable", currentPage === totalPages);
    return true;
  }

  $(".paginations").append(
    $("<li>").addClass("page-item").addClass("previous-pages").append($("<a>").addClass("page-link").attr({href: "javascript:void(0)"}).text("Prev")),
    $("<li>").addClass("page-item").addClass("next-pages").append($("<a>").addClass("page-link").attr({href: "javascript:void(0)"}).text("Next"))
  );

  $(".card-content").show();
  showPage(1);

  $(document).on("click", ".paginations li.current-pages:not(.active)", function(){
    return showPage(+$(this).text());
  });

  $(".next-pages").on("click", function(){
    return showPage(currentPage + 1);
  });

  $(".previous-pages").on("click", function(){
    return showPage(currentPage - 1);
  });
});
</script>  
</body>
</html>
