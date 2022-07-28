<?php

session_start();
include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\config.php');    


if(!isset($_SESSION['userid']))
  {
    echo "<script type ='text/javascript'> document.location.href='../login.php' </script>"; 
  } 

  else
  {
    $rentername=$_SESSION['firstname']." ".$_SESSION['lastname'];
    $id = $_SESSION['userid'];
   

  }
  if(isset($_GET['ownerid']))
  {
    date_default_timezone_set('Asia/Singapore');
    $ownerid=($_GET['ownerid']);
    $date = date('y-m-d H:i:s');
    
    $sql3 = "INSERT INTO notification(receiverid,message,header,date)VALUES($ownerid,'$rentername return your vehicle','return', '$date')";
    $query3 = $dbh->prepare($sql3);  
    $query3->execute();

    echo "<script type ='text/javascript'> document.location.href='rentedvehicles.php' </script>";
    
        
} 
  ?>