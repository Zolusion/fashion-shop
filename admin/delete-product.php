<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
</head>
<body>
    <div class="create">
        <h2>Delete Product</h2>
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

            // Get all products
            public function getAllProducts() {
                $sql = "SELECT * FROM products";
                $result = $this->conn->query($sql);
                $products = array();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $products[] = $row;
                    }
                }

                return $products;
            }

            // Delete product
            public function deleteProduct($productName) {
                $sql = "DELETE FROM products WHERE productName='$productName'";

                if ($this->conn->query($sql) === TRUE) {
                    return true;
                } else {
                    return "Error deleting product: " . $this->conn->error;
                }
            }

            // Close connection
            public function closeConnection() {
                $this->conn->close();
            }
        }

        class UpdateTable {

            // Properties
            public $db;

            // Methods
            public function __construct($servername, $username, $password, $dbname) {
                $this->db = new Database($servername, $username, $password, $dbname);
            }

            // Display table
            public function displayToUpdateProductTable() {
                $products = $this->db->getAllProducts();

                if (empty($products)) {
                    echo "No products found.";
                    return;
                }

                echo "<table class='table table-striped table-hover'>
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Image</th>
                                <th>Product Price</th>
                                <th>Product Description</th>
                                <th>Minimum Quantity</th>
                                <th>Maximum Quantity</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>";

                // Display products
                foreach ($products as $product) {
                    echo "<tr>";
                    echo "<td>" . $product['productName'] . "</td>";
                    echo "<td>" . $product['image'] . "</td>";
                    echo "<td>" . $product['productPrice'] . "</td>";
                    echo "<td>" . $product['productDescription'] . "</td>";
                    echo "<td>" . $product['minimumQuantity'] . "</td>";
                    echo "<td>" . $product['maximumQuantity'] . "</td>";
                    echo "<td>" . $product['amount'] . "</td>";
                    echo "<td><a href='delete-product.php?productName=" . $product['productName'] . "'>Delete</a></td>";
                    echo "</tr>";
                }

                echo "</tbody>
                    </table>";
            }

            // Delete product
            public function deleteProduct($productName) {
                $result = $this->db->deleteProduct($productName);

                if ($result === true) {
                    echo "Product deleted successfully.";
                } else {
                    echo $result;
                }
            }
        }

        // Delete product page
        if (isset($_GET['productName'])) {
            $productName = $_GET['productName'];
            $updateTable = new UpdateTable("localhost", "root", "", "fashion-shop");

            $updateTable->deleteProduct($productName);

            $updateTable->db->closeConnection();
        } else {
            // Display product table
            $updateTable = new UpdateTable("localhost", "root", "", "fashion-shop");
            $updateTable->displayToUpdateProductTable();
            $updateTable->db->closeConnection();
        }
        

    ?>

</body>
</html>