<?php
    $serverName = "localhost";
    $username = "root";
    $password = "";
    $dbname = "onlinenewsportal";
    // Enter your host name, database username, password, and database name.
    // If you have not set database password on localhost then set empty.
    $con = mysqli_connect($serverName, $username, $password, $dbname);
    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>