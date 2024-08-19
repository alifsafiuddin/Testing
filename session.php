<?php
include_once 'database.php';

session_start();

// Function to set buyer data in the session
function setBuyerData($userId) {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM tbl_user_pasarsiswa WHERE fld_user_id = :id");
    $stmt->bindParam(':id', $userId, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Store buyer data in the session
        $_SESSION['user_id'] = $user['fld_user_id'];
        $_SESSION['user_name'] = $user['fld_user_name'];
        $_SESSION['user_position'] = $user['fld_position'];
        $_SESSION['user_email'] = $user['fld_email'];
        $_SESSION['user_phone'] = $user['fld_phone'];
        $_SESSION['user_location'] = $user['fld_location'];
        $_SESSION['user_type'] = 'buyer'; // Add a user type for differentiation

        return true;
    }

    return false;
}

// Function to set seller data in the session
function setSellerData($sellerId) {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM tbl_seller_pasarsiswa WHERE fld_seller_id = :id");
    $stmt->bindParam(':id', $sellerId, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $seller = $stmt->fetch(PDO::FETCH_ASSOC);

        // Store seller data in the session
        $_SESSION['seller_id'] = $seller['fld_seller_id'];
        $_SESSION['seller_name'] = $seller['fld_seller_name'];
        $_SESSION['seller_business_name'] = $seller['fld_business_name'];
        $_SESSION['seller_email'] = $seller['fld_seller_email'];
        $_SESSION['seller_phone'] = $seller['fld_seller_phonenumber'];
        $_SESSION['seller_type'] = 'seller'; // Add a user type for differentiation

        return true;
    }

    return false;
}

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    // Buyer is already logged in, no need to fetch data again
    $userId = $_SESSION['user_id'];
    $userName = $_SESSION['user_name'];
    $userPosition = $_SESSION['user_position'];
    $userEmail = $_SESSION['user_email'];
    $userPhone = $_SESSION['user_phone'];
    $userLocation = $_SESSION['user_location'];
    $userType = $_SESSION['user_type'];
} elseif (isset($_SESSION['seller_id'])) {
    // Seller is already logged in, no need to fetch data again
    $sellerId = $_SESSION['seller_id'];
    $sellerName = $_SESSION['seller_name'];
    $sellerBusinessName = $_SESSION['seller_business_name'];
    $sellerEmail = $_SESSION['seller_email'];
    $sellerPhone = $_SESSION['seller_phone'];
    $sellerType = $_SESSION['seller_type'];
} elseif (isset($_SESSION['userid'])) {
    // User is not logged in but has a session ID, fetch user or seller data based on type
    $userId = $_SESSION['userid'];
    $userType = ''; // Initialize user type

    // Check if the user is a buyer
    if (setBuyerData($userId)) {
        // Buyer data set successfully, retrieve it
        $userName = $_SESSION['user_name'];
        $userPosition = $_SESSION['user_position'];
        $userEmail = $_SESSION['user_email'];
        $userPhone = $_SESSION['user_phone'];
        $userLocation = $_SESSION['user_location'];
        $userType = $_SESSION['user_type'];
    } elseif (setSellerData($userId)) {
        // Seller data set successfully, retrieve it
        $sellerId = $_SESSION['seller_id'];
        $sellerName = $_SESSION['seller_name'];
        $sellerBusinessName = $_SESSION['seller_business_name'];
        $sellerEmail = $_SESSION['seller_email'];
        $sellerPhone = $_SESSION['seller_phone'];
        $sellerType = $_SESSION['seller_type'];
    } else {
        // Unable to fetch user or seller data, redirect to login
        header("location: login.php");
        exit();
    }
} else {
    // User is not logged in and has no session ID, redirect to login
    header("location: login.php");
    exit();
}
?>