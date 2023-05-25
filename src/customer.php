<?php

class Customer {

    // Properties
    protected $customerId;
    protected $customerName;
    protected $customerEmail;
    protected $password;
    protected $streetName;
    protected $cityName;
    protected $postalCode;
    protected $salt;
    protected $role;

    // Methods
    // public function __construct($customerId="", $customerName="", $customerEmail, $password, $streetName="", $cityName="", $postalCode="") {
        public function __construct($customerId="", $customerName="", $customerEmail="") {
        $this->customerId = $customerId;
        $this->customerName = $customerName;
        $this->customerEmail = $customerEmail;
        // $this->password = $password;
        // $this->streetName = $streetName;
        // $this->cityName = $cityName;
        // $this->postalCode = $postalCode;
    }

    // Setters
    public function setCustomerId($customerId) {
        $this->customerId = $customerId;
    }

    public function setCustomerName($customerName) {
        $this->customerName = $customerName;
    }

    public function setCustomerEmail($customerEmail) {
        $this->customerEmail = $customerEmail;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setStreetName($streetName) {
        $this->streetName = $streetName;
    }

    public function setCityName($cityName) {
        $this->cityName = $cityName;
    }

    public function setPostalCode($postalCode) {
        $this->postalCode = $postalCode;
    }

    public function setSalt($salt) {
        $this->salt = $salt;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    // Getters
    public function getCustomerId() {
        return $this->customerId;
    }

    public function getCustomerName() {
        return $this->customerName;
    }

    public function getCustomerEmail() {
        return $this->customerEmail;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getStreetName() {
        return $this->streetName;
    }

    public function getCityName() {
        return $this->cityName;
    }

    public function getPostalCode() {
        return $this->postalCode;
    }

    public function getSalt() {
        return $this->salt;
    }

    public function getRole() {
        return $this->role;
    }

    public function signup() {

        // // Includes
        // require_once '../data/connect.php';

        // // Get database connection
        // $conn = getConnection();
        // if (!$conn) {
        //     error_log("Failed to establish database connection");
        //     return;
        // }

        // // Variables
        // $customerEmail = $this->getCustomerEmail();
        // $password = $this->getPassword();
        // $salt = $this->getSalt();
        // $role = $this->getRole();

        // // Statement
        // $sql = $conn->prepare("
        //     INSERT INTO customers (customerEmail, password, salt, role)
        //     VALUES (:customerEmail, :password, :salt, :role)
        // ");

        // // Check if prepare() returned false
        // if (!$sql) {
        //     error_log("Failed to prepare SQL statement: " . $conn->errorInfo());
        //     return;
        // }

        // // Set variables in statements
        // $sql->bindParam(':customerEmail', $customerEmail);
        // $sql->bindParam(':password', $password);
        // $sql->bindParam(':salt', $salt);
        // $sql->bindParam(':role', $role);

        // // Execute statement
        // $sql->execute();

        // // Message 
        // echo "Customer created successfully<br>";

    }

    public function printCustomer() {

        // // Includes
        // require_once '../data/connect.php';

        // // Get database connection
        // $conn = getConnection();
        // if (!$conn) {
        //     error_log("Failed to establish database connection");
        //     return;
        // }

        // // Variables
        // $customerEmail = $this->getCustomerEmail();

        // // Statement
        // $sql = $conn->prepare("
        //     SELECT * FROM customers WHERE customerEmail = :customerEmail
        // ");

        // // Check if prepare() returned false
        // if (!$sql) {
        //     error_log("Failed to prepare SQL statement: " . $conn->errorInfo());
        //     return;
        // }

        // // Set variables in statements
        // $sql->bindParam(':customerEmail', $customerEmail);

        // // Execute statement
        // $sql->execute();

        // // Fetch result
        // $result = $sql->fetch();

    }

    public function createCustomer() {
        
        // Includes
        require_once '../data/connect.php';
        
        // Get database connection
        $conn = getConnection();
        $passwordHash = password_hash($wachtwoord, PASSWORD_DEFAULT);
        if (!$conn) {
            error_log("Failed to establish database connection");
            return;
        }

        // Variables
        $customerId = $this->getCustomerId();
        $customerName = $this->getCustomerName();
        $customerEmail = $this->getCustomerEmail();
        $password = $this->getPassword();
        $streetName = $this->getStreetName();
        $cityName = $this->getCityName();
        $postalCode = $this->getPostalCode();

    
        // Statement 
        $sql = $conn->prepare("
            INSERT INTO customers (customerId, customerName, customerEmail, password, streetName, cityName, postalCode)
            VALUES (:customerId, :customerName, :customerEmail, :password, :streetName, :cityName, :postalCode)
        ");

        // Check if prepare() returned false
        if (!$sql) {
            error_log("Failed to prepare SQL statement: " . $conn->errorInfo());
            return;
        }
    
        // Set variables in statements
        $sql->bindParam(':customerId', $customerId);
        $sql->bindParam(':customerName', $customerName);
        $sql->bindParam(':customerEmail', $customerEmail);
        $sql->bindParam(':password', $password);
        $sql->bindParam(':streetName', $streetName);
        $sql->bindParam(':cityName', $cityName);
        $sql->bindParam(':postalCode', $postalCode);
    
        // Execute statement
        $sql->execute();

        // Message 
        echo "Customer created successfully<br>";
    }
    
    public function readCustomer() {
            
        // Includes
        require_once '../data/connect.php';

        // Get database connection
        $conn = getConnection();
        if (!$conn) {
            error_log("Failed to establish database connection");
            return;
        }

        // Statement
        $sql = $conn->prepare("
            SELECT customerId, customerName, customerEmail, streetName, cityName, postalCode, password FROM customers
        ");

        // Execute statement
        $sql->execute();

        // Fetch data
        foreach($sql as $customer)
        {
            echo $customer["customerId"]. " - ";
            echo $customer["customerName"]. " - ";
            echo $customer["customerEmail"]. " - ";
            echo $customer["password"]. " - ";
            echo $customer["streetName"]. " - ";
            echo $customer["cityName"]. " - ";
            echo $customer["postalCode"]. " - ";

            echo "<br>";
        }
    }

    public function updateCustomer($customerId) {

        // Includes
        require_once '../data/connect.php';

        // Get database connection
        $conn = getConnection();
        if (!$conn) {
            error_log("Failed to establish database connection");
            return;
        }

        // Variables
        $customerId = $this->getCustomerId();
        $customerName = $this->getCustomerName();
        $customerEmail = $this->getCustomerEmail();
        $password = $this->getPassword();
        $streetName = $this->getStreetName();
        $cityName = $this->getCityName();
        $postalCode = $this->getPostalCode();

        // Statement
        $sql = $conn->prepare("
            UPDATE customers SET customerName = :customerName, customerEmail = :customerEmail, password = :password, streetName = :streetName, cityName = :cityName, postalCode = :postalCode WHERE customerId = :customerId
        ");

        // Set variables in statements
        $sql->bindParam(':customerId', $customerId);
        $sql->bindParam(':customerName', $customerName);
        $sql->bindParam(':customerEmail', $customerEmail);
        $sql->bindParam(':password', $password);
        $sql->bindParam(':streetName', $streetName);
        $sql->bindParam(':cityName', $cityName);
        $sql->bindParam(':postalCode', $postalCode);

        // Execute statement
        if (!$sql->execute()) {
            error_log("Failed to execute SQL statement: " . $sql->errorInfo());
            return;
        }
    }

    public function deleteCustomer($customerId) {

        // Includes
        require_once '../data/connect.php';

        // Get database connection
        $conn = getConnection();
        if (!$conn) {
            error_log("Failed to establish database connection");
            return;
        }

        // Statement
        $sql = $conn->prepare("
            DELETE FROM customers WHERE customerId = :customerId
        ");

        // Set variables in statements
        $sql->bindParam(':customerId', $customerId);

        // Execute statement
        $sql->execute();
    }

    public function searchCustomer($customerId) {

        // Includes
        require_once '../data/connect.php';

        // Get database connection
        $conn = getConnection();
        if (!$conn) {
            error_log("Failed to establish database connection");
            return;
        }

        // Statement
        $sql = $conn->prepare("
            SELECT * FROM customers WHERE customerId = :customerId
        ");

        // Set variables in statements
        $sql->bindParam(':customerId', $customerId);

        // Execute statement
        $sql->execute();

        // Object 
        foreach($sql as $customer)
        {
            $this->customerName = $customer["name"];
            $this->customerEmail = $customer["email"];
            $this->password = $customer["password"];
            $this->streetName = $customer["streetname"];
            $this->cityName = $customer["city"];
            $this->postalCode = $customer["postalCode"];
        }
    }
}