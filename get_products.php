<?php
include_once 'database.php';

if (isset($_GET['category'])) {
    $category = $_GET['category'];  // No need to escape since we use prepared statements

    // Use a prepared statement to prevent SQL injection
    $query = ($category === "All")
        ? "SELECT * FROM tbl_products_pasarsiswa"
        : "SELECT * FROM tbl_products_pasarsiswa WHERE fld_category = :category";

    $stmt = $conn->prepare($query);

    if ($category !== "All") {
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
    }

    $result = $stmt->execute();

    if (!$result) {
        die("Error in query: " . $stmt->errorInfo()[2]);
    }

    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output the products HTML (similar to your existing code)
    foreach ($products as $product) {
        echo '<div class="product-option">';
        echo '<ul>';
        echo '<li>';
        if ($product['fld_product_image'] != "") {
            echo '<div class="product-imgs" style="display: flex;flex-wrap: wrap; place-content: center; ">';
            echo '<div class="img-display" style="position:relative; left: 70px;">';
            echo '<img src="img/' . $product['fld_product_image'] . '" alt="product image">';
            echo '</div>';
            echo '</div>';
        } else {
            echo '<p>No image available</p>';
        }
        ?>
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
        <?php
        echo '</li>';
        echo '</ul>';
        echo '</div>';
    }
}
?>