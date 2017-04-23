/* 
	Developer: Sindhu Balakrishnan
	Description: PHP page to create custom questionaire.

*/
<?php
    require_once('db_conn.php');
    require_once('show_ques.php');
    require_once('submit_asmt.php');
            
    try {
        
        $newUser = 2;
        $newtestid = [];
        
        $connection = connect_to_db();
        mysqli_autocommit($connection,FALSE);
        
            // prepare SQL to check if the Test name already exists in DB.
            if($_POST['options']==null) {
                $sql = sprintf("SELECT testid FROM Dim_Test WHERE testname = '".$_POST['testname']."';
                                                    ");
       // echo 'select testid, taesname sql '.$sql;
                $result = $connection->query($sql) or die(mysqli_error($connection)); 
                $assessName = mysqli_fetch_row($result);

            //    echo 'value of accessName '.$assessName[0];
                    if (isset($assessName[0]) && !empty($assessName[0])) {
                        
                        echo 'Questionaire with this name already exists in the DB. ';
                        echo 'Continue if you wish to add more questions to it';
                        echo '<br>';
                        echo 'Otherwise, please use a different name';
                        
                        } 
                        
                        else { 
                        // prepare SQL to insert the new Test name in DB.
                            
                            
                            
                            $sql = sprintf("INSERT INTO Dim_Test (userid, testname, created_date) 
                                        VALUES ($newUser, '".htmlspecialchars($_POST['testname'],ENT_QUOTES)."',now());");
                        
                            $sucess = $connection->query($sql) or die(mysqli_error($connection));  
                          //  echo 'insert nito Dim_test status'.$sucess; 
                         
                        }
            } 
            
            else {      
                        

                        $sql = sprintf("SELECT max(testid) FROM Dim_Test WHERE testname = '".$_POST['testname']."';
                                                    ");
                        
                      //  echo 'max testid from dim_test is '. $sql;
                        $result1 = $connection->query($sql) or die(mysqli_error()); 
                        $newtestid = mysqli_fetch_row($result1);
                       // $newtestid[0] = $newtestid[0]+1;
                       // echo 'Newusertestid is'.$newtestid[0];
                             
                        //Insert into question table
                        $insert = sprintf("INSERT INTO Dim_Question (testid, qus_desc, qus_type, ans) VALUES 
                                                                    ($newtestid[0],
                                                                    '".$_POST['questdesc']."',
                                                                    '2opt',
                                                                    '".$_POST['correctAnswer']."') ;");
                                                                    
                       // echo 'Insert query in Dim_Question is '.$insert;
                        $sucess1 = $connection->query($insert) or die(mysqli_error($connection));  
                                      
                    if ($sucess1 === true) {
                        
                        $op = $_POST['options'];
                        $arrayOptions = explode(",",$op);
                        //echo $arrayOptions[0];
                                
                        foreach($arrayOptions as $tmpChar) {
                            if ($tmpChar!='') {
                                $optionsCounter++;
                            }
                        }

                        $sql = sprintf("SELECT max(qusid) FROM Dim_Question;");
                        
                        
                        $result = $connection->query($sql) or die(mysqli_error()); 
                        $newqusid = mysqli_fetch_row($result);
                       // $newqusid[0] = $newqusid[0]+1;
                                
                        //Insert into question table
                        $sql_op = sprintf("INSERT INTO Dim_Qus_Option (qusid,testid, tot_col, op1, op2, op3, op4, op5) 
                                                                    VALUES ($newqusid[0],
                                                                    $newtestid[0], 
                                                                    $optionsCounter, 
                                                                    '".$arrayOptions[0]."',
                                                                    '".$arrayOptions[1]."', 
                                                                    '".$arrayOptions[2]."', 
                                                                    '".$arrayOptions[3]."', 
                                                                    '".$arrayOptions[4]."'
                                                                                    ) ;");
                                                                                    
                      //  echo 'Does come into insert int dim_qus_option table '.$sql_op;
                        $sucess2 = $connection->query($sql_op) or die(mysqli_error($connection));      
                                        
                        if ($sucess2 === false){
                            die("Assessment details not inserted into database");
                            }else{
                                echo 'Question entered into DB';
                            }
                    
                    }
                             
                }
                
        mysqli_commit($connection);
        mysqli_close($connection);
     
        }
                
    catch(PDOException $e)
        {
            echo 'Cannot connect to database';
            exit;
        }
?>