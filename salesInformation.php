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

            $stmtInsertVariation = $conn->prepare("INSERT INTO tbl_variation_pasarsiswa (fld_product_id, fld_value, fld_price, fld_stock) VALUES (:lastID, :type, :price, :stock)");
            $stmtInsertVariation->bindParam(':lastID', $lastID, PDO::PARAM_INT);
            $stmtInsertVariation->bindParam(':type', $type, PDO::PARAM_STR);
            $stmtInsertVariation->bindParam(':price', $price, PDO::PARAM_STR);
            $stmtInsertVariation->bindParam(':stock', $stock, PDO::PARAM_INT);
            $stmtInsertVariation->execute();
        }
    }


} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<style>
  
* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: sans-serif;
    text-decoration: none;
    transition: 0.3s;
  }

  body {
    margin: 0;
    padding: 0;
    min-height: 100vh;
    background: #e9eaf0;
    /* kelabu cair */
  }

  section {
    display: flex;
    justify-content: center;
    /* Center the content horizontally */
    align-items: stretch;
    /* Stretch the content vertically */
    min-height: 100vh;
  }

  section .side-nav {
    width: 250px;
    height: 100vh;
    background-color: #b5b7b8;
    overflow: hidden;
    padding: 20px 10px;
    margin-right: 20px;
  }

  section .addproductOption {
    flex: 1;
    /* Take up remaining space */
    height: 100vh;
    /* Full height */
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


footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding-top: 20px;
    padding-bottom: 20px;
    display: flex; /* Add this line */
    justify-content: flex-end; /* Add this line */
  }


  footer button {
    background-color: #4caf50;
    color: white;
    padding: 15px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
  }

</style>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <title>PasarSISWA : Add Porduct</title>

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
      <a href="basicInformation.php" class="addproduct">Add a New Product</a>
      <div class="icon3">
        <a href="sellermenu.php"><i class="fas" onclick="refreshPage()">&#xf015;</i><span>Home</span></a>
        <a href="mailto:alifsafiuddin0275@gmail.com"><i class="fa">&#xf29c;</i><span>Help</span></a>
      </div>
      <div class="profile">
        <a href="logout.php"><i class="fa">&#xf2be;</i></a>
      </div>
    </div>
  </nav>
</header>
  
  <section class="container" style=" display: flex;">
    <div class="side-nav" style="width: 250;">
      <ul>
        <li><a href="basicInformation.php">Basic Information</a></li>
              <li><a href="#">Sales Information</a></li>
            </ul>
        </div>

      <div class="addproductOption">
        <h1>Sales Information</h1>

    <form method="post" action="insertVariation.php" id="myForm"> 

    <div class="form-group" style="margin-top: 15px;">
      <label for="totalStock">Total Stock</label>
      <input type="text" id="totalStock" name="totalStock" readonly required>
    </div>


     <!-- Variation fields for type, price, and stock -->
<div id="variationFields">
  <!-- Variation fields will be added here dynamically -->
</div>

<button type="button" id="addButton" onclick="addVariationField()">Add Variation</button>

<button type="submit" name="saveAndPublish">Save and Publish</button>

</div>

    </section>

  <!-- Add this button in the footer -->
<footer class="tm-footer row tm-mt-small">
    <div class="col-12 font-weight-light">
        <!-- Add the button here -->
         <button type="submit" name="update" style="float: right; margin-right: 20px;">Save and Publish</button>
    </div>
</footer>

<!-- Modified JavaScript code -->
<script>
  // Initialize the counter
  var variationCounter = 0;

  document.addEventListener("DOMContentLoaded", function () {
    addVariationField(); // Add one initial variation field

    // Function to add a new variation field
    function addVariationField() {
      variationCounter++;

      var variationFields = document.getElementById('variationFields');

      var variationField = document.createElement('div');
      variationField.className = 'form-group'; // Add a class to style the variation section
      variationField.innerHTML = `
        <label for="variation${variationCounter}"><strong>Variation${variationCounter}:</strong> </label>
        <div style="display: flex;">
          <div class="form-group" style="margin-right: 10px;">
            <label for="type${variationCounter}">Type:</label>
            <input type="text" id="type${variationCounter}" name="types[]" placeholder="Enter type">
          </div>
          <div class="form-group" style="margin-right: 10px;">
            <label for="price${variationCounter}">Price:</label>
            <input type="text" id="price${variationCounter}" name="prices[]" placeholder="Enter price">
          </div>
          <div class="form-group">
            <label for="stock${variationCounter}">Stock:</label>
            <input type="text" id="stock${variationCounter}" name="stocks[]" placeholder="Enter stock">
          </div>
        </div>
      `;

      variationFields.appendChild(variationField);
    }

    // Attach the addVariationField function to the button click event
    var addButton = document.getElementById('addButton');
    if (addButton) {
      addButton.addEventListener('click', addVariationField);
    }
  });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Call the function to update the stock value
        updateStock();

        // Function to update the product ID input field
        function updateStock() {
            // You can use Ajax to fetch the stock value from the server
            // For simplicity, I'll use a JavaScript variable here
            var stock = <?php echo $lastProductStock; ?>;

            // Update the value of the "Total Stock" input field
            var totalStockInput = document.getElementById('totalStock');
            if (totalStockInput) {
                totalStockInput.value = stock;
            }
        }
    });
</script>

<script>
   document.addEventListener("DOMContentLoaded", function () {
      // Attach the addVariationField function to the button click event
      var addButton = document.getElementById('addButton');
      if (addButton) {
         addButton.addEventListener('click', addVariationField);
      }

      // Attach the form submission function to the button click event
      var submitButton = document.getElementById('submitButton');
      if (submitButton) {
         submitButton.addEventListener('click', submitForm);
      }
   });

   function submitForm() {
      // Manually submit the form
      var form = document.getElementById('myForm');
      if (form) {
         form.submit();
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