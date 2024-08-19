<?php
include_once 'database.php';

$status = $_GET['status'];
$conn = mysqli_connect('lrgs.ftsm.ukm.my', 'a187044', 'giantblackfox', 'a187044');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$orders = getOrdersByStatus($conn, $status);

// Output HTML content for the orders
foreach ($orders as $order) {
    // Display order details as needed
    echo '<div class="order-container">';
    echo '<div class="order-header">Product Ordered</div>';
    // Display other order details...
    echo '</div>';
}
?>
