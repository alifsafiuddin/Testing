<?php
include_once 'database.php';
include_once 'session.php';

// Make sure to properly escape and sanitize user input to prevent SQL injection
$seller_id = isset($_SESSION['seller_id']) ? $_SESSION['seller_id'] : '';

// Function to get products from the database
function getOrders($conn, $sellerId) {
    // Use prepared statements to prevent SQL injection
    $query = "SELECT * FROM tbl_order_pasarsiswa WHERE fld_order_status = 'Completed' AND fld_seller_id = :sellerId";
    
    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        die("Error in query preparation: " . $conn->errorInfo()[2]);
    }

    // Bind the parameter
    $stmt->bindParam(':sellerId', $sellerId, PDO::PARAM_STR);

    // Execute the statement
    $stmt->execute();

    // Fetch the result
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $orders;
}

// Call the function with the properly sanitized $seller_id
$orders = getOrders($conn, $seller_id);


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

        section .product-option ul li{
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            grid-gap: 1rem;
            background-color: #B5B7B8;
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

/*start container product-option*/
.container .side-nav ul li.active {
    background-color: #D4F1C9; /* Highlight color for the active link */
}


.product-container {
  width: 1200px; /* Set your desired fixed width */
  /* Add other styles as needed */
}

.container .product-option{
    overflow: hidden;
    padding: 15px 10px 15px 10px;
}
.container .product-option ul li{
    background-color: #fff;
}
.container .product-option ul li img{
    width: 100%;

}
.container .product-option .img-display{
    overflow: hidden;
}
.container .product-option .product-content{
    padding: 2rem 1rem;
}
.container .product-option .product-title{
    font-size: 2rem;
    text-transform: capitalize;
    font-weight: 700;
    position: relative;
    color: #12263a;
    margin: 1rem 0;
}
.container .product-option .product-rating{
    color: #5FFA3D;
}
.container .product-option .product-rating span{
    font-weight: 600;
    color: #5FFA3D;
    font-size: 10px;
}
.container .product-option .product-rating i {
    font-size: 10px;
}

.container .product-option .product-ratings span{
    font-size: 10px;
    color: #000000;
    font-weight: bold;
}
.container .product-option .product-sold span{
    font-size: 10px;
    font-weight: bold;
    color: #000000;
}
.container .product-option .product-price{
    margin: 1rem 0;
    font-size: 2rem;
    font-weight: 600;
    color: #5FFA3D;
}
.container .product-option .product-price span{
    font-size: 2rem;
    font-weight: 600;
}
.container .product-option .product-detail ul li{
    margin: 0px;
    font-size: 0.9rem;
    list-style: none;
    font-weight: 600;
    opacity: 0.9;
}
.container .product-option .product-detail ul li span{
    font-weight: 400;
}
.container .product-option .purchase-info{
    margin: 1.5rem 0;
}
.container .product-option .purchase-info .btn{
    border: 1.5px solid #ddd;
    text-align: center;
    padding: 0.45rem 0.8rem;
    outline: 0;
    margin-right: 0.2rem;
    margin-bottom: 1rem;
}
.container .product-option .purchase-info .btn{
    cursor: pointer;
    color: #fff;
}
.container .product-option .purchase-info .btn:first-of-type{
    background: #5FFA3D;
}
.container .product-option .purchase-info .btn:last-of-type{
    background: #5FFA3D;
}
.container .product-option .purchase-info .btn:hover{
    background: #B8FF95;
    border-color: transparent;
    color: #fff;
}
.container .product-option .social-links{
    display: flex;
    align-items: center;
}
.container .product-option .social-links {
    font-size: 0.9rem;
    list-style: none;
    font-weight: 600;
}
.container .product-option .social-links a{
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    color: #000;
    border: 1px solid #000;
    margin: 0 0.2rem;
    border-radius: 50%;
    text-decoration: none;
    font-size: 0.8rem;
    transition: all 0.5s ease;
}
.container .product-option .social-links a:hover{
    background: #000;
    border-color: transparent;
    color: #fff;
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

section .product-orders {
      flex: 1;
      height: 100%;
      background-color: #e9eaf0;
      padding: 20px;
      margin-top: 20px;
      margin-left: 20px;
      margin-right: 20px;
      display: flex;
      flex-direction: column;
      gap: 20px;
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

    .order-header {
      font-size: 24px;
      font-weight: bold;
    }

    .product-photo img {
      background-color: ; /* Set your desired background color */
      width: 120px;
      border-radius: 8px;
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
    margin-right: 200px;
  }

  .status-label {
    margin-right: 10px; /* Add margin to the left of the status label */
     min-width: 50px;
  }

  .product-status {
    font-weight: bold;
    text-align: right;
    background-color: #d3f3ce;
    padding: 10px;
    margin-right: 100px;
    min-width: 150px;
  }

  .confirmed-status {
  background-color: Moccasin; /* or any other color you want */
}


</style>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <title>PasarSISWA : Menu</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>
	<header>
  <nav>
    <div class="logo">
      <a href="sellermenu.php" class="logoo">pasar<span>siswa</span></a>
      <a href="#" class="addproduct">Completed Order</a>
      <div class="icon3">
        <a href="sellermenu.php"><i class="fas"onclick="refreshPage()">&#xf015;</i><span>Home</span></a>
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
				<li><a href="confirmOrder2.php">Received Orders</a></li>
            <li><a href="SellerOrder.php">Confirmed Orders</a></li>
            <li class="active"><a href="allorders.php">Completed Orders</a></li>
      </ul>
  </div>

    <div class="product-orders">
      <!-- First Order Container -->
      <div class="order-container">
        <div class="order-header">Completed Orders</div>

        <!-- Product 1 Details -->
                <div class="product-option">
                    <ul>
                        <?php foreach ($orders as $orders) : ?>
                            <div class="product-option">
                                <ul>
                                    <li>
                                        <div class="label-value">
                                            <strong>Image</strong>
                                            <?php if ($orders['fld_image'] != "") : ?>
                                                <div class="img-display">
                                                    <img src="img/<?php echo $orders['fld_image']; ?>" alt="product image">
                                                </div>
                                            <?php else : ?>
                                                <p>No image available</p>
                                            <?php endif; ?>
                                        </div>

                                        <div class="label-value">
                                            <strong>Product</strong>
                                            <h3 class="product-title"><?php echo $orders['fld_product_name']; ?></h3>
                                        </div>


                                        <div class="label-value">
                                            <strong>Unit Price</strong>
                                            <p>RM <span><?php echo number_format($orders['fld_price'],2); ?></span></p>
                                        </div>

                                        <div class="label-value">
                                            <strong>Quantity</strong>
                                            <p><span><?php echo $orders['fld_quantity']; ?></span></p>
                                        </div>

                                        <div class="label-value">
                                            <strong>Item SubTotal</strong>
                                            <p>RM <span><?php echo number_format($orders['fld_amount'],2); ?></span></p>
                                        </div>

                                        <div class="label-value">
    <strong>Order Date</strong>
    <p><span><?php echo $orders['fld_order_date']; ?></span></p>
</div>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-option">
                                <ul>
                                    <li>
                                        <div class="purchase-info">
                                          
                                        </div>



    

                                    </li>
                                </ul>
                            </div>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <!-- End of First Order Container -->
        </div>

    </section>

 <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
 function updateStatus(button) {
    var orderId = button.dataset.orderId.toString(); 
    console.log("Updating status for order ID:", orderId);

    $.ajax({
        type: "GET",
        url: "update_status.php?order_id=" + orderId, 
        success: function(response) {
            console.log("AJAX response:", response);

            // Parse the JSON response
            var data = JSON.parse(response);

            
            if (data.success) {
                console.log("Status update successful");
                
                changeStatus(button);
            } else {
                
                console.error("Error updating status:", data.error);
            }
        },
        error: function(xhr, status, error) {
            
            console.error("AJAX error:", status, error);
        }
    });
}


function changeStatus(button) {


  button.innerHTML = "To Ship";
  button.disabled = true;
  button.classList.add('confirmed-status'); 
}

</script>

</body>
</html>