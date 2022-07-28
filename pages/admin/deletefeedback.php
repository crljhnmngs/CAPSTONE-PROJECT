<?php

session_start();
include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\config.php');    

if(isset($_GET['feedbackid'])){
    
    $feedbackid = $_GET['feedbackid'];

    $sql = "DELETE FROM feedback WHERE feedbackid = $feedbackid ";
    $query = $dbh->prepare($sql);
    $query->execute();

    

    echo '<script>alert("Success!")</script>'; 
    echo "<script type ='text/javascript'> document.location.href='feedbacks.php' </script>"; 
}   


?>