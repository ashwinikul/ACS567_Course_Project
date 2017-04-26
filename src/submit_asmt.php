<?php
//	Developer: Sindhu Balakrishnan
//	Description: PHP file to submit an assessment details.
	
	// Updated <19 APR 2017> Setting up session variables
    
    session_start(); // session start
                    
    $newUser= $_SESSION['s_userid'];
    $s_testid = $_SESSION['s_testid'];
    //$_SESSION['s_emailid']=$email ;    
    //echo 'New user id is'.$newUser.'And testid is'.$s_testid;
    
    require_once('db_conn.php');
    
    function submit_asmt()
    {
            try {
                    $connection = connect_to_db();
                    echo 'inside submit New user id is'.$newUser.'And testid is'.$s_testid;

                    /*// prepare SQL
                    $sql = sprintf("SELECT max(userid) FROM UserDetails;");// Need to update this code

                    $result = $connection->query($sql) or die(mysqli_error()); 
                    $currentUser = mysqli_fetch_row($result);
                    $newUser = $currentUser[0]+1;

                    mysqli_autocommit($connection,FALSE);*/
		    
		            //$email ="ash.kulkarni1990@gmail.com"; // Need to update this code as of noe its hardcoded

                    
                     /*
                    if ($sucess === false)
                        die("User not inserted into database");*/
                    
                    //mysqli_commit($connection);
                    
                     /*                        
                    $insert_usr = sprintf("INSERT INTO UserDetails (userid , created_date) VALUES ('".htmlspecialchars($newUser, ENT_QUOTES)."', NOW());
                                            ");
                    //$sucess = false;
                    */

                    $original_array = unserialize($_POST['ArrayData']);
                    //var_dump($original_array);
                    
                    $newUser = $_SESSION['s_userid'];
                    $_SESSION['s_testid']=$testid;
                    echo 'Print again: New user id is'.$newUser.'And testid is'.$testid;
                    
                    
                    
                    $sql = sprintf("SELECT max(userid) FROM UserDetails;");// Need to update this code

                    $result = $connection->query($sql) or die(mysqli_error()); 
                    $currentUser = mysqli_fetch_row($result);
                    $newUser = $currentUser[0]+1;
                    $_SESSION['s_userid']=$newUser;
                    
                    
                     $insert_usr = sprintf("INSERT INTO UserDetails (userid,created_date) VALUES ('".htmlspecialchars($newUser,ENT_QUOTES)."',NOW());
                                            ");
                    

                     $sucess = $connection->query($insert_usr) or die(mysqli_error($connection)); 

                     mysqli_autocommit($connection,FALSE);
		    
                    
                    
                    echo 'New Uers: - again: New user id is'.$newUser.'And testid is'.$testid;
                    
                    if (is_array($original_array)) 
                    {
                        for ($row = 1; $row < $_POST['sizeOfQSet'] + 1; $row++) 
                        {
                                $testid = $original_array[$row][0];
                                $qusid = $original_array[$row][1];
                                $ans = $_POST['selection_'.$qusid];
                                $newUser = $_SESSION['s_userid'];
                              $s_testid=$testid;
                              $_SESSION['s_testid']=$testid;
                              echo 'Print again: New user id is'.$newUser.'And testid is'.$testid;
                            
                           /*
                            $insert = sprintf("DELETE FROM Test_User_Ans WHERE userid='".htmlspecialchars($newUser,ENT_QUOTES)."' and testid='".htmlspecialchars($testid,ENT_QUOTES)."' and qusid=;");
                                                    
                            $ins_sucess = $connection->query($insert) or die(mysqli_error($connection));
                            
                            $insert = sprintf("DELETE FROM TestDetails WHERE userid='".htmlspecialchars($newUser,ENT_QUOTES)."' and testid='".htmlspecialchars($testid,ENT_QUOTES)."';");
                                                    
                            $ins_sucess = $connection->query($insert) or die(mysqli_error($connection));
                            
                            $insert = sprintf("DELETE FROM User_MBTI_Result WHERE userid='".htmlspecialchars($newUser,ENT_QUOTES)."' and testid='".htmlspecialchars($testid,ENT_QUOTES)."';");
                                                    
                            $ins_sucess = $connection->query($insert) or die(mysqli_error($connection));
                            
                            $insert = sprintf("DELETE FROM Custom_Test_Result WHERE userid='".htmlspecialchars($newUser,ENT_QUOTES)."' and testid='".htmlspecialchars($testid,ENT_QUOTES)."';");
                                                    
                            $ins_sucess = $connection->query($insert) or die(mysqli_error($connection));
                            
                            $insert = sprintf("DELETE FROM Custom_TestDetails WHERE userid='".htmlspecialchars($newUser,ENT_QUOTES)."' and testid='".htmlspecialchars($testid,ENT_QUOTES)."';");
                                                    
                            $ins_sucess = $connection->query($insert) or die(mysqli_error($connection));
                            
                            
                            mysqli_commit($connection);
                            
                            */
                            
                            $insert = sprintf("INSERT INTO Test_User_Ans(testid, userid, qusid, ans, created_date)
                                                VALUES ('".htmlspecialchars($testid,ENT_QUOTES)."','".htmlspecialchars($newUser,ENT_QUOTES)."','".htmlspecialchars($qusid,ENT_QUOTES)."','".htmlspecialchars($ans,ENT_QUOTES)."', now());
                                                    ");
                                                    
                            $ins_sucess = $connection->query($insert) or die(mysqli_error($connection));  
                                
                            if ($ins_sucess === false)
                                die("Assessment details not inserted into database");
                              
                            mysqli_commit($connection);
                        }
                    }
		    
		// Updated <19 APR 2017> Making entry in DB which will trigger the calculation  :Start
			   if ($s_testid==1)
                          {
                              echo "This is MBTI Test";
                          $insert_entry =  sprintf("INSERT INTO TestDetails (testid, userid, created_date) VALUES
                                                 ('".htmlspecialchars($testid,ENT_QUOTES)."','".htmlspecialchars($newUser,ENT_QUOTES)."', now());
                                                    ");
                          }
                          else
                          {
                              echo "This is Custom Test";
                           $insert_entry =  sprintf("INSERT INTO Custom_TestDetails (testid, userid, created_date) VALUES
                                                 ('".htmlspecialchars($testid,ENT_QUOTES)."','".htmlspecialchars($newUser,ENT_QUOTES)."', now());
                                                    ");   
                              
                          }
                            $sucess = $connection->query($insert_entry) or die(mysqli_error($connection)); 
                          
                            if ($sucess === false)
				            die("Assessment details not inserted into database");
                              
                            mysqli_commit($connection);
                            
                            mysqli_close($connection);
	        // Updated <19 APR 2017> Making entry in DB which will trigger the calculation   :End    
                
            }
                        
            catch(PDOException $e)
            {
                echo 'Cannot connect to database';
                exit;
            }
                
            if($ins_sucess === true)
            {
                //header("Location: confirmation.php");
		  // Updated <19 APR 2017>
		  
		  echo '<br>submit Success New user id is'.$newUser.'And testid is'.$s_testid;
		            
	       	    header("Location: result.html"); 
                //exit;
            }
    }
    
?>
