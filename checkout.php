<?php
include_once 'session.php';

// Ensure that customer_id is set in the session
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';


$item_name = isset($_GET['item_name']) ? $_GET['item_name'] : '';
$price = isset($_GET['price']) ? $_GET['price'] : '';
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : '';
$seller_id = isset($_GET['seller_id']) ? $_GET['seller_id'] : '';
$product_id = isset($_GET['product_id']) ? $_GET['product_id'] : '';
$image_name = isset($_GET['image_name']) ? $_GET['image_name'] : '';


// Database connection details
$servername = "lrgs.ftsm.ukm.my";
$username = "a187044";
$password = "giantblackfox";
$dbname = "a187044";

// Fetch seller details based on seller ID
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->prepare("SELECT fld_business_name FROM tbl_seller_pasarsiswa WHERE fld_seller_id = :seller_id");
$stmt->bindParam(':seller_id', $seller_id, PDO::PARAM_STR);
$stmt->execute();
$seller_details = $stmt->fetch(PDO::FETCH_ASSOC);

$business_name = isset($seller_details['fld_business_name']) ? $seller_details['fld_business_name'] : '';

if (isset($_GET)) {

    function getOrders($conn) {
    $query = "SELECT * FROM tbl_products_pasarsiswa";
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


    $orders = getOrders($conn);

    // Assuming you have a condition to choose a specific product
    $selectedProduct = $orders[0]; // Change this based on your condition

    $product_id = $selectedProduct['fld_product_id'];
    $seller_id = $selectedProduct['fld_seller_id']

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Integration (Stripe)</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style type="text/css">
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap");

    * {
      margin: 0;
      padding: 0;
      font-family:  sans-serif;
      box-sizing: border-box;
      text-decoration: none;
      transition: 0.3s;
    }
    body {
      background-color: #e9eaf0;
      width: 100%;
      height: auto;
      bottom: 0;
    }

    /* header */

    header{
    background-color: #5FFA3D;
    background-image: linear-gradient(0deg, #5FFA3D, #2AA1A3);
    height: 125px;
    }

    header nav{
    width: 100%;
    margin: auto;
    }

    header nav .logo-search{ 
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-block: 35px;
    }

    header nav .logo-search .logo{ 
    color: #fff;
    text-transform: lowercase;
    font-size: 35px;
    font-weight: bold;
    padding-left: 30px;
    }

    header nav .logo-search .logo span{ 
    color: #fff;
    text-transform: uppercase;
    font-size: 35px;
    font-weight: bold;
    background-color: transparent;
    }

    header nav .logo-search .search-box{ 
    width: 500px;
    height: 40px;
    position: relative;
    }

    header nav .logo-search .search-box input{ 
    width: 100%;
    height: 100%;
    padding: 0 10px 0 12px;
    }

    header nav .logo-search .search-box i{ 
    position: absolute;
    right: 2;
    top: 10;
    height: 100%;
    width: 55px;
    text-align: center;
    line-height: 30px;
    cursor: pointer;
    color: #fff;
    background-color: #5FFA3D ;
    border: 6px solid white;
    }
    
    header nav .logo-search .icon a span.header-span {
    color: #fff;
    margin-left: 10px;
    font-size: 15px;
    text-align: center;
    font-family: sans-serif;
    background-color: transparent; /* Set background color to transparent */
    }

    header nav .logo-search .icon a{ 
    color: #fff;
    margin-left: 10px;
    font-size: 25px;
    }

    header nav .logo-search .icon span{
    color: #fff;
    margin-left: 10px;
    font-size: 15px;
    text-align: center;
    font-family: sans-serif;
    }

    header nav .logo-search .icon a:hover{
    color: #fccb3f;
    }

    header nav .logo-search .icon a span:hover{
    color: #fccb3f;
    }

    header nav .logo-search .icon2 a {
    color: #fff;
    font-size: 40px;  
    padding-right: 30px;
    } 

    header nav .logo-search .icon2 a:hover{
    color: #fccb3f;
    }

    .row {
      max-width: 1000px;
      background-color: #e9eaf0;
      margin: 0 auto;
      display: flex;
      justify-content: space-around;
      align-items: center;
      padding: 5px 2px;
      top: 0;
      left: 0;
      bottom: 0;
      text-align: center;
    }

    .col-md-3 {
      width: 300px;
      background: transparent;
      padding: 0;
      margin: 0 5px;
    }

    .col-md-6 {
      width: 500px;
      background: transparent;
      padding: 10px 5px;
      margin: 10px 5px;
      display: inline-block;
    }

    .checkout-container {
      max-width: 80%;
      margin: 0 auto !important;
      padding: 5px;
      background-color: #fff;
      float: right;
    }

    .checkout-container > img {
      width: 300px;
      height: 300px;
      padding: 5px;
    }
    .checkout-container > span {
      display: block;
      width: 300px;
      margin: 0 auto !important;
    }

    .checkout-container > h4 {
      width: 300px;
      margin: 0 auto !important;
    }

    .card {
      background-color: #edf2f4;
      box-shadow: 2px 1px #adb5bd;
      transition: 0.8s;
      transform: scale(0.7);
    }

    .card:hover {
      transform: scale(0.9);
    }
    .card-header {
      background-color: #5FFA3D;
      font-weight: 700;
      padding: 5px;
    }
    .card-body {
      background-color: #f7ede2;
      bottom: 0;
      margin: 0;
      padding: 0;
    }

    .card-footer > span {
      display: block;
      width: 100%;
      background-color: #f8f9fa;
      text-align: center;
      font-weight: 800;
      bottom: 0;
      margin: 0;
      padding: 0;
      top: -8px;
      position: relative;
    }

    .card-body > img {
      width: 100%;
      height: 100%;
      border-radius: 0;
      border: 0;
      padding: 11px;
      margin: 0;
    }

    span:nth-child(even) {
      color: #a4161a;
      font-size: 1rem;
    }

    span:nth-child(odd) {
      background-color: #000;
      color: whitesmoke;
    }

    .back {
      width: 20%;
      outline: none;
      border: 0;
      padding: 10px 7px;
      text-transform: uppercase;
      margin: 10px;
      background-color: #e9eaf0;
      text-align: center;
      color: whitesmoke;
      left: 30%;

      position: relative;
    }
    .col-md-6:nth-child(2) {
      text-align: center;
      margin: 0 auto !important;
      float: right;
      width: 50%;
    }

    .col-md-6:nth-child(1) {
      background-color: #ffa502;
      border: 0;
      border-radius: 5px;
    }

    .form-container {
      width: 100%;
      margin: 0 5px;
      padding: 1px;
      background: transparent;
      background-color: #fff;

    }
    .form-container > form > div > input {
      display: block;
      font-family:  "Poppins";
      width: 100%;
      border: 0;
      outline: none;
      border-radius: 0;
      border-bottom: 2px solid #000000;
      background: transparent;
      box-sizing: border-box;
      font-size: 1.2rem;
      padding: 5px;
      margin: 2px;
      top: 5px;
      color: rgb(14, 0, 0);
      
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    .form-container > form > div,
    .form-container > form {
      position: relative;
      background: transparent;
      margin: 25px 0px;
      padding: 10px;
    }
    .form-container > form > div > label {
      display: block;
      font-weight: bold;
      top: 1px;
      position: absolute;
      background: transparent;
      padding: 1px;
      text-align: justify;
      transition: 0.6s;
      pointer-events: none;
    }
    .form-container > form > div > input:focus ~ label {
      top: -20px;
      position: absolute;
      color: #000000;
    }

    .form-container > form > div > input:valid ~ label {
      top: -20px;
      color: #717171;
    }


    .form-container > button {
      display: block;
      width: 80px;
      margin: 0 auto !important;
      background-color:#5FFA3D ;
      color: #000000; 
      place-content: center;
    }
    </style>

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
            <div class="logo-search">
                <a href="customermenu.php" class="logo" onclick="refreshPage()">pasar<span class="header-span">siswa</span></a>
                
        <div class="search-box" >
                    <input type="hidden" placeholder="Search Here...">
                    
        </div>  

        <div class="icon">
                    <a href="customermenu.php"><i class="fas" onclick="refreshPage()">&#xf015;</i><span>Home</span></a>
          <a href="mailto:alifsafiuddin0275@gmail.com"><i class="fa">&#xf29c;</i><span>Help</span></a>
        </div>

        <div class="icon2">
          <a href="logout.php"><i class="fa">&#xf2be;</i></a>
        </div>

            </div>
        </nav>
    </header>
    
 
<div class="row">
    <div class="col-md-6" style="background-color: #5FFA3D">
        <div class="form-container">
        <form autocomplete="off" action="stripe/checkout-charge.php" method="POST" id="paymentForm">
                <div>
                    <input type="text"  name="product_name" value="<?php echo $item_name ?>" disabled required/>
                    <label>Product name</label>
                </div>
                <div>
                    <input type="text" name="user_id" value="<?php echo $user_id; ?>" readonly required/>
                    <label>Customer ID</label>
                </div>
                <div>
                    <input type="text"  name="price" value="<?php echo number_format($price, 2, '.', ''); ?>" disabled required/>
                    <label>Price (RM)</label>
                </div>
                <div>
                    <input type="number" name="quantity" value="<?php echo $quantity ?>" disabled required/>
                    <label>Quantity</label>
                </div>
                <div>
                <input type="number" name="amount" value="<?php echo number_format($price * $quantity, 2, '.', ''); ?>" disabled required/>
                    <label>Amount (RM)</label>
                </div>
                <input type="hidden" name="product_name" value="<?php echo $item_name; ?>" />
                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
                <input type="hidden" name="price" value="<?php echo number_format($price, 2, '.', ''); ?>" />
                <input type="hidden" name="quantity" value="<?php echo $quantity; ?>" />
                <input type="hidden" name="amount" value="<?php echo number_format($price * $quantity, 2, '.', ''); ?>" />
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
                <input type="hidden" name="seller_id" value="<?php echo $seller_id; ?>" />
                <input type="hidden" name="image_name" value="<?php echo $image_name; ?>" />
                <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_51OTdSkFOLOhoKPosClrXAz58BejmHK3U7xGmOuJGaDdknT3xtyvQCU0epXoUiVRN1xwiPu48H3YywXVSdDVoF57I00mr73ldTd"
    data-amount="<?php echo str_replace(",", "", $price) * $quantity * 100 ?>"
    data-name="<?php echo $item_name ?>"
    data-description="<?php echo $business_name ?>"
    data-product_id="<?php echo $product_id; ?>"
    data-seller_id="<?php echo $seller_id; ?>"
    data-image="<?php echo $image_name ?>"
    data-currency="myr"
    data-locale="auto"
    data-label="Pay"
    >
</script>

                <br> 
                <div style="text-align: center;">
                <button type="button" onclick="goback()" class="stripe-button-el" style="visibility: visible;"><span style="display: block; min-height: 30px;">Cancel</span></button>
    </div>
            </form>
        </div>
    </div>
    <div class="checkout-container" >
    <h4><?php echo $item_name ?></h4>
    <img src="<?php echo $image_name ?>" class="img-responsive"/>
    </div>
    </div>
</div> 

<?php
  }
?>
<script>
    function goback(){
        window.history.go(-1);
    }

    $('#ph').on('keypress',function(){
         var text = $(this).val().length;
         if(text > 9){
              return false;
         }else{
            $('#ph').text($(this).val());
         }
         
    });
</script>
</body>
</html>
