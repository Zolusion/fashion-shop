<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Read Customer</title>
</head>
<body>
    <div class="create">
        <h2>Read Product</h2>
        <br>
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
            function getAllCustomers() {
                $sql = "SELECT * FROM customers";
                $result = mysqli_query($this->conn, $sql);
                $customers = array();

                // Fetch one and one row
                while ($row = mysqli_fetch_array($result)) {
                    $customer = array(
                        "customerName" => $row['customerName'],
                        "customerEmail" => $row['customerEmail'],
                        "streetName" => $row['streetName'],
                        "cityName" => $row['cityName'],
                        "postalCode" => $row['postalCode'],
                        "password" => $row['password'],
                        "role" => $row['role'],
                    );

                    // Push customer to customers array
                    $customers[] = $customer;
                }

                // Return customers array
                return $customers;
            }
        }

        // Display table
        class CustomersTable {

            // Properties
            private $db;

            // Methods
            function __construct($servername, $username, $password, $dbname) {
                $this->db = new Database($servername, $username, $password, $dbname);
            }

            // Display Customers Table
            function displayCustomersTable() {

                // Get all customers
                $customers = $this->db->getAllCustomers();
                echo "<table class='table table-striped'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th scope='col'>Name</th>";
                echo "<th scope='col'>Email</th>";
                echo "<th scope='col'>Streetname</th>";
                echo "<th scope='col'>City</th>";
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
                    echo "<td>";
                    echo "<a href='update-customer.php?customerName=". $customer['customerName'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                    echo "<a href='delete-customer.php?customerName=". $customer['customerName'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                    echo "</td>";
                    echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
            }
        }

        // Create table object and display table
        $customerTable = new CustomersTable("localhost", "root", "", "fashion-shop");
        $customerTable->displayCustomersTable();
    ?>
</body>
</html>