<?php 
session_start();
include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\config.php');        
    if (isset($_POST['submit'])) {
      
      if(isset($_POST['terms']) && $_POST['terms']!="")
      {
        $firstname=($_POST['firstname']);
        $lastname=($_POST['lastname']);
        $age=($_POST['age']);
        $contactno=($_POST['contactno']);
        $address=($_POST['address']);
        $email=($_POST['email']);
        $password=($_POST['password']);
        $gender=($_POST['gender']);
        $usertype=($_POST['usertype']);
        $confirmpass=($_POST['confirmpass']);
        $terms=($_POST['terms']);
        
        $sql = "SELECT * FROM user WHERE  email = '".$email."' ";
        $query = $dbh->prepare($sql);
        $query->execute();

        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

          
        if($query->rowCount()>0)
        {
          echo '<script>alert("The email address you provided already exists!")</script>'; 
        }
        else if($age < 18)
        {
          echo '<script>alert("You Must be 18 Years of Age or Older to create an account!")</script>'; 
        }
        else if($terms == null)
        {
          echo '<script>alert("Please read and agree terms and condition")</script>'; 
        }
        else if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 4) 
         {
          echo '<script>alert("Password should be at least 4 characters in length and should include at least one upper case letter, one number, and one special character.")</script>'; 
         }
        else if($password == $confirmpass)
        {
        
          if($usertype == "Vehicle Owner")
          {
        $vkey = md5(time().$firstname);
        $p = password_hash($password, PASSWORD_DEFAULT);
        

          $sql = "INSERT INTO user(firstname,lastname,age,contactno,address, email, password, gender, usertype, accountstatus, image, vkey)VALUES(:firstname,:lastname,:age,:contactno,:address,:email,'".$p."',:gender,:usertype, 'NOT_VERIFIED', 'avatar5.png','".$vkey."')";
          $query = $dbh->prepare($sql);
          $query->bindParam(':firstname',$firstname,PDO::PARAM_STR);
          $query->bindParam(':lastname',$lastname,PDO::PARAM_STR);
          $query->bindParam(':age',$age,PDO::PARAM_STR);
          $query->bindParam(':contactno',$contactno,PDO::PARAM_STR);
          $query->bindParam(':address',$address,PDO::PARAM_STR);
          $query->bindParam(':email',$email,PDO::PARAM_STR);
          $query->bindParam(':gender',$gender,PDO::PARAM_STR);
          $query->bindParam(':usertype',$usertype,PDO::PARAM_STR);
          $query->execute();
          
          $to = $email;
          $subject = "Email Verification";
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
                      Please click on the link below to verify your email.
                      </p>
                      <p>
                      </p>
                      <a href='http://localhost/WeLift/pages/verify.php?vkey=$vkey'>
                      Verify your email
                      </a>
                      </div>
                      </body>
                      </html>
          ";
          $headers = "From: WeLift Vehicle Rental System <weliftvehiclerental@gmail.com> \r\n";
          $headers .= "MIME-Version: 1.0" . "\r\n";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

          mail($to, $subject, $message, $headers);
          
          echo '<script>alert("Registered Successfully! Verification link is send to your email")</script>'; 
          echo "<script type ='text/javascript'> document.location.href='login.php' </script>"; 
          }
          else
          {
          $vkey = md5(time().$firstname);
          $p = password_hash($password, PASSWORD_DEFAULT);

         
            $sql = "INSERT INTO user(firstname,lastname,age,contactno,address, email, password, gender, usertype, accountstatus, image, vkey)VALUES(:firstname,:lastname,:age,:contactno,:address,:email,'".$p."',:gender,:usertype, 'NOT_VERIFIED', 'avatar5.png','".$vkey."')";
          $query = $dbh->prepare($sql);
          $query->bindParam(':firstname',$firstname,PDO::PARAM_STR);
          $query->bindParam(':lastname',$lastname,PDO::PARAM_STR);
          $query->bindParam(':age',$age,PDO::PARAM_STR);
          $query->bindParam(':contactno',$contactno,PDO::PARAM_STR);
          $query->bindParam(':address',$address,PDO::PARAM_STR);
          $query->bindParam(':email',$email,PDO::PARAM_STR);
          $query->bindParam(':gender',$gender,PDO::PARAM_STR);
          $query->bindParam(':usertype',$usertype,PDO::PARAM_STR);
          $query->execute();

          $to = $email;
          $subject = "Email Verification";
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
         Please click on the link below to verify your email.
         </p>
         <p>
         </p>
         <a href='http://localhost/WeLift/pages/verify.php?vkey=$vkey'>
         Verify your email
         </a>
         </div>
         </body>
         </html>
          ";
          $headers = "From: WeLift Vehicle Rental System <weliftvehiclerental@gmail.com> \r\n";
          $headers .= "MIME-Version: 1.0" . "\r\n";
          $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

          mail($to, $subject, $message, $headers);
          
          echo '<script>alert("Registered Successfully! Verification link is send to your email")</script>'; 
          echo "<script type ='text/javascript'> document.location.href='login.php' </script>"; 
          }
        }
        else
        echo '<script>alert("Passwords do not match!")</script>';  
  }
  else{
    echo '<script>alert("Please read and agree Terms and Conditions")</script>'; 
  }
}
 
    

