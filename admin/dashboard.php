<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Europe',     11],
          ['North-America',      2],
          ['Africa',  2],
          ['South-America', 2],
          ['Asia',    7]
        ]);

        var options = {
          title: 'Visited customers'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
    <title>Admin dashboard</title>
</head>
<body>
    <div class="dashboard">
        <h2>Welcome to admin dashboard</h2>
    </div>
    <div class="sidebar">
        <h2>NINETY'S NATION</h2>
        <h3>Manage product</h3>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="create-product.php">Create product</a></li>
            <li><a href="read-product.php">Read product</a></li>
            <li><a href="update-product.php">Update product</a></li>
            <li><a href="delete-product.php">Delete product</a></li>
            <li><a href="view_order.php">View order</a></li>
            <li><a href="view_user.php">View user</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div id="piechart" style="width: 700px; height: 300px;"></div>
    <div class="note">
        <h2>NOTE: </h2>
        <p>
            This website is a project that is made by a group of 3 students 
            from Techniek College Rotterdam. The purpose of this website is
            to sell clothes online. The website is not real and the products
            are not real. The website is made for educational purposes only.
        </p>
    </div>
    <div class="home">
        <p>Go back to <a href="../src/index.php">homepage</a></p>
    </div>
    <div class="goals">
        <h2>Our mission</h2>
        <ul>
            <li>A Working database</li>
            <li>Trying to make an account</li>
            <li>Trying to login with the user account</li>
            <li>Searching for products</li>
            <li>Adding products to the shopping cart</li>
            <li>CRUD+S system</li>
        </ul>
    </div>
</body>
</html>