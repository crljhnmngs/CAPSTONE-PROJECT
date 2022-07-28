<?php

session_start();
$ownername=$_SESSION['firstname']." ".$_SESSION['lastname'];
include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\config.php');    

if(isset($_GET['bookingid']) && isset($_GET['vehicleid'])){
    date_default_timezone_set('Asia/Singapore');
    $bookingid = $_GET['bookingid'];
    $vehicleid = $_GET['vehicleid'];
    $renterid = $_GET['renterid'];
    $date = date('y-m-d H:i:s');
    $model = $_GET['model'];

    $sql = "UPDATE booking SET bookingstatus = 'DECLINED' WHERE bookingid = $bookingid";
    $query = $dbh->prepare($sql);
    $query->execute();

    //$sql2 = "UPDATE vehicle SET status = 'AVAILABLE' WHERE vehicleid = $vehicleid";
    //$query2 = $dbh->prepare($sql2);
    //$query2->execute();

    $sql3 = "INSERT INTO notification(receiverid,message,header,date)VALUES($renterid,'$ownername declined your $model booking request','booking', '$date')";
    $query3 = $dbh->prepare($sql3);  
    $query3->execute();

    echo '<script>alert("Success!")</script>'; 
    echo "<script type ='text/javascript'> document.location.href='vehiclerental.php' </script>"; 
}   


?>