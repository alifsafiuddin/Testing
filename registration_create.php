<?php
 
include_once 'database.php';
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
 
  try {
 
    $stmt = $conn->prepare("INSERT INTO tbl_user_pasarsiswa(fld_user_name, fld_user_id, fld_user_email, fld_user_phone, fld_user_password) VALUES(:name, :userid, :email, :phone, :password)");
   
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':userid', $userid, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
       
    $name = $_POST['name'];
    $userid = $_POST['userid'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $phone = $_POST['password'];
       
    $stmt->execute();
    }
 
  catch(PDOException $e)
  {
      echo "Error: " . $e->getMessage();
  }
}

?>