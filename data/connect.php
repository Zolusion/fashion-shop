<?php

function getConnection() {

    // Variables
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "fashion-shop";

    // Create connection
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        // echo "Connected successfully";  
    }
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

}