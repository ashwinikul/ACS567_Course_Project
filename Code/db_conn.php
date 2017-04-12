<?php
    function connect_to_db()
    {
        define("USER", "alhas01");
        define("PASS", "");
        define("DB", "Know_Thyself");
    
        // connect to database
        $connection = new mysqli('localhost', USER, PASS, DB);
    
        if ($connection->connect_error) {
            die('Connect Error (' . $connection->connect_errno . ') '
                . $connection->connect_error);
        }
        
        return $connection;   
    }
?>