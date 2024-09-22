<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["productId"]) && isset($_POST["quantity"])) {
    $productId = $_POST["productId"];
    $quantity = $_POST["quantity"];

    // Update the stock quantity in the database
    $sql = "UPDATE products SET stock = stock + $quantity WHERE product_id = $productId";
    if ($con->query($sql) === TRUE) {
        // Success
        echo "success";
    } else {
        // Error
        echo "error";
    }
}
?>