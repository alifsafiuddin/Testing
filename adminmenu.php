<?php
include_once 'database.php';

$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


// Fetch data for the line chart (total amount of sales for all sellers)
$queryLineChart = "SELECT DATE_FORMAT(fld_order_date, '%Y-%m') as month_year, SUM(fld_amount) as total_amount FROM tbl_order_pasarsiswa GROUP BY month_year ORDER BY month_year";
$stmtLineChart = $conn->prepare($queryLineChart);
$stmtLineChart->execute();
$stmtLineChart->store_result(); // Store the result to use with num_rows

$dataPointsLineChart = array();
$stmtLineChart->bind_result($yearMonth, $totalAmount);
while ($stmtLineChart->fetch()) {
    // Extract year and month from the concatenated label
    list($year, $month) = explode('-', $yearMonth);
    $dataPointsLineChart[] = array("y" => $totalAmount, "label" => date('M Y', mktime(0, 0, 0, $month, 1, $year)));
}


// Query to get the total amount of sales per year
$sql = "SELECT YEAR(fld_order_date) AS order_year, SUM(fld_amount) AS total_amount FROM tbl_order_pasarsiswa GROUP BY order_year";
$result = mysqli_query($conn, $sql);

$yearly_data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $yearly_data[$row['order_year']] = $row['total_amount'];
}

// Query to get the total count of orders
$sql = "SELECT COUNT(*) as total_orders FROM tbl_order_pasarsiswa";
$result = mysqli_query($conn, $sql);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalOrders = $row['total_orders'];
} else {
    $totalOrders = 0; 
}

// Query to get the total count of orders
$sql = "SELECT COUNT(*) as total_sellers FROM tbl_seller_pasarsiswa";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalSellers = $row['total_sellers'];
} else {
    $totalSellers = 0; 
}

// Query to get the total count of products
$sql = "SELECT COUNT(*) as total_products FROM tbl_products_pasarsiswa";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalProducts = $row['total_products'];
} else {
    $totalProducts = 0; 
}

// Query to get the total count of orders
$sql = "SELECT COUNT(*) as total_customers FROM tbl_user_pasarsiswa";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalCustomers = $row['total_customers'];
} else {
    $totalCustomers = 0; 
}

$totalUsers = $totalCustomers + $totalSellers;

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PasarSISWA :Admin Menu</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style type="text/css"> 
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap');

*{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: sans-serif;
    text-decoration: none;
    transition: 0.3s;
}
body{
    background: #e9eaf0;
}
section .container{
    margin: 1em;
    width: 100%;
}
section .side-nav{
    width: 30%;
    height:1300px;
    background-color: #B5B7B8; 
}
section .side-bar-option{
    width: 50%;
    height:100%;
    background-color: #e9eaf0; 
}
section .product-option ul li{
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap: 1rem;
    background-color: #B5B7B8;
}


