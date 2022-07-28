<?php

session_start();
$id = $_SESSION['userid'];
$rentername=$_SESSION['firstname']." ".$_SESSION['lastname'];
include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\config.php');    

if(isset($_GET['bookingid']) && isset($_GET['vehicleid'])){
    
    date_default_timezone_set('Asia/Singapore');
    $bookingid = $_GET['bookingid'];
    $vehicleid = $_GET['vehicleid'];
    $vehiclename = $_GET['vehiclename'];
    $ownerid=intval($_GET['ownerid']);
    $date = date('y-m-d H:i:s');

    $sql = "UPDATE booking SET bookingstatus = 'CANCELED' WHERE bookingid = $bookingid";
    $query = $dbh->prepare($sql);
    $query->execute();

    $sql2 = "UPDATE vehicle SET status = 'AVAILABLE' WHERE vehicleid = $vehicleid";
    $query2 = $dbh->prepare($sql2);
    $query2->execute();

    
    

    $sql3 = "INSERT INTO notification(receiverid,message,header,date)VALUES($ownerid,'$rentername cancel booking your vehicle named $vehiclename', 'booking', '$date')";
    $query3 = $dbh->prepare($sql3);  
    $query3->execute();

    echo '<script>alert("Success!")</script>'; 
    echo "<script type ='text/javascript'> document.location.href='vehiclerental.php' </script>"; 
}   


?>