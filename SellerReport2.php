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

// Fetch data for the pie chart (total count of orders by product category)
$queryPieChart = "SELECT fld_product_name, COUNT(*) as order_count FROM tbl_order_pasarsiswa WHERE fld_seller_id = :seller_id GROUP BY fld_product_name";
$stmtPieChart = $conn->prepare($queryPieChart);
$stmtPieChart->bindParam(':seller_id', $sellerId, PDO::PARAM_STR);
$stmtPieChart->execute();

$dataPointsPieChart = array();
while ($row = $stmtPieChart->fetch(PDO::FETCH_ASSOC)) {
    $dataPointsPieChart[] = array("y" => $row['order_count'], "label" => $row['fld_product_name']);
}

// Fetch data for the pie chart (total count of orders by product category)
$queryChart = "SELECT fld_product_name, COUNT(*) as order_count FROM tbl_order_pasarsiswa WHERE fld_seller_id = :seller_id GROUP BY fld_product_name";
$stmtChart = $conn->prepare($queryChart);
$stmtChart->bindParam(':seller_id', $sellerId, PDO::PARAM_STR);
$stmtChart->execute();

// Fetch data for the column chart (stock for each product)
$queryStockChart = "SELECT fld_product_name, SUM(fld_stock) as total_stock FROM tbl_products_pasarsiswa WHERE fld_seller_id = :seller_id GROUP BY fld_product_name";
$stmtStockChart = $conn->prepare($queryStockChart);
$stmtStockChart->bindParam(':seller_id', $sellerId, PDO::PARAM_STR);
$stmtStockChart->execute();

$dataPointsStock = array();
while ($row = $stmtStockChart->fetch(PDO::FETCH_ASSOC)) {
    $dataPointsStock[] = array("y" => $row['total_stock'], "label" => $row['fld_product_name']);
}




$conn = null; // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>PasarSISWA : Monthly Seller Report</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Link File CSS -->
    <link rel="stylesheet" href="style_sellermenu.css">
    
</head>
<body>
<header>
        <nav>
            <div class="logo-search">
                <a href="sellermenu.php" class="logo" onclick="refreshPage()">pasar<span>siswa</span></a>

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
        <div class="side-nav" style="width: 300px" >
            <ul>
                <li><a href="sellermenu.php" onclick="refreshPage()">Home</a></li>
                <li><a href="basicInformation.php">+ Add a new product +</a></li>
                <li><a href="confirmOrder2.php">Order</a></li>
                <li><a href="SellerReport2.php">Report</a></li>
            </ul>
        </div>
        <div class="product-option product-container" style="padding: 20px 20px 20px 20px">
        <div id="barChartContainer" style="height: 370px; width: 100%; margin-bottom: 30px;"></div>
        <div id="piechartContainer" style="height: 370px; width: 100%;margin-bottom: 30px;"></div>
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>

    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script>
        window.onload = function () {

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

            //Pie Chart

                var piechart = new CanvasJS.Chart("piechartContainer", {
               animationEnabled: true,
               title:{
               text: "Products that have been sold for <?php echo $businessName; ?>",
                horizontalAlign: "center"
                 },
                 data: [{
                   type: "pie",
                   startAngle: 240,
                   yValueFormatString: "##0.00\"%\"",
                   indexLabel: "{label} {y}",
                dataPoints: <?php echo json_encode($dataPointsPieChart, JSON_NUMERIC_CHECK); ?>
                 }]
                });
                piechart.render();      

          // Column Chart
var chart = new CanvasJS.Chart("chartContainer", {
    animationEnabled: true,
    theme: "light2",
    title: {
        text: "Products stock for <?php echo $businessName; ?>"
    },
    axisY: {
        title: "Stock available"
    },
    data: [{
        type: "column",
        yValueFormatString: "#,##0.## stocks",
        dataPoints: <?php echo json_encode($dataPointsStock, JSON_NUMERIC_CHECK); ?>
    }]
});

// Add logic to check stock and display alert
chart.options.data[0].dataPoints.forEach(function(dataPoint) {
    if (dataPoint.y < 10) {
        dataPoint.indexLabel = "Low Stock!";
        dataPoint.indexLabelFontColor = "red"; // You can customize the color
    }
});

chart.render();

          }
    
    </script>
    <section class="container" style=" display: flex;">

</body>
</html>