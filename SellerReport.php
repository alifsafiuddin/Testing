<?php
include_once 'database.php';
include_once 'session.php';

// Check if seller ID is present in the session
if (!isset($_SESSION['seller_id'])) {
    // Handle the case when the seller ID is not set in the session
    // You can redirect to a login page or perform any other appropriate action
    exit("Seller ID not set in the session");
}

$sellerId = $_SESSION['seller_id'];

// Fetch business name from the database based on the seller ID
$query = "SELECT fld_business_name FROM tbl_seller_pasarsiswa WHERE fld_seller_id = :seller_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':seller_id', $sellerId, PDO::PARAM_STR);
$stmt->execute();

if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $businessName = $row['fld_business_name'];
} else {
    // Handle the case when the seller ID is not found in the database
    exit("Seller ID not found in the database");
}

// Fetch data for the line chart
$queryLineChart = "SELECT DAYNAME(fld_order_date) as day, COUNT(*) as order_count FROM tbl_order_pasarsiswa WHERE fld_seller_id = :seller_id GROUP BY DAYNAME(fld_order_date)";
$stmtLineChart = $conn->prepare($queryLineChart);
$stmtLineChart->bindParam(':seller_id', $sellerId, PDO::PARAM_STR);
$stmtLineChart->execute();

$dataPointsLineChart = array();
while ($row = $stmtLineChart->fetch(PDO::FETCH_ASSOC)) {
    $dataPointsLineChart[] = array("y" => $row['order_count'], "label" => $row['day']);
}

// Fetch data for the bar chart (total amount of orders)
$queryBarChart = "SELECT DATE_FORMAT(fld_order_date, '%Y-%m') as month_year, SUM(fld_amount) as total_amount FROM tbl_order_pasarsiswa WHERE fld_seller_id = :seller_id GROUP BY month_year ORDER BY month_year";
$stmtBarChart = $conn->prepare($queryBarChart);
$stmtBarChart->bindParam(':seller_id', $sellerId, PDO::PARAM_STR);
$stmtBarChart->execute();

$dataPointsBarChart = array();
while ($row = $stmtBarChart->fetch(PDO::FETCH_ASSOC)) {
    // Extract year and month from the concatenated label
    list($year, $month) = explode('-', $row['month_year']);
    $dataPointsBarChart[] = array("y" => $row['total_amount'], "label" => date('M Y', mktime(0, 0, 0, $month, 1, $year)));
}

$conn = null; // Close the database connection
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>PasarSISWA : Seller Report</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Link File CSS -->
    <link rel="stylesheet" href="style_sellermenu.css">

    <script type="text/javascript">
        function searchProduct() {
            let input = document.getElementById('searchbar').value.toLowerCase();
            let products = document.getElementsByClassName('product-title');

            for (let i = 0; i < products.length; i++) {
                if (!products[i].innerHTML.toLowerCase().includes(input)) {
                    products[i].parentNode.parentNode.style.display = "none";
                } else {
                    products[i].parentNode.parentNode.style.display = "";
                }
            }
        }

        function refreshPage() {
            location.reload(true); // Reloads the page
        }
    </script>
    
</head>
<body>
<header>
        <nav>
            <div class="logo-search">
                <a href="sellermenu.php" class="logo" onclick="refreshPage()">pasar<span>siswa</span></a>
                <div class="search-box">
                    <input id="searchbar" onkeyup="searchProduct()" type="text" name="search" placeholder="Search Here..">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>  

                <div class="icon">
                    <a href="sellermenu.php"><i class="fas" onclick="refreshPage()">&#xf015;</i><span>Home</span></a>
                    <a href="mailto:alifsafiuddin0275@gmail.com"><i class="fa">&#xf29c;</i><span>Help</span></a>
                </div>

                <div class="icon2">
                    <a href="logout.php"><i class="fa">&#xf2be;</i></a>
                </div>
            </div>
        </nav>
    </header>

    <section class="container" style="display: flex; padding-right: 100px; ">
        <div class="side-nav" style="width: 350px" >
            <ul>
                <li><a href="sellermenu.php" onclick="refreshPage()">Home</a></li>
                <li><a href="basicInformation.php">+ Add a new product +</a></li>
                <li><a href="confirmOrder2.php">Order confirmation</a></li>
                <li><a href="SellerOrder.php">Order</a></li>
                <li><a href="testchart.php">Report</a></li>
            </ul>
        </div>
        <div class="product-option product-container" style="padding: 20px 20px 20px 20px">
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script>
        window.onload = function () {
            // Line Chart
            var lineChart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title: {
                    text: "Number Of Orders for <?php echo $businessName; ?> Over A Week"
                },
                axisY: {
                    title: "Number of Orders"
                },
                data: [{
                    type: "line",
                    dataPoints: <?php echo json_encode($dataPointsLineChart, JSON_NUMERIC_CHECK); ?>
                }]
            });
            lineChart.render();

            // Bar Chart
            var barChart = new CanvasJS.Chart("barChartContainer", {
                animationEnabled: true,
                title: {
                    text: "Sales Chart for <?php echo $businessName; ?> by Month"
                },
                axisY: {
                    title: "Total Amount (in RM)",
                    includeZero: true,
                    prefix: "RM",
                    suffix: ""
                },
                data: [{
                    type: "bar",
                    yValueFormatString: "RM#,##0",
                    indexLabel: "{y}",
                    indexLabelPlacement: "inside",
                    indexLabelFontWeight: "bolder",
                    indexLabelFontColor: "white",
                    dataPoints: <?php echo json_encode($dataPointsBarChart, JSON_NUMERIC_CHECK); ?>
                }]
            });
            barChart.render();
        }
    </script>
    <div id="barChartContainer" style="height: 370px; width: 100%;"></div>
</body>
</html>