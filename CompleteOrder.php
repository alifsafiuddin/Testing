<?php
include_once 'database.php';

// Fetch order details from the URL
if (isset($_GET['order_details'])) {
    $orderDetails = json_decode(base64_decode($_GET['order_details']), true);

    // Assuming you have a column named 'fld_status' in tbl_order_pasarsiswa to store the status
    $status = "Completed";
    $orderid = $orderDetails['fld_order_id']; // Use 'orderid' instead of 'productid'

    // Fetch order details based on order ID
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM tbl_order_pasarsiswa WHERE fld_order_id = :orderid");
    $stmt->bindParam(':orderid', $orderid, PDO::PARAM_STR);
    $stmt->execute();
    $readrow = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the order exists
    if (!$readrow) {
        // Redirect to the previous page if order details are not available
        header("Location: SellerOrder.php");
        exit();
    }

    // Fetch customer details based on user ID
    $userId = $readrow['fld_user_id'];
    $userStmt = $conn->prepare("SELECT * FROM tbl_user_pasarsiswa WHERE fld_user_id = :userId");
    $userStmt->bindParam(':userId', $userId, PDO::PARAM_STR);
    $userStmt->execute();
    $userDetails = $userStmt->fetch(PDO::FETCH_ASSOC);

    // Handle the confirmation of the order
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_order'])) {
        // Update the order status in the database
        $updateStmt = $conn->prepare("UPDATE tbl_order_pasarsiswa SET fld_order_status = :status WHERE fld_order_id = :orderid");
        $updateStmt->bindParam(':status', $status, PDO::PARAM_STR);
        $updateStmt->bindParam(':orderid', $orderid, PDO::PARAM_STR);
        $updateStmt->execute();

        // Redirect to the previous page after updating the order status
        header("Location: SellerOrder.php");
        exit();
    }
} else {
    // Redirect to the previous page if order details are not available
    header("Location: SellerOrder.php");
    exit();
}
?>




<style>
  
*{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: sans-serif;
    text-decoration: none;
    transition: 0.3s;
}

body{
    background: #e9eaf0;/*kelabu cair*/
}

    section {
            display: flex;
            justify-content: center; /* Center the content horizontally */
            align-items: stretch; /* Stretch the content vertically */
        }

        section .side-nav {
            width: 250px;
            height: 100vh;
            background-color: #B5B7B8;
            overflow: hidden;
            padding: 20px 10px 20px 10px;
        }

        section .addproductOption {
            flex: 1; /* Take up remaining space */
            height: 100%; /* Full height */
            background-color: #e9eaf0;
            padding: 20px;
            margin-top: 20px;
            margin-left: 20px;
            margin-right: 20px;
        }

  header{
    background-color: #5FFA3D;
    background-image: linear-gradient(0deg, #5FFA3D, #2AA1A3);
    height: 125px;
}

  header nav{
    width: 100%;
    margin: auto;
    justify-content: space-between;
  }

  header nav .logo{ 
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding-block: 35px;
      margin-right: 20px;
  }

  header nav .logo .logoo{ /*adjust font logo pasarsiswa*/
    color: #fff;
    text-transform: lowercase;
    font-size: 35px;
    font-weight: bold;
    padding-left: 30px;
  }

  header nav .logo .logoo span{ /*adjust font logo pasarsiswa*/ 
    color: #fff;
    text-transform: uppercase;
    font-size: 35px;
    font-weight: bold;
    margin-right: 70px;
}

  header nav .logo .addproduct{ 
      color: #fff;
      font-size: 25px;
      margin-right: 350px; 

  }

  header nav .logo .icon3 a{ /*adjust nav icon*/ 
    color: #fff;
    margin-left: 10px;
    font-size: 25px;
  }

  header nav .logo .icon3 span{
      color: #fff;
      margin-left: 10px;
      font-size: 15px;
      text-align: center;
      font-family: sans-serif;
  }
  header nav .logo .icon3 a:hover{
      color: #fccb3f;
  }
  header nav .logo .icon3 a span:hover{
      color: #fccb3f;
  }
  header nav .logo .profile a {
      color: #fff;
      font-size: 40px;  
      padding-right: 30px;
      margin-left: 50px;
  }  
  header nav .logo  .profile a:hover{
      color: #fccb3f;
  }

/*start container side-nav*/

.container .side-nav{
    width: 250px;
      height: 100vh;
      background-color: #B5B7B8;
    overflow: hidden;
    padding: 20px 10px 20px 10px;
}
.container .side-nav ul li{
    padding: 10px 20px;
    color: #000000;
    cursor: pointer;
    background-color: #fff;
    margin: 5px 0 20px 0;
    text-align: center;
}
.container .side-nav ul li a{
    color: #black;
}
.container .side-nav ul li:hover{
    background-color: #D4F1C9;
}

/*start container side-bar-option*/

.container .addproductOption{
    width: 100%;
    height: 100%;
    background-color: #fff;
    overflow: hidden;
    padding: 35px;
    margin-top: 30px;
    margin-left: 220px;
    margin-right: 20px; /* Added margin to the right */
}
.container .addproductOption ul li{
    padding: 25px 0px;
    color: #000000;
    background-color: #fff;
    margin: 5px 0 10px 0;
    text-align: center;
    font-weight: bold;
}
.container .addproductOption ul li img{
    width: 100%;
}
.container .addproductOption ul li a{
    color: #black;
    display: block;
}

  .form-group {
    display: flex;
    align-items: center;
    margin-top: 5px;
    margin-bottom: 20px;
}

.form-group label {
  display: inline-block;
  width: 150px; /* Adjust the width as needed */
  text-align: right;
  margin-right: 25px;
  margin-top: 10px;
  margin-bottom: 10px;
}

.form-group input,
.form-group select,
.form-group textarea {
  width: 80%; /* Adjust the width as needed */
  padding: 13px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  display: inline-block;
  vertical-align: top;
}

    .addproductOption form button {
      background-color: #4caf50;
      /* Green */
      color: white;
      padding: 15px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }

    .addproductOption form button:hover {
      background-color: #45a049;
    }

.image-upload {
  display: flex;
  align-items: center;
  margin-top: 20px;
  width: 230px;
  height: 200px;
}

.image-upload input {
  width: 0;
  height: 0;
  opacity: 0;
  overflow: hidden;
  position: absolute;
  z-index: -1;
}

.tm-upload-icon {
  font-size: 40px;
  color: #555;
  margin-top: 55px;
}

.file-box {
  border: 1px solid #ccc;
  padding: 10px;
  width: 200px;
  height: 200px;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
  align-items: center; /* Center content vertically */
  justify-content: center; /* Center content horizontally */
}

.file-content {
  display: flex;
  flex-direction: column;
  align-items: center;
}

#fileName {
  font-size: 14px;
  color: #555;
  flex-grow: 1;
  margin-right: 10px
}

