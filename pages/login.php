<?php 
session_start();
include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\config.php');    

if(isset($_POST['login']))
{
    $email=$_POST['email'];
    $password=$_POST['password'];
    $latitude=$_POST['latitude'];
    $longitude=$_POST['longitude'];
    $sql = "SELECT * FROM user WHERE email=:email";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email,PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetch(PDO::FETCH_ASSOC);
    
    

    if($query->rowCount()>0)
    {
      $p = $results['password'];
     if(password_verify($password, $p))
      {
    $usertype = $results['usertype'];
    if($usertype == 'Admin')
    {
        $emailstatus = $results['emailstatus'];
        $email = $results['email'];
        if($emailstatus == 1)
        {
        session_regenerate_id();
        $_SESSION['userid'] = $results['userid'];
        $_SESSION['firstname'] = $results['firstname'];
        $_SESSION['lastname'] = $results['lastname'];
        echo "<script type ='text/javascript'> document.location.href='admin/dashboard.php' </script>"; 
        }
        else
        {
          echo '<script>alert("This account has not been verified. An email was sent to ' . $email . ' ")</script>'; 
        }
    }

    else if($usertype == 'Renter')
    {
      $accountstatus = $results['accountstatus'];
      $emailstatus = $results['emailstatus'];
      $email = $results['email'];
      if($emailstatus == 1 && $accountstatus != 'DEACTIVATED')
      {
      session_regenerate_id();
      $_SESSION['userid'] = $results['userid'];
      $_SESSION['firstname'] = $results['firstname'];
      $_SESSION['lastname'] = $results['lastname'];
      $_SESSION['latitude'] = $latitude;
      $_SESSION['longitude'] = $longitude;

      echo "<script type ='text/javascript'> document.location.href='renter/dashboard.php' </script>"; 
      }
      else if($accountstatus == 'DEACTIVATED')
      {
        echo '<script>alert("This account was deactivated by the admin")</script>';
      }
      else
      {
        echo '<script>alert("This account has not been verified. An email was sent to ' . $email . ' ")</script>'; 
      }
  }
    
  else if($usertype == 'Vehicle Owner')
  {
    $accountstatus = $results['accountstatus'];
      $emailstatus = $results['emailstatus'];
      $email = $results['email'];
      if($emailstatus == 1 && $accountstatus != 'DEACTIVATED')
      {
      session_regenerate_id();
      $_SESSION['userid'] = $results['userid'];
      $_SESSION['firstname'] = $results['firstname'];
      $_SESSION['lastname'] = $results['lastname'];
      echo "<script type ='text/javascript'> document.location.href='owner/dashboard.php' </script>"; 
      }
      else if($accountstatus == 'DEACTIVATED')
      {
        echo '<script>alert("This account was deactivated by the admin")</script>';
      }
      else
      {
        echo '<script>alert("This account has not been verified. An email was sent to ' . $email . ' ")</script>'; 
      }

    
     }
  }
  else{
    echo '<script>alert("Wrong Credentials!")</script>'; 
   
    }
}
  else{
    echo '<script>alert("Wrong Credentials!")</script>'; 
   
    }
    }
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    
    <title>Login Page</title>
    <link rel="stylesheet" href="../dist/css/login.css">
    <link rel="stylesheet"
  href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;1,200;1,300;1,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link rel = "icon" href = "../dist/img/logo/favicon.ico" type = "image/x-icon">
  </head>
  <body onLoad="getLocation();">
    <div class="wrapper">
    <div class="title" style="margin-bottom:-25px;">
    <a href="../index.php"><span class="logo-mini"><b><img src="../dist/img/logo/logo.png" style="width: 120px;height: 100px;"></b></span></a>
    </div>
      <div class="title">Login Account</div>
      <form method="post">
        <div class="field">
          <input type="text" name="email" required>
          <label>Email Address</label>
        </div>
        <input type="hidden" name="latitude" id="latitude" value="">
          <input type="hidden" name="longitude" id="longitude" value="">
        <div class="field"> 
          
          <input type="password" name="password"  required id="id_password">
          
          <div style="margin-top: -35px;text-align:right; margin-right:20px;">
          <span><i class="far fa-eye" id="togglePassword" style="font-size:22px; cursor: pointer;"></i></span>
          </div>
          <label>Password </label>
        </div>
        
        <div class="content">
        <div class="signup-link"><a href="forgot-password.php">Forgot Password?</a></div>
        </div>
        
        <div class="field">
          <input type="submit" name="login" value="Login">
        </div>

        <div class="signup-link">Not a member? <a href="register.php">Signup now</a></div>
        <br>

      </form>


      
    </div>

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

<script type="text/javascript">
   

    function getLocation() {

        if(navigator.geolocation) 
        {
            navigator.geolocation.getCurrentPosition(showPosition);
        } 
        else 
        {
          alert("Sorry, your browser does not support geolocation services.");
        }
    }

    function showPosition(position) 
    {
      document.getElementById("latitude").value = position.coords.latitude;
      document.getElementById("longitude").value = position.coords.longitude;
    }
    </script>

  </body>
  
</html>

