<?php

session_start();
include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\config.php');    

if(isset($_GET['userid'])){
    date_default_timezone_set('Asia/Singapore');
    $date = date('y-m-d H:i:s');
    $userid = $_GET['userid'];
    $fileid = $_GET['fileid'];

    $sql = "UPDATE user SET accountstatus='NOT_VERIFIED' WHERE userid = $userid ";
    $query = $dbh->prepare($sql);
    $query->execute();

    $sql2 = "DELETE FROM ownercredentials WHERE fileid = $fileid ";
    $query2 = $dbh->prepare($sql2);
    $query2->execute();

    $sql3 = "INSERT INTO notification(receiverid,message,header,date)VALUES($userid,'Sorry! your verification request was not approved by WeLift Admin, Please double check your details and try again.','profile', '$date')";
    $query3 = $dbh->prepare($sql3);  
    $query3->execute();

    echo '<script>alert("Success!")</script>'; 
    echo "<script type ='text/javascript'> document.location.href='dashboard.php' </script>"; 
}   


?>