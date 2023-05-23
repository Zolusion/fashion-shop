<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Create Product</title>
</head>
<body>
    <div class="create">
        <h2>Create Product</h2>
    </div>
    <?php
        class Create {

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

            // Create product
            public function createProduct() {
                echo "<form action='create-product.php' method='POST' enctype='multipart/form-data'>'";
                echo "<input type='text' name='productName' placeholder='Product Name' required>";
                echo "<input type='text' name='image' placeholder='Image' required>";
                echo "<input type='decimal' name='productPrice' placeholder='Price' required>";
                echo "<input type='text' name='productDescription' placeholder='Description' required>";
                echo "<input type='text' name='minQuantity' placeholder='Minimum Quantity' required>";
                echo "<input type='text' name='maxQuantity' placeholder='Maximum Quantity' required>";
                echo "<input type='text' name='productAmount' placeholder='Amount' required>";
                echo "<input type='submit' name='submit' value='Create Product'>";
                echo "</form>";

                if(isset($_POST['submit'])) {
                    $productName = $_POST['productName'];
                    $image = $_POST['image'];
                    $productPrice = $_POST['productPrice'];
                    $productDescription = $_POST['productDescription'];
                    $minQuantity = $_POST['minQuantity'];
                    $maxQuantity = $_POST['maxQuantity'];
                    $productAmount = $_POST['productAmount'];

                    $sql = "INSERT INTO products (productName, image, productPrice, productDescription, minimumQuantity, maximumQuantity, amount) VALUES ('$productName', '$image', '$productPrice', '$productDescription', '$minQuantity', '$maxQuantity', '$productAmount')";

                    if($this->conn->query($sql) === TRUE) {
                        echo "<script>alert('Product created successfully!')</script>";
                    } else {
                        echo "Error: " . $sql . "<br>" . $this->conn->error;
                    }
                }
            }

            // Close connection
            public function __destruct() {
                $this->conn->close();
            }
        }

        $create = new Create("localhost", "root", "", "fashion-shop");
        $create->createProduct();
    ?>
</body>
</html>