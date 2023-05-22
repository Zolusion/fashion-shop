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

        if($_SERVER["REQUEST_METHOD"] == "POSTS") {
            // Variables
            $customerEmail = $_POST['email'];
            $password = $_POST['password'];

            // Object
            $customer1 = new Customer(NULL, NULL, $customerEmail, NULL, NULL, NULL, $password, NULL, NULL );
            $customer1->searchCustomerByEmail($customerEmail);

            // Check if customer exists and verify password
            if ($customer1->getCustomerName() != NULL && password_verify($password, $customer1->getPassword())) {
                echo "Login successful! Welcome, " . $customer1->getCustomerName();
            } else {
                echo "Login failed. Invalid email or password.";
            }
        }
    ?>
</body>
</html>
