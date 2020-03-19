<?php

include("../../config.php");
include("../admin_functions.php");



    if(isset($_GET['id'])) {

        $query = query("DELETE FROM events WHERE id =" . escape_string($_GET['id']) ."");
        confirm($query);


        set_message("Event Deleted");
        redirect("index.php?events");


    }else {
        set_message("No Product Deleted");
        redirect("index.php?events");

    }

?>