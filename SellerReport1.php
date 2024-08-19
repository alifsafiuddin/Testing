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



$conn = null; // Close the database connection
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>PasarSISWA : Yearly Seller Report</title>

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
        <div class="side-nav" style="width: 350px" >
            <ul>
                <li><a href="sellermenu.php" onclick="refreshPage()">Home</a></li>
                <li><a href="basicInformation.php">+ Add a new product +</a></li>
                <li><a href="confirmOrder2.php">Order confirmation</a></li>
                <li><a href="SellerOrder.php">Order</a></li>
                <li><a href="SellerReport2.php">Monthly Report</a></li>
                <li><a href="SellerReport1.php">Yearly Report</a></li>
            </ul>
        </div>
        <div class="product-option product-container" style="padding: 20px 20px 20px 20px">
        <div id="chartContainer" style="height: 370px; width: 100%;padding: 100px"></div>
        <div id="barChartContainer" style="height: 370px; width: 100%;padding: 100px"></div>
        <div id="piechartContainer" style="height: 370px; width: 100%;"></div>
        <div id="columnchartContainer" style="height: 370px; width: 100%; padding: 100px;"></div>
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


          }
    
    </script>
    <section class="container" style=" display: flex;">

</body>
</html>