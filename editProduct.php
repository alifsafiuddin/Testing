<?php
$uploadDir = 'img/'; 
include_once 'database.php';

function getProductById($conn, $productId) {
    $query = "SELECT * FROM tbl_products_pasarsiswa WHERE fld_product_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $productId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    return mysqli_fetch_assoc($result);
}

function updateProduct($conn, $productId, $productName, $category, $description, $stock, $price, $imagePath) {
    // Check if $imagePath is empty, if it is, don't update the image field
    $imageUpdate = empty($imagePath) ? "" : ", fld_product_image=?";

    $query = "UPDATE tbl_products_pasarsiswa SET fld_product_name=?, fld_category=?, fld_product_description=?, fld_stock=?, fld_price=?" . $imageUpdate . " WHERE fld_product_id=?";
    
    $stmt = mysqli_prepare($conn, $query);

    if (empty($imagePath)) {
        mysqli_stmt_bind_param($stmt, 'sssdds', $productName, $category, $description, $stock, $price, $productId);
    } else {
        mysqli_stmt_bind_param($stmt, 'sssddss', $productName, $category, $description, $stock, $price, $imagePath, $productId);
    }

    return mysqli_stmt_execute($stmt);
}
function uploadImages($productId) {
    global $uploadDir; 
    $imagePath = '';

    if (!empty($_FILES['productImage']['name'][0])) {
        $imagePath = '';

        // Iterate through uploaded files
        for ($i = 0; $i < count($_FILES['productImage']['name']); $i++) {
            $imageName = $_FILES['productImage']['name'][$i];
            $imageTmpName = $_FILES['productImage']['tmp_name'][$i];
            $targetFilePath = $uploadDir . $imageName;

            // Move the file to the target directory
            if (move_uploaded_file($imageTmpName, $targetFilePath)) {
                $imagePath .= $imageName . ','; 
            }
        }
    }

    return rtrim($imagePath, ','); 
}

$conn = mysqli_connect('lrgs.ftsm.ukm.my', 'a187044', 'giantblackfox', 'a187044');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
    $productId = $_POST['pid'];
    $productName = $_POST['name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $stock = $_POST['stock'];
    $price = $_POST['price'];

    // Upload new images and get the image path
    $imagePath = uploadImages($productId);

    // Get the existing product details
    $productDetails = getProductById($conn, $productId);

    // Delete the old image file
    if (!empty($productDetails['fld_product_image']) && file_exists($uploadDir . $productDetails['fld_product_image'])) {
        unlink($uploadDir . $productDetails['fld_product_image']);
    }

     if (!empty($imagePath) || !empty($productDetails['fld_product_image'])) {
        if (updateProduct($conn, $productId, $productName, $category, $description, $stock, $price, $imagePath)) {
            $successMessage = "Product information updated successfully.";
        } else {
            $errorMessage = "Error updating product information: " . mysqli_error($conn);
        }
    } else {
        $errorMessage = "Please upload at least one image.";
    }
}

if (isset($_GET['pid'])) {
    $productId = $_GET['pid'];
    $productDetails = getProductById($conn, $productId);
} else {
    header("Location: sellermenu.php");
    exit();
}

