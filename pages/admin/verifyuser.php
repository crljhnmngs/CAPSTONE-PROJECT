<?php

session_start();
include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\config.php');    

if(isset($_GET['userid'])){
    date_default_timezone_set('Asia/Singapore');
    $date = date('y-m-d H:i:s');
    $userid = $_GET['userid'];

    $sql = "UPDATE user SET accountstatus='VERIFIED' WHERE userid = $userid ";
    $query = $dbh->prepare($sql);
    $query->execute();

    $sql3 = "INSERT INTO notification(receiverid,message,header,date)VALUES($userid,'Welift Admin verified your account','profile', '$date')";
    $query3 = $dbh->prepare($sql3);  
    $query3->execute();

    echo '<script>alert("Success!")</script>'; 
    echo "<script type ='text/javascript'> document.location.href='dashboard.php' </script>"; 
}   


?>