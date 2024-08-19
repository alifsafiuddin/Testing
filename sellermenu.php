<?php
include_once 'database.php';
include_once 'session.php';

$seller_id = isset($_SESSION['seller_id']) ? $_SESSION['seller_id'] : '';

// Function to get products from the database based on seller ID
function getProducts($conn, $sellerId) {
    $query = "SELECT * FROM tbl_products_pasarsiswa WHERE fld_seller_id = '$sellerId'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error in query: " . mysqli_error($conn));
    }

    $products = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }

    return $products;
}

$conn = mysqli_connect('lrgs.ftsm.ukm.my', 'a187044', 'giantblackfox', 'a187044');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve seller ID from the session
$sellerId = $_SESSION['seller_id'];

// Get products for the specific seller
$products = getProducts($conn, $sellerId);
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>PasarSISWA : Seller Menu</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Link File CSS -->
    <link rel="stylesheet" href="style_sellermenu.css">

    <style>
        .product-content {
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 0px;
    margin: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0.1, 0.1, 0.1, 0.1);
    transition: box-shadow 0.3s ease-in-out;
    font-family: 'Arial', sans-serif; /* You can change the font-family as needed */
}

.product-content:hover {
    box-shadow: 0 4px 8px rgba(0.2, 0.2, 0.2, 0.2);
}

.product-container ul {
    list-style: none; /* Remove default list styling */
    margin: 0;
    padding: 0;
}

.product-container li {
    margin-bottom: 20px; /* Add margin between each item */
}


        .product-title {
            font-size: 1.5em;
            margin-bottom: 10px;
            color: #333;
            font-weight: bold;
        }

        .product-price {
            font-size: 1.2em;
            color: #e44d26;
        }

        .product-ratings,
        .product-sold {
            font-size: 1em;
            color: #555;
            margin-bottom: 8px;
        }

        .purchase-info {
            margin-top: 0px;
            display: flex;
            gap: 0px; /* Adjust the gap as needed */
        }

        .purchase-info a.btn {
            display: inline-block;
            background-color: #3498db;
            color: #fff;
            padding: 0px 0px;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease-in-out;
        }

        .purchase-info a.btn:hover {
            background-color: #2980b9;
        }

        .container {
            display: flex;
            padding-right: 10px;
        }

        .side-nav {
            width: 150px;
            height: auto;
        }

        .product-container {
            padding: 10px;
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
                <a href="sellermenu.php" class="logo" onclick="refreshPage()">pasar<span>siswa</span></a>
                <div class="search-box">
                    <input id="searchbar" onkeyup="searchProduct()" type="text" name="search" placeholder="Search Here..">
                </div>  
                
                <div class="icon">
                    <a href="sellermenu.php"><i class="fas" onclick="refreshPage()">&#xf015;</i><span>Home</span></a>
                    <a href="mailto:alifsafiuddin0275@gmail.com"><i class="fa">&#xf29c;</i><span>Help</span></a>
                </div>

                <div class="icon2">
                    <a href="logout.php"><i class="fa">&#xf2be;</i></a>
                </div>
            </div>
        </nav>
    </header>

    <section class="container" style="display: flex; padding-right: 100px; ">
        <div class="side-nav" style="width: 300px;height: auto;" >
            <ul>
                <li><a href="sellermenu.php" onclick="refreshPage()">Home</a></li>
                <li><a href="basicInformation.php">+ Add a new product +</a></li>
                <li><a href="confirmOrder2.php">Orders</a></li>
                <li><a href="SellerReport2.php">Report</a></li>
            </ul>
        </div>


        <div class="product-option product-container" style="padding: 20px 20px 20px 20px;  padding-left: 100px;">
            <!-- Dynamic product details based on database -->
    
            <ul>
                <?php foreach ($products as $product) : ?>
            
                    <ul>
                        <li>
                            <!-- Dynamic product options based on database -->
                            <?php if ($product['fld_product_image'] != "") : ?>
                            <div class="product-imgs" style="place-self: center">
                                <div class="img-display">
                                    <img src="img/<?php echo $product['fld_product_image']; ?>" alt="product image" style="width: 300px; height: 250px;">
                                </div>
                            </div>

                            <?php else : ?>
                            <p>No image available</p>
                            <?php endif; ?>

                        <div class="product-content">
                            <h2 class="product-title"><?php echo $product['fld_product_name']; ?></h2>

                            <div class="product-price">
                                <p>RM <span><?php echo $product['fld_price']; ?><span></p>
                            </div>

                            <div class="product-ratings">
                                <p> <span>Ratings : <?php echo $product['fld_num_of_rating']; ?><span> </p>
                            </div>

                            <div class="product-sold">
                                <p><span>Sold : <?php echo $product['fld_sold']; ?><span> </p>
                            </div>

                            <div class="product-sold">
                                <p><span>Stock : <?php echo $product['fld_stock']; ?><span> </p>
                            </div>

                            <div class="purchase-info" style="padding-bottom: 0px;">
                                <a href="editProduct.php?pid=<?php echo $product['fld_product_id']; ?>" class="btn">Edit</a>
                            </div>
                            <div class="purchase-info">
                                        <a href="viewFeedback.php?product_id=<?php echo $product['fld_product_id']; ?>" class="btn">View Feedback</a>

                            </div>
                        </div>
                        </li>
                    </ul>
                <?php endforeach; ?>

            </ul>
        </div>

    </section>
     <!-- Add the jQuery library -->
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