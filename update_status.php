<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (isset($_GET['order_id'])) {
        $orderId = $_GET['order_id'];

 
        if (updateOrderStatus($orderId, 'Waiting Seller to ship')) {

            echo json_encode(['success' => true]);
        } else {

            echo json_encode(['success' => false, 'error' => 'Failed to update status']);
        }
    } else {

        echo json_encode(['success' => false, 'error' => 'Bad request']);
    }
} else {

    echo json_encode(['success' => false, 'error' => 'Unsupported request method']);
}

function updateOrderStatus($orderId, $status) {
    $conn = mysqli_connect('lrgs.ftsm.ukm.my', 'a187044', 'giantblackfox', 'a187044');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $status = mysqli_real_escape_string($conn, $status);

    $query = "UPDATE tbl_order_pasarsiswa SET fld_order_status = '$status' WHERE fld_order_id = '$orderId'";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        // Handle the error if the query fails
        die("Error in query: " . mysqli_error($conn));
    }

    // Close the database connection
    mysqli_close($conn);

    return true;
}
?>
