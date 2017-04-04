<?php
    function show_ques($sql, $connection)
    {   
         echo "<ul>\n";
        // execute query
        $result = $connection->query($sql) or die(mysqli_error());           
    
        // check whether we found a row
        while ($list = $result->fetch_assoc())
        {
            echo "<li>" . implode($list) . "</li><br>";
            echo "<input type='radio' name='selection'";
                if ((isset($_POST['selection']) && $_POST['selection'] == "yes")) echo "checked";
            echo "value='yes'>Yes" ."<br>";
            
            echo "<input type='radio' name='selection'";
                if ((isset($_POST['selection']) && $_POST['selection'] == "no")) echo "checked";
            echo "value='no'>No";
            
            echo "<p style='text-indent: 10em;'>";
            echo "<input type='submit' name='previous' value='<< prev' />\n";
            echo "<input type='submit' name='next' value='next >>' />"."<br><br>";
        }
        echo "</ul>\n";
    }

?>