header{
    background-color: #5FFA3D;
    background-image: linear-gradient(0deg, #5FFA3D, #2AA1A3);
    height: 125px;
}
header nav{
    width: 100%;
    margin: auto;
}
header nav .logo-search{ 
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-block: 35px;
}
header nav .logo-search .logo{ 
    color: #fff;
    text-transform: lowercase;
    font-size: 35px;
    font-weight: bold;
    padding-left: 30px;
}
header nav .logo-search .logo span{ 
    color: #fff;
    text-transform: uppercase;
    font-size: 35px;
    font-weight: bold;
}
header nav .logo-search .icon a{  
    color: #fff;
    margin-left: 10px;
    font-size: 25px;
}
header nav .logo-search .icon span{
    color: #fff;
    margin-left: 10px;
    font-size: 15px;
    text-align: center;
    font-family: sans-serif;
}
header nav .logo-search .icon a:hover{
    color: #fccb3f;
}
header nav .logo-search .icon a span:hover{
    color: #fccb3f;
}
header nav .logo-search .icon2 a {
    color: #fff;
    font-size: 40px;  
    padding-right: 30px;
}  
header nav .logo-search .icon2 a:hover{
    color: #fccb3f;
}

.container .side-nav{
    overflow: hidden;
    width: 250px;
    height: 100vh;
    background-color: #B5B7B8;
    overflow: hidden;
    padding: 20px 10px 20px 10px;
}
.container .side-nav ul li{
    padding: 10px 20px;
    color: #000000;
    cursor: pointer;
    background-color: #fff;
    margin: 5px 0 20px 0;
    text-align: center;
}
.container .side-nav ul li a{
    color: #000000;
}
.container .side-nav ul li:hover{
    background-color: #D4F1C9;
}
.container .side-nav ul li:hover{
    background-color: #D4F1C9;
}
.container .side-nav ul li:hover{
    background-color: #D4F1C9;
}
.container .side-nav ul li:hover{
    background-color: #D4F1C9;
}
.container .side-nav ul li:hover{
    background-color: #D4F1C9;
}

.main--content {
    
    overflow        : hidden;
    margin-top      : 0px;
    margin-bottom   : 0px;
    margin-left     : 30px;
    padding         : 0 20px;
    height          : 100%;
    width           : calc(100% - 300px);
    transition      : .3s;
   
   
}
.main--content.active {
    width: calc(100% - 103px);
}
.title {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 10px;
    margin-top: 30px;
}
.section--title {
    font-weight: 400;
}
.dropdown {
    outline: none;
    border: none;
    background-color: #f1f4f8;
    border-radius: 5px;
    width: 150px;
    padding: 5px;
}
.cards {
    display: flex;
    gap: 20px;
}
.card {
    padding: 20px;
    border-radius: 20px;
    min-width: 230px;
    height: auto;
    transition: .3s;
}
.card:hover {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
}
.card--data {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
}
.card h1 {
    font-size: 30px;
    margin-top: 10px;
}
.card--icon--lg {
    font-size: 80px;
}

.card-1 {
    background-color: rgba(80, 115, 251, .1);
}
.card-1 .card--title {
    color: rgba(80, 115, 251, 1);
}
.card-1 .card--icon--lg {
    color: rgba(80, 115, 251, .4);
}
.card-2 {
    background-color: rgba(241, 210, 67, .1);
}
.card-2 .card--title {
    color: rgba(241, 210, 67, 1);
}
.card-2 .card--icon--lg {
    color: rgba(241, 210, 67, .4);
}
.card-3 {
    background-color: rgba(112, 215, 165, .1);
}
.card-3 .card--title {
    color: rgba(112, 215, 165, 1);
}
.card-3 .card--icon--lg {
    color: rgba(112, 215, 165, .4);
}
.card-4 {
    background-color: rgba(227, 106, 82, .1);
}
.card-4 .card--title {
    color: rgba(227, 106, 82, 1);
}
.card-4 .card--icon--lg {
    color: rgba(227, 106, 82, .4);
}
.card-5 {
    background-color: rgba(218, 177, 67, .1);
}
.card-5 .card--title {
    color: rgba(218, 177, 67, 1);
}
.card-5 .card--icon--lg {
    color: rgba(218, 177, 67, .4);
}


.sales--right--btns {
    display: flex;
    align-items: center;
    gap: 30px;
}

.sales--cards {
    display: flex;
    gap: 200px;
}
.sale--card {
    padding: 20px;
    border-radius: 20px;
    height: auto;
    transition: .3s;
    border: 2px solid #f1f1f1;
    display: flex;
    flex-direction: column;
    align-items: center;
    font-size: .8rem;
}
.sale--card:hover {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
}

.yearly--report {
    margin-bottom: 20px;
}

.table {
    height: 200px;
    overflow-y: scroll;
}
table {
    width: 100%;
    text-align: left;
    border-collapse: collapse;
}
tr {
    border-bottom: 1px solid #f1f1f1;
}
td,
th {
    padding-block: 10px;
}
.pending {
    color: #f1d243;
}
.confirmed {
    color: #70d7a5;
}
.rejected {
    color: #e86786;
}

/* responsive starts here */
@media screen and (max-width:1350px) {
    .cards,
    .sales--cards {
        overflow-x: scroll;
    }
}

}

</style>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
        $(document).ready(function () {
            // Load order list when "Orders" link is clicked
            $("#load-orders").click(function () {
                $("#content-container").load("admin_order.php");
            });
        });
</script>
<script>
        $(document).ready(function () {
            // Load Seller list when "Sellers" link is clicked
            $("#load-sellers").click(function () {
                $("#content-container").load("admin_seller.php");
            });
        });
</script>
<script>
        $(document).ready(function () {
            // Load Customers list when "Customers" link is clicked
            $("#load-customers").click(function () {
                $("#content-container").load("admin_customer.php");
            });
        });
</script>
<script>
        $(document).ready(function () {
            // Load products list when "Products" link is clicked
            $("#load-products").click(function () {
                $("#content-container").load("admin_products.php");
            });
        });
