<?php

$servername = "lrgs.ftsm.ukm.my";
$username = "a187044";
$password = "giantblackfox";
$dbname = "a187044";
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
 
  try {
 
      $stmt = $conn->prepare("INSERT INTO tbl_seller_pasarsiswa(fld_seller_id,
        fld_seller_name, fld_business_name, fld_seller_email, fld_seller_phonenumber,
        fld_seller_password) VALUES(:sellerid, :fullname, :businessname, :selleremail,
        :phonenumber, :sellerpassword)");
     
      $stmt->bindParam(':sellerid', $sellerid, PDO::PARAM_STR);
      $stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR);
      $stmt->bindParam(':businessname', $businessname, PDO::PARAM_STR);
      $stmt->bindParam(':selleremail', $selleremail, PDO::PARAM_STR);
      $stmt->bindParam(':phonenumber', $phonenumber, PDO::PARAM_STR);
      $stmt->bindParam(':sellerpassword', $sellerpassword, PDO::PARAM_STR);
       
    $sellerid = $_POST['sellerid'];
    $fullname = $_POST['fullname'];
    $businessname = $_POST['businessname'];
    $selleremail =  $_POST['selleremail'];
    $phonenumber = $_POST['phonenumber'];
    $sellerpassword = $_POST['sellerpassword'];
     
    $stmt->execute();
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
} 
  $conn = null;
?>