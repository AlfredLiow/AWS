<?php include("config.php");

session_start();
include('includes/header.php'); 
include('includes/navbar.php');
?>

<html>
<style>
.help-block{
color:red;
}

input[type=text], input[type=password], input[type=name], input[type=phone] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  

}
</style>
<body>

<form action="addBrand.php" method="POST" enctype="multipart/form-data" style="margin-left:300px; margin-right:300px;" >
 
	<div class="container">
	
	<br><br>
	<label for="b_id"><b>Brand Name</b></label>
    <input type="text" placeholder="Enter New Brand Name" name="b_name" required>
   
    <input type="submit" name="submit" value="submit" class="btn btn-primary">
    <button type="button" class="btn btn-primary" onclick="goBack()" data-dismiss="modal" style="height:40px">Close</button>
  </div>
</form>


</body>

<script>
function goBack() {
  window.location.href = "viewBrands.php";
}
</script>

</html>

<?php

include('includes/scripts.php');
include('includes/footer.php');


$status =1;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $b_id = $_POST["b_id"];
    $b_name = $_POST["b_name"];

    // Check if the category already exists
    $sql = "SELECT * FROM brands WHERE brand_title = '$b_name'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
      // If the category already exists, display an error message
      echo "<script>alert('Brand already exists');</script>";
      echo "<script>window.location.href='addBrand.php';</script>";
    } else {
      // Insert the new category into the database
      $sql = "INSERT INTO brands (brand_id, brand_title, brand_status) VALUES ('$b_id', '$b_name', '$status')";
      $result = $con->query($sql);

      // Display a success message and redirect after user confirmation
        echo "<script>alert('Brand added successfully');</script>";
        //echo "<script>window.location.href='../index.php';</script>";
        //echo "<script>setTimeout(function(){ window.location.href = '../index.php#category'; }, 5000);</script>";

        // Stay on the same page
        echo "<script>window.history.go(-2);</script>";

      // Redirect back to the homepage
        //header("Location: ../index.php#category");
    }
  }
?>