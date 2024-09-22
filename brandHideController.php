<?php
    include_once "config.php";
    
    $b_id = $_POST['record'];
    
    // Update the cat_status column to hide the category
    $query = "UPDATE brands SET brand_status = 0 WHERE brand_id = '$b_id'";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo "Brand hidden";
    } else {
        echo "Not able to hide brand";
    }
?>