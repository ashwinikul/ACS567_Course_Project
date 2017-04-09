<?php
    require_once('db_conn.php');
    function save_to_db($sql, $connection)
    {
            try {
                    $connection = connect_to_db();
                        
                    // prepare SQL
                    $insert = sprintf("INSERT INTO `answers` (`question`,`answer`)
                                        VALUES ('".htmlspecialchars($_POST["$questionId"],ENT_QUOTES)."','".htmlspecialchars($_POST["selection"])."')
                                            ");
                    // execute query
                    $sucess = $connection->query($insert) or die(mysqli_error($connection));  
                    if ($sucess === false)
                        die("Review not inserted into database");
                        
                    mysqli_close($connection);
                    
                }
                        
            catch(PDOException $e)
                {
                    echo 'Cannot connect to database';
                    exit;
                }
                
            //if($sucess === true && $error === false)
            if($sucess === true)
                {
                    header("Location: confirmation.php");
                    exit;
                }
    }
?>