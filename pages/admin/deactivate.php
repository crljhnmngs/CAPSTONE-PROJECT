<?php

session_start();
include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\config.php');    

if(isset($_GET['userid'])){

   
    $userid = $_GET['userid'];

    $sql = "UPDATE user SET accountstatus='DEACTIVATED' WHERE userid = $userid ";
    $query = $dbh->prepare($sql);
    $query->execute();

   

    echo '<script>alert("Success!")</script>'; 
    echo "<script type ='text/javascript'> document.location.href='dashboard.php' </script>"; 
}   


?>