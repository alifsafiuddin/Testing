<?php
$servername = "lrgs.ftsm.ukm.my";
$username = "a187044";
$password = "giantblackfox";
$dbname = "a187044";

// Initialize variables
$feedbackMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Read orderid from URL
        $orderid = isset($_GET['orderid']) ? $_GET['orderid'] : null;

        // Use orderid to fetch order details
        $stmtOrder = $conn->prepare("SELECT * FROM tbl_order_pasarsiswa WHERE fld_order_id = :orderid");
        $stmtOrder->bindParam(':orderid', $orderid, PDO::PARAM_STR);
        $stmtOrder->execute();
        $orderDetails = $stmtOrder->fetch(PDO::FETCH_ASSOC);

        // Extract relevant details
        $userId = $orderDetails['fld_user_id'];
        $sellerId = $orderDetails['fld_seller_id'];
        $productId = $orderDetails['fld_product_id'];

        $stmtMaxFeedbackId = $conn->query("SELECT MAX(fld_feedback_id) FROM tbl_feedback_pasarsiswa");
        $maxFeedbackId = $stmtMaxFeedbackId->fetchColumn();

        if ($maxFeedbackId === null) {
            // If there are no existing feedback records, start from 1
            $feedbackId = 1;
        } else {
            // If there are existing records, extract the numeric part and increment
            $feedbackId = (int)substr($maxFeedbackId, 1) + 1;
        }

        // Format the feedback ID to have a consistent length (e.g., F001)
        $feedbackId = 'F' . str_pad($feedbackId, 3, '0', STR_PAD_LEFT);

        // Process form data
        $rating = $_POST['rating'];
        $comment = $_POST['comment'];

        // Process file upload
        $uploadDir = "feedbackPhoto/";
        $fileName = basename($_FILES["deliverImage"]["name"]);
        $targetFilePath = $fileName;
        move_uploaded_file($_FILES["deliverImage"]["tmp_name"], $uploadDir . $targetFilePath);

        // Insert data into the database
        $sql = "INSERT INTO tbl_feedback_pasarsiswa (fld_user_id, fld_seller_id, fld_product_id, fld_feedback, fld_feedback_date, fld_feedback_img, fld_feedback_rating) 
                VALUES (:userId, :sellerId, :productId, :feedback, NOW(), :photoPath, :rating)";
        $stmtFeedback = $conn->prepare($sql);

        $stmtFeedback->bindParam(':userId', $userId);
        $stmtFeedback->bindParam(':sellerId', $sellerId);
        $stmtFeedback->bindParam(':productId', $productId);
        $stmtFeedback->bindParam(':feedback', $comment);
        $stmtFeedback->bindParam(':photoPath', $targetFilePath);
        $stmtFeedback->bindParam(':rating', $rating, PDO::PARAM_INT);

        if ($stmtFeedback->execute()) {
            $feedbackMessage = "Feedback submitted successfully";

            // Update product rating in tbl_products_pasarsiswa
            $stmtCountFeedback = $conn->prepare("SELECT COUNT(*) FROM tbl_feedback_pasarsiswa WHERE fld_product_id = :productId");
            $stmtCountFeedback->bindParam(':productId', $productId);
            $stmtCountFeedback->execute();
            $numFeedbacks = $stmtCountFeedback->fetchColumn();

            // Calculate average rating
$stmtAverageRating = $conn->prepare("SELECT AVG(fld_feedback_rating) FROM tbl_feedback_pasarsiswa WHERE fld_product_id = :productId");
$stmtAverageRating->bindParam(':productId', $productId);
$stmtAverageRating->execute();
$averageRating = (float) $stmtAverageRating->fetchColumn(); // Cast to float to handle decimal values

// Update product rating in tbl_products_pasarsiswa
$stmtUpdateProductRating = $conn->prepare("UPDATE tbl_products_pasarsiswa SET fld_num_of_rating  = :averageRating,fld_product_rating  = :numFeedbacks WHERE fld_product_id = :productId");
$stmtUpdateProductRating->bindParam(':averageRating', $averageRating, PDO::PARAM_STR); // Use PARAM_STR for decimal values
$stmtUpdateProductRating->bindParam(':numFeedbacks', $numFeedbacks, PDO::PARAM_INT);
$stmtUpdateProductRating->bindParam(':productId', $productId);
$stmtUpdateProductRating->execute();


            header("Location: customermenu.php");
            exit();
        } else {
            $feedbackMessage = "Error submitting feedback";
        }
    } catch (PDOException $e) {
        $feedbackMessage = "Connection failed: " . $e->getMessage();
    } finally {
        $conn = null;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

     <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

  <!-- Basic styles of the plugin -->
  <link rel="stylesheet" href="path/to/jquery.rateyo.css"/>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PasarSISWA :Give Feedback</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style type="text/css"> 
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap');

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
section .container{
    margin: 1em;
    width: 100%;
}
section .side-nav{
    width: 30%;
    height:1300px;
    background-color: #B5B7B8; /*kelabu pekat*/
}
section .side-bar-option{
    width: 50%;
    height:100%;
    background-color: #e9eaf0; 
}
section .product-option ul li{
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap: 1rem;
    background-color: #B5B7B8;
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
header nav .logo-search{ /*align semua item dalam header*/
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-block: 35px;
}
header nav .logo-search .logo{ /*adjust font logo pasarsiswa*/
    color: #fff;
    text-transform: lowercase;
    font-size: 35px;
    font-weight: bold;
    padding-left: 30px;
}
header nav .logo-search .logo span{ /*adjust font logo pasarsiswa*/ 
    color: #fff;
    text-transform: uppercase;
    font-size: 35px;
    font-weight: bold;
}
header nav .logo-search .search-box{ /*adjust searchbox*/ 
    width: 500px;
    height: 40px;
    position: relative;
}
header nav .logo-search .search-box input{ /*adjust searchbox Seach for... input*/ 
    width: 100%;
    height: 100%;
    padding: 0 10px 0 12px;
}
header nav .logo-search .search-box i{ /*adjust searchbox icon*/ 
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
header nav .logo-search .icon a{ /*adjust nav icon*/ 
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


/* container above */

.container .addproductOption{
  padding:30px;
  width:1200px;
  background: #fff;
  box-shadow: 0 5px 10px rgba(0,0,0,.1);
  align-self:   center;
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
      padding-left: 20px;
      padding-right: 20px;
      margin-left: 20px;
      margin-right: 20px;
      display: flex;
      flex-direction: column;    
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
   .status-label {
    font-size: 18px;
    font-weight: bold;
     text-align: right; /* Align text to the right */
      margin-right: 100px;
  }


   .container{
    display: flex;
    justify-content: center;
    overflow        : hidden;
    padding:25px;
    align-self:   center;
   
}

/* rating container */

.container form{
  padding:30px;
  width:1200px;
  background: #fff;
  box-shadow: 0 5px 10px rgba(0,0,0,.1);
  align-self:   center;
}

.container form .row{
  display: flex;
  flex-wrap: wrap;
  gap:15px;
  align-self:   center;
}

.container form .row .col{
  flex:1 1 250px;
}

.rating-review{
    height: 100%;
    width: 55%;
    margin: 50px auto;
    background-color: #fff;
}
.rating-review table {
    width: 100%;
    margin: 0;
    font-family: "roboto", sans-serif;
    border-collapse: collapse;
    border-spacing: 0;
    color: #DCDCDC; /*kelabu cair*/
    margin-bottom: .625rem;
}
.rating-review table,
.rating-review td {
    font-size: .8125rem;
    text-align: center;

}
.rating-review td {
    padding: 1rem;
    width: 33.3%;

}
.tri {
    border-bottom: 1px solid #ffff;
    padding: 12px;

}
.rnb h3 {
    color: #FFE045 ; /*kuning cair*/
    font-size: 2.4rem;
    font-family: font-family: "roboto", sans-serif ;

}
.tri .pdt-rate {
    height: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;

}
.rating-stars {
    position: relative;
    vertical-align: baseline;
    color: #DCDCDC; /*kelabu cair*/
    line-height: 10px;
    float: left;

}
.grey-stars {
    height: 100%;
}
.filled-stars {
    position: absolute;
    left: 1px;
    top: 2.5px;
    height: 100%;
    overflow: hidden;
    color: #FFE045 ; /*kuning cair*/
}
.filled-stars::before,
.grey-stars::before {
    content: "\2605 \2605 \2605 \2605 \2605";
    font-size: 19px;
    line-height: 18px;
    letter-spacing: 0;
}
.tri .filled-stars::before,
.tri .grey-stars::before {
    font-size: 20px;
    line-height: 23px;  
}

.container form .row .col .inputBox{
  margin:15px 0;
}

.container form .row .col .inputBox span{
  margin-bottom: 10px;
  display: block;
}

.container form .row .col .inputBox input{
  width: 100%;
  border:1px solid #ccc;
  padding:10px 15px;
  font-size: 15px;
  text-transform: none;
}

.container form .row .col .inputBox input:focus{
  border:1px solid #000;
}

.container form .row .col .flex{
  display: flex;
  gap:15px;
}

.container form .row .col .flex .inputBox{
  margin-top: 5px;
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

.container form .row .col .rateyo {
  display: flex;
  align-items: center;
  margin-top: 10px;
  margin-bottom: 3px;
}

</style>

</head>
<body>

<?php
// Retrieve orderid from the URL
$orderid = isset($_GET['orderid']) ? $_GET['orderid'] : null;

// Use the orderid to fetch the order details from the database
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $conn->prepare("SELECT * FROM tbl_order_pasarsiswa WHERE fld_order_id = :orderid");
  $stmt->bindParam(':orderid', $orderid, PDO::PARAM_STR);
  $stmt->execute();
  $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
?>


    <header>
        <nav>
            <div class="logo-search">
                <a href="customermenu.php" class="logo" onclick="refreshPage()">pasar<span>siswa</span></a>
                <div class="search-box">
                    <input id="searchbar" onkeyup="searchProduct()" type="text" name="search" placeholder="Search Order">
                    <i class="fa-solid fa-magnifying-glass"></i>
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

    <div class="order-header" style="margin-left: 20px; margin-top: 15px">Give Feedback for Ordered Item</div>
    <section class="container" style=" display: flex;">

      <div class="product-orders">

      <!-- Product Order Container -->
      <div class="order-container">

        <!-- Product 1 Details -->
     <div class="attribute-column">
    <div><strong>Image</strong></div>
    <div><strong>Product</strong></div>
    <div><strong>Unit Price</strong></div>
    <div><strong>Quantity</strong></div>
    <div><strong>Amount</strong></div>
    </div>


    <div class="attribute-values">
    <div class="product-photo">
    <img src="img/1.png" alt="Reviewer Image">
</div>
    <div><?php echo $readrow['fld_product_name']; ?></div>
    <div><?php echo number_format($readrow['fld_price'], 2); ?></div>
    <div><?php echo $readrow['fld_quantity']; ?></div>
    <div><?php echo number_format($readrow['fld_amount'], 2); ?></div>
    </div>

    <div class="order-total">Order Total: RM<?php echo number_format($readrow['fld_amount'], 2); ?></div>
    <div class="status-label">Status: <?php echo $readrow['fld_order_status']; ?> </div>
  </div>
      </div>
      <!-- End of First Order Container -->
    </div>
</section>

<div class="container">

    <form method="post" enctype="multipart/form-data">

        <div class="row">

            <div class="col">

                <h3 class="title">Rating </h3>
                <div class="rateyo" id="rating"
        data-rateyo-rating="4"
        data-rateyo-num-stars="5"
        data-rateyo-score="3">
      </div>

      <span class='result'>Please rate the product.</span>
      <input type="hidden" name="rating">

                 <div class="col">
            <div class="inputBox">
                <span></span>
                <input type="text" name="comment" placeholder="Type your comment here">
            </div>

            <label for="deliver" class="col-sm-3 col-form-label">Add Photos</label>
            <div class="col-sm-9" id="imagePreviewContainer">
                <!-- This is where the image will be displayed -->
            </div>

            <input type="file" name="deliverImage" id="deliver" onchange="previewImage(this);">
            <button class="confirm-order-btn" name="submit_feedback">Submit</button>
        </div>
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
              
<script>
 $(function () {
  $(".rateyo").rateYo({
    precision: 0, // Set precision to 0 to allow only whole numbers
  }).on("rateyo.change", function (e, data) {
    var rating = Math.round(data.rating); // Round to the nearest integer
    $(this).rateYo("rating", rating); // Set the rating to the rounded value
    $(this).parent().find('.result').text('You rated ' + rating + ' for this product!');
    $(this).parent().find('input[name=rating]').val(rating);
  });
});
</script>

                
 </div>
</div>
</form>

    


    
</body>
</html>