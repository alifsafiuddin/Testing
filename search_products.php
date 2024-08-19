<?php
include_once 'database.php';

if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);

    $query = "SELECT * FROM tbl_products_pasarsiswa WHERE fld_product_name LIKE '%$search%'";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error in query: " . mysqli_error($conn));
    }

    $products = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }

    // Output the products HTML (similar to your existing code)
    foreach ($products as $product) {
        echo '<div class="product-option">';
        echo '<ul>';
        echo '<li>';
        if ($product['fld_product_image'] != "") {
            echo '<div class="product-imgs" style="place-self: center">';
            echo '<div class="img-display">';
            echo '<img src="img/' . $product['fld_product_image'] . '" alt="product image">';
            echo '</div>';
            echo '</div>';
        } else {
            echo '<p>No image available</p>';
        }

        echo '<div class="product-content">';
        echo '<h2 class="product-title">' . $product['fld_product_name'] . '</h2>';
        // Output other product details as needed
        echo '</div>';
        echo '</li>';
        echo '</ul>';
        echo '</div>';
    }
}
?>