<?php 
session_start();
include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\config.php');    

if(isset($_GET['vkey']))
{

    $vkey = $_GET['vkey'];

    $sql = "SELECT vkey FROM user WHERE  vkey = '".$vkey."' ";
    $query = $dbh->prepare($sql);
    $query->execute();

    if ($query->rowCount()<=0) 
    {
        echo '<script>alert("Password reset link is invalid!")</script>'; 
        echo "<script type ='text/javascript'> document.location.href='login.php' </script>"; 
    }
}
if(!isset($_GET['vkey']))
  {
    echo "<script type ='text/javascript'> document.location.href='login.php' </script>"; 
  } 

if(isset($_POST['submit']))
        {
            $confirmpass=($_POST['confirmpass']);
            $password=($_POST['password']);
            $vkey = $_GET['vkey'];
            
            $sql = "SELECT * FROM user WHERE  vkey = '".$vkey."' ";
            $query = $dbh->prepare($sql);
            $query->execute();
            $results=$query->fetch(PDO::FETCH_ASSOC);
           

            if($password == $confirmpass)
            {
            $emailstatus = $results['emailstatus'];
            if($emailstatus != 0)
            {
            $newvkey = md5(time().$password);
            $p = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE user SET vkey = '".$newvkey."',password = '".$p."' WHERE vkey = '".$vkey."'";
            $query = $dbh->prepare($sql);
            $query->execute();
            echo '<script>alert("Password was change successfully!")</script>'; 
            echo "<script type ='text/javascript'> document.location.href='login.php' </script>"; 
            }
            else
            {
            $p = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE user SET password = '".$p."' WHERE vkey = '".$vkey."'";
            $query = $dbh->prepare($sql);
            $query->execute();
            echo '<script>alert("Password was change successfully!")</script>'; 
            echo "<script type ='text/javascript'> document.location.href='login.php' </script>"; 
            }
            }
            else
            {
                echo '<script>alert("Passwords do not match!")</script>'; 
            }
        }
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>New Password</title>
    <link rel="stylesheet" href="../dist/css/login.css">
    <link rel="stylesheet"
  href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;1,200;1,300;1,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link rel = "icon" href = "../dist/img/logo/favicon.ico" type = "image/x-icon">
  </head>
  <body>
    <div class="wrapper" style="height:350px">
      <div class="title" style="margin-bottom:-20px">Reset Password</div>
      <form method="post">
        <div class="field">
          <input type="password" name="password" required id="id_password">
          <div style="margin-top: -35px;text-align:right; margin-right:20px;">
          <span><i class="far fa-eye" id="togglePassword" style="font-size:22px; cursor: pointer;"></i></span>
          </div>
          <label>New Password</label>
        </div>
        <div class="field">
          <input type="password" name="confirmpass" required id="id_password2">
          <div style="margin-top: -35px;text-align:right; margin-right:20px;">
          <span><i class="far fa-eye" id="togglePassword2" style="font-size:22px; cursor: pointer;"></i></span>
          </div>
          <label>Confirm Password</label>
        </div>
        <div class="field">
        <input type="submit" name="submit" value="Submit">
        <div class="signup-link"><a href="login.php">Cancel</a></div>
        </div>
        
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

  </body>
</html>