.file-content span {
  margin-top: 5px;
  font-size: 12px;
}

 .product-orders {
    flex: 1;
    height: 100%;
    background-color: #e9eaf0;
    padding: 20px;
    margin-top: 20px;
    margin-left: 20px;
    margin-right: 20px;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .order-container {
  border: 1px solid #ccc;
  border-radius: 8px;
  padding: 20px;
  display: flex;
  flex-direction: column;
  gap: 10px;
  background-color: white;
}

.orderInfo,
.orderImage {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.orderImage .image-view {
  display: flex;
  align-items: center;
}

.orderImage img {
  max-width: 50%;
  height: auto;
}

  .form-group {
    margin-bottom: 10px; /* Adjust the margin-bottom between form groups */
  }

  .form-group input[type="file"] {
    width: 100%;
  }

    .order-header {
      font-size: 24px;
      font-weight: bold;
    }

    .product-photo img {
      background-color: ; /* Set your desired background color */
      width: 120px;
      border-radius: 8px;
    }

    .product-details {
    display: grid;
    grid-template-rows: 1fr 1fr;
    grid-template-columns: repeat(6, 1fr); /* Use auto to equally distribute columns */
    gap: 10px;
    width: 100%;
    align-items: center; /* Center vertically */
    justify-content: center; /* Center horizontally */
  }

  .attribute-column,
  .attribute-values {
    display: flex;
    flex-direction: row;
    gap: 10px;
    flex-wrap: wrap;
    align-items: center; /* Center horizontally within each column */
    justify-items: center; /* Center horizontally */
  }

  .attribute-column div,
  .attribute-values div {
    flex: 1;
    margin-right: 0;
  }

    .order-total {
    font-size: 18px;
    font-weight: bold;
     text-align: right; /* Align text to the right */
      margin-right: 100px;
  }

  .status-container {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    margin-right: 100px;
  }

  .status-label {
    margin-right: 10px; /* Add margin to the left of the status label */
     min-width: 50px;
  }

  .product-status {
    font-weight: bold;
    text-align: right;
    padding: 10px;
  }

  .attribute {
     color: #555; 
  }

  .confirm-order-btn {
  background-color: #4caf50;
  color: white;
  padding: 15px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 16px;
  margin-top: 10px; /* Add margin for spacing */
}

.confirm-order-btn:hover {
  background-color: #45a049;
}


</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PasarSISWA: Complete Order</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script type="text/javascript">
        function searchProduct() {
            let input = document.getElementById('searchbar').value.toLowerCase();
            let products = document.getElementsByClassName('product-title');

            for (let i = 0; i < products.length; i++) {
                if (!products[i].innerHTML.toLowerCase().includes(input)) {
                    products[i].parentNode.parentNode.style.display = "none";
                } else {
                    products[i].parentNode.parentNode.style.display = "";
                }
            }
        }

        function refreshPage() {
            location.reload(true); // Reloads the page
        }
    </script>


</head>
<body>
<header>
    <nav>
        <div class="logo">
            <a href="sellermenu.php" class="logoo" onclick="refreshPage()">pasar<span>siswa</span></a>
            <a href="#" class="addproduct">Complete Order</a>
            <div class="icon3">
                <a href="sellermenu.php"><i class="fas" onclick="refreshPage()" >&#xf015;</i><span>Home</span></a>
                <a href="mailto:alifsafiuddin0275@gmail.com"><i class="fa">&#xf29c;</i><span>Help</span></a>
            </div>
            <div class="profile">
                <a href="logout.php"><i class="fa">&#xf2be;</i></a>
            </div>
        </div>
    </nav>
</header>

<section class="container" style=" display: flex;">
    <div class="side-nav" style="width: 250; height: auto;">
        <ul>
            <li><a href="SellerOrder.php">back</a></li>
        </ul>
    </div>

    <div class="product-orders">
        <!-- First Order Container -->
        <div class="order-container">
            <!-- Product 1 Details -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                        <div class="page-header">
                            <h2>Order</h2>
                        </div>

                        <div class="orderImage">
                            <div class="image-view">
                                <?php if ($readrow['fld_image'] == "" ) {
                                    echo "No image";
                                } else { ?>
                                    <img src="img/<?php echo $readrow['fld_image']; ?>" alt="Product Image" class="img-fluid">
                                <?php } ?>
                            </div>
                        </div>

                        <div class="orderInfo">
                            <div class="form-group row">
                                <label for="orderid" class="col-sm-3 col-form-label">Order ID</label>
                                <div class="col-sm-9">
                                    <input name="oid" type="text" class="form-control" id="orderid" value="<?php echo $readrow['fld_order_id'] ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="productname" class="col-sm-3 col-form-label">Product Name</label>
                                <div class="col-sm-9">
                                    <input name="productname" type="text" class="form-control" id="productname" value="<?php echo $readrow['fld_product_name'] ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                 <label for="customername" class="col-sm-3 col-form-label">Customer Name</label>
    <div class="col-sm-9">
        <input name="customername" type="text" class="form-control" id="customername" value="<?php echo $userDetails['fld_user_name'] ?? 'N/A'; ?>" readonly>
    </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-sm-3 col-form-label">Delivery Address</label>
    <div class="col-sm-9">
        <input name="address" type="text" class="form-control" id="address" value="<?php echo $userDetails['fld_location'] ?? 'N/A'; ?>" readonly>
    </div>
                            </div>

                            <div class="form-group row">
                                <label for="quantity" class="col-sm-3 col-form-label">Quantity</label>
                                <div class="col-sm-9">
                                    <input name="quantity" type="text" class="form-control" id="quantity" value="<?php echo $readrow['fld_quantity'] ?>" readonly>
                                </div>
                            </div>

                       

 <div class="form-group row">
   <label for="deliver" class="col-sm-3 col-form-label">Preview</label>
  <div class="col-sm-9" id="imagePreviewContainer">
    <!-- This is where the image will be displayed -->
  </div>
  <input type="file" name="deliverImage" id="deliver" onchange="previewImage(this);">
     <label for="deliverLabel" class="deliverLabel">Add proof of deliver</label>
</div>
  <form method="post">
    <button class="confirm-order-btn" name="confirm_order">Confirm Order</button>
</form>
</div>


    </div>
  </div>


    </section>

<script>
  function previewImage(input) {
    var previewContainer = document.getElementById('imagePreviewContainer');
    previewContainer.innerHTML = ''; // Clear previous content

    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        var image = new Image();
        image.src = e.target.result;
        image.alt = 'Image Preview';
        image.className = 'img-fluid';
        image.style.maxWidth = '100%';
        image.style.maxHeight = '100px';
        previewContainer.appendChild(image);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }
</script>

<style>
  .form-group input[type="file"] {
    width: 220px; /* Set your desired width */
  }
</style>

</body>
</html>
