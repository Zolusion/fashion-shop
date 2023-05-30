<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Order</title>
</head>
<body>
    <div class="create">
        <h2>View order</h2>
        <br>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Product Price</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product Amount</th>
                <th scope="col">Customer ID</th>
                <th scope="col">Article ID</th>
            </tr>
        </thead>
    </table>

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

            public function getOrders() {
                $sql = "SELECT * FROM orders";
                $result = $this->conn->query($sql);

                $orders = [];

                while ($row = $result->fetch_assoc()) {
                    $orders[] = [
                        'orderID' => $row['orderID'],
                        'productPrice' => $row['productPrice'],
                        'productName' => $row['productName'],
                        'productAmount' => $row['productAmount'],
                        'customerID' => $row['customerID'],
                        'articleID' => $row['articleID'],
                    ];
                }

                return $orders;
            }
        }

        class Orders {
            // Properties
            private $orderID;
            private $productPrice;
            private $productName;
            private $productAmount;
            private $customerID;
            private $articleID;

            // Methods
            public function __construct($orderID, $productPrice, $productName, $productAmount, $customerID, $articleID) {
                $this->orderID = $orderID;
                $this->productPrice = $productPrice;
                $this->productName = $productName;
                $this->productAmount = $productAmount;
                $this->customerID = $customerID;
                $this->articleID = $articleID;
            }

            public function getOrderID() {
                return $this->orderID;
            }

            public function getProductPrice() {
                return $this->productPrice;
            }

            public function getProductName() {
                return $this->productName;
            }

            public function getProductAmount() {
                return $this->productAmount;
            }

            public function getCustomerID() {
                return $this->customerID;
            }

            public function getArticleID() {
                return $this->articleID;
            }

            public function setOrderID($orderID) {
                $this->orderID = $orderID;
            }

            public function setProductPrice($productPrice) {
                $this->productPrice = $productPrice;
            }

            public function setProductName($productName) {
                $this->productName = $productName;
            }

            public function setProductAmount($productAmount) {
                $this->productAmount = $productAmount;
            }

            public function setCustomerID($customerID) {
                $this->customerID = $customerID;
            }

            public function setArticleID($articleID) {
                $this->articleID = $articleID;
            }

            public function __toString() {
                return $this->orderID . ' ' . $this->productPrice . ' ' . $this->productName . ' ' . $this->productAmount . ' ' . $this->customerID . ' ' . $this->articleID;
            }

            public function __destruct() {
                echo '<br>';
                echo 'Order ' . $this->orderID . ' has been deleted.';
            }

            public function viewOrder() {
                echo '<div class="container">';
                echo '<table class="table table-striped">';
                echo '<thead>';
                echo '<tr>';
                echo '<th scope="col">Order ID</th>';
                echo '<th scope="col">Product Price</th>';
                echo '<th scope="col">Product Name</th>';
                echo '<th scope="col">Product Amount</th>';
                echo '<th scope="col">Customer ID</th>';
                echo '<th scope="col">Article ID</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                echo '<tr>';
                echo '<td>' . $this->orderID . '</td>';
                echo '<td>' . $this->productPrice . '</td>';
                echo '<td>' . $this->productName . '</td>';
                echo '<td>' . $this->productAmount . '</td>';
                echo '<td>' . $this->customerID . '</td>';
                echo '<td>' . $this->articleID . '</td>';
                echo '</tr>';
                echo '</tbody>';
                echo '</table>';
                echo '</div>';
            }
        }

        // Retrieve orders from the database
        $database = new Database("localhost", "root", "", "fashion-shop");
        $orders = $database->getOrders();

        if (!empty($orders)) {
            echo '<table class="table table-striped">';
            echo '<thead>';
            echo '<tr>';
            echo '<th scope="col">Order ID</th>';
            echo '<th scope="col">Product Price</th>';
            echo '<th scope="col">Product Name</th>';
            echo '<th scope="col">Product Amount</th>';
            echo '<th scope="col">Customer ID</th>';
            echo '<th scope="col">Article ID</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            foreach ($orders as $order) {
                $orderObj = new Order(
                    $order['orderID'],
                    $order['productPrice'],
                    $order['productName'],
                    $order['productAmount'],
                    $order['customerID'],
                    $order['articleID']
                );

                echo '<tr>';
                echo '<td>' . $orderObj->getOrderID() . '</td>';
                echo '<td>' . $orderObj->getProductPrice() . '</td>';
                echo '<td>' . $orderObj->getProductName() . '</td>';
                echo '<td>' . $orderObj->getProductAmount() . '</td>';
                echo '<td>' . $orderObj->getCustomerID() . '</td>';
                echo '<td>' . $orderObj->getArticleID() . '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p style="padding: 5px; margin: 10px">There are no orders yet... <br> <a href="dashboard.php">Go back to dashboard</a></p>';
        }
    ?>

    <br>
</body>
</html>