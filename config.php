<?php
    //Define DB param

    define("DB_HOST", "us-cdbr-iron-east-04.cleardb.net");
    define("DB_USER", "b5a1bd816a4613");
    define("DB_PASS", "a89a9c5f");
    define("DB_NAME", "heroku_f301b44b19a9953");

    // define("DB_HOST", "localhost");
    // define("DB_USER", "root");
    // define("DB_PASS", "");
    // define("DB_NAME", "uconnect");

    // define URl
    define("ROOT_PATH", "/index");
    define("ROOT_URL", "/index");

    // define("ROOT_PATH", "/daveTicket/index");
    // define("ROOT_URL", "http://localhost/daveTicket/index");

    defined ("DS") ? null : define ("DS", DIRECTORY_SEPARATOR);
    defined ("UPLOAD_DIR") ? null : define ("UPLOAD_DIR", __DIR__ . DS . "uploads");
