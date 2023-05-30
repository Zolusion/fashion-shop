<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Customer</title>
</head>
<body>
    <div class="create">
        <h2>Create Customer</h2>
    </div>

    <?php
        class CreateCustomer {

            // Connection
            private $servername;
            private $username;
            private $password;
            private $dbname;
            private $conn;

            // Constructor
            public function __construct($servername, $username, $password, $dbname) {
                $this->servername = $servername;
                $this->username = $username;
                $this->password = $password;
                $this->dbname = $dbname;

                // Create connection
                $this->conn = new mysqli($servername, $username, $password, $dbname);
                if($this->conn->connect_error) {
                    die("Connection failed: " . $this->conn->connect_error);
                }
            }

            // Create customer
            public function createCustomer() {
                echo "<form action='create-customer.php' method='POST' enctype='multipart/form-data'>'";
                echo "<input type='text' name='customerName' placeholder='Name' required>";
                echo "<input type='text' name='customerEmail' placeholder='Email' required>";
                echo "<input type='text' name='streetName' placeholder='Streetname' required>";
                echo "<input type='text' name='cityName' placeholder='City' required>";
                echo "<input type='text' name='postalcode' placeholder='Postal Code' required>";
                echo "<input type='password' name='password' placeholder='Password' required>";
                echo "<input type='text' name='role' placeholder='Role' required>";
                echo "<input type='submit' name='submit' value='Create Customer'>";
                echo "<br>";
                echo "<a href='dashboard.php'>Back to dashboard</a>";
                echo "</form>";

                // Create customer
                if(isset($_POST['submit'])) {
                    $customerName = $_POST['customerName'];
                    $customerEmail = $_POST['customerEmail'];
                    $streetName = $_POST['streetName'];
                    $cityName = $_POST['cityName'];
                    $postalcode = $_POST['postalcode'];
                    $password = $_POST['password'];
                    $role = $_POST['role'];

                    // Insert product
                    $sql = "INSERT INTO customers (customerName, customerEmail, streetName, cityName, postalcode, password, role) VALUES (?, ?, ?, ?, ?, ?, ?)";

                    // Prepare the statement
                    $stmt = $this->conn->prepare($sql);

                    // Check if the preparation was successful
                    if ($stmt === false) {
                        echo "Error preparing statement: " . $this->conn->error;
                        return;
                    }

                    // Bind parameters to statement
                    $stmt->bind_param("sssssss", $customerName, $customerEmail, $streetName, $cityName, $postalcode, $password, $role);

                    // Execute statement
                    if ($stmt->execute()) {
                        echo "<br>";
                        echo "Customer created successfully";
                    } else {
                        echo "Error creating customer: " . $stmt->error;
                    }

                    // Close statement
                    $stmt->close();
                }
            }

            // Close connection
            public function __destruct() {
                $this->conn->close();
            }
        }

        // Create customer
        $create = new createCustomer("localhost", "root", "", "fashion-shop");
        $create->createCustomer();
    ?>
</body>
</html>