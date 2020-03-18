<?php
include("../../config.php");
include("../admin_functions.php");



    if(isset($_GET['id'])) {
        
        $query = query("DELETE FROM reports WHERE report_id =" . escape_string($_GET['id']) ."");
        confirm($query);
        
        set_message("Report ". $_GET['id'] . " Deleted");
        redirect("../index.php?reports");


    }else {
        set_message("No Report Deleted");
        redirect("../index.php?reports");

    }

?>