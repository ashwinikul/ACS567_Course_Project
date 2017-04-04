<?php
    function connect_to_db()
    {
        define("USER", "sinanal");
        define("PASS", "");
        define("DB", "acs567_db");
    
        // connect to database
        $connection = new mysqli('127.0.0.1', USER, PASS, DB);
    
        if ($connection->connect_error) {
            die('Connect Error (' . $connection->connect_errno . ') '
                . $connection->connect_error);
        }
        
        return $connection;   
    }
?>