</script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</head>
<body>
    <header>
        <nav>
            <div class="logo-search">
                <a href="adminmenu.php" class="logo" onclick="refreshPage()">pasar<span>siswa</span></a>
                
                <div class="icon">
                    <a href="adminmenu.php"><i class="fas" onclick="refreshPage()">&#xf015;</i><span>Home</span></a>
                    <a href="mailto:alifsafiuddin0275@gmail.com"><i class="fa">&#xf29c;</i><span>Help</span></a>
                </div>

                <div class="icon2">
                    <a href="logout.php"><i class="fa">&#xf2be;</i></a>
                </div>
            </div>
        </nav>
    </header>

    <section class="container" style="display: flex;">
        <div class="side-nav" style="height: auto";>
            <ul>
                <li><a href="adminmenu.php" onclick="refreshPage()">Home</a></li>
                <li><a href="admin_order.php">Orders</a></li>
                <li><a href="admin_seller.php">Sellers</a></li>
                <li><a href="admin_customer.php">Customers</a></li>
                <li><a href="admin_products.php">Products</a></li>
            </ul>
        </div>

        <div class="main--content">
        <div id="content-container">
            <div class="overview">
                <div class="title">
                    <h2 class="section--title">Overview</h2>
                </div>
                <div class="cards">

                    <div class="card card-1">
                    <div class="card--data">
                    <div class="card--content">
                    <h5 class="card--title">Total Orders</h5>
                    <h1><?php echo $totalOrders; ?></h1>
                    </div>
                    <i class="ri-orders-line card--icon--lg"></i>
                    </div>
                    </div>

                    <div class="card card-2">
                    <div class="card--data">
                    <div class="card--content">
                    <h5 class="card--title">Total Users</h5>
                    <h1><?php echo $totalUsers; ?></h1>
                    </div>
                    <i class="ri-users-line card--icon--lg"></i>
                    </div>
                    </div>

                    <div class="card card-3">
                    <div class="card--data">
                    <div class="card--content">
                    <h5 class="card--title">Total Sellers</h5>
                    <h1><?php echo $totalSellers; ?></h1>
                    </div>
                    <i class="ri-sellers-line card--icon--lg"></i>
                    </div>
                    </div>

                    <div class="card card-4">
                    <div class="card--data">
                    <div class="card--content">
                    <h5 class="card--title">Total Customers</h5>
                    <h1><?php echo $totalCustomers; ?></h1>
                    </div>
                    <i class="ri-customers-line card--icon--lg"></i>
                    </div>
                    </div>

                    <div class="card card-5">
                    <div class="card--data">
                    <div class="card--content">
                    <h5 class="card--title">Total Products</h5>
                    <h1><?php echo $totalProducts; ?></h1>
                    </div>
                    <i class="ri-products-line card--icon--lg"></i>
                    </div>
                    </div>

                </div>
            </div>
<div class="sales">
    <div class="title">
        <h2 class="section--title">Monthly Sales Report</h2>
    </div>
    <form action="reportmonthly.php" method="get">
        <label for="selected_month">Select Month:</label>
        <select name="selected_month" id="selected_month">
        <option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
        </select>
        <label for="selected_year">Select Year:</label>
        <select name="selected_year" id="selected_year">
            <!-- Add options dynamically based on the available years in your orders -->
            <?php
                $current_year = date('Y');
                for ($year = $current_year; $year >= 2022; $year--) {
                    echo "<option value='$year'>$year</option>";
                }
            ?>
        </select>
        <input type="submit" value="View Report">
    </form>
    <br>
            </div>
    <div id="lineChartContainer" style="height: 370px; width: 100%;"></div>
                <br></br>
            <div class="yearly--report">
                <div class="title">
                    <h2 class="section--title">Yearly  Sales Report</h2>
                </div>
                <form action="report.php" method="get">
        <select name="selected_year">
            <!-- Add options dynamically based on the available years in your orders -->
            <?php
                $current_year = date('Y');
                for ($year = $current_year; $year >= 2022; $year--) {
                    echo "<option value='$year'>$year</option>";
                }
            ?>
        </select>
        <input type="submit" value="View Report">
    </form>
    <br>
                <div class="yearly--chart">
                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                </div>
                </div>
            </div>
        </div>

    </section>
    <script>
window.onload = function () {
    // Yearly Chart
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        theme: "light2",
        title: {
            text: "Yearly Sales Report"
        },
        axisY: {
            title: "Total Amount (in RM)"
            
        },
        data: [{
            type: "column",
            yValueFormatString: "RM#,##0.00",
            dataPoints: <?php echo json_encode(array_map(function($year, $amount) {
                return array("label" => $year, "y" => $amount);
            }, array_keys($yearly_data), $yearly_data), JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();

    // Line Chart
var lineChart = new CanvasJS.Chart("lineChartContainer", {
    animationEnabled: true,
    title: {
        text: "Monthly Sales Trend Across All Sellers"
    },
    axisY: {
        title: "Total Amount (in RM)",
        includeZero: true,
        prefix: "",
        suffix: "",
        valueFormatString: "RM #,##0.00" 
    },
    data: [{
        type: "line",
        yValueFormatString: "RM#,##0.00",
        dataPoints: <?php echo json_encode($dataPointsLineChart, JSON_NUMERIC_CHECK); ?>
    }]
});
lineChart.render();

}

</script>



    <!-- Add the jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js">
    </script>

    <!-- JavaScript for handling category image click event -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- DataTables CSS and JS -->
<link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<!-- Buttons CSS and JS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

<!-- Other required libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.5.0/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js"></script>
    
</body>
</html>