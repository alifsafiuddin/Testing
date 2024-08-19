<?php
include_once 'products_create.php';

$servername = "lrgs.ftsm.ukm.my";
$username = "a187044";
$password = "giantblackfox";
$dbname = "a187044";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch the last inserted product ID
$stmtLastID = $conn->query("SELECT MAX(fld_product_id) AS max_id FROM tbl_products_pasarsiswa");
$lastID = $stmtLastID->fetch(PDO::FETCH_ASSOC)['max_id'];

// Read stock for the last product ID
$stmtStock = $conn->prepare("SELECT fld_stock FROM tbl_products_pasarsiswa WHERE fld_product_id = :lastID");
$stmtStock->bindParam(':lastID', $lastID, PDO::PARAM_INT);
$stmtStock->execute();

$stockData = $stmtStock->fetch(PDO::FETCH_ASSOC);
$lastProductStock = $stockData['fld_stock'];

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['saveAndPublish'])) {

        // Insert variation data into the tbl_variation table
        $types = $_POST['types'];
        $prices = $_POST['prices'];
        $stocks = $_POST['stocks'];

        for ($i = 0; $i < count($types); $i++) {
            $type = $types[$i];
            $price = $prices[$i];
            $stock = $stocks[$i];

            $stmtInsertVariation = $conn->prepare("INSERT INTO tbl_variations_pasarsiswa (fld_product_id, fld_value, fld_price_v, fld_stock_v) VALUES (:lastID, :type, :price, :stock)");
            $stmtInsertVariation->bindParam(':lastID', $lastID, PDO::PARAM_INT);
            $stmtInsertVariation->bindParam(':type', $type, PDO::PARAM_STR);
            $stmtInsertVariation->bindParam(':price', $price, PDO::PARAM_STR);
            $stmtInsertVariation->bindParam(':stock', $stock, PDO::PARAM_INT);
            $stmtInsertVariation->execute();
        }
    }
      header("Location: sellermenu.php");

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>