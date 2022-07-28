<?php 
    session_start();
    include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\config.php');    
    if(isset($_SESSION['userid'])){
        $senderid = $_SESSION['userid'];
        $receiverid = $_POST['receiverid'];
        $message = $_POST['message'];
        if(!empty($message)){
            $sql2 = "INSERT INTO message(senderid, receiverid,message) VALUES(:senderid, :receiverid, :message)";
            $query2 = $dbh->prepare($sql2);
            $query2->bindParam(':senderid',$senderid,PDO::PARAM_STR);
            $query2->bindParam(':receiverid',$receiverid,PDO::PARAM_STR);
            $query2->bindParam(':message',$message,PDO::PARAM_STR);
           
            $query2->execute();
        }
    }else{
        echo "<script type ='text/javascript'> document.location.href='dashboard.php' </script>"; 
    }
?>