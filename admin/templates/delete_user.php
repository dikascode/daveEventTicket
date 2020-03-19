<?php

include("../../config.php");
include("../admin_functions.php");


    if(isset($_GET['id'])) {
        
        $query = query("DELETE FROM users WHERE user_id =" . escape_string($_GET['id']) ."");
        confirm($query);
        
        set_message("User Deleted");
        redirect("index.php?users");


    }else {
        set_message("No User Deleted");
        redirect("index.php?users");

    }

?>