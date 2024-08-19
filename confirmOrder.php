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
      <a href="#" class="addproduct">Confirm Order</a>
      <div class="icon3">
        <a href="sellermenu.php"><i class="fas" onclick="refreshPage()">&#xf015;</i><span>Home</span></a>
        <a href="mailto:alifsafiuddin0275@gmail.com"><i class="fa">&#xf29c;</i><span>Help</span></a>

      <div class="profile">
        <a href="logout.php"><i class="fa">&#xf2be;</i></a>
      </div>
    </div>
  </nav>
</header>
	
	<section class="container" style=" display: flex;">
		<div class="side-nav" style="width: 250;">
			<ul>
				<li><a href="#">All</a></li>
            	<li><a href="#">Order Received</a></li>
              <li><a href="#">Confirmed</a></li>
              <li><a href="#">Cancel</a></li>
            </ul>
       	</div>

    <div class="product-orders">
      <!-- First Order Container -->
      <div class="order-container">
        <div class="order-header">Product Order 1</div>

        <!-- Product 1 Details -->
  <div class="attribute-column">
    <div><strong>Image</strong></div>
    <div><strong>Product</strong></div>
    <div><strong>Variation</strong></div>
    <div><strong>Unit Price</strong></div>
    <div><strong>Quantity</strong></div>
    <div><strong>Amount</strong></div>
  </div>
  <div class="attribute-values">

    <?php
$servername = "lrgs.ftsm.ukm.my";
$username = "a187044";
$password = "giantblackfox";
$dbname = "a187044";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("
         SELECT 
            o.fld_order_id,
            o.fld_variation,
            o.fld_quantity,
            od.fld_product_id,
            od.fld_quantity AS order_quantity,
            p.fld_product_name,
            p.fld_variation_category,
            p.fld_price
        FROM
            tbl_order_pasarsiswa o
        INNER JOIN
            tbl_order_detail_pasarsiswa od ON o.fld_order_id = od.fld_order_id
        INNER JOIN
            tbl_products_pasarsiswa p ON od.fld_product_id = p.fld_product_id
    ");

    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $readrow) {
      ?>
      <div class="product-photo">
    <img src="potatochips.png" alt="Product 1">
  </div>
    <div><?php echo $readrow['fld_product_name']; ?></div>
    <div><?php echo $readrow['fld_variation']; ?></div>
    <div><?php echo $readrow['fld_price']; ?></div>
    <div><?php echo $readrow['fld_quantity']; ?></div>
    <div>RM5.20</div>
        
        <?php
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} finally {
    $conn = null; // Close the connection in the finally block
}
?>


    <div class="attribute-values">
    <?php foreach ($result as $readrow) : ?>
        <div class="product-photo">
            <img src="potatochips.png" alt="Product Image">
        </div>
        <div><?= $readrow['fld_product_name']; ?></div>
        <div><?= $readrow['fld_variation']; ?></div>
        <div><?= $readrow['fld_price']; ?></div>
        <div><?= $readrow['order_quantity']; ?></div>
        <div><?= number_format($readrow['fld_price'] * $readrow['order_quantity'], 2); ?></div>
    <?php endforeach; ?>
</div>

    <div class="order-total">Order Total: RM5.20</div>

    <div class="status-container">
    <div class="status-label"><strong>Status:</strong></div>
    <div class="product-status confirmed-status" id="status" onclick="changeStatus(this)">To Be Confirmed</div>
  </div>

</div>
      <!-- End of First Order Container -->

      <!-- Second Order Container -->
      <div class="order-container">
        <div class="order-header">Product Order 2</div>

        <!-- Product 3 Details -->
       <div class="attribute-column">
    <div><strong>Image</strong></div>
    <div><strong>Product</strong></div>
    <div><strong>Variation</strong></div>
    <div><strong>Unit Price</strong></div>
    <div><strong>Quantity</strong></div>
    <div><strong>Amount</strong></div>
  </div>
  <div class="attribute-values">
    <div class="product-photo">
    <img src="potatochips.png" alt="Product 1">
  </div>
    <div>Potato Chips</div>
    <div>Flavour: Spicy</div>
    <div>RM5.20</div>
    <div>1</div>
    <div>RM5.20</div>
  </div>

    <div class="order-total">Order Total: RM5.20</div>
        <div class="status-container">
    <div class="status-label"><strong>Status:</strong></div>
    <div class="product-status confirmed-status" id="status" onclick="changeStatus(this)">To Be Confirmed</div>
  </div>
      </div>
      <!-- End of Second Order Container -->
    </div>

    </section>

 <script>
    function changeStatus(element) {

    element.classList.toggle("confirmed-status");

      // Check the current color
      var currentColor = element.style.backgroundColor || window.getComputedStyle(element).backgroundColor;

      // Toggle between two colors
      if (currentColor === "rgb(211, 243, 206)") {
        element.style.backgroundColor = "Moccasin";
        element.innerText = "To Be Confirmed";
      } else {
        element.style.backgroundColor = "#d3f3ce";
        element.innerText = "Confirmed"
      }
    }
  </script>

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- JavaScript for handling category image click event -->
    <script>
        $(document).ready(function () {
            $(".category-image").click(function () {
                var category = $(this).data("category");

                // Use AJAX to fetch and update products without refreshing the page
                $.ajax({
                    type: "GET",
                    url: "get_products.php",
                    data: { category: category },
                    success: function (data) {
                        $("#product-container").html(data);
                    }
                });
            });
        });
    </script>

</body>
</html>