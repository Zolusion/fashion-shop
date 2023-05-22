<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Create</title>
</head>
<body>
    <div class="create">
        <h2>Read Product</h2>
    </div>
    <?php
        class Database {
            private $conn;

            function __construct($servername, $username, $password, $dbname) {
                $this->conn = mysqli_connect($servername, $username, $password, $dbname);
                if (!$this->conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
            }

            function getAllProducts() {
                $sql = "SELECT * FROM products";
                $result = mysqli_query($this->conn, $sql);
                $products = array();
                while ($row = mysqli_fetch_array($result)) {
                    $product = array(
                        "productName" => $row['productName'],
                        "image" => $row['image'],
                        "productPrice" => $row['productPrice'],
                        "productDescription" => $row['productDescription'],
                        "minimumQuantity" => $row['minimumQuantity'],
                        "maximumQuantity" => $row['maximumQuantity'],
                        "amount" => $row['amount'],
                        
                    );
                    $products[] = $product;
                }
                return $products;
            }
        }

        class ProductTable {
            private $db;

            function __construct($servername, $username, $password, $dbname) {
                $this->db = new Database($servername, $username, $password, $dbname);
            }

            function displayTable() {
                $products = $this->db->getAllProducts();
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
                    echo "</tr>";
                }
                echo "</tbody>
                    </table>";
            }
        }

        $productTable = new ProductTable("localhost", "root", "", "fashion-shop");
        $productTable->displayTable();
    ?>
</body>
</html>