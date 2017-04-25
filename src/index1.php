<?php
//	Developer: Sindhu Balakrishnan
//	Description: PHP index file for MBTI application 

    require_once('db_conn.php');
    require_once('show_ques.php');
    require_once('submit_asmt.php');
	
	$connection = connect_to_db();

                    // prepare SQL
    $sql = sprintf("SELECT max(userid) FROM UserDetails;");// Need to update this code

    $result = $connection->query($sql) or die(mysqli_error()); 
    $currentUser = mysqli_fetch_row($result);
    $newUser = $currentUser[0]+1;
    
    $insert_usr = sprintf("INSERT INTO UserDetails (userid,created_date) VALUES ('".htmlspecialchars($newUser,ENT_QUOTES)."',NOW());
                                            ");
                    
                    // execute query
                    $sucess = $connection->query($insert_usr) or die(mysqli_error($connection)); 

                    mysqli_autocommit($connection,FALSE);
		    
		            //$email ="ash.kulkarni1990@gmail.com"; // Need to update this code as of noe its hardcoded
		            // Updated <19 APR 2017> Setting up session variables
	session_start(); // session start
                    
    $_SESSION['s_userid']=$newUser ;
	
	
    $s_testid = $_SESSION['s_testid']; // session get
    $s_userid = $_SESSION['s_userid'];
    
    if (empty($s_testid)) {
            //echo '$var is either 0, empty, or not set at all';
            $s_testid=1;
            $_SESSION['s_testid']=$s_testid;
        }
    
     try {
        $connection = connect_to_db();
        
        // prepare SQL
	     //updated <19 APR 2017 >    added condition DT.testname='MBTI'   
        $sql = sprintf("SELECT DQ.qusid, DT.Testid, DQ.qus_desc, OPT.op1, OPT.op2
                            From Dim_Question DQ
                            INNER JOIN  Dim_Test DT ON DQ.testid= DT.testid
                            INNER JOIN Dim_Qus_Option OPT ON (DQ.testid=OPT.testid and DQ.qusid=OPT.qusid)
			    WHERE DT.testid= '".$s_testid."'
                            ORDER BY DQ.qusid;
                            ");
        
        show_ques($sql, $connection);
        
        mysqli_close($connection);
    
        }
        
    catch(PDOException $e)
        {
            echo 'Cannot connect to database';
            exit;
        }
?>


     
