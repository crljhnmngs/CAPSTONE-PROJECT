<?php
 session_start();
 include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\config.php');    
    $connection = mysqli_connect("localhost", "root", "");
    $receiverid = $_POST['receiverid'];
    $db = mysqli_select_db($connection, 'welift');
    $sql1="SELECT * from ownercredentials 
    INNER JOIN user ON ownercredentials.ownerid = user.userid
    WHERE ownercredentials.ownerid= '$receiverid'";
    $query_run = mysqli_query($connection, $sql1);

        while($row = mysqli_fetch_array($query_run)){

            if(isset($row['ownerid'])){
                $senderid = mysqli_real_escape_string($connection, $_SESSION['userid']);
                $receiverid = mysqli_real_escape_string($connection, $_POST['receiverid']);
                $output = "";
            
                $sql3 = "SELECT * FROM message WHERE (senderid = {$senderid} AND receiverid = {$receiverid}) OR (senderid = {$receiverid} AND receiverid = {$senderid}) ORDER BY messageid ASC";
                $query3 = mysqli_query($connection, $sql3);
                if(mysqli_num_rows($query3) > 0){
                    while($row = mysqli_fetch_assoc($query3)){
                        if($row['senderid'] == $senderid){
                            $output .= '<div class=" text-dark m-3 justify-content-end text-end"  >
                                
                                            <div class="d-inline-block text-wrap bg-white py-2 px-3 rounded-3 shadow text-start"
                                        
                                            style="
                                            max-width: 45em; 
                                            word-wrap: break-word;
                                            text-align:left;
                                            background-color:#03c2fc;
                                            font-size:17px;
                                            margin-top:10px;
                                            border-radius:9px;
                                            height:auto;
                                            width:auto;
                                            margin-left:500px;
                                            
                                           
                                            
                                            
                                             ">
            
                                            
                                                <p style="padding:5px;">'. $row['message'] .'</p>
                                            </div>
                                            </div>';
                            }
                            else
                            {
                                $output .= '<div class=" text-light m-3" ">
                                             <div class=" d-inline-block py-2 px-3 rounded-3 text-wrap"
                                              style="
                                              background-color: #03fca5; 
                                              max-width: 45em;
                                               word-wrap: break-word;
                                               text-align:left;
                                               font-size:17px;
                                               margin-top:10px;
                                               border-radius:9px;
                                               height:auto;
                                               width:200px;
            
                                               ">
            
            
            
            
            
                                                <p style="padding:5px;">'. $row['message'] .'</p>
                                            </div>
                                            </div>';
                            }
                        }
                    }
                    else
                    {
                        $output .= '<div class="text text-center align-items-center">No messages are available. Once you send message they will appear here.</div>';
                    }
                    echo $output;
                }
                else
                {
                    echo "<script>alert('No conversation found');</script>";
                }      
        }
    
?>