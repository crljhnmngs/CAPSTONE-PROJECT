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
    $userid=($_POST['userid']);
    $firstname=($_POST['firstname']);
    $lastname=($_POST['lastname']);
    $age=($_POST['age']);
    $contactno=($_POST['contactno']);
    $address=($_POST['address']);
    $email=($_POST['email']);
    $oldemail=($_POST['oldemail']);
    $password=($_POST['password']);
    $gender=($_POST['gender']);
    $usertype=($_POST['usertype']);
    $image=($_POST['image']);
    $updateid=($_POST['updateid']);
    $accountstatus=($_POST['accountstatus']);
    if($age < 18)
        {
          echo '<script>alert("Invalid Age")</script>'; 
        }
    else if($oldemail == $email)
    {
    $sql = "UPDATE user SET userid=:userid, firstname=:firstname,lastname=:lastname,age=:age,contactno=:contactno,address=:address,email=:email,password=:password,
            gender=:gender,usertype=:usertype,image=:image,accountstatus=:accountstatus WHERE userid=:updateid";
            
            $query = $dbh->prepare($sql);  
            $query->bindParam(':userid',$userid,PDO::PARAM_STR);
            $query->bindParam(':firstname',$firstname,PDO::PARAM_STR);
            $query->bindParam(':lastname',$lastname,PDO::PARAM_STR);
            $query->bindParam(':age',$age,PDO::PARAM_STR);
            $query->bindParam(':contactno',$contactno,PDO::PARAM_STR);
            $query->bindParam(':address',$address,PDO::PARAM_STR);
            $query->bindParam(':email',$email,PDO::PARAM_STR);
            $query->bindParam(':password',$password,PDO::PARAM_STR);
            $query->bindParam(':gender',$gender,PDO::PARAM_STR);
            $query->bindParam(':usertype',$usertype,PDO::PARAM_STR);
            $query->bindParam(':image',$image,PDO::PARAM_STR);
            $query->bindParam(':accountstatus',$accountstatus,PDO::PARAM_STR);
            $query->bindParam(':updateid',$updateid,PDO::PARAM_STR);
            $query->execute();
            echo '<script>alert("Updated Successfully!")</script>'; 
            echo "<script type ='text/javascript'> document.location.href='profile.php' </script>"; 
    }
    else{
      $sql = "SELECT * FROM user WHERE  email = '".$email."' ";
      $query = $dbh->prepare($sql);
      $query->execute();
  
      if($query->rowCount()>0)
      {
        echo '<script>alert("The email address you provided already exists!")</script>'; 
      }
      else{
        $sql = "UPDATE user SET userid=:userid, firstname=:firstname,lastname=:lastname,age=:age,contactno=:contactno,address=:address,email=:email,password=:password,
            gender=:gender,usertype=:usertype,image=:image,accountstatus=:accountstatus WHERE userid=:updateid";
            
            $query = $dbh->prepare($sql);  
            $query->bindParam(':userid',$userid,PDO::PARAM_STR);
            $query->bindParam(':firstname',$firstname,PDO::PARAM_STR);
            $query->bindParam(':lastname',$lastname,PDO::PARAM_STR);
            $query->bindParam(':age',$age,PDO::PARAM_STR);
            $query->bindParam(':contactno',$contactno,PDO::PARAM_STR);
            $query->bindParam(':address',$address,PDO::PARAM_STR);
            $query->bindParam(':email',$email,PDO::PARAM_STR);
            $query->bindParam(':password',$password,PDO::PARAM_STR);
            $query->bindParam(':gender',$gender,PDO::PARAM_STR);
            $query->bindParam(':usertype',$usertype,PDO::PARAM_STR);
            $query->bindParam(':image',$image,PDO::PARAM_STR);
            $query->bindParam(':accountstatus',$accountstatus,PDO::PARAM_STR);
            $query->bindParam(':updateid',$updateid,PDO::PARAM_STR);
            $query->execute();
            echo '<script>alert("Updated Successfully!")</script>'; 
            echo "<script type ='text/javascript'> document.location.href='profile.php' </script>"; 
      }
    }
  }

  if (isset($_POST['updatepassword'])) 
  {
  
    $userid=($_POST['userid']);
    $password=($_POST['password']);
    $confirmpassword=($_POST['confirmpassword']);
    $oldpassword=($_POST['oldpassword']);
    $confirmoldpassword=($_POST['confirmoldpassword']);
    $updateid=($_POST['updateid']);
    $firstname=($_POST['firstname']);
    $lastname=($_POST['lastname']);
    $age=($_POST['age']);
    $contactno=($_POST['contactno']);
    $address=($_POST['address']);
    $email=($_POST['email']);
    $gender=($_POST['gender']);
    $usertype=($_POST['usertype']);
    $image=($_POST['image']);
    $accountstatus=($_POST['accountstatus']);
    $p = password_hash($password, PASSWORD_DEFAULT);
     
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);


     if($password != $confirmpassword)
     {
      echo '<script>alert("New Password do not match!")</script>';
     }
     else if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 4) 
     {
          echo '<script>alert("Password should be at least 4 characters in length and should include at least one upper case letter, one number, and one special character.")</script>'; 
     }
     else if(password_verify($confirmoldpassword, $oldpassword))
     {
      $sql = "UPDATE user SET userid=:userid, firstname=:firstname,lastname=:lastname,age=:age,contactno=:contactno,address=:address,email=:email,password='".$p."',
      gender=:gender,usertype=:usertype,image=:image,accountstatus=:accountstatus WHERE userid=:updateid";
            
            $query = $dbh->prepare($sql);  
            $query->bindParam(':userid',$userid,PDO::PARAM_STR);
            $query->bindParam(':firstname',$firstname,PDO::PARAM_STR);
            $query->bindParam(':lastname',$lastname,PDO::PARAM_STR);
            $query->bindParam(':age',$age,PDO::PARAM_STR);
            $query->bindParam(':contactno',$contactno,PDO::PARAM_STR);
            $query->bindParam(':address',$address,PDO::PARAM_STR);
            $query->bindParam(':email',$email,PDO::PARAM_STR);
            $query->bindParam(':gender',$gender,PDO::PARAM_STR);
            $query->bindParam(':usertype',$usertype,PDO::PARAM_STR);
            $query->bindParam(':image',$image,PDO::PARAM_STR);
            $query->bindParam(':accountstatus',$accountstatus,PDO::PARAM_STR);
            $query->bindParam(':updateid',$updateid,PDO::PARAM_STR);
            $query->execute();
            echo '<script>alert("Password Updated Successfully!")</script>'; 
            echo "<script type ='text/javascript'> document.location.href='profile.php' </script>"; 
  
     }
     else
     {
      echo '<script>alert("Old Password is wrong!")</script>';
      
     }
  }

    if(isset($_POST['uploadvalidid'])) {
    date_default_timezone_set('Asia/Singapore');
    $date = date('y-m-d H:i:s');
    $username=($_POST['username']);
    $userid=($_POST['userid']);

    $temp = explode(".",$_FILES["validid"]["name"]);
    $temp2 = explode(".",$_FILES["holdingtheid"]["name"]);

    $newfilename = substr(microtime(), 2, 7) . '.' .end($temp);
    $newfilename2 = substr(microtime(), 2, 7) . '.' .end($temp2);

    $target_dir = "../../dist/img/userid/";

    $target_file = $target_dir . basename($_FILES["validid"]["name"]);
    $target_file2 = $target_dir . basename($_FILES["holdingtheid"]["name"]);

    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $imageFileType2 = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));

    $extensions_arr = array("jpg","jpeg","png","gif");
    $extensions_arr2 = array("jpg","jpeg","png","gif");

        if(!in_array($imageFileType,$extensions_arr) || !in_array($imageFileType2,$extensions_arr2)){
          echo '<script>alert("Invalid File Type!")</script>'; 
        }
        else{

        move_uploaded_file($_FILES['holdingtheid']['tmp_name'],$target_dir.$newfilename2);
        move_uploaded_file($_FILES['validid']['tmp_name'],$target_dir.$newfilename);
       

      $sql = "INSERT INTO ownercredentials(ownerid,validid,validid2)VALUES(:userid,'".$newfilename."','".$newfilename2 ."')";
      $query = $dbh->prepare($sql);  
      $query->bindParam(':userid',$userid,PDO::PARAM_STR);
      $query->execute();

     $sql2 = "UPDATE user SET accountstatus = 'PENDING' WHERE userid = $userid";
      $query2 = $dbh->prepare($sql2);  
      $query2->execute();
      echo '<script>alert("Uploaded Successfully!")</script>'; 
      echo "<script type ='text/javascript'> document.location.href='profile.php' </script>"; 

      $sql3 = "INSERT INTO notification(receiverid,message,header, date)VALUES('1','Vehicle Owner: $username Uploaded valid ID','owner', '$date')";
      $query3 = $dbh->prepare($sql3);  
      $query3->execute();
        }
  }



  if(isset($_POST['updateprofilepic'])) {

    if($oldimage=($_POST['oldimage']) == 'avatar5.png')
    {
    $userid=($_POST['userid']);
    $password=($_POST['password']);
    $updateid=($_POST['updateid']);
    $firstname=($_POST['firstname']);
    $lastname=($_POST['lastname']);
    $age=($_POST['age']);
    $contactno=($_POST['contactno']);
    $address=($_POST['address']);
    $email=($_POST['email']);
    $gender=($_POST['gender']);
    $usertype=($_POST['usertype']);
    $accountstatus=($_POST['accountstatus']);

    $temp = explode(".",$_FILES["image"]["name"]);
    $newfilename = substr(microtime(), 2, 7) . '.' .end($temp);
    $target_dir = "../../dist/img/userimage/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $extensions_arr = array("jpg","jpeg","png","gif");
   

        if(!in_array($imageFileType,$extensions_arr))
        {
          echo '<script>alert("Invalid File Type!")</script>'; 
        }
        else{
        move_uploaded_file($_FILES['image']['tmp_name'],$target_dir.$newfilename);
       

      $sql = "UPDATE user SET userid=:userid, firstname=:firstname,lastname=:lastname,age=:age,contactno=:contactno,address=:address,email=:email,password=:password,
      gender=:gender,usertype=:usertype,image='".$newfilename."',accountstatus=:accountstatus WHERE userid=:updateid";

      $query = $dbh->prepare($sql);  
      $query->bindParam(':userid',$userid,PDO::PARAM_STR);
      $query->bindParam(':firstname',$firstname,PDO::PARAM_STR);
      $query->bindParam(':lastname',$lastname,PDO::PARAM_STR);
      $query->bindParam(':age',$age,PDO::PARAM_STR);
      $query->bindParam(':contactno',$contactno,PDO::PARAM_STR);
      $query->bindParam(':address',$address,PDO::PARAM_STR);
      $query->bindParam(':email',$email,PDO::PARAM_STR);
      $query->bindParam(':password',$password,PDO::PARAM_STR);
      $query->bindParam(':gender',$gender,PDO::PARAM_STR);
      $query->bindParam(':usertype',$usertype,PDO::PARAM_STR);
      $query->bindParam(':accountstatus',$accountstatus,PDO::PARAM_STR);
      $query->bindParam(':updateid',$updateid,PDO::PARAM_STR);
      $query->execute();
      echo '<script>alert("Uploaded Successfully!")</script>'; 
      echo "<script type ='text/javascript'> document.location.href='profile.php' </script>"; 
        }
  }
  else{
    $userid=($_POST['userid']);
    $password=($_POST['password']);
    $updateid=($_POST['updateid']);
    $firstname=($_POST['firstname']);
    $lastname=($_POST['lastname']);
    $age=($_POST['age']);
    $contactno=($_POST['contactno']);
    $address=($_POST['address']);
    $email=($_POST['email']);
    $gender=($_POST['gender']);
    $usertype=($_POST['usertype']);
    $accountstatus=($_POST['accountstatus']);
    $oldimage = ($_POST['oldimage']);

    $name = $_FILES['image']['name'];
    $temp = explode(".",$_FILES["image"]["name"]);
    $newfilename = substr(microtime(), 2, 7) . '.' .end($temp);
    $target_dir = "../../dist/img/userimage/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $extensions_arr = array("jpg","jpeg","png","gif");

    if(!in_array($imageFileType,$extensions_arr))
    {
      echo '<script>alert("Invalid File Type!")</script>'; 
    }
    else
    {
    move_uploaded_file($_FILES['image']['tmp_name'],$target_dir.$newfilename);
    unlink("../../dist/img/userimage/".$oldimage);

    $sql = "UPDATE user SET userid=:userid, firstname=:firstname,lastname=:lastname,age=:age,contactno=:contactno,address=:address,email=:email,password=:password,
    gender=:gender,usertype=:usertype,image='".$newfilename."',accountstatus=:accountstatus WHERE userid=:updateid";

    $query = $dbh->prepare($sql);  
    $query->bindParam(':userid',$userid,PDO::PARAM_STR);
    $query->bindParam(':firstname',$firstname,PDO::PARAM_STR);
    $query->bindParam(':lastname',$lastname,PDO::PARAM_STR);
    $query->bindParam(':age',$age,PDO::PARAM_STR);
    $query->bindParam(':contactno',$contactno,PDO::PARAM_STR);
    $query->bindParam(':address',$address,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->bindParam(':password',$password,PDO::PARAM_STR);
    $query->bindParam(':gender',$gender,PDO::PARAM_STR);
    $query->bindParam(':usertype',$usertype,PDO::PARAM_STR);
    $query->bindParam(':accountstatus',$accountstatus,PDO::PARAM_STR);
    $query->bindParam(':updateid',$updateid,PDO::PARAM_STR);
    $query->execute();
    echo '<script>alert("Uploaded Successfully!")</script>'; 
    echo "<script type ='text/javascript'> document.location.href='profile.php' </script>"; 
     }
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Vehicle Owner - Manage Profile</title>
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
  <link rel="stylesheet" href="../../dist/css/profile.css">
  <script src="https://kit.fontawesome.com/4eb9df22a3.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" charset="utf-8"></script>
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
        <li >
          <a href="history.php">
            <i class="fa fa-history"></i> <span>Rental History</span>
          </a>
        </li>
        <li class="active">
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
        <i class="fa fa-user"></i> Manage Account
        <small></small>
      </h1>
    </section>
    
    <section>
       <!-- /.modal-dialog -->
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
    <div class="modal fade" id="updatepassword">
          <div class="modal-dialog">
            <form role="form" method="post">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Password</h4>
              </div>
              <div class="modal-body">
            <div class="box box-primary">
            <div class="box-header with-border">
              
            </div>
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Old Password</label>
                  <input type="password" style="font-size: 15px; " class="form-control" id="id_password"  name="confirmoldpassword" required>
                  <div style="margin-top: -30px;text-align:right; margin-right:20px;">
                  <span><i class="far fa-eye" id="togglePassword" style="font-size:22px; cursor: pointer;"></i></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">New Password</label>
                  <input type="password" style="font-size: 15px; " class="form-control" id="id_password2"  name="password" required>
                  <div style="margin-top: -30px;text-align:right; margin-right:20px;">
                  <span><i class="far fa-eye" id="togglePassword2" style="font-size:22px; cursor: pointer;"></i></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Confirm New Password</label>
                  <input type="password" style="font-size: 15px; " class="form-control" id="id_password3"  name="confirmpassword" required>
                  <div style="margin-top: -30px;text-align:right; margin-right:20px;">
                  <span><i class="far fa-eye" id="togglePassword3" style="font-size:22px; cursor: pointer;"></i></span>
                  </div>
                </div>
              </div>
              <input type="hidden" class="form-control" name="firstname" required value="<?php echo htmlentities($result->firstname);?>">
              <input type="hidden" class="form-control" name="age" required value="<?php echo htmlentities($result->age);?>">
              <input type="hidden" class="form-control" name="lastname" required value="<?php echo htmlentities($result->lastname);?>">
              <input type="hidden" class="form-control" name="gender" required value="<?php echo htmlentities($result->gender);?>">
              <input type="hidden" class="form-control" name="address" required value="<?php echo htmlentities($result->address);?>">
              <input type="hidden" class="form-control" name="contactno" required value="<?php echo htmlentities($result->contactno);?>">
              <input type="hidden" class="form-control" name="email" required value="<?php echo htmlentities($result->email);?>">
              <input type="hidden" class="form-control" name="image" required value="<?php echo htmlentities($result->image);?>">
              <input type="hidden" class="form-control" name="usertype" required value="<?php echo htmlentities($result->usertype);?>">
              <input type="hidden" class="form-control" name="accountstatus" required value="<?php echo htmlentities($result->accountstatus);?>">
              <input type="hidden" class="form-control" name="userid" required value="<?php echo htmlentities($result->userid);?>">
              <input type="hidden" class="form-control" name="updateid" required value="<?php echo htmlentities($result->userid);?>">
              <input type="hidden" class="form-control" name="oldpassword" required value="<?php echo htmlentities($result->password);?>">
              
          </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                <button type="submit" name="updatepassword" class="btn btn-primary">Submit</button>
              </div>
            </div>
            </form>
          </div>
          <?php } 
                    } ?>
          <!-- /.modal-dialog -->
    </section>
        <!-- /.modal-dialog -->
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
    <div class="modal fade" id="update">
          <div class="modal-dialog">
            <form role="form" method="post">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Information</h4>
              </div>
              <div class="modal-body">
            <div class="box box-primary">
            <div class="box-header with-border">
              
            </div>
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">First Name</label>
                  <input type="text" class="form-control" onkeydown="return /[a-z]/i.test(event.key)"  name="firstname" required value="<?php echo htmlentities($result->firstname);?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Lastname</label>
                  <input type="text" class="form-control" onkeydown="return /[a-z]/i.test(event.key)"  name="lastname" required value="<?php echo htmlentities($result->lastname);?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Age</label>
                  <input type="number" class="form-control"  name="age" required value="<?php echo htmlentities($result->age);?>">
                </div>
                <div class="form-group">
                  <label>Gender</label>
                  <select class="form-control"  name="gender" value="<?php echo htmlentities($result->gender); ?>">
                  <?php
                    
                    if(htmlentities($result->gender) == 'Female') { ?>
                   <option>Male</option>
                   <option selected>Female</option>
                   <?php } else { ?>
                   <option selected>Male</option>
                   <option >Female</option>
                   <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Address</label>
                  <input type="text" class="form-control"  name="address" required value="<?php echo htmlentities($result->address);?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Contact No.</label>
                  <input type="text" class="form-control"  name="contactno" required value="<?php echo htmlentities($result->contactno);?>">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Email</label>
                  <input type="email" class="form-control"  name="email" required value="<?php echo htmlentities($result->email);?>">
                </div>
                <input type="hidden" class="form-control"  name="oldemail" required value="<?php echo htmlentities($result->email);?>">
              </div>
              <input type="hidden" class="form-control" name="userid" required value="<?php echo htmlentities($result->userid);?>">
              <input type="hidden" class="form-control" name="updateid" required value="<?php echo htmlentities($result->userid);?>">
              <input type="hidden" class="form-control" name="usertype" required value="<?php echo htmlentities($result->usertype);?>">
              <input type="hidden" class="form-control" name="password" required value="<?php echo htmlentities($result->password);?>">
              <input type="hidden" class="form-control" name="accountstatus" required value="<?php echo htmlentities($result->accountstatus);?>">
              <input type="hidden" class="form-control" name="image" required value="<?php echo htmlentities($result->image);?>">
          </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                <button type="submit" name="update" class="btn btn-primary">Submit</button>
              </div>
            </div>
            </form>
          </div>
          <?php } 
                    } ?>
          <!-- /.modal-dialog -->
          
        </div>
        <section>
       <!-- /.modal-dialog -->
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
         <div class="modal fade" id="uploadid">
          <div class="modal-dialog">
            <form role="form" method="post" enctype="multipart/form-data">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Upload Valid ID</h4>
              </div>
              <div class="modal-body">
            <div class="box box-primary">
            <div class="box-header with-border">
            <div class="phvalidid">
                  <a href="https://governmentph.com/list-valid-id-in-the-philippines/" target="_blank"> List of Valid IDs in the Philippines</a>
            </div>
            </div>
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">ID</label>
                  <input type="file" id="exampleInputFile"  class="form-control"  name="validid" required>
                </div>
                <label>Example:</label>
                <div> <img src="../../dist/img/id.jpg" style="width:300px; height:200px"> </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Holding the ID</label>
                  <input type="file"   class="form-control"  name="holdingtheid" required>
                </div>
                <label>Example:</label>
                <div> <img src="../../dist/img/id1.jpg" style="width:280px; height:150px"> </div>
              </div>
              <input type="hidden" class="form-control" name="username" required value="<?php echo htmlentities($result->firstname);?> <?php echo htmlentities($result->lastname);?>">
              <input type="hidden" class="form-control" name="userid" required value="<?php echo htmlentities($result->userid);?>">
              
          </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                <button type="submit" name="uploadvalidid" class="btn btn-primary">Submit</button>
              </div>
            </div>
            </form>
          </div>
          <?php } 
                    } ?>
          <!-- /.modal-dialog -->
    </section>
    <section>
       <!-- /.modal-dialog -->
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
         <div class="modal fade" id="updateprofilepic">
          <div class="modal-dialog">
            <form role="form" method="post" enctype="multipart/form-data">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Profile Picture</h4>
              </div>
              <div class="modal-body">
            <div class="box box-primary">
            <div class="box-header with-border">
              
            </div>
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Upload Image</label>
                  <input type="file" id="exampleInputFile"  class="form-control"  name="image" required>
                </div>
              </div>
              <input type="hidden" class="form-control" name="firstname" required value="<?php echo htmlentities($result->firstname);?>">
              <input type="hidden" class="form-control" name="age" required value="<?php echo htmlentities($result->age);?>">
              <input type="hidden" class="form-control" name="lastname" required value="<?php echo htmlentities($result->lastname);?>">
              <input type="hidden" class="form-control" name="gender" required value="<?php echo htmlentities($result->gender);?>">
              <input type="hidden" class="form-control" name="address" required value="<?php echo htmlentities($result->address);?>">
              <input type="hidden" class="form-control" name="contactno" required value="<?php echo htmlentities($result->contactno);?>">
              <input type="hidden" class="form-control" name="email" required value="<?php echo htmlentities($result->email);?>">
              <input type="hidden" class="form-control" name="oldimage" required value="<?php echo htmlentities($result->image);?>">
              <input type="hidden" class="form-control" name="usertype" required value="<?php echo htmlentities($result->usertype);?>">
              <input type="hidden" class="form-control" name="accountstatus" required value="<?php echo htmlentities($result->accountstatus);?>">
              <input type="hidden" class="form-control" name="userid" required value="<?php echo htmlentities($result->userid);?>">
              <input type="hidden" class="form-control" name="updateid" required value="<?php echo htmlentities($result->userid);?>">
              <input type="hidden" class="form-control" name="password" required value="<?php echo htmlentities($result->password);?>">
              
          </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                <button type="submit" name="updateprofilepic" class="btn btn-primary">Submit</button>
              </div>
            </div>
            </form>
          </div>
          <?php } 
                    } ?>
          <!-- /.modal-dialog -->
    </section>
    <!-- Main content -->
    <section class="content" >
      <div class="row" >
        <div class="col-xs-12" >
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><i class="fa fa-user"></i> Profile Settings</h3>
            </div>
            <!-- /.box-header -->
            <div class="container rounded bg-white mt-10 mb-10"  style="align:center; margin-top: 30px; min-height: 65vh; display:flex;">
            <div class="row" style="margin-left:10%;">
        <div class="col-md-3 border-right" >
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
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img style="max-width:150px;height:150px" src="../../dist/img/userimage/<?php echo htmlentities($result->image);?>"  class="img-circle" alt="User Image"><span class="font-weight-bold"><div   style="margin-top:10px" class= "editbutton"> <a data-toggle="modal" data-target="#updateprofilepic">Update Profile Picture</a> </div> </span></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">First Name</label><input type="text" disabled class="form-control"  value="<?php echo htmlentities($result->firstname);?>"></div>
                    <div class="col-md-6"><label class="labels">Last Name</label><input type="text" disabled class="form-control" value="<?php echo htmlentities($result->lastname);?>" ></div> 
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Age</label><input type="number" disabled class="form-control"  value="<?php echo htmlentities($result->age);?>"></div>
                    <div class="col-md-12"><label class="labels">Gender</label><input type="text" disabled class="form-control" value="<?php echo htmlentities($result->gender);?>"></div>
                    <div class="col-md-12"><label class="labels">Address</label><input type="text"  disabled class="form-control" value="<?php echo htmlentities($result->address);?>"></div>
                    <div class="col-md-12"><label class="labels">Contact No.</label><input type="text"  disabled class="form-control"  value="<?php echo htmlentities($result->contactno);?>"></div>
                    <div style="margin-bottom:10px" class="col-md-12"><label class="labels">Email</label><input type="text" class="form-control" disabled value="<?php echo htmlentities($result->email);?>"></div>
                    <div  class= "editbutton"><a data-toggle="modal" data-target="#update">Edit Information</a> </div>
                    <div   class= "editbutton"> <a data-toggle="modal" data-target="#updatepassword">Edit Password</a> </div>
                    <div style="margin-bottom:10px"  class="col-md-12"><label class="labels">Account Status</label><input type="text"  disabled class="form-control"  value="<?php echo htmlentities($result->accountstatus);?>"></div>
                    <?php if($result->accountstatus != 'NOT_VERIFIED')
                      {
                    ?>
                    <div style="display: none;" class= "editbutton"> <a data-toggle="modal" data-target="#uploadid">Upload Valid ID</a> </div>
                    <?php } 
                    else
                    {
                     ?>
                      <div class= "editbutton"> <a data-toggle="modal" data-target="#uploadid">Upload Valid ID</a> </div>
                      <?php } 
                     ?>
                </div>
                <?php } 
                    } ?>
            </div>
        </div>
        
  
</div>  
</div>

            
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

<!-- Bootstrap 3.3.7 -->
<script src="assets/js/jquery.js"></script>
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- page script -->
<script>
  const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#id_password');
 
  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
</script>   

<script>
  const togglePassword2 = document.querySelector('#togglePassword2');
  const password2 = document.querySelector('#id_password2');
 
  togglePassword2.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
    password2.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
</script>   

<script>
  const togglePassword3 = document.querySelector('#togglePassword3');
  const password3 = document.querySelector('#id_password3');
 
  togglePassword3.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password3.getAttribute('type') === 'password' ? 'text' : 'password';
    password3.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
</script>    

</body>
</html>
