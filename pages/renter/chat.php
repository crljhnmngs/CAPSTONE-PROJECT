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
  <title>Client - Chat</title>
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <link rel="stylesheet" href="../../dist/css/chat.css">
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
        <li >
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
        <li  class="active">
          <a href="chat.php" class="remove">
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
    <section class="chatsection">
        <div class="container-fluid">
            <div class="row no-glutters">
                <!-- chat list column -->
                <div class="col-md-4 text-light" style="height:550px; width: 350px; ">
                    <div class="name py-3 text-center">
                        <h5>Chats</h5>
                    </div>
                    <div class="row justify-content-center align-items-center pb-4 d-flex">
                    <form action="" method="GET">
                        <div class="col-12 input-group-sm px-4">
                            <input class="form-control rounded-pill shadow-none" type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];} ?>" placeholder="Search Vehicle Owner" aria-describedby="inputGroup-sizing-sm">
                        </div>
                        </form>       
                    </div> 
                    
                        <?php

                      if(isset($_GET['search']))
                      {
                      $search = $_GET['search'];

                      if($search == null)
                      {
                     echo "<script type ='text/javascript'> document.location.href='chat.php' </script>"; 
                      }
                      else
                      {
                        $sql="SELECT * FROM message
                        INNER JOIN ownercredentials ON message.receiverid = ownercredentials.ownerid OR message.senderid = ownercredentials.ownerid
                        INNER JOIN user ON ownercredentials.ownerid = user.userid WHERE (user.firstname LIKE '%$search%' OR user.lastname LIKE '%$search%') AND (message.senderid = $id OR message.receiverid = $id)   GROUP BY ownercredentials.ownerid";
                        $query=$dbh->prepare($sql);
                        $query->execute(); 
                        $results=$query->fetchALL(PDO::FETCH_OBJ);  
                      
                        }
                      }
                      else
                       {
                    
                            $sql="SELECT * FROM message
                            INNER JOIN ownercredentials ON message.receiverid = ownercredentials.ownerid OR message.senderid = ownercredentials.ownerid
                            INNER JOIN user ON ownercredentials.ownerid = user.userid WHERE message.senderid = $id OR message.receiverid = $id  GROUP BY ownercredentials.ownerid";
                            $query=$dbh->prepare($sql);
                            $query->execute(); 
                            $results=$query->fetchALL(PDO::FETCH_OBJ);
                       }   
                       $cnt=1;   
                       if ($query->rowCount()<=0) {
                        
                         echo "No Record Found";
                         
                       }
                       else
                       {
                         foreach ($results as $result) 
                         {
                        ?>
                        
                        <form method="POST">
                        <div class="row px-2">
                            <button  type="submit" name="submit" value="submit" class="btn" onclick="myFunction()">
                                <div class="row py-2 px-2">
                                    <div class="col-md-2">
                                    <img src="../../dist/img/userimage/<?php echo htmlentities($result->image);?>" class="img-circle" alt="User Image" style="height:50px; width:50px;">
                                    </div>
                                    <input type="hidden" name="receiverid" value="<?php echo htmlentities($result->ownerid)?>">
                                    <div class="col-md-10 text-start" style="margin-left:-35px">  
                                        <h6 style="color:#FBFBF9"><?php echo htmlentities($result->firstname);?> <?php echo htmlentities($result->lastname);?></h6> 
                                    </div>
                                </div>
                            </button>
                        </div>
                        </form>
                        <?php }}  ?>
                </div>

                             
       


                <!-- chat column -->
               
                <div class="col-md-8" style="background:#f8f8f8; width: 700px;"  id="boang" >
                    <div class="col">
                        <div class="row bg-blue py-1 text-dark align-items-center"  style="width: 700px;">
                            <div class="col-md-2" style="width:50px;margin-top:10px;">
                            <button class="btn2" style="background-color:red; border: none; width:30px; height:30px; "><i class="fa fa-mail-reply"></i></button>
                            
                            </div>
                            <div class="col-md-9">
                                <?php
                                    if(isset($_POST['submit'])){
                                        $connection = mysqli_connect("localhost", "root", "");
                                        $db = mysqli_select_db($connection, 'welift');
                                        $receiverid = $_POST['receiverid'];
                                        $sql1="SELECT * from ownercredentials 
                                        INNER JOIN user ON ownercredentials.ownerid = user.userid
                                        WHERE ownercredentials.ownerid=$receiverid";
                                       $query_run = mysqli_query($connection, $sql1);
                                       while($row = mysqli_fetch_array($query_run)){
                                         
                                    ?>
                                    <div style="display: inline-block;">
                                <img src="../../dist/img/userimage/<?php echo $row['image']?>" class="img-circle" alt="User Image" style="height:45px;width:45px;display: inline-block; margin-bottom:5px; ">
                                <h5 style="margin-right:-100px;display: inline-block;"><?php echo $row['firstname']?> <?php echo $row['lastname']?></h5>
                                <input type="hidden" id="textfield" class="form-control" value="<?php echo $row['ownerid']?>" name="testid"> 
                                       </div>
                                <?php 

                                    $receiverid = $row['ownerid'];
                                }}?>
                                
                            </div>
                        </div>
                        <div class="row text-dark" >
                            <div class="col-sm-12 chatBox" style="height: 450px; overflow-y: auto; ">

                                
                           
                                <!-- <?php
                                 if(isset($_POST['submit']))
                                 {
                         
                                        $connection = mysqli_connect("localhost", "root", "");
                                        $db = mysqli_select_db($connection, 'welift');
                                        $receiverid = $_POST['receiverid'];
                                        $sql1="SELECT * from ownercredentials 
                                        INNER JOIN user ON ownercredentials.ownerid = user.userid
                                        WHERE ownercredentials.ownerid= '$receiverid'";
                                        $query_run = mysqli_query($connection, $sql1);
                                        while($row = mysqli_fetch_array($query_run)){
                                          
                                    ?>
                                    
                                    <input type="text" required name="receiverid" value="<?php echo $row['ownerid']?>">
                                    
                                    <?php
                                    if(isset($row['receiverid'])){
                                        $senderid = mysqli_real_escape_string($connection, $_SESSION['userid']);
                                        $receiverid = mysqli_real_escape_string($connection, $_POST['ownerid']);
                                       
                                        
                                        $sql3 = "SELECT * FROM message WHERE (senderid = {$senderid} AND receiverid = {$receiverid}) ORDER BY messageid ASC";
                                        $query3 = mysqli_query($connection, $sql3);
                                        if(mysqli_num_rows($query3) > 0){
                                            while($row = mysqli_fetch_assoc($query3)){
                                              if($row['senderid'] == $senderid){ 
                                                ?>
                                                    <div class=" text-dark m-3 justify-content-end text-end">
                                                        <p  class=" d-inline-block bg-white py-2 px-4 rounded-pill"><?php echo $row['message'];?></p>
                                                    </div>
                                                <?php
                                                }else if($row['receiverid'] == $receiverid){  
                                                ?>
                                                    <div class=" text-light m-3">
                                                        <p  class=" d-inline-block py-2 px-4 rounded-pill" style="background-color: #302D32;"><?php echo $row['message'];?></p>
                                                    </div>
                                                <?php
                                                }
                                                
                                            }
                                        }
                                    }
                                   }
                                 }
                                
                                ?> -->
                            </div>
                        </div>
                        <div class="row pt-2" style="background: #302D32">
                            <form class="typing-area">
                                <div class="input-group pb-2">
                                    <div class="col-sm-11">
                                    <input type="hidden" required class="receiverid" name="receiverid" value="<?php echo $receiverid ?>">
                                    <input type="text" name="message" placeholder="Type message here..." class="form-control rounded-pill shadow-none border-0 input-field1" style="margin-left:-15px;height:45px;" required>
                                    </div>
                                    <button class="btn1 fa-solid fa-paper-plane col-sm-1" type="submit" name="send" style="color: #F8F8F8; border: none; background-color: #302D32; margin-top:15px; float:left; margin-left:-15px;"></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                              
        </div>
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
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
<script src="../../dist/js/renter-chat.js"></script>  

<script >
   let btn = document.querySelector("button.btn2");
          let div = document.querySelector("div.col-md-8");

          btn.addEventListener("click", () => {
        
           if (div.style.display === "none" ) 
           {
            div.style.display = "block";
           } 
            else {
           div.style.display = "none";
           }
          });
  </script>



<script>

         

         
          let btn1 = document.querySelector("button.btn");
          btn1.addEventListener("click", () => 
          {
            $("#boang").show();
          });


</script>












    
</body>
</html>
