<?php 

    session_start();
    session_destroy();
    header("Location: http://localhost/daveTicket/admin/login.php");

?>