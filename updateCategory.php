<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve the category ID and the new category name from the AJAX request
  $categoryId = $_POST["categoryId"];
  $categoryName = $_POST["categoryName"];

  // Update the category name in the database
  $sql = "UPDATE categories SET cat_title = '$categoryName' WHERE cat_id = '$categoryId'";
  if ($con->query($sql) === TRUE) {
    echo "Category name updated successfully";
  } else {
    echo "Error updating category name: " . $con->error;
  }
}
?>