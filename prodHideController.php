<?php
    include_once "config.php";
    
    $prod_id = $_POST['record'];
    
    // Update the cat_status column to hide the category
    $query = "UPDATE products SET prod_status = 0 WHERE product_id = '$prod_id'";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo "Product hidden";
    } else {
        echo "Not able to hide product";
    }
?>