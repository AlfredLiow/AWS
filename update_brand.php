<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve the brand ID and the new brand name from the AJAX request
  $brandId = $_POST["brandId"];
  $brandName = $_POST["brandName"];

  // Update the brand name in the database
  $sql = "UPDATE brands SET brand_title = '$brandName' WHERE brand_id = '$brandId'";
  if ($con->query($sql) === TRUE) {
    echo "Brand name updated successfully";
  } else {
    echo "Error updating brand name: " . $con->error;
  }
}
?>