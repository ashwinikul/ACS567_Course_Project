/* 
	Developer: Sindhu Balakrishnan
	Description: PHP page for displaying MBTI questionnaire. 

*/
<?php
   require_once('submit_asmt.php');

    function show_ques($sql, $connection)
    {  
        $divCnt =0;
        $organizedArray = array(array("0","0","0"));

         echo "<ol>\n";
        // execute query
        $result = $connection->query($sql) or die(mysqli_error());           
         
        // check whether we found a row
        $array = array();
        while ($row =  $result->fetch_assoc()) {
            $array[] = $row;
	    // Updated <19 Jul 2017>
	    $s_testid = $row['Testid'] ;
        }
	// Updated <19 APR 2017> Setting up session variables
	session_start(); // session start
        $_SESSION['s_testid']=$s_testid ;   
        
        $itemcount = 0;
                echo "<script>disableSubmit();</script>";
		echo "<script>funcsizeofQSet(".sizeof($array).");</script>";																															  
        echo "<div id='set0'";

        
		$itemno=1;		  
        foreach ($array as $innerArray)
        {
        	foreach ($innerArray as $key => $value)
        	{
        		if ($key === 'qusid')
        		{
        		    echo "<br><li>" .$itemno++. ". " . $innerArray['qus_desc'] . "</li><br><br>";
        		    echo "<div>";
                    echo "<input type='radio' name='selection_".$innerArray['qusid']."' value='1' onclick='answeredCounter()'>" . $innerArray['op1'] ."<br>";
                    echo "<input type='radio' name='selection_".$innerArray['qusid']."' value='2' onclick='answeredCounter()'>" . $innerArray['op2'] ."<br>";
                    echo "</div>";
                    echo "<input type='hidden' name='qusid' value='".$innerArray['qusid']."'>";
                    
        		}
        		else
        		{
        			$innerArray[$key] = $value;
        			echo "<input type='hidden' name='testid' value='".$innerArray['Testid']."'>";
        		}
        		
        	}
        	array_push($organizedArray,array($innerArray['Testid'],$innerArray['qusid']));
        	
        	$itemcount ++;
        	
        	if ($itemcount == sizeof($array))
            {
                echo "<p style='text-indent: 10em;  margin: 0;'>";
				echo "<input type='hidden' name='sizeOfQSet' value='".sizeof($array)."'>";						  
                echo "<input type='submit' name='SubmitAsmt' value='Submit Assessment' data-target='submit_asmt' id='button' />\n";
            }
                
        	else if ($itemcount % 5 == 0)
            {
                echo "</div>";
        		echo "<p id='slide' style='text-indent: 10em;'>";
                echo "<input type='button' id='next".$divCnt."' name='next' value='Next' onclick='nextButton(".++$divCnt.")' />"."<br><br>";
                echo "<script>hideSet(" .$divCnt. ");</script>";
                echo "<div id=set".$divCnt.">";
            }
        }

        $serialized = htmlspecialchars(serialize($organizedArray));
        echo "<input type=\"hidden\" name=\"ArrayData\" value=\"$serialized\"/>";
    
    }
        if(isset($_POST["SubmitAsmt"]))
        {
            submit_asmt($_POST['testid']);
        }
        
        if(isset($_POST["previous"]))
        {
            //echo "<script type=\"text/javascript\">";
            //echo "alert(\"Hi\");";
           // echo "</script>";
            echo "<script type=\"text/javascript\">  $(\".toggle\").click(function(e){ e.preventDefault(); $(\"#slide\").slideToggle(); });";
	        echo "</script>";
        }
?>

