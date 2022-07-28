<?php
 session_start();
 include('D:\PROGRAMMING SOFTWARES\XAMPP\htdocs\WeLift\includes\config.php');  
    
   date_default_timezone_set('Asia/Singapore');
   function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    $connection = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($connection, 'welift');
    
    
        $id = $_SESSION['userid'];
        $output = "";

        $sql3="SELECT * FROM notification where receiverid = $id ORDER BY notifid DESC";
        $query3 = mysqli_query($connection, $sql3);
        if(mysqli_num_rows($query3) > 0){
            while($row = mysqli_fetch_assoc($query3)){
                if($row['header'] == 'booking'){
                    $output .= '<div href="#" class="dropdown-item">
                        <p>'. $row['message'] .'</p>
                        <span class="float-right text-muted text-sm">'. time_elapsed_string($row['date']) .'</span>
                    </div>
                    <div style="text-align:right; margin-right:15px;">
                    <a href="vehiclerental.php"> View </a>
                    </div>
                    <div class="dropdown-divider"></div>
                    ';
                }
                else if($row['header'] == 'reserved'){
                $output .= '<div href="#" class="dropdown-item">
                <p>'. $row['message'] .'</p>
                    <span class="float-right text-muted text-sm">'. time_elapsed_string($row['date']) .'</span>
                </div>
                <div style="text-align:right; margin-right:15px;">
                <a href="rentedvehicles.php"> View </a>
                </div>
                <div class="dropdown-divider"></div>
                ';
                }
                else if($row['header'] == 'return'){
                    $output .= '<div href="#" class="dropdown-item">
                    <p>'. $row['message'] .'</p>
                        <span class="float-right text-muted text-sm">'. time_elapsed_string($row['date']) .'</span>
                    </div>
                    <div style="text-align:right; margin-right:15px;">
                    <a href="requestreturn.php"> View </a>
                    </div>
                    <div class="dropdown-divider"></div>
                    ';
                    }
                else if($row['header'] == 'renter'){
                        $output .= '<div href="#" class="dropdown-item">
                        <p>'. $row['message'] .'</p>
                            <span class="float-right text-muted text-sm">'. time_elapsed_string($row['date']) .'</span>
                        </div>
                        <div style="text-align:right; margin-right:15px;">
                        <a href="rentercredential.php"> View </a>
                        </div>
                        <div class="dropdown-divider"></div>
                        ';
                        }
              else if($row['header'] == 'owner'){
                            $output .= '<div href="#" class="dropdown-item">
                            <p>'. $row['message'] .'</p>
                                <span class="float-right text-muted text-sm">'. time_elapsed_string($row['date']) .'</span>
                            </div>
                            <div style="text-align:right; margin-right:15px;">
                            <a href="ownercredential.php"> View </a>
                            </div>
                            <div class="dropdown-divider"></div>
                            ';
                            }
                else if($row['header'] == 'profile'){
                                $output .= '<div href="#" class="dropdown-item">
                                <p>'. $row['message'] .'</p>
                                    <span class="float-right text-muted text-sm">'. time_elapsed_string($row['date']) .'</span>
                                </div>
                                <div style="text-align:right; margin-right:15px;">
                                <a href="profile.php"> View </a>
                                </div>
                                <div class="dropdown-divider"></div>
                                ';
                                }
                else if($row['header'] == 'report'){
                             $output .= '<div href="#" class="dropdown-item">
                             <p>'. $row['message'] .'</p>
                             <span class="float-right text-muted text-sm">'. time_elapsed_string($row['date']) .'</span>
                             </div>
                             <div style="text-align:right; margin-right:15px;">
                             <a href="report.php"> View </a>
                             </div>
                             <div class="dropdown-divider"></div>
                                    ';
                                    }
                    else if($row['header'] == 'email'){
                     $output .= '<div href="#" class="dropdown-item">
                   <p>'. $row['message'] .'</p>
                     <span class="float-right text-muted text-sm">'. time_elapsed_string($row['date']) .'</span>
                     </div>
                     <div style="text-align:right; margin-right:15px;">
                    <a href="https://mail.google.com/mail/u/0/#inbox" target="_blank"> View </a>
                     </div>
                    <div class="dropdown-divider"></div>
                                               ';
                                               }
                    else {
                        $output .= '<div href="#" class="dropdown-item">
                        <p>'. $row['message'] .'</p>
                            <span class="float-right text-muted text-sm">'.time_elapsed_string($row['date']) .'</span>
                        </div>
                        <div class="dropdown-divider"></div>
                        ';
                        }
            }
        }
        else{
            $output .= '<div class="text text-center align-items-center" style="font-weight: bold;">No new Notification</div>
            <div class="dropdown-divider"></div>';
        }
        echo $output;
    
?>