<?php 
    session_start();
    include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\config.php');    
    if(isset($_SESSION['userid'])){
        $userid = $_SESSION['userid'];
            $sql2 = "UPDATE notification SET status = 'read' WHERE receiverid = :userid";
            $query2 = $dbh->prepare($sql2);
            $query2->bindParam(':userid',$userid,PDO::PARAM_STR);
            $query2->execute();
        
    }
    
?>