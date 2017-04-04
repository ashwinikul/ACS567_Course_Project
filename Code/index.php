<!DOCTYPE html>
<html>
    <head>
        <title>Demo Personality Assesment</title>
    </head>
    <body>
        <form method="post" action="index.php">
            <h1>Personality Assesment</h1>
        <?php
            require_once('db_conn.php');
            require_once('show_ques.php');
            
             try {
                $connection = connect_to_db();
                
                // prepare SQL
                $sql = sprintf("SELECT question FROM questions");
                
                show_ques($sql, $connection);
                
                mysqli_close($connection);
            
                }
                
            catch(PDOException $e)
                {
                    echo 'Cannot connect to database';
                    exit;
                }
        ?>
        </form>
    </body>
</html>