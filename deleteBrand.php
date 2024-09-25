<?php
include("Conf.php"); // Ensure this file correctly sets up the database connection

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the required POST variable is set
    if (isset($_POST["brandId"])) {
        // Retrieve the brand ID from the AJAX request
        $brandId = $_POST["brandId"];

        // Prepare a delete statement to prevent SQL injection
        $sql = "DELETE FROM brands WHERE brand_id = ?";
        $stmt = $con->prepare($sql);

        // Check if the statement was prepared successfully
        if ($stmt) {
            // Bind the brand ID parameter to the SQL query
            $stmt->bind_param("i", $brandId);

            // Execute the statement and check for success
            if ($stmt->execute()) {
                echo "Brand deleted successfully.";
            } else {
                // Output the specific error if execution fails
                echo "Error deleting brand: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            // Output error if the statement preparation fails
            echo "Error preparing statement: " . $con->error;
        }
    } else {
        echo "Invalid request: Missing brandId.";
    }
} else {
    echo "Invalid request method.";
}

// Close the database connection
$con->close();
?>
