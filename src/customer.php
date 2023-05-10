<?php

class Customer {

    // Properties
    protected $customerId;
    protected $customerName;
    protected $customerEmail;
    protected $streetName;
    protected $cityName;
    protected $postalCode;
    protected $password;
    protected $salt;
    protected $role;

    // Methods
    public function __construct($customerId, $customerName, $customerEmail, $streetName, $cityName, $postalCode, $password, $salt, $role) {
        $this->customerId = $customerId;
        $this->customerName = $customerName;
        $this->customerEmail = $customerEmail;
        $this->streetName = $streetName;
        $this->cityName = $cityName;
        $this->postalCode = $postalCode;
        $this->password = $password;
        $this->salt = $salt;
        $this->role = $role;
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

    public function setStreetName($streetName) {
        $this->streetName = $streetName;
    }

    public function setCityName($cityName) {
        $this->cityName = $cityName;
    }

    public function setPostalCode($postalCode) {
        $this->postalCode = $postalCode;
    }

    public function setPassword($password) {
        $this->password = $password;
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

    public function getStreetName() {
        return $this->streetName;
    }

    public function getCityName() {
        return $this->cityName;
    }

    public function getPostalCode() {
        return $this->postalCode;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getSalt() {
        return $this->salt;
    }

    public function getRole() {
        return $this->role;
    }

    public function createCustomer() {

        // Includes
        require_once '../data/connect.php';

        // Variables
        $customerId = NULL;
        $customerName = $this->getCustomerName();
        $customerEmail = $this->getCustomerEmail();
        $streetName = $this->getStreetName();
        $cityName = $this->getCityName();
        $postalCode = $this->getPostalCode();
        $password = $this->getPassword();

        // Statement 
        $sql = $conn->prepare("
            INSERT INTO customers (customerId, customerName, customerEmail, streetName, cityName, postalCode, password)
            VALUES (:customerId, :customerName, :customerEmail, :streetName, :cityName, :postalCode, :password)
        ");

        // Set variables in statements
        $sql->bindParam(':customerId', $customerId);
        $sql->bindParam(':customerName', $customerName);
        $sql->bindParam(':customerEmail', $customerEmail);
        $sql->bindParam(':streetName', $streetName);
        $sql->bindParam(':cityName', $cityName);
        $sql->bindParam(':postalCode', $postalCode);
        $sql->bindParam(':password', $password);

        // Execute statement
        $sql->execute();

        // Message 
        echo "Customer created successfully";
    }

    public function readCustomer() {
            
        // Includes
        require_once '../data/connect.php';

        // Statement
        $sql = $conn->prepare("
            SELECT * FROM customers WHERE customerId, customerName, customerEmail, streetName, cityName, postalCode, password
        ");

        // Execute statement
        $sql->execute();

        foreach($sql as $customer)
        {
            echo $customer["customerId"]. " - ";
            echo $customer["customerName"]. " - ";
            echo $customer["customerEmail"]. " - ";
            echo $customer["streetName"]. " - ";
            echo $customer["cityName"]. " - ";
            echo $customer["postalCode"]. " - ";
            echo $customer["password"]. " - ";
            echo "<br>";
        }
    }

    public function updateCustomer($customerId) {

        // Includes
        require_once '../data/connect.php';

        // Variables
        $customerName = $this->getCustomerName();
        $customerEmail = $this->getCustomerEmail();
        $streetName = $this->getStreetName();
        $cityName = $this->getCityName();
        $postalCode = $this->getPostalCode();
        $password = $this->getPassword();

        // Statement
        $sql = $conn->prepare("
            UPDATE customers SET customerName = :customerName, customerEmail = :customerEmail, streetName = :streetName, cityName = :cityName, postalCode = :postalCode, password = :password WHERE customerId = :customerId
        ");

        // Set variables in statements
        $sql->bindParam(':customerId', $customerId);
        $sql->bindParam(':customerName', $customerName);
        $sql->bindParam(':customerEmail', $customerEmail);
        $sql->bindParam(':streetName', $streetName);
        $sql->bindParam(':cityName', $cityName);
        $sql->bindParam(':postalCode', $postalCode);
        $sql->bindParam(':password', $password);

    }

    public function deleteCustomer($customerId) {

        // Includes
        require_once '../data/connect.php';

        // Statement
        $sql = $conn->prepare("
            DELETE FROM customers WHERE customerId = :customerId, customerName = :customerName, customerEmail = :customerEmail, streetName = :streetName, cityName = :cityName, postalCode = :postalCode, password = :password
        ");

        // Set variables in statements
        $sql->bindParam(':customerId', $customerId);
        $sql->bindParam(':customerName', $customerName);
        $sql->bindParam(':customerEmail', $customerEmail);
        $sql->bindParam(':streetName', $streetName);
        $sql->bindParam(':cityName', $cityName);
        $sql->bindParam(':postalCode', $postalCode);
        $sql->bindParam(':password', $password);

        // Execute statement
        $sql->execute();
    }

    public function searchCustomer() {

        // Includes
        require_once '../data/connect.php';

        // Statement
        $sql = $conn->prepare("
            SELECT * FROM customers WHERE customerId = :customerId, customerName = :customerName, customerEmail = :customerEmail, streetName = :streetName, cityName = :cityName, postalCode = :postalCode, password = :password
        ");

        // Set variables in statements
        $sql->bindParam(':customerId', $customerId);
        $sql->bindParam(':customerName', $customerName);
        $sql->bindParam(':customerEmail', $customerEmail);
        $sql->bindParam(':streetName', $streetName);
        $sql->bindParam(':cityName', $cityName);
        $sql->bindParam(':postalCode', $postalCode);
        $sql->bindParam(':password', $password);

        // Execute statement
        $sql->execute();

        // Object 
        foreach($sql as $customer)
        {
            $this->customerName = $customer["customerName"];
            $this->customerEmail = $customer["customerEmail"];
            $this->streetName = $customer["streetName"];
            $this->cityName = $customer["cityName"];
            $this->postalCode = $customer["postalCode"];
            $this->password = $customer["password"];
        }
    }
}