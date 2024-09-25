<?php
include("Conf.php"); // Ensure this file correctly sets up the database connection

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required POST variables are set
    if (isset($_POST["brandId"]) && isset($_POST["brandName"]) && isset($_POST["brandQty"])) {
        // Retrieve the brand ID, new brand name, and quantity from the AJAX request
        $brandId = $_POST["brandId"];
        $brandName = $_POST["brandName"];
        $brandQty = $_POST["brandQty"];

        // Validate and sanitize input
        if (!is_numeric($brandQty) || $brandQty < 0) {
            echo "Invalid quantity value.";
            exit;
        }

        // Prepare an update statement to prevent SQL injection
        $sql = "UPDATE brands SET brand_title = ?, brand_qty = ? WHERE brand_id = ?";
        $stmt = $con->prepare($sql);

        // Bind parameters to the SQL query: 'sii' means string, integer, and integer respectively
        $stmt->bind_param("sii", $brandName, $brandQty, $brandId);

        // Execute the statement and check for success
        if ($stmt->execute()) {
            echo "Brand name and quantity updated successfully.";
        } else {
            echo "Error updating brand: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Invalid request: Missing brandId, brandName, or brandQty.";
    }
} else {
    echo "Invalid request method.";
}

// Close the database connection
$con->close();
?>
