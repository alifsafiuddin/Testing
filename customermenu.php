<?php
include_once 'database.php';
include_once 'session.php';

// Ensure that customer_id is set in the session
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id']:'';

function getProducts($conn) {
    $query = "SELECT * FROM tbl_products_pasarsiswa";
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

$products = getProducts($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PasarSISWA : Customer Menu</title>

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
        height:auto;
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



    /*start container side-nav*/

    .container .side-nav{
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
        color: #000000;
    }
    .container .side-nav ul li:hover{
        background-color: #D4F1C9;
    }



    /*start container side-bar-option*/

    .container .side-bar-option{
        overflow: hidden;
        padding: 25px 10px 20px 10px;

    }
    .container .side-bar-option ul li{
        
        padding: 35px 0px;
        color: #000000;
        cursor: pointer;
        background-color: #fff;
        margin: 5px 0 20px 0;
        text-align: center;
        font-weight: bold;
        
    }
    .container .side-bar-option ul li img{
        width: 80%;
    }
    .container .side-bar-option ul li a{
        color: #000000;
        display: block;
    }
    .container .side-bar-option ul li:hover{
        background-color: #D4F1C9;
    }


    /*start container product-option*/

    .container .product-option{
        overflow: hidden;
        padding: 15px 10px 15px 10px;
    }
    .container .product-option ul li{
        background-color: #fff;
    }
    .container .product-option ul li img{
        width: 70%;
        align-self: center;

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

    /* Add CSS for highlighted category image */
        .category-image.active {
            border: 3px solid #5FFA3D; /* Change border color as needed */
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
                <a href="customermenu.php" class="logo" onclick="refreshPage()">pasar<span>siswa</span></a>
                <div class="search-box">
                    <input id="searchbar" onkeyup="searchProduct()" type="text" name="search" placeholder="Search Here..">
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

    <section class="container" style="display: flex;">
        <div class="side-nav">
            <ul>
                <li><a href="customermenu.php" onclick="refreshPage()">Home</a></li>
                <li><a href="ViewOrderStatus.php">View Order Status</a></li>
                <li><a href="orderList.php">Give Feedback</a></li>
            </ul>
        </div>

        <div class="side-bar-option" style="margin-left: 10px; width: 400px">
            <ul>
                <li class="category-image" data-category="All">
                    <img src="img/all product.png"  >
                    <a href="#">All</a>
                </li>
                <li class="category-image" data-category="Snacks">
                    <img src="img/snacks.png" >
                    <a href="#">Snacks</a>
                </li>
                <li class="category-image" data-category="Outfits">
                    <img src="img/clothes.png" >
                    <a href="#">Outfits</a>
                </li>
                <li class="category-image" data-category="Others">
                    <img src="img/others.png" >
                    <a href="#">Others</a>
                </li>
            </ul>
        </div>

        <div id="product-container" class="product-option" style="width:1300px">
            <!-- Dynamic product details based on filtered products -->
            <ul>
                <?php foreach ($products as $product) : ?>
                    <div class="product-option">
                        <ul>
                            <li>
                                <!-- Dynamic product options based on database -->
                                <?php if ($product['fld_product_image'] != "") : ?>
                                    <div class="product-imgs" style="display: flex;flex-wrap: wrap; place-content: center; ">
                                        <div class="img-display" style="position:relative; left: 70px;">
                                            <img src="img/<?php echo $product['fld_product_image']; ?>" alt="product image">
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <p>No image available</p>
                                <?php endif; ?>

                                <div class="product-content">
                                    <h2 class="product-title"><?php echo $product['fld_product_name']; ?></h2>

                                    <div class="product-ratings">
                                        <?php
                                        $rating = isset($product['fld_num_of_rating']) ? $product['fld_num_of_rating'] : 'Unknown';

                                        if ($rating > 4) {
                                            $label = '🔥 HOT';
                                            $color = 'red';
                                        } elseif ($rating > 3) {
                                            $label = '👍 GOOD';
                                            $color = '#FFAC1C';
                                        } elseif ($rating > 2) {
                                            $label = '&#128513; NOT BAD';
                                            $color = 'blue';
                                        } else {
                                            $label = '😕 NOT REALLY';
                                            $color = 'grey';
                                        }
                                        ?>
                                        <p>Rating: <?php echo $rating; ?> / 5 (<span class="cmdt" style="color: <?php echo $color; ?>; font-weight: bold;"><?php echo $label; ?></span>)</p>
                                    </div>

                                    <div class="cmdt" style="margin-top: 10px">
                                        <p><span><?php echo $product['fld_sold']; ?><span> Sold</p>
                                    </div>

                                    <div class="product-price">
                                        <p>RM <span><?php echo $product['fld_price']; ?><span></p>
                                    </div>

                                    <div class="product-detail">
                                        <ul>
                                            <li>Category: <span><?php echo $product['fld_category']; ?></span></li>
                                            <!-- Add other details as needed -->
                                        </ul>
                                    </div>

                                    <div class="purchase-info">
                                        <a href="makeOrder.php?pid=<?php echo $product['fld_product_id']; ?>" class="btn">Make Order</a>
                                         <a href="viewFeedback.php?product_id=<?php echo $product['fld_product_id']; ?>" class="btn">View Feedback</a>

                                    </div>

                                    <div class = "social-links">
                            <p>Share </p>
                            <a href = "https://www.facebook.com/amira.misran.3?mibextid=LQQJ4d"><i class = "fab fa-facebook"></i></a>
                            <a href = "https://instagram.com/amiramsrn?igshid=OGQ5ZDc2ODk2ZA=="><i class = "fab fa-instagram"></i></a>
                            <a href = "https://x.com/farahdianamasri?s=11"><i class = "fab fa-twitter"></i></a>
                            </div>
                                </div>
                            </li>
                        </ul>
                    </div>
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
                // Remove 'active' class from all category images
                $(".category-image").removeClass("active");

             // Add 'active' class to the clicked category image
                $(this).addClass("active");


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