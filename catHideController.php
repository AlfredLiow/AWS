<?php
    include_once "config.php";
    
    $c_id = $_POST['record'];
    
    // Update the cat_status column to hide the category
    $query = "UPDATE categories SET cat_status = 0 WHERE cat_id = '$c_id'";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo "Category hidden";
    } else {
        echo "Not able to hide category";
    }
?>