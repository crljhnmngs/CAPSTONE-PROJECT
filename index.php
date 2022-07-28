<?php

session_start();
include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\config.php');    
date_default_timezone_set('Asia/Singapore');
//$currentdate = date('2022-05-25 01:00:00');
 $currentdate = date('y-m-d H:i:s');
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
   $penaltyrate = htmlentities($result->penaltyrate);
   $date2 = date($returndate .= '23:59:59');
   $hours = floor((strtotime($currentdate) - strtotime($date2)) / 3600);
   
   if($hours > 0)
   {
   $penalty = $hours * $penaltyrate;
   if($currentdate > $date2)
   {
     $sql = "UPDATE booking SET penalty = $penalty WHERE bookingid = $bookingid";
     $query = $dbh->prepare($sql);
     $query->execute();
   }
 }
 }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
   <link rel="stylesheet" href="dist/css/mains.css">
   <link rel="stylesheet" href="dist/css/styles.css">
    <title>Landing Page</title>
    <link rel = "icon" href = "dist/img/logo/favicon.ico"
        type = "image/x-icon">
</head>
<body>
    <script src="node_modules/bootstrap/dist/js/bootstrap.js">

    </script>

     

    <nav class="navbar navbar-expand-lg navbar-light shadow">
      <div class="container">
        <div>
        <span class="logo-mini"><b><img src="dist/img/logo/logo.png" style="width: 50px;height: 50px;"></b></span>
        <a class="navbar-brand text-primary" href="#" >WeLift</a>
      
      </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
             
              <a class="nav-link" href="#1"> <img src="dist/image/home.png" alt="img" width="30" height="24" class="nav-icon">Home</a>
              
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#service"><img src="dist/image/home.png" alt="img" width="30" height="24" class="nav-icon">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#4"><img src="dist/image/home.png" alt="img" width="30" height="24" class="nav-icon">Explainer</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#3"><img src="dist/image/home.png" alt="img" width="30" height="24" class="nav-icon">Contact Us</a>
            </li>
            
           
           
            
          </ul>
          <ul class="navbar-nav ms-auto">
            <a href="pages/login.php"><button  type="button" class="btn btn-outline-primary">Login</button></a>
            
           
          </ul>
        </div>
      </div>
    </nav>
    
    <div class="img-wrapper" style="height:650px" id="1">
   
    <img src="dist/image/indexbg.jpg" style="width:100%;height:100%;object-fit: cover;" alt="bg-image" >
      <!---->
      <div class="text-wrapper">
       
       
        <a href="pages/login.php"><button type="button" class="buttonimg-wrapper" style="margin-top: 530px;float:left;margin-left:55px;margin-right:-300px;">
          BOOK NOW
        </button></a>
        <a href="pages/register.php"><button type="button" class="buttonimg-wrapper" style="margin-top: 530px;">
          REGISTER
        </button></a>
      </div>
      
      
    </div>

    <!--content Wrapper-->
    <div id="content-wrapper">
      <!--Main Wrapper-->
      <div id="wrapper">
        <section id="service">
          <h2 class="main-title">Our Services</h2>
          <p class="service-disc">
            "WeLift: A Web-based Vehicle Rental Management System" aims to help clients find a vehicle they want to rent and enable owners to offer vehicle for rent.
             The system that can assist clients in finding a vehicle according to their needs. The developed system has a very user-friendly interface, 
             making it very easy for users to work with it.
          </p>

          <div class="col-wrap">
            <div class="col-three-item">
              <div class="inner">
                <div class="inner">
                  <div class="service-title-1">
                      <p style="margin-left:100px;">Flexible rentals</p>
                  </div>
                  <div class="test">
                    <p>Cancel or change most bookings for free up to 24 hours before pick-up.</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-three-item">
              <div class="inner">
                <div class="inner">
                  <div class="service-title-1">
                      <p style="margin-left:100px;">No hidden fees</p>
                  </div>
                  <div class="test">
                    <p>Know exactly what you’re paying.</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-three-item">
              <div class="inner">
                <div class="service-title-1">
                      <p style="margin-left:100px;">Made it easy</p>
                </div>
                <div class="test">
                  <p>Making it very easy for users to work with it.</p>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
     <div class="content-mid" id="4">

            <div class="content-wrapper-boy">
            <video width="100%" height="100%" controls>
                <source src="dist/image/My Video4.mp4" type="video/mp4">
               

            </video>
            </div>
            
            <div class="content-wrapper-boy">
              <img src="dist/image/nice-thumbsup.png" class="boy-thumb">
            </div>
     </div>


      
      <div id="wrapper">
        <div class="contact-us" id="3">
        <h1>Have a question or need a custom quote?</h1>
        <p> Contact us with anything you want to know about WeLift,
           Inc. or kindly email us at<br> <a href="mailto:Welift@getyourowncar.com" class="welift-mail">weliftvehiclerental@gmail.com</a>. A Voyg representative will follow-up with you shortly.</p>
           
      </div>
        

    </div>
   
    <style>
     
      </style>
      </head>
      <body>
      

        <div class="slide-wrapper">
      <div class="slideshow-container">
      
      <div class="mySlides fade">
     
        <img src="dist/image/3.jpg" style="width:100%; height: 400px;">
      
      </div>
      
      <div class="mySlides fade">
   
        <img src="dist/image/2.png" style="width:100%; height: 400px;" >
        
      </div>
      
      <div class="mySlides fade">
        
        <img src="dist/image/4.png" style="width:100%; height: 400px;" >
        
      </div>
      </div>
    </div>



  <section>
    <div class="container1">
					
    <div class="card" style="width:300px; height:450px;">
				<div class="imgBx">
					<a href="#">
					<img src="dist/image/adana.jpg" style="width:230px; height:250px;">
					</a>
          <h2> TEAM MANAGER </H2> <br>
					<h2>Richelle Adana  </h2>
					
					<a href="https://www.facebook.com/richenggg" target="_blank"  class="fa fa-facebook"></a>
          <a href="#" class="fa fa-twitter"></a>
          <a href="#" class="fa fa-google"></a>
          <a href="#" class="fa fa-instagram"></a>
          <a href="#" class="fa fa-yahoo"></a>
				</div>
			</div>

      <div class="card" style="width:300px; height:450px;">
				<div class="imgBx">
					<a href="#">
					<img src="dist/image/ligtas.jpg" style="width:230px; height:250px;">
					</a>
          <h2> HACKER </H2> <br>
					<h2>Ferdinand Ligtas </h2>
					
          <a href="https://www.facebook.com/DesididoMoApuchJr" target="_blank"  class="fa fa-facebook"></a>
          <a href="#" class="fa fa-twitter"></a>
          <a href="#" class="fa fa-google"></a>
          <a href="#" class="fa fa-instagram"></a>
          <a href="#" class="fa fa-yahoo"></a>
				</div>
			</div>
		
      <div class="card" style="width:300px; height:450px;">
				<div class="imgBx">
					<a href="#">
          <img src="dist/image/bolneo.jpg" style="width:230px; height:250px;">
					</a>
          <h2> HUSTLER </H2> <br>
					<h2>Steven Bolneo  </h2>
							
          <a href="https://www.facebook.com/ShanaTsuchida" target="_blank" class="fa fa-facebook"></a>
          <a href="#" class="fa fa-twitter"></a>
          <a href="#" class="fa fa-google"></a>
          <a href="#" class="fa fa-instagram"></a>
          <a href="#" class="fa fa-yahoo"></a>
				</div>	
			</div>	
			
		  <div class="card" style="width:300px; height:450px;">
				<div class="imgBx">
					<a href="#">
          <img src="dist/image/manigos.jpg" style="width:230px; height:250px;">
					</a>
          <h2> HIPSTER </H2> <br>
					<h2> Carl John Manigos  </h2>
				
          <a href="https://www.facebook.com/crljhnmngs/" target="_blank"  class="fa fa-facebook"></a>
          <a href="#" class="fa fa-twitter"></a>
          <a href="#" class="fa fa-google"></a>
          <a href="#" class="fa fa-instagram"></a>
          <a href="#" class="fa fa-yahoo"></a>
				</div>	
			</div>	
			
		</div>	
 
<section class="footer">
  <div class="social">
          <a href="#" class="fa fa-facebook"></a>
          <a href="#" class="fa fa-twitter"></a>
          <a href="#" class="fa fa-google"></a>
          <a href="#" class="fa fa-instagram"></a>
          <a href="#" class="fa fa-yahoo"></a>
  </div>

    <ul class="list">
      <li>
          <a href="#"> Home </a>
      </li>
      <li>
          <a href="#"> Services </a>
      </li>
      <li>
          <a href="#"> About </a>
      </li>
      <li>
          <a href="#"> Terms </a>
      </li>
      <li>
          <a href="#"> Privacy Policy </a>
      </li>

      <p class="copyright">
        WeLift @ 2022
      </p>

    </ul>




</section>

    



















      <script>
     let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  slides[slideIndex-1].style.display = "block";
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}
      </script>

     

    </div>
 
    

</body>
</html>