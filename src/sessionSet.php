<?php
    echo "<h2> Thankyou for taking up the Personality Test! </h2>";
    session_start(); 
    $_SESSION['s_testid']=$_GET['c_testid'];
    $testid=$_SESSION['c_testid'];
    echo "Test ID=:".$testid;
    header("Location: assessment.html");
    // session_start(); // session start
     //$c_testid = $_SESSION['c_testid']; 
     //echo "<p> Test_Id =".(string)$c_testid." </p>";
?>