<?php
include_once 'database.php';
include_once 'session.php';

// Ensure that customer_id is set in the session
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id']:'';

   // Fetch product details based on product ID
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT * FROM tbl_products_pasarsiswa WHERE fld_product_id = :pid");
$stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
$pid = $_GET['pid'];
$stmt->execute();
$readrow = $stmt->fetch(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PasarSISWA : Make Order</title>
    <!-- css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style type="text/css"> 
    /* resetting */

    *{

    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: sans-serif;
    text-decoration: none;
    transition: 0.3s;

   }
    /*background belakang*/

     body{
    background: #e9eaf0;/kelabu cair/

    }

    /*container putih*/

     section .card ul li{
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap: 1rem;
    background-color: #fff;
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

    /* container card */

    .container .card{

    overflow        : hidden;
    margin-top      : 30px;
    margin-bottom   : 30px;
    margin-left     : 10px;
    width           : 1100px;
    height          : 450px;
   
    }*/
    
    .container .card ul li{
    background-color: #fff;
    align-self:   center;


    }

    .container .card ul li img{
    width: 100%;
    
    }

    .container .card .img-display{
    overflow: hidden;
    }

    .container .card h2 p {
    font-size: 0.5rem;
    padding: 0.3rem;
    opacity: 0.8;
    }

    .container .card .product-content{
    padding: 2rem 1rem ;
     }


    .container .card.product-title{
    font-size: 2rem;
    text-transform: capitalize;
    font-weight: 700;
    position: absolute;
    color: #12263a;
    
    }

    .container .card .product-rating{
    color: #5FFA3D;
    }

    .container .card .product-rating span{
    font-weight: 600;
    color: #5FFA3D;
    font-size: 15px;
    }

    .container .card .product-rating i {
    font-size: 15px;
    }

    .container .card .product-ratings span{
    font-size: 15px;
    color: #000000;
    font-weight: bold;
    }

    .container .card .product-sold span{
    font-size: 15px;
    font-weight: bold;
    color: #000000;
    }

    .container .card .product-price{
    margin: 1rem 0;
    font-size: 3rem;
    font-weight: 600;
    color: #5FFA3D;
    }

    .container .card .product-price span{
    font-size: 3rem;
    font-weight: 600;
    }

   .container .card .product-detail ul li{
    margin: 1rem 0;
    font-size: 0.9rem;
    list-style: none;
    font-weight: 600;
    opacity: 0.9;
    }

    .container .card .product-quantity ul li{
    margin: 1rem 0;
    font-size: 0.9rem;
    list-style: none;
    font-weight: 600;
    opacity: 0.9;
    }

    .container .card .product-quantity input{
    width: 40px;
    }

    .container .card .purchase-info{
    margin: 1.5rem 0;
    }

    .container .card .purchase-info .btn{
    border: 1.5px solid #ddd;
    text-align: center;
    padding: 0.45rem 0.8rem;
    outline: 0;
    margin-right: 0.2rem;
    margin-bottom: 1rem;
    }

    .container .card .purchase-info .btn{
    cursor: pointer;
    color: #fff;
    }

    .container .card .purchase-info .btn:first-of-type{
    background: #5FFA3D;
    }
    .container .card .purchase-info .btn:nth-of-type(2) {
    background: #5FFA3D; 
    }

    .container .card .purchase-info .btn:last-of-type{
    background: #006600;
    }

    .container .card .purchase-info .btn:hover{
    background: #B8FF95;
    border-color: transparent;
    color: #fff;
    }

    .container .card .social-links{
    display: flex;
    align-items: center;
    }

    .container .card .social-links {
    font-size: 0.9rem;
    list-style: none;
    font-weight: 600;
    }

    .container .card .social-links a{
    display: flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    color: #000;
    border: 0px solid #000;
    margin: 0 0.2rem;
    border-radius: 50%;
    text-decoration: none;
    font-size: 0.8rem;
    transition: all 0.5s ease;
    }

    .container .card .social-links a:hover{
    background: #000;
    border-color: transparent;
    color: #fff;
    }

  
</style>
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
            <div class="logo-search">
                <a href="customermenu.php" class="logo" onclick="refreshPage()">pasar<span>siswa</span></a>
                
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
    

   <section class="container" style=" display: flex; place-content: center;">
    <div class = "card"> 

        <!-- Dynamic product details based on database -->
    <ul>
            <li>
                <!-- Dynamic product options based on database -->
                <!--card left -->
                <?php if ($readrow['fld_product_image'] == "" ) {
                                echo "No image";
                }
                else { ?>

                    <div class="product-imgs" style="display: flex; flex-wrap: wrap; place-content: center; place-self: center; width: 60%;">
                        <div class="img-display">
                            <img src="img/<?php echo $readrow['fld_product_image']; ?>" class="img-responsive">
                            <?php } ?>
                        </div>
                        <div><h5> Description </h5>
                            <td><?php echo $readrow['fld_product_description'] ?></td>
                        </div>
                    </div>
              
    
               <!--card right -->
            
                    <div id="item_name" value="Product Name" class = "product-content">
                    <h2 class="product-title"><?php echo $readrow['fld_product_name'] ?></h2>
                    
                    <div class = "product-rating" >
                         <p><span><?php echo $readrow['fld_product_rating'] ?><span> Ratings</p>
                    </div>
                        
                    <div class = "product-sold">
                         <p><span><?php echo $readrow['fld_sold'] ?><span> Sold</p>
                    </div>

                    <div id="price" value="Product Price" class = "product-price">
                          <p>RM <span><?php echo $readrow['fld_price'] ?><span></p>
                    </div>

                    <div class = "product-detail">
                        <ul>
                        <li>Category: <span><?php echo $readrow['fld_category'] ?></span></li>
                        </ul>
                    </div>

                             <div id="quantity" value="Product Quantity" class = "product-quantity">
                            <ul>
                            <li>Quantity: <span><input type = "number" min = "1" max ="15"value = "1">
                            </span></li>
                            </ul>
                            </div>

                            <div class = "purchase-info">
                            <button type="submit" class="btn btn-make-order">Make Order</button>
                            <a href="https://api.whatsapp.com/send?phone=174362979&text=Welcome%20to%20pasarSISWA.%20What%20do%20you%20want%20to%20know%20about%20the%20<?php echo urlencode($readrow['fld_product_name']); ?>%20sold?">
    <button type="button" class="btn">Chat Now</button>
</a>

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
  
  </section>

  <script>
        // Function to handle the "Make Order" button click
        function makeOrder() {
    // Get the values you want to send to order_crud.php
    var orderID = 'O' + ('00' + Math.floor(Math.random() * 100)).slice(-2); // Generate a unique order ID (customize as needed)
    var pid = '<?php echo $pid; ?>'; // Assuming $pid is defined in your PHP code
    var quantity = $('.product-quantity input').val();


}

// Attach the function to the "Make Order" button click event
$(document).on('click', '.btn-make-order', function() {
    makeOrder();
});

    </script>

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
    <script>
    $(document).ready(function () {
    $(".btn-make-order").on('click', function (e) {
        e.preventDefault();
        var item_name = $(this).closest(".card").find(".product-title").text().trim();
        var price = $(this).closest(".card").find(".product-price span").text().trim();
        var quantity = $(this).closest(".card").find(".product-quantity input").val();
        var image_name = $(this).closest(".card").find(".product-imgs img").attr("src");

        // URL encode values
        var dt = '&item_name=' + encodeURIComponent(item_name) +
            '&price=' + encodeURIComponent(price) +
            '&quantity=' + encodeURIComponent(quantity) +
            '&image_name=' + encodeURIComponent(image_name);

        var url = 'http://localhost/aa/checkout.php?' + dt;

        $.ajax({
            url: url,
            method: 'GET',
            success: function () {
                window.location.href = url;
            }
        });
    });
});
</script>

</body>
</html>
