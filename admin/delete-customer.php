<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Customer</title>
</head>
<body>
    <div class="create">
        <h2>Delete Customer</h2>
        <br>
    </div>

    <?php
        class Database {

            // Properties
            private $conn;

            // Methods
            public function __construct($servername, $username, $password, $dbname) {
                $this->conn = new mysqli($servername, $username, $password, $dbname);
                if ($this->conn->connect_error) {
                    die("Connection failed: " . $this->conn->connect_error);
                }
            }

            // Get all customers
            public function getAllCustomers() {
                $sql = "SELECT * FROM customers";
                $result = $this->conn->query($sql);
                $customers = array();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $customers[] = $row;
                    }
                }

                return $customers;
            }

            // Delete customer
            public function deleteCustomer($customerName) {
                $sql = "DELETE FROM customers WHERE customerName='$customerName'";

                if ($this->conn->query($sql) === TRUE) {
                    return true;
                } else {
                    return "Error deleting customer: " . $this->conn->error;
                }
            }

            // Close connection
            public function closeConnection() {
                $this->conn->close();
            }
        }

        class UpdateCustomer {

            // Properties
            public $db;

            // Methods
            public function __construct($servername, $username, $password, $dbname) {
                $this->db = new Database($servername, $username, $password, $dbname);
            }

            // Display Table
            public function displayUpdateCustomerTable() {
                $customers = $this->db->getAllCustomers();

                if (empty($customers)) {
                    echo "No Customers found";
                    return;
                }

                echo "<table class='table table-striped table-hover'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th scope='col'>Customer Name</th>";
                echo "<th scope='col'>Customer Email</th>";
                echo "<th scope='col'>Street name</th>";
                echo "<th scope='col'>City Name</th>";
                echo "<th scope='col'>Postal Code</th>";
                echo "<th scope='col'>Password</th>";
                echo "<th scope='col'>Role</th>";
                echo "<th scope='col'>Action</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                // Display customers
                foreach ($customers as $customer) {
                    echo "<tr>";
                    echo "<td>" . $customer['customerName'] . "</td>";
                    echo "<td>" . $customer['customerEmail'] . "</td>";
                    echo "<td>" . $customer['streetName'] . "</td>";
                    echo "<td>" . $customer['cityName'] . "</td>";
                    echo "<td>" . $customer['postalCode'] . "</td>";
                    echo "<td>" . $customer['password'] . "</td>";
                    echo "<td>" . $customer['role'] . "</td>";
                    echo "<td><a href='delete-customer.php?customerName=" . $customer['customerName'] . "'><button type='button' class='btn btn-danger'>Delete</button></a></td>";
                    echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
            }

            // Delete customer
            public function deleteCustomer($customerName) {
                $result = $this->db->deleteCustomer($customerName);

                if ($result === true) {
                    echo "<div class='alert alert-success' role='alert'>Customer deleted successfully</div>";
                    echo "<a href='delete-customer.php'><button type='button' class='btn btn-primary'>Back</button></a>";
                } else {
                    echo "<div class='alert alert-danger' role='alert'>$result</div>";
                }
            }
        }

        if(isset($_GET['customerName'])) {
            $customerName = $_GET['customerName'];
            $UpdateCustomer = new UpdateCustomer("localhost", "root", "", "fashion-shop");

            $UpdateCustomer->deleteCustomer($customerName);

            $UpdateCustomer->db->closeConnection();
        } else {

            $UpdateCustomer = new UpdateCustomer("localhost", "root", "", "fashion-shop");
            $UpdateCustomer->displayUpdateCustomerTable();
            $UpdateCustomer->db->closeConnection();
        }
    ?>
</body>
</html>