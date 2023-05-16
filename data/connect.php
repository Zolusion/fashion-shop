<?php

function getConnection() {

    // Variables
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "fashion-shop";

    // Create connection
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);

    // Check connection
    if (!$conn) {
        error_log("Failed to establish database connection");
        return;
    }

    return $conn;

}