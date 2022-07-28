

<header class="main-header">
    <!-- Logo -->
    <a href="dashboard.php" class="logo" style="background-color:#fff; border:1px #333333 solid; ">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b><img src="../../dist/img/logo/logo.png" style="width: 60px;height: 60px;margin-top:-10px;"></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lgasda"><b><img src="../../dist/img/logo/logo.png" style="width: 60px;height: 60px;margin-top:-10px;margin-left:-40px;margin-right:10px;"> We</b>Lift</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <form class="readnotifs">
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
        
        <li class="nav-item dropdown">
        
        <a class="nav-link" data-toggle="dropdown" type="submit"  href="#">
        
          <i class="fa fa-bell"></i>
          
          <?php
                 $sql="SELECT COUNT(*) AS total FROM notification where receiverid = $id AND status = 'unread'";
                 $query=$dbh->prepare($sql);
                 $query->execute();
                 $results=$query->fetchALL(PDO::FETCH_OBJ);
                 $cnt=1;   
                   foreach ($results as $result) 
                   {
                     
                 ?>
               
          <span class="badge badge-danger navbar-badge" id="unreadcount"><?php echo htmlentities($result->total);?></span>
         
        </a>
        <?php }   ?>
      
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right"  id="notifdropdown">
        <?php
               $sql="SELECT COUNT(*) AS total FROM notification where receiverid = $id";
               $query=$dbh->prepare($sql);
               $query->execute();
               $results=$query->fetchALL(PDO::FETCH_OBJ);
               $cnt=1;   
                 foreach ($results as $result) 
                 {
           ?>
          <span class="dropdown-item dropdown-header" id="notifcount"><?php echo htmlentities($result->total);?> Notifications</span>
          <?php }  ?>
          <div class="dropdown-divider"></div>
          
          <?php
               $sql="SELECT * FROM notification where receiverid = $id";
               $query=$dbh->prepare($sql);
               $query->execute();
               $results=$query->fetchALL(PDO::FETCH_OBJ);
               $cnt=1;   
                 foreach ($results as $result) 
                 {
           ?>
          <div class="notifbox" id="message">

         </div>
          <?php }  ?>
          </form>
          <form class="deletenotifs">
          <a class="clearnotif dropdown-item dropdown-footer" style="cursor:pointer;">Clear All Notifications</a>
          </form>
          
        </div>
      </li>
      
      <!-- Notif End -->
      <?php
                $id = $_SESSION['userid'];
                $sql="SELECT * FROM user where userid = $id";
                $query=$dbh->prepare($sql);
                $query->execute();
                $results=$query->fetchALL(PDO::FETCH_OBJ);
              
                $cnt=1;   
                if ($query->rowCount()>0) {
                  # code...
                  foreach ($results as $result) 
                  {
                
              ?>
         <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../../dist/img/userimage/<?php echo htmlentities($result->image);?>" class="user-image" alt="User Image">
              <span class="hidden-xs">  <?php echo htmlentities($result->firstname);?> <?php echo htmlentities($result->lastname);?> </span>
            </a>
            <ul class="dropdown-menu" style="width:190px;">
              <!-- User image -->
              
              <li class="user-footer" >
                <div class="pull-center"  >
              <a class="btn btn-danger" style="width: 100%; " href="../logout.php"><i class="fa fa-sign-out"></i> Log out</a>                
            </div>
              </li>

            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../../dist/img/userimage/<?php echo htmlentities($result->image);?>" style="max-width:50px;height:50px" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p> <?php echo htmlentities($result->firstname);?> <?php echo htmlentities($result->lastname);?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Admin</a>
        </div>
      </div> 
      <?php } 
                    } ?>
      <!-- sidebar menu: : style can be found in sidebar.less -->
 <script type="text/javascript">

function loadDoc() {
  setInterval(function(){
    var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("unreadcount").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "../notifs/unreadcount.php", true);
  xhttp.send();
  }, 1000);
}
loadDoc();

function loadDoc2() {
  setInterval(function(){
    var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("notifcount").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "../notifs/notifcount.php", true);
  xhttp.send();
  }, 1000);
}
loadDoc2();

function loadDoc3() {
  setInterval(function(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("message").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "../notifs/getmessage.php", true);
  xhttp.send();
  }, 1000);
}
loadDoc3();

document.getElementById("message").setAttribute("style","overflow:auto;width:300px;max-height:450px");


</script>
<script src="../../dist/js/notif.js"></script>  
<script src="../../dist/js/deletenotif.js"></script>  
<script src="jquery.min.js" type="text/javascript"></script>
<script src="jquery.timeago.js" type="text/javascript"></script>



