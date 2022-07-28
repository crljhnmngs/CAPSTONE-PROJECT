<?php

session_start();
include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\config.php');    
    date_default_timezone_set('Asia/Singapore');
    $currentdate = date("Y-m-d");
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
      $date1 = new DateTime($currentdate);
      $date2 = new DateTime($returndate);
      $interval = $date1->diff($date2);
      $penalty = $interval->days;

      if($returndate < $currentdate)
      {
        $sql = "UPDATE booking SET penalty = $penalty WHERE bookingid = $bookingid";
        $query = $dbh->prepare($sql);
        $query->execute();
      }
    }
if(!isset($_SESSION['userid']))
  {
    echo "<script type ='text/javascript'> document.location.href='../login.php' </script>"; 
  } 
  else
  {
    date_default_timezone_set('Asia/Singapore');
    $username=$_SESSION['firstname']." ".$_SESSION['lastname'];
    $id = $_SESSION['userid'];
    $latitude = $_SESSION['latitude'];
    $longitude = $_SESSION['longitude'];
    $lat=($_GET['latitude']);
    $long=($_GET['longitude']);
    $currentdatetime = strtotime(date('y-m-d h:i:s'));
    $date = date('y-m-d h:i:s');
    
    $sql="SELECT * FROM booking
    INNER JOIN vehicle ON booking.vehicleid=vehicle.vehicleid
    INNER JOIN user ON vehicle.userid=user.userid
    WHERE booking.bookingstatus = 'PENDING'";
    $query=$dbh->prepare($sql);
    $query->execute();
    $results=$query->fetchALL(PDO::FETCH_OBJ);
    foreach ($results as $result) 
    {
      $oldDate = strtotime(date(htmlentities($result->datetime))) + 86400;
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

       $sql3 = "INSERT INTO notification(receiverid,message,date)VALUES($userid,'Your vehicle booking is automatically canceled', '$date')";
       $query3 = $dbh->prepare($sql3);  
       $query3->execute();

       $sql4 = "INSERT INTO notification(receiverid,message,date)VALUES($renterid,'Your vehicle booking is automatically canceled', '$date')";
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
  <title>WeLift</title>
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
        <li  class="active">
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
    <section class="content-header">
      <h1 align="center">
        <i class="fa fa-map"></i> Map
        <small></small>
      </h1>
    </section>
  
    <!-- Main content -->
    <section class="content" style="width:100%;height:100%; margin-left:80px;display:flex;flex-flow: column;
">
    <div class="mapouter" style="display:flex;">
             <div class="gmap_canvas" style="display:flex;">
               <iframe style="flex: 1 1 auto;border: 0;"  width="1000" height="700" id="gmap_canvas" src="https://maps.google.com/maps?q=<?php echo $lat?>, <?php echo $long?> & <?php echo $latitude?>, <?php echo $longitude?>&output=embed" 
                frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>

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
<script>
      var customLabel = {
        restaurant: {
          label: 'R'
        },
        bar: {
          label: 'B'
        }
      };

        function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(-33.863276, 151.207977),
          zoom: 12
        });
        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          downloadUrl('http://localhost/welift/pages/renter/xml.php', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var id = markerElem.getAttribute('id');
              var name = markerElem.getAttribute('name');
              var address = markerElem.getAttribute('address');
              var type = markerElem.getAttribute('type');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = address
              infowincontent.appendChild(text);
              var icon = customLabel[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label
              });
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
          });
        }



      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          } 
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}
    </script>
<script
      src="https://maps.googleapis.com/maps/api/js?key='AIzaSyB4w20tk94WqtTBSoDw45yga_r2dcxoxTk'"
      defer
    ></script>
</body>
</html>
