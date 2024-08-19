<?php

$servername = "lrgs.ftsm.ukm.my";
$username = "a187044";
$password = "giantblackfox";
$dbname = "a187044";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Create
if (isset($_POST['create'])) {

    try {
        // Loop through each uploaded file
        foreach ($_FILES['productImage']['tmp_name'] as $key => $tmp_name) {
            $image = $_FILES['productImage']['name'][$key];
            $pid = $_POST['pid'];
            $name = $_POST['name'];
            $category = $_POST['category'];
            $description = $_POST['description'];
            $stock = $_POST['stock'];
            $price = $_POST['price'];

            // Specify the directory where you want to store the uploaded files
            $uploadDir = 'uploads/';

            // Create the directory if it doesn't exist
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Generate a unique filename to avoid overwriting existing files
            $uploadFile = $uploadDir . basename($image);

            // Move the uploaded file to the specified directory
            move_uploaded_file($_FILES['productImage']['tmp_name'][$key], $uploadFile);

            $stmt = $conn->prepare("INSERT INTO tbl_products_pasarsiswa(fld_product_image,
                fld_product_id, fld_product_name, fld_category, fld_product_description, fld_stock, fld_price) VALUES(:image, :pid, :name, :category, :description, :stock, :price)");

            $stmt->bindParam(':image', $uploadFile, PDO::PARAM_STR);
            $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':category', $category, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_INT);
            $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
            $stmt->bindParam(':price', $price, PDO::PARAM_INT);

            $stmt->execute();
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>
