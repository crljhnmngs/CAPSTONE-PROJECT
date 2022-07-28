<?php 
session_start();
include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\config.php');     

if(isset($_GET['vkey'])){

    $vkey = $_GET['vkey'];

    $sql = "SELECT emailstatus,vkey FROM user WHERE emailstatus = 0 AND vkey = '".$vkey."' ";
    $query = $dbh->prepare($sql);
    $query->execute();

    if ($query->rowCount()>0)
    {
        $sql2 = "UPDATE user SET emailstatus = 1 WHERE vkey = '".$vkey."'";
        $query2 = $dbh->prepare($sql2);
        $query2->execute();

        echo '<script>alert("Verified Successfully")</script>'; 
        echo "<script type ='text/javascript'> document.location.href='login.php' </script>"; 
    }

    else{
        echo '<script>alert("This account is invalid or already verified")</script>'; 
        echo "<script type ='text/javascript'> document.location.href='login.php' </script>"; 
    }

}

?>