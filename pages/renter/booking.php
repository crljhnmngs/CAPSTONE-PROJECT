<?php
session_start();
include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\config.php');    


if(!isset($_SESSION['userid']))
  {
    echo "<script type ='text/javascript'> document.location.href='../login.php' </script>"; 
  }
  else if(!isset($_GET['vehicleid']))
  {
    echo "<script type ='text/javascript'> document.location.href='dashboard.php' </script>"; 
  } 
  else{
    $username=$_SESSION['firstname']."  ".$_SESSION['lastname'];
    $id = $_SESSION['userid'];
  }  
 
  if (isset($_POST['submit'])) {

    if(isset($_POST['manpower']) && $_POST['manpower']!="")
    {
    date_default_timezone_set('Asia/Singapore');
    $currentdate = date("Y-m-d");
    $vehicleid=intval($_GET['vehicleid']);
    $ownerid=intval($_GET['ownerid']);
    $rate=($_GET['rate']);
    $bookingdate=($_POST['bookingdate']);
    $returndate=($_POST['returndate']);
    $pickuptime=($_POST['pickuptime']);
    $purpose=($_POST['purpose']);
    $otherpurpose=($_POST['otherpurpose']);
    $manpower=($_POST['manpower']);
    $rentername=($_POST['rentername']);
    $vehiclename=($_POST['vehiclename']);
    $date = date('y-m-d H:i:s');
    $mp="";
    $newpurpose="";
    $date1 = new DateTime($bookingdate);
    $date2 = new DateTime($returndate);
    $interval = $date1->diff($date2);
    if($interval->days < 1)
    {
      $total = $rate * 1;
    }
    else
    {
      $total = $interval->days * $rate;
    }
   
    
  
   

    if($purpose != 'Other')
    {
      $newpurpose = $purpose;
    }
    else if($purpose == 'Other')
    {
      $newpurpose = $otherpurpose;
    }
    foreach($manpower as $mp1)  
    { 
     
        $mp .= $mp1.",";
  
    }
    if($bookingdate <= $currentdate)
    {
      echo '<script>alert("Invalid Booking Date")</script>';
    }
    else if($returndate < $bookingdate)
    {
      echo '<script>alert("Invalid Return Date")</script>';
    }
    else{
    $sql = "INSERT INTO booking(vehicleid,renterid,bookingdate,returndate,pickuptime,datetime,total,purpose,manpower,bookingstatus)VALUES($vehicleid,$id,:bookingdate,:returndate,:pickuptime,'$date',$total,'$newpurpose','$mp','PENDING')";
    $query = $dbh->prepare($sql);
    $query->bindParam(':bookingdate',$bookingdate,PDO::PARAM_STR);
    $query->bindParam(':returndate',$returndate,PDO::PARAM_STR);
    $query->bindParam(':pickuptime',$pickuptime,PDO::PARAM_STR);
    
    $query->execute();

    //$sql2 = "UPDATE vehicle SET status = 'PENDING' WHERE vehicleid = $vehicleid";
    //$query2 = $dbh->prepare($sql2);
    //$query2->execute();
    
    
    $sql3 = "INSERT INTO notification(receiverid,message,header,date)VALUES($ownerid,'$rentername is requesting to book your vehicle named $vehiclename', 'booking', '$date')";
    $query3 = $dbh->prepare($sql3);  
    $query3->execute();

    echo '<script>alert("Booked Successfully! Just wait for the vehicle owner to respond  ")</script>'; 
   echo "<script type ='text/javascript'> document.location.href='viewvehicles.php' </script>"; 
    }
  }
else{

  date_default_timezone_set('Asia/Singapore');
    $currentdate = date("Y-m-d");
    $vehicleid=intval($_GET['vehicleid']);
    $ownerid=intval($_GET['ownerid']);
    $rate=($_GET['rate']);
    $bookingdate=($_POST['bookingdate']);
    $returndate=($_POST['returndate']);
    $pickuptime=($_POST['pickuptime']);
    $purpose=($_POST['purpose']);
    $otherpurpose=($_POST['otherpurpose']);
    $rentername=($_POST['rentername']);
    $vehiclename=($_POST['vehiclename']);
    $date = date('y-m-d H:i:s');
    $newpurpose="";
    $date1 = new DateTime($bookingdate);
    $date2 = new DateTime($returndate);
    $interval = $date1->diff($date2);
    if($interval->days < 1)
    {
      $total = $rate * 1;
    }
    else
    {
      $total = $interval->days * $rate;
    }
    
    
    if($purpose != 'Other')
    {
      $newpurpose = $purpose;
    }
    else if($purpose == 'Other')
    {
      $newpurpose = $otherpurpose;
    }
    if($bookingdate <= $currentdate)
    {
      echo '<script>alert("Invalid Booking Date")</script>';
    }
    else if($bookingdate > $returndate)
   {
      echo '<script>alert("Invalid Return Date")</script>';
    }
    else{
    
      $sql = "INSERT INTO booking(vehicleid,renterid,bookingdate,returndate,pickuptime,datetime,total,purpose,manpower,bookingstatus)VALUES($vehicleid,$id,:bookingdate,:returndate,:pickuptime,'$date',$total,'$newpurpose','N/A','PENDING')";
    $query = $dbh->prepare($sql);
    $query->bindParam(':bookingdate',$bookingdate,PDO::PARAM_STR);
    $query->bindParam(':returndate',$returndate,PDO::PARAM_STR);
    $query->bindParam(':pickuptime',$pickuptime,PDO::PARAM_STR);
    $query->execute();

    //$sql2 = "UPDATE vehicle SET status = 'PENDING' WHERE vehicleid = $vehicleid";
    //$query2 = $dbh->prepare($sql2);
    //$query2->execute();
    
                
    $sql3 = "INSERT INTO notification(receiverid,message,header,date)VALUES($ownerid,'$rentername is requesting to book your vehicle named $vehiclename', 'booking', '$date')";
    $query3 = $dbh->prepare($sql3);  
    $query3->execute();

    echo '<script>alert("Booked Successfully! Just wait for the vehicle owner to respond ")</script>'; 
   echo "<script type ='text/javascript'> document.location.href='viewvehicles.php' </script>"; 
    }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Client - Book Vehicle</title>
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<?php  include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\renterheader.php');      ?>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Navigation Forms</li>
        <li >
          <a href="dashboard.php">
            <i class="fa fa-home"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="active">
          <a href="viewvehicles.php">
            <i class="fa fa-cab"></i> <span>View Vehicles</span>
          </a>
        </li>
        <li >
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
        <i class="fa fa-car"></i> Book Vehicle
        <small></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <form role="form" method="post">
            <div class="modal-content">
              <div class="modal-header"><a href="viewvehicles.php"><button type="button" class="btn btn-danger btn-sm" >
               <i class="fa fa-backward"></i> Back
              </button></a>
              <a href="viewvehicles.php"><button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
                  <span aria-hidden="true">&times;</span></button> </a>
              </div>
              <div class="modal-body">
            <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Fill In : </h3>
            </div>
              <div class="box-body">
              <div class="form-group">
                  <label for="exampleInputEmail1">Rental Date</label>
                  <input type="date" class="form-control" required name="bookingdate">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Return Date</label>
                  <input type="date" class="form-control" required name="returndate"> 
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Pick up time</label>
                  <input type="time" class="form-control" required name="pickuptime"> 
                </div>
                <div class="form-group">
                  <label>Purpose</label>
                  <select class="form-control" required name="purpose" id="choose">
                  <option value="" disabled selected>Select your option</option>
                    <option >Moving Things</option>
                    <option>Outing</option>
                    <option value="Other">Others</option>
                  </select>
                </div>

                <div class="form-group" id="otherpurpose" style="display:none;">
                  <label for="exampleInputEmail1" >Specify Others</label>
                  <input type="text" id="textfield" class="form-control" name="otherpurpose"> 
                  </div>

                <?php 
                 $sql4 = "SELECT * FROM user WHERE userid = $id";
                 $query4 = $dbh->prepare($sql4);
                 $query4->execute();
                 $results=$query4->fetchALL(PDO::FETCH_OBJ);
                 foreach ($results as $result) 
                  {
                ?>
                <input type="hidden" class="form-control" value="<?php echo htmlentities($result->firstname);?> <?php echo htmlentities($result->lastname);?>" required name="rentername"> 
                 <?php } ?>   
                 <?php 
                 $vehicleid=intval($_GET['vehicleid']);
                 $sql5 = "SELECT * FROM vehicle WHERE vehicleid = $vehicleid";
                 $query5 = $dbh->prepare($sql5);
                 $query5->execute();
                 $results=$query5->fetchALL(PDO::FETCH_OBJ);
                 foreach ($results as $result) 
                  {
                ?>
                <input type="hidden" class="form-control" value="<?php echo htmlentities($result->vehiclename);?>" required name="vehiclename"> 
                 <?php } ?>   
                <div class="form-group">
                <label for="exampleInputEmail1">Manpower(Optional)</label>
                <br>
                <input type="checkbox"  name="manpower[]" value="Driver" style="border:20px;"> 
                  <label style=" font-weight: normal;">Driver</label>
                  <br>
                  <input type="checkbox"  name="manpower[]" value="Helper"> 
                  <label style=" font-weight: normal;" >Helper</label>
                </div>
            <div style="display:block;">
          <input type="checkbox" id="slk" name="terms" required> 
          I agree to the <a data-toggle="modal" data-target="#myModal" style="cursor:pointer;">  Vehicle Rental Agreement </a>
          </div>
          </div>
              </div>
              <div class="modal-footer">
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

  <!-- Modal -->
              <?php 
                 $vehicleid=intval($_GET['vehicleid']);
                 $sql7 = "SELECT * FROM vehicle WHERE vehicleid = $vehicleid";
                 $query7 = $dbh->prepare($sql7);
                 $query7->execute();
                 $results=$query7->fetchALL(PDO::FETCH_OBJ);
                 foreach ($results as $result) 
                  {
                ?>
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" role="document" style="width:60%;max-height:80%;overflow:scroll;" >
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">WeLift: A Web-based Vehicle Rental Management System Agreement</h4>
      </div>
      
      <div class="modal-body" >
        <p style="text-align:center;"> <b>The Parties Hereby mutually agree as follows:</b> </p>
        

        <h5> <b>1.	DESCRIPTION OF THE VEHICLE:</b> </h5>
        <p style="text-align: justify;text-justify: inter-word;"> <b>Model:</b> <u><?php echo htmlentities($result->model);?></u>  </p>
        <p style="text-align: justify;text-justify: inter-word;"> <b>Brand:</b> <u><?php echo htmlentities($result->brand);?></u>  </p>
        <p style="text-align: justify;text-justify: inter-word;"> <b>Color:</b> <u><?php echo htmlentities($result->color);?></u>  </p>
        <p style="text-align: justify;text-justify: inter-word;"> <b>Plate number:</b> <u><?php echo htmlentities($result->platenumber);?></u>  </p> 

        <h5> <b>2.</b>	Any excess hours used shall be charged a rate of <b><u><?php echo htmlentities($result->penaltyrate);?></u></b>  per hour. </h5>
      
        <h5><b>3.</b>	If a client requests manpower services, there will be additional charges it depends on the vehicle owner If how much the charged. </h5>
       
        <h5> <b>4. </b> Physical damage or property damage shall be for the sole liability of the client.  </h5>

        <h5> <b>5.</b> 	<b>DAMAGE, DESTRUCTION, OR LOSS OF VEHICLE:</b> The client will be financially responsible if the vehicle is damaged, destroyed, stolen, abandoned, or taken by any judicial or governmental authority during the term of this contract. </h5>
         

        <h5> <b>6.	USE OF VEHICLE: The client agrees that client will not</b> </h5>
        <p style="text-align: justify;text-justify: inter-word;margin-left:20px;"> <b>a.</b> Use the vehicle to carry any passenger other than client; </p>
        <p style="text-align: justify;text-justify: inter-word;margin-left:20px;"> <b>b.</b> Allow any other person to operate the vehicle </p> 
        <p style="text-align: justify;text-justify: inter-word;margin-left:20px;"> <b>c.</b> Operate the vehicle in violation of any laws or an illegal purpose and that if client does, Client Is responsible for all associated, tickets, fines, and fees; </p> 
        <p style="text-align: justify;text-justify: inter-word;margin-left:20px;"> <b>d.</b> Operate the vehicle in a negligent manner; </p>
        <p style="text-align: justify;text-justify: inter-word;margin-left:20px;"> <b>e.</b> Use the vehicle for any race or competition. </p>

        <h5> <b>7.</b> The vehicle owner represents that to the best of his knowledge and belief that the vehicle is in sound and safe condition and free of any known faults or defects that would affect its safe operation under normal use. </h5>

        <h5> <b>8.</b> 	The client should be responsible for fuel consumption and should be returned in the same condition.  </h5>
       
        <h5> <b>9.	MAINTENANCE AND REPAIRS: </b> Client agrees to maintain the property in good working condition and not to misuse or abuse it. </h5>
        
        <h5> <b>10.</b> WeLift shall not or under any circumstances be liable for any damages or injuries to persons or property suffered or sustained in the use, condition, or operation of the property and all such claims are specifically waived by clients. </h5>

      
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="checkSlk" data-dismiss="modal" class="btn btn-primary">Agree</button>
      </div>
    </div>
  </div>
  </div>
  <?php } ?>  
  <!-- Modal -->

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
$(document).ready(function() {
    $("#choose").on("change", function() {
        if ($(this).val() === "Other") {
            $("#otherpurpose").show();
            $("#textfield").attr('required', true);
        }
        else {
            $("#otherpurpose").hide();
            $("#textfield").attr('required', false);
        }
    });
});
</script>

<script>
  $('#myModal').on('shown.bs.modal', function () {  
  $('#myInput').focus()
})
</script>     
<script type="text/javascript">
    $(function () {
        $("#checkSlk").on("click", function () {
            if ($("#slk").is(':checked')) {
                $("#slk").attr("checked", false);
            } else {
                $("#slk").attr("checked", true);
            }
        });
    });
</script>
</body>
</html>