mysqli_close($conn);
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
              height: 100%;
              background-color: #B5B7B8;
              overflow: hidden;
              padding: 20px 10px 20px 10px;
          }
  
          section .editproduct {
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
    *{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: sans-serif;
    text-decoration: none;
    transition: 0.3s;
}

body{
    background: #e9eaf0;/kelabu cair/
}

    section {
            display: flex;
            justify-content: center; /* Center the content horizontally */
            align-items: stretch; /* Stretch the content vertically */
        }

        section .side-nav {
            width: 250px;
            height: 100%;
            background-color: #B5B7B8;
            overflow: hidden;
            padding: 20px 10px 20px 10px;
        }

        section .editproduct {
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

/start container side-nav/

.container .side-nav{
    width: 250px;
      height: 113vh;
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

.container .side-nav ul li.active {
    background-color: #D4F1C9; /* Light green background for active item */
}

/start container side-bar-option/

.container .editproduct{
    width: 100%;
    height: 100%;
    background-color: #fff;
    overflow: hidden;
    padding: 35px;
    margin-top: 30px;
    margin-left: 220px;
    margin-right: 20px; /* Added margin to the right */
    margin-bottom: 30px;
}
.container .editproduct ul li{
    padding: 25px 0px;
    color: #000000;
    background-color: #fff;
    margin: 5px 0 10px 0;
    text-align: center;
    font-weight: bold;
}
.container .editproduct ul li img{
    width: 100%;
}
.container .editproduct ul li a{
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

    .editproduct form button {
      margin-left: auto;
      margin-top: 5px;
      background-color: #4caf50;
      /* Green */
      color: white;
      padding: 15px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }

    .editproduct form button:hover {
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

.image-preview {
  width: 100px; 
  height: 100px; 
  object-fit: cover; 
}
.image-container {
    display: flex;
    align-items: center;
}

.image-upload,
.image-preview-container {
    width: 230px; 
    height: 200px; 
    display: flex;
    justify-content: center;
    align-items: center;
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

.image-preview {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.image-preview-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PasarSISWA : Edit Product</title>
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
      <a href="#" class="addproduct">Edit Product</a>
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
        <div class="side-nav" style="width: 250; height: auto; ">
            <ul>
                <li class="active"><a href="#">Product Information</a></li>
            </ul>
        </div>

      <div class="editproduct">
        <h1>Product Information</h1>

<form action="editproduct.php" method="post" enctype="multipart/form-data">

   <div class="form-group">
        <label for="productImage">Product Images</label>
        <div class="image-container">
            <div class="image-upload">
                <input type="file" id="productImage" name="productImage[]" accept="image/*" onchange="displayImagePreviews(this);"  multiple>
                 <div class="file-box" id="fileName" onclick="document.getElementById('productImage').click();">
                <div class="file-content">
                    <i class="fas fa-cloud-upload-alt tm-upload-icon"></i>
                    <span>Images</span>
                </div>
            </div>
            </div>
            <div class="image-preview-container" id="imagePreviewContainer">
            <img src="img/<?php echo $productDetails['fld_product_image']; ?>" alt="product image">
            </div>
        </div>
    </div>

  <div class="form-group">
      <label for="productNameid">Product ID</label>
      <input type="text" id="productid" name="pid" value="<?php echo $productDetails['fld_product_id']; ?>" required readonly>
    </div>

         <div class="form-group">
      <label for="productName">Product Name</label>
      <input type="text" id="name" name="name" value="<?php echo $productDetails['fld_product_name']; ?>" >
    </div>

    <div class="form-group">
        <label for="category">Category</label>
        <select id="category" name="category">
            <?php
            $currentCategory = $productDetails['fld_category'];
            $categories = array("Snacks", "Outfits", "Books", "Others");

            // Generate options for the dropdown
            foreach ($categories as $categoryOption) {
                $selected = ($categoryOption === $currentCategory) ? 'selected' : '';
                echo "<option value='$categoryOption' $selected>$categoryOption</option>";
            }
            ?>
        </select>
    </div>

 <div class="form-group">
    <label for="description">Description</label>
    <textarea id="description" name="description" rows="5" placeholder="Enter description"><?php echo $productDetails['fld_product_description']; ?></textarea>
</div>

      <div class="form-group">
      <label for="stock">Stock</label>
      <input type="number" id="stock" name="stock" value="<?php echo $productDetails['fld_stock']; ?>">
    </div>

      <div class="form-group">
      <label for="productName">Price per unit (RM)</label>
      <input type="number" id="price" name="price" value="<?php echo $productDetails['fld_price']; ?>">
    </div>

    <div class="form-group"style="text-align: right;">
     
     
      <button type="submit" name="create">Save</button>
      

    </div>
  </form>
</div>

    </section>

<script>
    function displayImagePreviews(input) {
        var container = document.getElementById('imagePreviewContainer');
        container.innerHTML = '';

        if (input.files) {
            for (var i = 0; i < input.files.length; i++) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    var preview = document.createElement('img');
                    preview.src = e.target.result;
                    preview.className = 'image-preview';
                    container.appendChild(preview);
                };

                reader.readAsDataURL(input.files[i]);
            }
        }
    }
</script>

<script>
    // Function to update the product ID input field
    function updateProductID() {
        // You can use Ajax to fetch the next product ID from the server
        // For simplicity, I'll use a JavaScript variable here
        var nextProductID = <?php echo $nextProductID; ?>;

        // Update the value of the hidden input field
        document.getElementById('productid').value = nextProductID;
    }

    // Call the function when the page loads
    window.onload = updateProductID;
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

<?php if (isset($successMessage)): ?>

<?php endif; ?>
</body>
</html>