<?php

class Connect {
    
    // Properties
    private $localhost = "localhost";
    private $servername = "root";
    private $password = "";
    private $dbname = "fashion-shop";
    
    // Database PDO connection
    public function connect() {
        try {
            $dsn = "mysql:host=" . $this->localhost . ";dbname=" . $this->dbname;
            $pdo = new PDO($dsn, $this->servername, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    // Close connection
    public function closeConnection($pdo) {
        $pdo = null;
    }
}