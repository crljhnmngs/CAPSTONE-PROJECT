<?php
 session_start();
 include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\config.php');    
 $id = $_SESSION['userid'];
    
       
        

             $sql="SELECT COUNT(*) AS total FROM notification where receiverid = $id AND status = 'unread'";
                 $query=$dbh->prepare($sql);
                 $query->execute();
                 $results=$query->fetchALL(PDO::FETCH_OBJ);
                 $cnt=1;   
                   foreach ($results as $result) 
                   {
                    
                    if(htmlentities($result->total) < 1)
                    {
                      echo "";
                    }
                    else{
                    echo htmlentities($result->total);
                    }
                    }
                ?>