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
    
    function QueryExec($connection,$sql,$op)
    {
      
            
            // execute query
                $result = $connection->query($sql) or die(mysqli_error($connection));  

                if ($result === false)
                    die("Could not query database");
                else
                    echo "Database Operation successful!\n" .$op."<br>" ;    
    

        
  
    }
?>