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

        $customerEmail=$_POST['email'];
        $password=$_POST['password'];

        $customer = new Customer($customerEmail, $password);
        $customer->signup($conn);

        // Print the result
        echo "Customer is logged in successfully! </br>";
        $customer->printCustomer();

        echo '<a href="./index.php">Go back to home page</a>';
    ?>
</body>
</html>
