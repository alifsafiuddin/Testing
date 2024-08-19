<?php
include_once 'database.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
 
  try {
 
    $stmt = $conn->prepare("INSERT INTO tbl_order_pasarsiswa(fld_order_id, fld_order_date, fld_product_id, fld_variation, fld_quantity, fld_buyer_id, fld_seller_id) VALUES(:orderid, :orderdate, :pid, :variation, :quantity, :buyerid, :sellerid)");
   
    $stmt->bindParam(':orderid', $orderid, PDO::PARAM_STR);
    $stmt->bindParam(':orderdate', $orderdate, PDO::PARAM_STR);
    $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
    $stmt->bindParam(':variation', $variation, PDO::PARAM_STR);
    $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
    $stmt->bindParam(':buyerid', $buyerid, PDO::PARAM_STR);
    $stmt->bindParam(':sellerid', $sellerid, PDO::PARAM_STR);
       
    $orderid = $_POST['orderid'];
    $orderdate = $_POST['orderdate'];
    $pid = $_POST['pid'];
    $variation = $_POST['variation'];
    $quantity = $_POST['quantity'];
    $buyerid = $_POST['buyerid'];
    $sellerid = $_POST['sellerid'];
       
    $stmt->execute();
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}

?>