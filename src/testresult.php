<?php
    require_once('db_conn.php');
    session_start(); // session start
    $s_testid = $_SESSION['s_testid']; // session get
    $s_userid = $_SESSION['s_userid'];
    $s_emailid = $_SESSION['s_emailid'];
    
   
    
    $connection = connect_to_db();
                
                // prepare SQL
                $sql = sprintf("SELECT testid, userid, E_I, S_N, T_F, J_P, E_I_type, S_N_type, T_F_type, J_P_type, res, E, I, S, N, T, F, J, P FROM User_MBTI_Result WHERE 
                                testid=".htmlspecialchars($s_testid,ENT_QUOTES)." and userid=".htmlspecialchars($s_userid,ENT_QUOTES)."
                                LIMIT 1 ;
                                ");
            
                                    
                                    
    // execute query
    $result = $connection->query($sql) or die(mysqli_error());   
    //echo "<div>This is result page<div>";
    //echo "<div><br>" .$s_testid. "<br> ".$s_userid." <br>".$s_emailid."<br></div>";
    
    
    $stack = array();
    
    //print_r($stack);
    echo "<fieldset><div id='resultMBTI' align='center'>" ;
    echo "<table id='MBTIres'><tr><td align='center' valign='top' height='125' width='650' colspan='2'>";
    while($row = $result->fetch_assoc()) {
    array_push($stack, $row["E"],$row["I"],$row["S"],$row["N"],$row["T"],$row["F"],$row["J"],$row["P"]); 
    echo "<div><textarea name='resultMBTI' id='resultMBTI' rows='10' cols='60'  readonly style='border:groove 6px orange; color: green; background-color: lightyellow; font-family: cursive; font-size: 19px; font-style: italic; 	font-variant: normal; 	font-weight: bold'> Result : ".$row["res"]." </textarea><br /></div>";
    }
    echo "</td><td align='center' valign='top' height='125' width='650' colspan='2'>";
    echo "<div style ='background-color:white'><canvas width='600px' height='265px' id='graphs' style='border:groove 6px orange;'></canvas><div>";
    echo "</td></tr><tr><td align='center' valign='top' height='125' width='650' colspan='3'><div> <legend>Send result to your mail</legend><div><input type='text' name='email' size='60' value = ". $s_emailid ."><br><input type='submit' name='SendEmail' value='Send Email' data-target='send_email' class='send_email_bt' /></div></div></td></tr>";
    echo "</table>";
    echo "</div></fieldset>";
   // print_r($stack); 
    $datapoints =json_encode($stack,JSON_NUMERIC_CHECK);
   

?>
<script type="text/javascript" src="jQuery/RGraph.common.core.js"></script>
        <script type="text/javascript" src="jQuery/RGraph.bar.js"></script>

<script type="text/javascript">
            
            var dt = JSON.parse('<?= $datapoints; ?>');
            var chart=new RGraph.Bar('graphs',[dt[0],dt[1],dt[2],dt[3],dt[4],dt[5],dt[6],dt[7]]); //these are the values of bar chart that be drawn
            chart.Set('chart.colors',['blue']); // color of graph
            chart.Set('chart.title',"Personality"); //title for bar chart
            chart.Set('chart.labels', ["Extraver'n", "Introver'n", "Sensing", "Intuition","Thinking","Feeling","Judging","Perceiving"]); //these are the labels shown
            chart.Draw();
</script>