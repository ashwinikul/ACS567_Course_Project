/* 
	Developer: Sindhu Balakrishnan
	Description: PHP page for submitting MBTI questionnaire. 

*/
<?php
    require_once('db_conn.php');
    
    function submit_asmt()
        {
            try {
                    echo "U r here";
                    $connection = connect_to_db();

                    // prepare SQL
                    $sql = sprintf("SELECT max(userid) FROM UserDetails;");// Need to update this code

                    $result = $connection->query($sql) or die(mysqli_error()); 
                    $currentUser = mysqli_fetch_row($result);
                    $newUser = $currentUser[0]+1;

                    mysqli_autocommit($connection,FALSE);
		    
		    $email ="ash.kulkarni1990@gmail.com"; // Need to update this code as of noe its hardcoded
		    // Updated <19 APR 2017> Setting up session variables
		    session_start(); // session start
                    $_SESSION['s_userid']=$newUser ;
                    $_SESSION['s_emailid']=$email ;
                   
                    $insert_usr = sprintf("INSERT INTO UserDetails (created_date) VALUES (NOW());
                                            ");
                    
                    // execute query
                    $sucess = $connection->query($insert_usr) or die(mysqli_error($connection));  
                    if ($sucess === false)
                        die("User not inserted into database");
                    
                    mysqli_commit($connection);
                    
                     /*                        
                    $insert_usr = sprintf("INSERT INTO UserDetails (userid , created_date) VALUES ('".htmlspecialchars($newUser, ENT_QUOTES)."', NOW());
                                            ");
                    //$sucess = false;
                    */

                    $original_array = unserialize($_POST['ArrayData']);
                    //var_dump($original_array);
                    
                    if (is_array($original_array)) {
                        
                        for ($row = 1; $row < 43; $row++) {
                                $testid = $original_array[$row][0];
                                $qusid = $original_array[$row][1];
                                $ans = $_POST['selection_'.$qusid];
                        
                            $insert = sprintf("INSERT INTO Test_User_Ans(testid, userid, qusid, ans, created_date)
                                                VALUES ('".htmlspecialchars($testid,ENT_QUOTES)."','".htmlspecialchars($newUser,ENT_QUOTES)."','".htmlspecialchars($qusid,ENT_QUOTES)."','".htmlspecialchars($ans,ENT_QUOTES)."', now());
                                                    ");
                            
                            // execute query
                            $sucess = $connection->query($insert) or die(mysqli_error($connection));  
                                
                            if ($sucess === false)
                                die("Assessment details not inserted into database");
                              
                            mysqli_commit($connection);
                        }
                    }
		    
		// Updated <19 APR 2017> Making entry in DB which will trigger the calculation  :Start
			    $insert_entry =  sprintf("INSERT INTO TestDetails (testid, userid, created_date) VALUES
                                                 ('".htmlspecialchars($testid,ENT_QUOTES)."','".htmlspecialchars($newUser,ENT_QUOTES)."', now());
                                                    ");
                            $sucess = $connection->query($insert_entry) or die(mysqli_error($connection)); 
                          
                            if ($sucess === false)
				    die("Assessment details not inserted into database");
                              
                            mysqli_commit($connection);
	        // Updated <19 APR 2017> Making entry in DB which will trigger the calculation   :End    
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
                //header("Location: confirmation.php");
		// Updated <19 APR 2017> 
		header("Location: result.html"); 
                exit;
                
            }
        }
?>
