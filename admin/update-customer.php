<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Update Customer</title>
</head>
<body>
    <div class="create">
        <h2>Update Customer</h2>
    </div>

    <?php
        class Database {

            // Properties
            private $conn;

            // Methods
            function __construct($servername, $username, $password, $dbname) {
                $this->conn = mysqli_connect($servername, $username, $password, $dbname);
                if (!$this->conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
            }

            // Get all customers
            public function getAllCustomers() 
            {
                // Prepare SQL statement
                $sql = "SELECT * FROM customers";
                $result = mysqli_query($this->conn, $sql);
                $customers = array();

                // Fetch all rows from the result
                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $customers[] = $row;
                    }
                }

                return $customers;
            }

            // Update customer
            public function updateCustomer($customerName, $customerEmail, $streetName, $cityName, $postalCode, $password, $role) {
                $sql = "UPDATE customers SET customerName='$customerName', customerEmail='$customerEmail', streetName='$streetName', cityName='$cityName', postalCode='$postalCode', password='$password', role='$role' WHERE customerEmail='$customerEmail'";
                $result = mysqli_query($this->conn, $sql);

                if($result) {
                    echo "Customer updated successfully";
                } else {
                    echo "Error updating customer: " . mysqli_error($this->conn);
                }
            }
            
            // Close connection
            public function closeConnection()
            {
                $this->conn->close();
            }
        }

        class UpdateCustomerTable {

            // Properties
            public $db;

            // Methods
            public function __construct($servername, $username, $password, $dbname)
            {
                $this->db = new Database($servername, $username, $password, $dbname);
            }

            // Display Table
            public function displayCustomerTable() {
                $customers = $this->db->getAllCustomers();

                // Check if there are any customers
                if(empty($customers)) {
                    echo "No customers found.";
                    return;
                }

                // Display customers in a table
                echo "<table class='table table-striped table-hover'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th scope='col'>Customer Name</th>";
                echo "<th scope='col'>Customer Email</th>";
                echo "<th scope='col'>Street Name</th>";
                echo "<th scope='col'>City Name</th>";
                echo "<th scope='col'>Postal Code</th>";
                echo "<th scope='col'>Password</th>";
                echo "<th scope='col'>Role</th>";
                echo "<th scope='col'>Action</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                // Loop through each customer and display data in a new row
                foreach($customers as $customer) {
                    echo "<tr>";
                    echo "<td>" . $customer['customerName'] . "</td>";
                    echo "<td>" . $customer['customerEmail'] . "</td>";
                    echo "<td>" . $customer['streetName'] . "</td>";
                    echo "<td>" . $customer['cityName'] . "</td>";
                    echo "<td>" . $customer['postalCode'] . "</td>";
                    echo "<td>" . $customer['password'] . "</td>";
                    echo "<td>" . $customer['role'] . "</td>";
                    echo "<td>";
                    echo "<a href='update-customer.php?customerName=" . $customer['customerName'] . "' class='btn btn-primary'>Update</a>";
                    echo "</td>";
                    echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
            }

            // Update customer
            public function updateCustomer($customerName, $data) 
            {
                // Check if customer name is empty
                $result = $this->db->updateCustomer($customerName, $data);

                // Check if customer was updated successfully
                if ($result === true) {
                    echo "Customer updated successfully.";
                } else {
                    echo $result;
                }
            }
        }

        // Create new instance of UpdateCustomerTable
        if (isset($_GET['customerName'])) {
            $customerName = $_GET['customerName'];
            $UpdateCustomerTable = new UpdateCustomerTable('localhost', 'root', '', 'fashion-shop');

            // Check if form was submitted
            if (isset($_POST['submit'])) {
                $data = array(
                    'customerName' => $_POST['customerName'],
                    'customerEmail' => $_POST['customerEmail'],
                    'streetName' => $_POST['streetName'],
                    'cityName' => $_POST['cityName'],
                    'postalCode' => $_POST['postalCode'],
                    'password' => $_POST['password'],
                    'role' => $_POST['role']
                );

                // Update customer
                $UpdateCustomerTable->updateCustomer($customerName, $data);
            }

            // Get customer details
            $customerDetails = $UpdateCustomerTable->db->getAllCustomers($customerName);

            // Check if customer exists
            if ($customerDetails) {
                echo "<form action='update-customer.php?customerName=" . $customerName . "' method='POST'>";
                echo "<input type='text' name='Name' value='" . $customerName . "'>";
                echo "<input type='text' name='Email' value='" . $customerDetails[0]['customerEmail'] . "'><br>";
                echo "<input type='text' name='streetName' value='" . $customerDetails[0]['streetName'] . "'><br>";
                echo "<input type='text' name='City' value='" . $customerDetails[0]['cityName'] . "'><br>";
                echo "<input type='text' name='Postal Code' value='" . $customerDetails[0]['postalCode'] . "'><br>";
                echo "<input type='password' name='Password' value='" . $customerDetails[0]['password'] . "'><br>";
                echo "<input type='text' name='Role' value='" . $customerDetails[0]['role'] . "'><br>";
                echo "<input type='submit' name='submit' value='Update'>";
                echo "</form>";
            } else {
                echo "Customer not found.";
            }

            // Close connection
            $UpdateCustomerTable->db->closeConnection();
        } else {
            $UpdateCustomerTable = new UpdateCustomerTable("localhost", "root", "", "fashion-shop");
            $UpdateCustomerTable->displayCustomerTable();
            $UpdateCustomerTable->db->closeConnection();
        }
    ?>
</body>
</html>