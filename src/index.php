<?php
    // Set the target date and time for the fashion event
    $targetDate = strtotime("2023-06-01 18:00:00"); // Change this to your desired event date and time

    // Get the current date and time
    $currentDate = time();

    // Calculate the remaining time in seconds
    $remainingSeconds = $targetDate - $currentDate;

    // Calculate the remaining days, hours, minutes, and seconds
    $days = floor($remainingSeconds / (60 * 60 * 24));
    $hours = floor(($remainingSeconds % (60 * 60 * 24)) / (60 * 60));
    $minutes = floor(($remainingSeconds % (60 * 60)) / 60);
    $seconds = $remainingSeconds % 60;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">NINETY'S Nation</a>
            <div>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">ABOUT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">CONTACT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">WOMEN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">MEN</a>
                    </li>
                </ul>
                <!-- Login -->
                <div class="form">
                    <a href="login.php">LOGIN</a>
                    <a href="signup.php">REGISTER</a>
                </div>
            </div>
        </div>
    </nav>
    <main>
        <div class="container">
            <div class="container-item">
                <img class="animate__animated animate__fadeIn" src="http://localhost/fashionshop/images/high-rise-flare-jeans.jpg" alt="rise-flare-jeans-women">
            </div>
            <div class="container-item">
                <img class="animate__animated animate__fadeIn" src="https://cdn.shopify.com/s/files/1/0293/9277/products/DeAngeloTurtleneckSweater-Black_mer_2_360x.jpg?v=1644885629" alt="jumpsuit-women">
            </div>
            <div class="container-item">
                <img class="animate__animated animate__fadeIn" src="http://localhost/fashionshop/images/matching-sets.jpg" alt="matching-sets-women">
            </div>
        </div>
        <!-- Info -->
        <div class="info">
            <h2>NINETY'S NATION</h2>
            <p>Our mission is to provide you with the best quality clothing for the best price. We are a small company that is trying to grow and we hope you will be a part of our journey.</p>
        </div>
        <!-- Shop now button -->
        <div class="shop-now">
            <a href="men.php">SHOP FOR MEN</a>
            <a href="women.php">SHOP FOR WOMEN</a>
        </div>
        <div class="search">
            <input type="text" placeholder="Search">
            <input type="submit"></input>
        </div>
    </div>
        <div class="text">
            <h2>SHOP MORE FOR MEN</h2>
        </div>
        <div class="clothing-container">
            <?php

                class Database {

                    private $servername;
                    private $username;
                    private $password;
                    private $database;

                    public function __construct($servername, $username, $password, $database) {
                        $this->servername = $servername;
                        $this->username = $username;
                        $this->password = $password;
                        $this->database = $database;
                    }

                }

                $product1 = new Product(); 
                $product1->getProducts();

                class Product {

                    public function getProducts() {
                        // Establish a database connection
                        $conn = mysqli_connect('localhost', 'root', '', 'fashion-shop');
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }
                        
                        // Get all the products from the database
                        $sql = "SELECT * FROM products WHERE category = 1";
                        $result = mysqli_query($conn, $sql);
                    
                        // Loop through the results and display them in the HTML
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<div class="clothing-item">';
                                echo '<img src="' . $row['image'] . '" alt="' . $row['productName'] . '">';
                                    echo '<div>';
                                    echo '<h3>€' . $row['productPrice'] . '</h3>';
                                    echo '<h3>' . $row['productName'] . '</h3>';
                                    echo '<button type="submit">Add To Cart</button>';
                                echo '</div>';
                            echo '</div>';
                    }
                    
                        // Close the database connection
                        mysqli_close($conn);
                    }
                }
            ?>
        </div>
    </main>
    <div id="countdown-timer">
        <h2>Fashion Event Countdown</h2>
        <div id="timer">
            <div id="days"><?php echo $days; ?> Days</div>
            <div id="hours"><?php echo $hours; ?> Hours</div>
            <div id="minutes"><?php echo $minutes; ?> Minutes</div>
            <div id="seconds"><?php echo $seconds; ?> Seconds</div>
        </div>
    </div>
    <script>
        // Update the countdown timer every second
        setInterval(function () {
            // Get the remaining time elements
            var daysElement = document.getElementById('days');
            var hoursElement = document.getElementById('hours');
            var minutesElement = document.getElementById('minutes');
            var secondsElement = document.getElementById('seconds');

            // Decrement the remaining seconds by 1
            var seconds = parseInt(secondsElement.innerText);
            seconds -= 1;

            if (seconds < 0) {
                // If seconds become negative, set it to 59 and decrement minutes
                seconds = 59;

                var minutes = parseInt(minutesElement.innerText);
                minutes -= 1;

                if (minutes < 0) {
                    // If minutes become negative, set it to 59 and decrement hours
                    minutes = 59;

                    var hours = parseInt(hoursElement.innerText);
                    hours -= 1;

                    if (hours < 0) {
                        // If hours become negative, set it to 23 and decrement days
                        hours = 23;

                        var days = parseInt(daysElement.innerText);
                        days -= 1;

                        if (days < 0) {
                            // If days become negative, stop the timer
                            clearInterval();
                            return;
                        }

                        daysElement.innerText = days + ' Days';
                    }

                    hoursElement.innerText = hours + ' Hours';
                }

                minutesElement.innerText = minutes + ' Minutes';
            }

            secondsElement.innerText = seconds + ' Seconds';
        }, 1000); // Update the timer every 1 second
    </script>
    <main>
        <div class="text">
            <h2>SHOP MORE FOR WOMEN</h2>
        </div>
        <div class="clothing-container">
            <?php

                class Data {

                    private $servername;
                    private $username;
                    private $password;
                    private $database;

                    public function __construct($servername, $username, $password, $database) {
                        $this->servername = $servername;
                        $this->username = $username;
                        $this->password = $password;
                        $this->database = $database;
                    }

                }

                $product2 = new ProductWomen(); 
                $product2->getProducts();

                class ProductWomen {

                    public function getProducts() {
                        // Establish a database connection
                        $conn = mysqli_connect('localhost', 'root', '', 'fashion-shop');
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }
                        
                        // Get all the products from the database
                        $sql = "SELECT * FROM products WHERE category = 2";
                        $result = mysqli_query($conn, $sql);
                    
                        // Loop through the results and display them in the HTML
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<div class="clothing-item">';
                                echo '<img src="' . $row['image'] . '" alt="' . $row['productName'] . '">';
                                    echo '<div>';
                                    echo '<h3>€' . $row['productPrice'] . '</h3>';
                                    echo '<h3>' . $row['productName'] . '</h3>';
                                    echo '<button type="submit">Add To Cart</button>';
                                echo '</div>';
                            echo '</div>';
                    }
                    
                        // Close the database connection
                        mysqli_close($conn);
                    }
                }
            ?>
    </main>
    <footer>
        <div class="categories">
            <h3>Most asked questions</h3>
            <a href="./refund.php">Refund</a>
            <a href="./returning-package.php">Returning a package</a>
            <a href="./change-password.php">Change password</a>
        </div>
        <div class="categories">
            <h3>Policy</h3>
            <a href="./return-policy.php">Return Policy</a>
            <a href="./terms-and-conditions.php">Terms and Conditions</a>
            <a href="./privacy-policy.php">Privacy Policy</a>
        </div>
        <div class="categories">
            <h3>Online shopping</h3>
            <a href="./free-shipping.php">Free shipping</a>
            <a href="./free-return.php">Free return</a>
            <a href="./return-policy.php">30 Days returnpolicy</a>
        </div>
    </footer>
</body>
</html>