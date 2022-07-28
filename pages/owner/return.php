<?php

session_start();
$ownername=$_SESSION['firstname']." ".$_SESSION['lastname'];
include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\config.php');    

if(isset($_GET['bookingid']) && isset($_GET['vehicleid']) && isset($_GET['renterid'])){
    date_default_timezone_set('Asia/Singapore');
    $bookingid = $_GET['bookingid'];
    $vehicleid = $_GET['vehicleid'];
    $renterid = $_GET['renterid'];
    $date = date('y-m-d H:i:s');

    $sql = "UPDATE booking SET bookingstatus = 'RETURNED' WHERE bookingid = $bookingid";
    $query = $dbh->prepare($sql);
    $query->execute();

    $sql2 = "UPDATE vehicle SET status = 'AVAILABLE' WHERE vehicleid = $vehicleid";
    $query2 = $dbh->prepare($sql2);
    $query2->execute();
 

    $sql3 = "INSERT INTO notification(receiverid,message,date)VALUES($renterid,'$ownername mark your reserved vehicle as returned', '$date')";
    $query3 = $dbh->prepare($sql3);  
    $query3->execute();

    $sql4 = "INSERT INTO bookinghistory(bookingid,renterid,vehicleid)VALUES($bookingid,$renterid,$vehicleid)";
    $query4 = $dbh->prepare($sql4);
    $query4->execute();

    echo '<script>alert("Success!")</script>'; 
    echo "<script type ='text/javascript'> document.location.href='rentedvehicles.php' </script>"; 
}   


?>