?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration Page</title>
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">

  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="../dist/css/register.css">
    <link rel="stylesheet"
  href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;1,200;1,300;1,400&display=swap" rel="stylesheet">
  <link rel="stylesheet"href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js">    </script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
<link rel = "icon" href = "../dist/img/logo/favicon.ico" type = "image/x-icon">
   </head>
<body>
 
        
  <div class="container">

    
    <div class="title" style="text-align:center;margin-bottom:-25px;">  <a href="../index.php"><span class="logo-mini"><b><img src="../dist/img/logo/logo.png" style="width: 100px;height: 90px;"></b></span></a> Registration
   
    </div>
    <div class="content">
      <form action="#" method="post">
        <div class="user-details">
          <div class="input-box">
            <span class="details">First Name</span>
            <input type="text" onkeydown="return /[a-z]/i.test(event.key)" name="firstname" placeholder="Enter your first name" required>
          </div>
          <div class="input-box">
            <span class="details">Last Name</span>
            <input type="text" onkeydown="return /[a-z]/i.test(event.key)" name="lastname" placeholder="Enter your last name" required>
          </div>
          <div class="input-box">
            <span class="details">Age</span>
            <input type="number" name="age" placeholder="Enter your age" required>
          </div>
          
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="number" name="contactno" placeholder="Enter your phone number" required>
          </div>
          <div class="input-box">
            <span class="details">Address</span>
            <input type="text" name="address" placeholder="Enter your complete address" required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="email" name="email" placeholder="Enter your email" required>
          </div>

        <div class="input-box">
        <span class="details">Sign Up as:</span>
        <select name="usertype" required>
        <option value="" disabled selected>Select your option</option>
        <option>Renter</option>
        <option>Vehicle Owner</option>
        
        </select>
        </div>

        <div class="input-box">
        <span class="details">Gender</span>
        <select name="gender" required>
        <option value="" disabled selected>Select your option</option>
        <option>Male</option>
        <option>Female</option>
       
        </select>
        </div>

          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" name="password" placeholder="Enter your password" id="id_password" required>
            <div style="margin-top: -35px;text-align:right; margin-right:20px;">
          <span><i class="far fa-eye" id="togglePassword" style="font-size:22px; cursor: pointer;"></i></span>
          </div>
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="password"  name="confirmpass" placeholder="Confirm your password" id="id_password2" required>
            <div style="margin-top: -35px;text-align:right; margin-right:20px;">
          <span><i class="far fa-eye" id="togglePassword2" style="font-size:22px; cursor: pointer;"></i></span>
          </div>
          </div>

          <div style="display:block;">
          <input type="checkbox" id="slk" name="terms" required> 
          I agree to the <a data-toggle="modal" data-target="#myModal"> Terms and Condition </a>
          </div>
        </div>

       

        <div class="button">
          <input type="submit" id="id" name="submit"value="Register">
        </div>
        <div class="signup-link"><a href="login.php">Already have an account?</a></div>
      </form>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" role="document" style="width:50%;max-height:80%;overflow:scroll;" >
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Terms and Condition</h4>
      </div>
      
      <div class="modal-body" >
        <p style="text-align:center;"> <b>We appreciate your interest in WeLift.</b> </p>
        
        <p style="text-align: justify;text-justify: inter-word;"> PLEASE READ THESE TERMS AND CONDITIONS CAREFULLY BECAUSE THEY GOVERN YOUR RELATIONSHIP WITH THE VEHICLE OWNER. BY ACCESSING AND USING THE PLATFORM, YOU ACKNOWLEDGE THAT YOU HAVE READ, UNDERSTOOD, AND AGREED TO BE SUBJECT TO THESE TERMS AND CONDITIONS. IF YOU DO NOT AGREE WITH THESE TERMS AND CONDITIONS, YOU MUST IMMEDIATELY STOP USING ALL WELIFT PLATFORMS. THESE TERMS AND CONDITIONS INCLUDE ALL FEES LISTED ON ALL WELIFT PLATFORMS. </p> 

        <h5> <b>Eligibility to hire a vehicle:</b> </h5>
        <p style="text-align: justify;text-justify: inter-word;"> The minimum age for renting a vehicle is 18 years old, and the license must be present at the time of Account Verification. You must also have a valid PH driving license or Valid ID (front and back). </p> 

        <h5> <b>Driving License Requirements:</b> </h5>
      <li style="text-align: justify;text-justify: inter-word;">   The client and driver must be in possession of a valid driving license. </li>
      <li style="text-align: justify;text-justify: inter-word;">   Republic of the Philippines residents require a driver's license.  </li>
      <li style="text-align: justify;text-justify: inter-word;">   International clients also have to be in possession of an international driving license. (Please note this may vary depending on LTFRB rules and regulations).  </li>

      <h4 style="text-align:center;"> Use of the Services </h4>
      
      <h5> <b>User Accounts:</b> </h5>
        <p style="text-align: justify;text-justify: inter-word;"> In order to use most aspects of the Services, clients must register for and maintain an active personal user Services account (“Account”). Clients must be at least 18 years of age, or the age of legal majority in their jurisdiction. Clients agree to maintain accurate, complete, and up-to-date information in their accounts. Failure to maintain accurate, complete, and up-to-date Account information, Clients are also responsible for all activity that occurs under their account and agree to maintain the security and secrecy of their Account username and password at all times. </p> 

        <h5> <b>User Requirements and Conduct:</b> </h5>
        <p style="text-align: justify;text-justify: inter-word;"> The Service is not available for use by individuals under the age of 18. Clients may not authorize third parties to use their Account, and may not allow individuals under the age of 18 to receive WeLift services. Clients agree to comply with all applicable laws when using the Services, and may only use the Services for lawful purposes (e.g., no transport of unlawful or hazardous materials). They will not, in their use of the Services, cause nuisance, annoyance, inconvenience, or property damage.  </p> 

        <h5> <b>Email Communications:</b> </h5>
        <p style="text-align: justify;text-justify: inter-word;"> WeLift uses email and electronic means to stay in touch with their clients. For verification purposes, Clients: </p>
        <p style="text-align: justify;text-justify: inter-word;margin-left:20px;"> <b>A.</b>	Consent to receive communications from WeLift in an electronic form via the email address they have submitted or via the Platform. </p>
        <p style="text-align: justify;text-justify: inter-word;margin-left:20px;"> <b>B.</b>	Agree that all Terms and Conditions, agreements, notices, disclosures, and other communications that WeLift provides to them electronically satisfy any legal requirement that such communications would satisfy if it were in a physical writing or traditional mailing. </p> 

        <h5> <b>Governing Law:</b> </h5>
        <p style="text-align: justify;text-justify: inter-word;"> This Agreement between a client and WeLift and any access to or use of the Platform or the Service by a Client is governed by  </p> 
        <li style="text-align: justify;text-justify: inter-word;margin-left:20px;">   The laws and regulations of the Land Transportation Franchising and Regulatory Board (LTFRB) as applied by the Republic of the Philippines.  </li>

        <h5> <b>Viewing your Account History:</b> </h5>

        <p style="text-align: justify;text-justify: inter-word;margin-left:20px;"> <b>A.</b> At present, clients can access the following information through the WeLift application: </p>
        <p style="text-align: justify;text-justify: inter-word;margin-left:20px;"> <b>B.</b> Rental history </p> 
        <p style="text-align: justify;text-justify: inter-word;margin-left:20px;"> <b>C.</b> Account information </p> 
        <p style="text-align: justify;text-justify: inter-word;margin-left:20px;"> <b>D.</b> Incurred fees and charges </p>

        <p style="text-align: justify;text-justify: inter-word;"> Clients must understand and agree that WeLift has no duty to provide clients with rental, billing, payment, or other account information or reminders in any other way. Clients are responsible for checking, managing, and updating their accounts, rental, billing, and payment information. </p>

        <h5> <b>Cancellations of Confirmed Reservations:</b> </h5>
        <p style="text-align: justify;text-justify: inter-word;margin-left:20px;"> <b>A.</b> The client agrees and accepts that a confirmed reservation will be valid for 48 hours starting from the confirmation of the vehicle owner, after which it will be canceled automatically. </p>
        <p style="text-align: justify;text-justify: inter-word;margin-left:20px;"> <b>B.</b> The client agrees and accepts that a pending reservation will be valid for 48 hours starting from the date of the reservation, after which it will be canceled automatically. </p> 

        <h5> <b>Network Access and Devices:</b> </h5>
        <p style="text-align: justify;text-justify: inter-word;margin-left:20px;"> Clients are responsible for obtaining the data network access necessary to use the Services. Their device network’s data fees may apply if client’s access or use of the Services from a wireless-enabled device and will be responsible for such rates and fees. Clients are responsible for acquiring and updating compatible hardware or devices necessary to access and use the Services and Applications and any updates thereto. WeLift does not guarantee that the Services, or any portion thereof, will function on any particular hardware or devices. In addition, the Services may be subject to malfunctions and delays inherent in the use of the Internet and electronic communications. </p>

        <h5> <b>Conditions</b> </h5>

        <p style="text-align: justify;text-justify: inter-word;margin-left:20px;"> <b>A.</b> If a client is involved in a traffic accident while renting a vehicle WeLift is no longer liable. </p>
        <p style="text-align: justify;text-justify: inter-word;margin-left:20px;"> <b>B.</b> If a vehicle is damage while being use of the client, the client should be charged for the damaged. </p> 
        <p style="text-align: justify;text-justify: inter-word;margin-left:20px;"> <b>C.</b> WeLift has the right to suspend an account that is being reported not following the terms and conditions. (if proven) </p> 
        <p style="text-align: justify;text-justify: inter-word;margin-left:20px;"> <b>D.</b> If the clients fail to return the vehicle to the return date, penalty charges will be applied. </p>
        <p style="text-align: justify;text-justify: inter-word;margin-left:20px;"> <b>E.</b> Suspended Clients will not be able to use the Welift services anymore. </p>
        
        <h5> <b>Disclaimer</b> </h5>
        <p style="text-align: justify;text-justify: inter-word;margin-left:20px;"> By accepting these Terms and Conditions, you agree to accept the Terms and Conditions of our agreement. </p>

        <p style="text-align: justify;text-justify: inter-word;margin-left:20px;"> YOU ACKNOWLEDGE THAT YOUR USE OF OUR APP, ITS CONTENT, OR SERVICES IS AT YOUR SOLE RISK AND YOU ASSUME FULL RESPONSIBILITY AND RISK OF LOSS ARISING FROM YOUR USE OF INFORMATION OR CONTENT OBTAINED FROM A VENDOR OR THE SERVICES. </p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="checkSlk" data-dismiss="modal" class="btn btn-primary">Agree</button>
      </div>

    </div>
  </div>
</div>

          
        
    
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_componentsbower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../bower_componentsbower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_componentsbower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../bower_componentsbower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_componentsbower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../bower_componentsdist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../bower_componentsdist/js/demo.js"></script>
<!-- page script -->
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
