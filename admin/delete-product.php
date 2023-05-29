<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <div class="create">
        <h2>Delete Product</h2>
    </div>
    

    <?php

class Database {
    private $conn;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

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

    public function deleteProduct($productName) {
        $sql = "DELETE FROM products WHERE productName='$productName'";

        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return "Error deleting product: " . $this->conn->error;
        }
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

class UpdateTable {
    public $db;

    public function __construct($servername, $username, $password, $dbname) {
        $this->db = new Database($servername, $username, $password, $dbname);
    }

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