<?php 
session_start();
include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\config.php');    

if(isset($_POST['submit']))
{
  $email=$_POST['email'];
  $sql = "SELECT * FROM user WHERE email=:email";
  $query = $dbh->prepare($sql);
  $query->bindParam(':email', $email,PDO::PARAM_STR);
  $query->execute();
  $results=$query->fetch(PDO::FETCH_ASSOC);

  if($query->rowCount()>0)
    {
      $emailstatus = $results['emailstatus'];
      $vkey = $results['vkey'];
      if($emailstatus == 0)
      {
          $to = $email;
          $subject = "Password Reset Link";
          $message = " <!DOCTYPE html>
          <html lang='en' >
          <head>
         <meta charset='UTF-8'>
         <title>Verify Email</title>
         </head>
         <body>
         <div>
         <p>
         Hello there,
         </p>
         <p>
         </p>
         <p>
         Please click on the link below to reset your password.
         </p>
         <p>
         </p>
         <a href='http://localhost/WeLift/pages/new-password.php?vkey=$vkey'>
         Reset your password
         </a>
         </div>
         </body>
         </html>
          ";
          $headers = "From: WeLift Vehicle Rental System <weliftvehiclerental@gmail.com> \r\n";
          $headers .= "MIME-Version: 1.0" . "\r\n";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

          mail($to, $subject, $message, $headers);
          
          echo '<script>alert("We have sent a password reset link to your email - ' . $email . '")</script>'; 
          echo "<script type ='text/javascript'> document.location.href='forgot-password.php' </script>"; 
      }
      else{
        $lastname = $results['lastname'];
        $newvkey = md5(time().$lastname);
        $sql = "UPDATE user SET vkey = '".$newvkey."' WHERE email=:email";
        $query = $dbh->prepare($sql);
        $query->bindParam(':email', $email,PDO::PARAM_STR);
        $query->execute();
        
        $to = $email;
          $subject = "Password Reset Link";
          $message = " <!DOCTYPE html>
          <html lang='en' >
          <head>
         <meta charset='UTF-8'>
         <title>Verify Email</title>
         </head>
         <body>
         <div>
         <p>
         Hello there,
         </p>
         <p>
         </p>
         <p>
         Please click on the link below to reset your password.
         </p>
         <p>
         </p>
         <a href='http://localhost/WeLift/pages/new-password.php?vkey=$newvkey'>
         Reset your password
         </a>
         </div>
         </body>
         </html>
          ";
          $headers = "From: WeLift Vehicle Rental System <weliftvehiclerental@gmail.com> \r\n";
          $headers .= "MIME-Version: 1.0" . "\r\n";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

          mail($to, $subject, $message, $headers);
          
          echo '<script>alert("We have sent a password reset link to your email - ' . $email . '")</script>'; 
          echo "<script type ='text/javascript'> document.location.href='forgot-password.php' </script>"; 
      }
    }
  else{
    echo '<script>alert("Email Address does not exist!")</script>'; 
  }
}
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../dist/css/login.css">
    <link rel="stylesheet"
  href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;1,200;1,300;1,400&display=swap" rel="stylesheet">
  <link rel = "icon" href = "../dist/img/logo/favicon.ico" type = "image/x-icon">
  </head>
  <body>
    <div class="wrapper2">
      <div class="title"> Forgot Password?</div>
      <form method="post">
      <label> Enter Your Email Address </label>
        <div class="field" style="margin-bottom:40px;">
          <input type="email" name="email" required>
          <label>Email Address</label>
        </div>
        <div class="field">
          <input type="submit" name="submit" value="Submit">
        </div>
        <div class="signup-link"><a href="login.php">Back</a></div>
        <br>
      </form>
    </div>
  </body>
</html>
