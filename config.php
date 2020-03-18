<?php
    //Define DB param

    define("DB_HOST", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_NAME", "dave_ticket");

    //define URl
    define("ROOT_PATH", "/daveTicket/index");
    define("ROOT_URL", "http://localhost/daveTicket/index");

    defined ("DS") ? null : define ("DS", DIRECTORY_SEPARATOR);
    defined ("UPLOAD_DIR") ? null : define ("UPLOAD_DIR", __DIR__ . DS . "uploads");
