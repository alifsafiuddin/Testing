<?php
include_once 'session.php';
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
    background: #e9eaf0;
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

  header nav .logo .logoo{ 
    color: #fff;
    text-transform: lowercase;
    font-size: 35px;
    font-weight: bold;
    padding-left: 30px;
  }

  header nav .logo .logoo span{
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

  header nav .logo .icon3 a{ 
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

/start container side-nav/

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

/start container side-bar-option/

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
      margin-bottom: 20px; /* Add margin between each order container */
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

  .attribute-values .img-display img {
        width: 100px; /* Set your desired width */
        height: 100px; /* Set your desired height */
        object-fit: cover; /* This property ensures the image covers the specified dimensions without stretching */
        border: 1px solid #ccc; /* Optional: Add a border for better visual appearance */
    }

    .order-total {
    color: green;
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
    padding-bottom: 0px; /* Add padding after order total and status */
    margin-bottom: 0px; /* Add margin after order total and status */
    }
    .Date-container {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    margin-right: 100px;
    padding-bottom: 10px; /* Add padding after order total and status */
    margin-bottom: 10px; /* Add margin after order total and status */
    border-bottom: 5px solid #ccc; /* Add a border after order total and status */
    }
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

  <?php
include_once 'database.php';
include_once 'session.php';

// Function to get orders for a specific user from the database
function getOrdersByUserId($conn, $user_id) {
    $query = "SELECT * FROM tbl_order_pasarsiswa WHERE fld_user_id = '$user_id'";
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

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
$orders = getOrdersByUserId($conn, $user_id);

function groupOrdersByTitle($orders) {
    $groupedOrders = array();

    foreach ($orders as $order) {
        $title = $order['fld_product_name'];

        if (!isset($groupedOrders[$title])) {
            $groupedOrders[$title] = array();
        }

        $groupedOrders[$title][] = $order;
    }

    return $groupedOrders;
}

// Group orders by product name
$groupedOrders = groupOrdersByTitle($orders);

?>


</style>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <title>PasarSISWA : View Order Status</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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
      <a href="customermenu.php" class="logoo" onclick="refreshPage()">pasar<span>siswa</span></a>
      <a href="ViewOrderStatus.php" class="addproduct" onclick="refreshPage()">View Order Status</a>
      <div class="icon3">
        <a href="customermenu.php"><i class="fas" onclick="refreshPage()">&#xf015;</i><span>Home</span></a>
        <a href="mailto:alifsafiuddin0275@gmail.com"><i class="fa">&#xf29c;</i><span>Help</span></a>
      </div>
      <div class="profile">
        <a href="logout.php"><i class="fa">&#xf2be;</i></a>
      </div>
    </div>
  </nav>
</header>
    
<section class="container" style=" display: flex;">
    <div class="side-nav" style="width: 250; height: auto;" >
        <ul>
            <li><a href="#">All</a></li>
            <li><a href="ViewOrderStatus.php">View Order Status</a></li>
            <li><a href="orderList.php">Give Feedback</a></li>
        </ul>
    </div>

    <div class="product-orders">
       <?php
if (empty($groupedOrders)) {
    echo '<p>You haven\'t made an order before.</p>';
} else {
    foreach ($groupedOrders as $title => $group) {
        // Order Container for each title
        echo '<div class="order-container">';
        echo '<div class="order-header">' . $title . '</div>';

        foreach ($group as $order) {
            // Existing code for displaying order details
            ?>
            <div class="attribute-column">
                <!-- Header Row -->
                <div><strong>Image</strong></div>
                <div><strong>Product</strong></div>
                <div><strong>Unit Price (RM)</strong></div>
                <div><strong>Quantity</strong></div>
                <div><strong>Amount (RM)</strong></div>
            </div>

            <!-- Data Rows -->
            <div class="attribute-values">
                <div class="label-value">
                    <?php if ($order['fld_image'] != "") : ?>
                        <div class="img-display">
                            <img src="img/<?php echo $order['fld_image']; ?>" alt="product image">
                        </div>
                    <?php else : ?>
                        <p>No image available</p>
                    <?php endif; ?>
                </div>
                <div><?php echo $order['fld_product_name']; ?></div>
                <div><?php echo number_format($order['fld_price'], 2); ?></div>
                <div><?php echo $order['fld_quantity']; ?></div>
                <div><?php echo number_format($order['fld_amount'], 2); ?></div>
            </div>

            <!-- Order Total and Status -->
            <div class="order-total">Order Total: RM <?php echo number_format($order['fld_amount'], 2); ?></div>
            <div class="status-container">
                <div class="status-label"><strong>Status:</strong></div>
                <div class="product-status cancelled-status" id="status"><?php echo $order['fld_order_status']; ?></div>
            </div>
            <div class="Date-container">
                <div class="status-label"><strong>Date:</strong></div>
                <div><?php echo $order['fld_order_date']; ?></div>
            </div>
                
        <?php
        }
        echo '</div>'; // Closing order-container div
    }
}
?>

</section>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    var statusElements = document.querySelectorAll(".product-status");

    statusElements.forEach(function(element) {
      var statusText = element.textContent.trim().toLowerCase();

      if (statusText === "cancelled") {
        element.style.color = "#ff0000"; // Red color for "Cancelled"
      } else if (statusText === "completed") {
        element.style.color = "#008000"; // Green color for "Completed"
      }
      else if (statusText === "pay now") {
        element.style.color = "#FEB421"; // orange color for "Pay Now"
      }
      else if (statusText === "waiting seller to ship") {
        element.style.color = "#21E0FE"; // blue color for "waiting seller to ship"
      }


    });
  });
</script>
</body>
</html>
