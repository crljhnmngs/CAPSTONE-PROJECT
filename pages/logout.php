<?php

session_start();

session_destroy();

echo "<script type ='text/javascript'> document.location.href='login.php' </script>"; 

?>