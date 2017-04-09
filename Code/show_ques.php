<?php
    require_once('submit_asmt.php');
    
    function show_ques($sql, $connection)
    {   
         echo "<ol>\n";
        // execute query
        $result = $connection->query($sql) or die(mysqli_error());           
         
        // check whether we found a row
        $array = array();
        while ($row =  $result->fetch_assoc()) {
            $array[] = $row;
        }
        
        $itemcount = 0;
        $organizedArray = array();
        foreach ($array as $innerArray)
        {
        	foreach ($innerArray as $key => $value)
        	{
        		if ($key === 'QuestionID')
        		{
        			$questionId = $value;
        			$organizedArray[$questionId] = array();
        		}
        		else
        		{
        			$organizedArray[$questionId][$key] = $value;
        		}
                echo "<br><li>" . $organizedArray[$questionId][$key] . "</li><br>";
                echo "<input type='radio' name='selection'";
                    if ((isset($_POST['selection']) && $_POST['selection'] == "yes")) echo "checked";
                echo "value='yes'>Yes" ."<br>";
                echo "<input type='radio' name='selection'";
                    if ((isset($_POST['selection']) && $_POST['selection'] == "no")) echo "checked";
                echo "value='no'>No" ."<br>";

                $itemcount ++;

        	}
        	if ($itemcount == sizeof($array))
            {
                echo "<p style='text-indent: 10em;'>";
                echo "<input type='submit' name='SubmitAsmt' value='submit' />\n";
            }
        	else if ($itemcount % 2 == 0)
            {
        		echo "<p style='text-indent: 10em;'>";
                echo "<input type='submit' name='previous' value='<< prev' />\n";
                echo "<input type='submit' name='next' value='next >>' />"."<br><br>";
            }
        }
    }
         /* 
        while ($list = $result->fetch_assoc())
        {
           // echo "<li>" . implode($array[0].value) . "</li><br>";
        }
        echo "</ul>\n";
        */
    
    if(isset($_POST["SubmitAsmt"]))
    {
            $error = false;
    
            submit_asmt($sql, $connection);
    }
    
    /*
    if(isset($_POST["SubmitAsmt"]))
    {
        if (empty($_POST["selection"]))
            {
                $error = true;
                echo "Answer all questions before submitting";
            }
        else
            {
            $error = false;
            submit_asmt($sql, $connection);
            }
    }
    */

?>