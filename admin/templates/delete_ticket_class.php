<?php

include("../../config.php");
include("../admin_functions.php");


    if(isset($_GET['id'])) {
        $ticket_title = show_ticket_class_title($_GET['t_id']);
        set_message($ticket_title . " Ticket Class Deleted");
        $query = query("DELETE FROM tickets WHERE ticket_id =" . escape_string($_GET['t_id']) ."");
        confirm($query);
        
        redirect("index.php?ticket_class&id={$_GET['id']}");


    }else {
        set_message("No Ticket Class Deleted");
        redirect("index.php?ticket_class&id={$_GET['id']}");

    }

?>