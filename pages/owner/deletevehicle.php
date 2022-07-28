<?php

session_start();
include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\config.php');    

if(isset($_GET['deleteid']) && isset($_GET['vehicleimage'])){
    
    $deleteid = $_GET['deleteid'];
    $sql1 = "UPDATE vehicle SET status = 'DELETED' WHERE vehicleid = $deleteid";
    $query1 = $dbh->prepare($sql1);
    $query1->execute();

    echo '<script>alert("Deleted Successfully!")</script>'; 
    echo "<script type ='text/javascript'> document.location.href='managevehicle.php' </script>"; 
}   


?>