<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form 2</title>
</head>
<body>
    <?php

        // Includes
        include '../data/connect.php';
        include 'customer.php';

        // Variables
        $customerId = NULL;
        $customerEmail = $_POST['email'];
        $password = $_POST['password'];
        $salt = NULL;
        $role = NULL;

        // Object
        $customer1 = new Customer($customerEmail, $password, $salt, $role); // This is the object that will be used to create the customer
        $customer1->createCustomer(); // This is the method that creates the customer
        $customer1->readCustomer(); // This is just to check if the customer was created
        $customer1->updateCustomer($customerId); // This is the method that updates the customer
        $customer1->deleteCustomer($customerId); // This is the method that deletes the customer
        $customer1->searchCustomer($customerId); // This is the method that searches for the customer
    ?>
</body>
</html>