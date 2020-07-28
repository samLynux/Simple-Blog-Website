<?php
    $host = "localhost";
    $username = "root";
    $dbname = "uts";
    $password = "";

    $db = new mysqli($host, $username, $password, $dbname);

    if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
    }
?>