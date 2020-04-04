<?php 

    session_start();
    session_destroy();
   header("Location: https://youconnect.herokuapp.com/admin/login.php");
  //  header("Location: http://localhost/daveTicket/admin/login.php");
    

?>