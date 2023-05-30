<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Update Product</title>
</head>
<body>
    <div class="create">
        <h2>Update Product</h2>
        <br>
    </div>
    
    <?php
        
        class Database
        {
            // Properties
            private $conn;
        
            // Methods
            public function __construct($servername, $username, $password, $dbname)
            {
                $this->conn = new mysqli($servername, $username, $password, $dbname);
                if ($this->conn->connect_error) {
                    die("Connection failed: " . $this->conn->connect_error);
                }
            }
        
            // Get all products
            public function getAllProducts()
            {
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
        
            // Update product
            public function updateProduct($productName, $data)
            {
                $updates = array();
                foreach ($data as $key => $value) {
                    $updates[] = "$key='$value'";
                }
                $updates = implode(", ", $updates);
        
                $sql = "UPDATE products SET $updates WHERE productName='$productName'";
        
                if ($this->conn->query($sql) === TRUE) {
                    return true;
                } else {
                    return "Error updating product: " . $this->conn->error;
                }
            }
        
            // Close connection
            public function closeConnection()
            {
                $this->conn->close();
            }
        }
        
        // Create table
        class UpdateTable {

            // Properties
            public $db;

            // Methods
            public function __construct($servername, $username, $password, $dbname)
            {
                $this->db = new Database($servername, $username, $password, $dbname);
            }

            // Display table
            public function displayToUpdateProductTable()
            {
                $products = $this->db->getAllProducts();

                if (empty($products)) {
                    echo "No products found.";
                    return;
                }

                // Display table
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
                    echo "<td><a href='update-product.php?productName=" . $product['productName'] . "'>Update</a></td>";
                    echo "</tr>";
                }

                echo "</tbody>
                    </table>";
            }

            // Update product
            public function updateProduct($productName, $data)
            {
                $result = $this->db->updateProduct($productName, $data);

                if ($result === true) {
                    echo "Product updated successfully.";
                } else {
                    echo $result;
                }
            }
        }

        // Update product page
        if (isset($_GET['productName'])) {
            $productName = $_GET['productName'];
            $updateTable = new UpdateTable("localhost", "root", "", "fashion-shop");

            if (isset($_POST['submit'])) {
                $data = array(
                    "productName" => $_POST['productName'], 
                    "image" => $_POST['image'],
                    "productPrice" => $_POST['productPrice'],
                    "productDescription" => $_POST['productDescription'],
                    "minimumQuantity" => $_POST['minQuantity'],
                    "maximumQuantity" => $_POST['maxQuantity'],
                    "amount" => $_POST['amount']
                );

                $updateTable->updateProduct($productName, $data);
            }

            // Fetch product details
            $productDetails = $updateTable->db->getAllProducts($productName);

            // Display form
            if ($productDetails) {
                echo "<form action='update-product.php?productName=" . $productName . "' method='POST'>";
                echo "<input type='text' name='productName' value='" . $productName . "'>";
                echo "<input type='text' name='image' value='" . $productDetails[0]['image'] . "'><br>";
                echo "<input type='text' name='productPrice' value='" . $productDetails[0]['productPrice'] . "'><br>";
                echo "<input type='text' name='productDescription' value='" . $productDetails[0]['productDescription'] . "'><br>";
                echo "<input type='text' name='minQuantity' value='" . $productDetails[0]['minimumQuantity'] . "'><br>";
                echo "<input type='text' name='maxQuantity' value='" . $productDetails[0]['maximumQuantity'] . "'><br>";
                echo "<input type='text' name='amount' value='" . $productDetails[0]['amount'] . "'><br>";
                echo "<input type='submit' name='submit' value='Update'>";
                echo "</form>";
            } else {
                echo "Product not found.";
            }

            // Close connection
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