<?php
 session_start();
 include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\config.php');    
 $id = $_SESSION['userid'];
 $output = "";
       
        

             $sql="SELECT COUNT(*) AS total FROM notification where receiverid = $id";
                 $query=$dbh->prepare($sql);
                 $query->execute();
                 $results=$query->fetchALL(PDO::FETCH_OBJ);
                    
                   foreach ($results as $result) 
                   {
                    
                    echo htmlentities($result->total), ' Notification/s';
                    
                    }
                   
                ?>