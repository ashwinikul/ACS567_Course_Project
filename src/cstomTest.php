<?php
            require_once('db_conn.php');
            //require_once('test.php');

            
             try {
                $connection = connect_to_db();
                
                // prepare SQL
                $sql = sprintf("SELECT DISTINCT testid, testname
                                    From Dim_Test where testname <> 'MBTI' ORDER BY  testname;
                                    ");
                $result = $connection->query($sql) or die(mysqli_error());
               
               session_start(); // session start


                    echo "<br><br><div align= 'center'  style = 'font: normal 20px/150% Arial, Helvetica, sans-serif;'><fieldset  style='width: 50%;'>Dear Visiter,<br>Following assessments are made by users. They are not related to our main provided assessment 'MBTI'. Feel free to take following Test. Have fun.........!</fieldset></div><br><br>";
                    echo "<div align= 'center' style = 'font: normal 20px/150% Arial, Helvetica, sans-serif;'> -: Customized Assessments :- </div>";
                    echo "<div class='datagrid' style = 'font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden;'>";
                    echo "<table align= 'center' style = 'border-collapse: collapse; text-align: left; width: 50%;'>";


                $count =1;
               while ($row =  $result->fetch_assoc()) {
                    $id = $row['testid']; 
                    if ($count%2 ==0)
                    {
                       echo "<tr class='alt'  style = 'color: #7D7D7D; font-size: 13px;border-bottom: 1px solid #E1EEF4;font-weight: normal; '><td>".$row['testname']."</td><td><a href='sessionSet.php?c_testid=".$id."' class='link_path' data-target='test' id=".$id.">Take Test</a>";
                     
                    }
                    else
                    {
                        echo "<tr class='alt' style = 'color: #7D7D7D; font-size: 13px;border-bottom: 1px solid #E1EEF4;font-weight: normal; background: #EBEBEB;'><td>".$row['testname']."</td><td><a href='sessionSet.php?c_testid=".$id."' class='link_path' data-target='test' id=".$id.">Take Test</a>";
                    
                    }
                    $count=$count +1;
                    
                    //echo "".$row['testname']."</li><br>";
                    //echo "</td><td>";
                    //echo "<br><li class='link_path'><a href='test.php' >Take Test</a></li><br>";
                    echo "</td><tr>";
                    //$url= "test.php?c_testid=" + $id;
                    //echo "<br><li><a href='test.php' data-target='test' class='link_path' id=".$id.">".$row['testname']."</a></li><br>";
                   // echo "<br><li><a href='test.php?c_testid=".(string)$row['testid']."' > . $row['testname'] .</a></li><br>";
                   
                }
                echo "</tbody></table></div>";
                
                mysqli_close($connection);
            
                }
                
            catch(PDOException $e)
                {
                    echo 'Cannot connect to database';
                    exit;
                }
?>
    
     
