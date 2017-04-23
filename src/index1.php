/* 
	Developer: Sindhu Balakrishnan
	Description: PHP index file for MBTI application 

*/
<?php
    require_once('db_conn.php');
    require_once('show_ques.php');
    require_once('submit_asmt.php');
    
     try {
        $connection = connect_to_db();
        
        // prepare SQL
	//updated <19 APR 2017 >    added condition DT.testname='MBTI'   
        $sql = sprintf("SELECT DQ.qusid, DT.Testid, DQ.qus_desc, OPT.op1, OPT.op2
                            From Dim_Question DQ
                            INNER JOIN  Dim_Test DT ON DQ.testid= DT.testid
                            INNER JOIN Dim_Qus_Option OPT ON (DQ.testid=OPT.testid and DQ.qusid=OPT.qusid)
			    WHERE DT.testname='MBTI'
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
    
     
