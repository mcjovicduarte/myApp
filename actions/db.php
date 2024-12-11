<?php

// Set database credentials
$db_servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "linkUp";

try {
    // create a new connection instance
    $conn = new PDO("mysql:host=$db_servername;dbname=$db_name", $db_username, $db_password);

    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    
    echo "Connection failed: " . $e->getMessage();

}