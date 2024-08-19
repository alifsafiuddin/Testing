<?php

// Include your database connection logic here
$servername = "lrgs.ftsm.ukm.my";
$username = "a187044";
$password = "giantblackfox";
$dbname = "a187044";

// Assuming you have a database connection object named $conn
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET)) {

    function getOrders($conn) {
    $query = "SELECT * FROM tbl_products_pasarsiswa";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error in query: " . mysqli_error($conn));
    }

    $orders = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $orders[] = $row;
    }

    return $orders;
}

$conn = mysqli_connect('lrgs.ftsm.ukm.my', 'a187044', 'giantblackfox', 'a187044');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$orders = getOrders($conn);

// Get data from the form
$product_name = isset($_POST['product_name']) ? $_POST['product_name'] : '';
$price = isset($_POST['price']) ? $_POST['price'] : '';
$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : '';
$amount = isset($_POST['amount']) ? $_POST['amount'] : '';
$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
$product_id = isset($_POST['product_id']) ? $_POST['product_id'] : '';
$seller_id = isset($_POST['seller_id']) ? $_POST['seller_id'] : '';
$image_name = isset($_POST['image_name']) ? $_POST['image_name'] : '';

// Sanitize the input data
$product_name = mysqli_real_escape_string($conn, $product_name);
$price = mysqli_real_escape_string($conn, $price);
$quantity = mysqli_real_escape_string($conn, $quantity);
$amount = mysqli_real_escape_string($conn, $amount);
$user_id = mysqli_real_escape_string($conn, $user_id);
$product_id = mysqli_real_escape_string($conn, $product_id);
$seller_id = mysqli_real_escape_string($conn, $seller_id);
$image_name = mysqli_real_escape_string($conn, basename($image_name)); // Extract only the filename

// Generate a unique order ID
$order_id = uniqid('A', true);

// Construct and execute the SQL INSERT query

// Assuming you have a condition to choose a specific product
    $selectedProduct = null;

    foreach ($orders as $order) {
        // Replace 'product_name' with the actual criteria you want to use
        if ($order['fld_product_name'] == $product_name) {
            $selectedProduct = $order;
            break; // Exit the loop once a match is found
        }
    }

    if ($selectedProduct) {
        $product_id = $selectedProduct['fld_product_id'];
        $seller_id = $selectedProduct['fld_seller_id'];


 $sql = "INSERT INTO tbl_order_pasarsiswa (fld_order_id, fld_order_date, fld_product_id, fld_product_name, fld_quantity, fld_amount, fld_user_id, fld_seller_id, fld_order_status, fld_price, fld_image) 
                VALUES ('$order_id', NOW(), '$product_id', '$product_name', '$quantity', '$amount', '$user_id', '$seller_id', 'Waiting Seller to Accept', '$price', '$image_name')";

 } else {
        echo "Selected product not found.";
    }


if (mysqli_query($conn, $sql)) {
    // Continue with Stripe payment processing
    include("./config.php");

    $token = $_POST["stripeToken"];
    $contact_name = $_POST["c_name"];
    $token_card_type = $_POST["stripeTokenType"];
    $phone = $_POST["phone"];
    $email = $_POST["stripeEmail"];
    $address = $_POST["address"];

    $charge = \Stripe\Charge::create([
        "amount" => str_replace(",", "", $amount) * 100,
        "currency" => 'myr',
        "description" => $product_name,
        "source" => $token,
    ]);

    if ($charge) {
        header("Location: invoice_try.php?amount=$amount&order_id=$order_id&item_name=$product_name&price=$price&quantity=$quantity&user_id=$user_id&seller_id=$seller_id&product_id=$product_id&image_name=$image_name");

        exit(); // Ensure that no further code is executed after the redirect
    } else {
        echo "Stripe payment failed.";
    }
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);

}
?>

