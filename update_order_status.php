<?php
include_once 'database.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract product ID from the POST data
    $productId = isset($_POST['productId']) ? $_POST['productId'] : '';

    if (!empty($productId)) {
        // Update the order status in the database
        $updateQuery = "UPDATE tbl_order_pasarsiswa SET fld_order_status = 'waiting seller to ship' WHERE fld_product_id = '$productId'";
        $updateResult = mysqli_query($conn, $updateQuery);

        if ($updateResult) {
            // Retrieve the updated list of orders
            $updatedOrdersQuery = "SELECT * FROM tbl_order_pasarsiswa WHERE fld_seller_id = '$sellerId'";
            $updatedOrdersResult = mysqli_query($conn, $updatedOrdersQuery);

            if ($updatedOrdersResult) {
                $updatedOrders = [];
                while ($row = mysqli_fetch_assoc($updatedOrdersResult)) {
                    $updatedOrders[] = $row;
                }

                // Send the updated orders back to the client-side JavaScript
                echo json_encode(['status' => 'success', 'message' => 'Order status updated successfully.', 'updatedOrders' => $updatedOrders]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error retrieving updated orders: ' . mysqli_error($conn)]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error updating order status: ' . mysqli_error($conn)]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Product ID not provided.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
