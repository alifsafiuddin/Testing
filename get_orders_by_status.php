<?php
include_once 'database.php';

function displayOrder($order) {
    echo '<div class="order-container">';
    echo '<div class="order-header">Product Ordered</div>';

    // Display other order details
    echo '<div class="product-option">';
    echo '<ul>';
    echo '<li>';
    
    // Display product image
    echo '<div class="label-value">';
    echo '<strong>Image</strong>';
    if ($order['fld_image'] != "") {
        echo '<div class="img-display">';
        echo '<img src="img/' . $order['fld_image'] . '" alt="product image">';
        echo '</div>';
    } else {
        echo '<p>No image available</p>';
    }
    echo '</div>';

    // Display product title
    echo '<div class="label-value">';
    echo '<strong>Product</strong>';
    echo '<h3 class="product-title">' . $order['fld_product_name'] . '</h3>';
    echo '</div>';

    // Display unit price
    echo '<div class="label-value">';
    echo '<strong>Unit Price</strong>';
    echo '<p>RM <span>' . $order['fld_price'] . '</span></p>';
    echo '</div>';

    // Display quantity
    echo '<div class="label-value">';
    echo '<strong>Quantity</strong>';
    echo '<p><span>' . $order['fld_quantity'] . '</span></p>';
    echo '</div>';

    // Display item subtotal
    echo '<div class="label-value">';
    echo '<strong>Item SubTotal</strong>';
    echo '<p>RM <span>' . $order['fld_amount'] . '</span></p>';
    echo '</div>';

    echo '</li>';
    echo '</ul>';
    echo '</div>'; // .product-option

    // Display purchase info and button
    echo '<div class="product-option">';
    echo '<ul>';
    echo '<li>';
    echo '<div class="purchase-info">';
    echo '<button type="button" name="pressMe" class="btn" data-order-id="' . $order['fld_order_id'] . '" onclick="updateStatus(this)">Confirm Order</button>';
    echo '</div>';
    echo '</li>';
    echo '</ul>';
    echo '</div>'; // .product-option

    echo '</div>'; // .order-container
}

$conn = mysqli_connect('lrgs.ftsm.ukm.my', 'a187044', 'giantblackfox', 'a187044');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$status = $_GET['status'];
$orders = getOrdersByStatus($conn, $status);

foreach ($orders as $order) {
    displayOrder($order);
}
?>
