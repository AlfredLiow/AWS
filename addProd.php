<?php
include("config.php");

session_start();
include('includes/header.php');
include('includes/navbar.php');
?>

<html>
<style>
  .help-block {
    color: red;
  }

  input[type=text],
  input[type=password],
  input[type=name],
  input[type=phone] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
  }
</style>

<body>
  <form action="addProd.php" method="post" enctype="multipart/form-data" style="margin-left:300px; margin-right:300px;" onsubmit="return validateForm()">

    <div class="container">
      <h4 class="modal-title">New Product Item</h4>

      <label for="name">Product Name:</label>
      <input type="text" class="form-control" name="p_name" value="<?php echo isset($_POST['p_name']) ? $_POST['p_name'] : ''; ?>" required>
      <!--<input type="text" class="form-control" name="p_name" required>-->
      <span id="name-error" class="help-block"></span>
      <p></p>

      <label for="price">Price (RM):</label>
      <input type="number" class="form-control" name="p_price" id="p_price" value="<?php echo isset($_POST['p_price']) ? $_POST['p_price'] : ''; ?>" required>
      <!--<input type="number" class="form-control" name="p_price" id="p_price" required>-->
      <span id="price-error" class="help-block"></span>
      <p></p>

      <label for="desc">Description:</label>
      <input type="text" class="form-control" name="p_desc" value="<?php echo isset($_POST['p_desc']) ? $_POST['p_desc'] : ''; ?>" required>
      <!--<input type="text" class="form-control" name="p_desc" required>-->
      <span id="desc-error" class="help-block"></span>
      <p></p>

      <label for="qty">Quantity:</label>
      <input type="number" class="form-control" name="p_qty" id="p_qty" value="<?php echo isset($_POST['p_qty']) ? $_POST['p_qty'] : ''; ?>" required>
      <!--<input type="number" class="form-control" name="p_qty" id="p_qty" required>-->
      <span id="qty-error" class="help-block"></span>
      <p></p>

      <label>Category:</label>
      <select name="category" required>
        <option disabled selected>Select Category</option>

        <?php
        $sql = "SELECT * from categories";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $selected = isset($_POST['category']) && $_POST['category'] == $row['cat_id'] ? 'selected' : '';
            //echo "<option value='" . $row['cat_id'] . "'>" . $row['cat_title'] . "</option>";
            echo "<option value='" . $row['cat_id'] . "' " . $selected . ">" . $row['cat_title'] . "</option>";
          }
        }
        ?>

      </select>
      <span id="category-error" class="help-block"></span>
      <p></p>

      <label>Brand:</label>
      <select name="brand" required>
        <option disabled selected>Select Brand</option>
        <?php

        $sql = "SELECT * from brands";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $selected = isset($_POST['brand']) && $_POST['brand'] == $row['brand_id'] ? 'selected' : '';
            echo "<option value='" . $row['brand_id'] . "' " . $selected . ">" . $row['brand_title'] . "</option>";
          }
        }
        ?>
      </select>
      <span id="brand-error" class="help-block"></span>
      <p></p>
      <label for="file">Choose Image:</label>
      <input type="file" class="form-control-file" name="image" required>
      <span id="image-error" class="help-block"></span>
      <p></p>

      <input type="hidden" name="current_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>">

      <!--<input type="submit" name="submit" value="Submit" class="btn btn-primary">-->
      <input type="submit" name="submit" value="Submit" class="btn btn-primary" onclick="return validateForm(this.form)">
      <button type="button" class="btn btn-primary" onclick="goBack()" data-dismiss="modal" style="height:40px">Close</button>
      <p></p>
    </div>
  </form>
</body>

</html>

<?php

include('includes/scripts.php');
include('includes/footer.php');

$status = 1;
$errors = array();

if (isset($_POST["submit"])) {
  $name = $_POST["p_name"];
  $price = $_POST["p_price"];
  $desc = $_POST["p_desc"];
  $qty = $_POST["p_qty"];

  if (isset($_POST['category'])) {
    $category = $_POST['category'];
  } else {
    // Handle the case when 'category' is not set
    $errors['category'] = "Please select a category.";
  }

  if (isset($_POST['brand'])) {
    $brand = $_POST['brand'];
  } else {
    // Handle the case when 'brand' is not set
    $errors['brand'] = "Please select a brand.";
  }

  $img = $_FILES["image"]["name"];

  // Check if the product name already exists in the database
  $check_query = "SELECT * FROM products WHERE product_title = '$name'";
  $check_result = mysqli_query($con, $check_query);
  if (mysqli_num_rows($check_result) > 0) {
    echo "<script>alert('Product name already exists. Please choose a different name.')</script>";
    exit;
  }

  if ($price <= 0) {
    $errors['price'] = "Product price must be more than 0.";
  }

  if ($qty <= 0) {
    $errors['qty'] = "Product quantity must be more than 0.";
  }

  if (empty($errors)) {

    $target_dir = "../product_images/";
    $finalImage = $target_dir . $img;

    $fileExt = explode('.', $img);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    if (in_array($fileActualExt, $allowed)) {
      $insert = "INSERT INTO products(product_title,product_image,product_desc,product_price,stock,prod_status,product_cat,product_brand) VALUES ('$name','$img','$desc','$price','$qty','$status','$category','$brand')";

      $result = mysqli_query($con, $insert);

      if ($result) {
        move_uploaded_file($_FILES["image"]["tmp_name"], "./product_images/$img");
?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script type="text/javascript">
          swal({
            title: "Upload Success",
            icon: "success",
            button: "View All Product"
          }).then(function() {
            window.location.href = "viewAllProducts.php";
          });
        </script>
      <?php
      } else {
        echo "<script>document.getElementById('image-error').innerHTML = 'Upload Fail';</script>";
      }
    } else {
      ?>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script type="text/javascript">
        swal({
          title: "Upload Fail",
          text: "Cannot upload this type of file",
          icon: "error",
          button: "Retry"
        });
      </script>
<?php
    }
  }
}
?>
<script>
  function goBack() {
    window.location.href = "viewAllProducts.php";
  }

  function validateForm() {
    var name = document.forms[0].p_name.value;
    //var price = document.forms[0].p_price.value;
    var desc = document.forms[0].p_desc.value;
    //var qty = document.forms[0].p_qty.value;
    var category = document.forms[0].category.value;
    var brand = document.forms[0].brand.value;
    var img = document.forms[0].image.value;

    var price = document.getElementsByName("p_price")[0].value;
    var qty = document.getElementsByName("p_qty")[0].value;
    
    document.getElementById('name-error').innerHTML = "";
    document.getElementById('price-error').innerHTML = "";
    document.getElementById('desc-error').innerHTML = "";
    document.getElementById('qty-error').innerHTML = "";
    document.getElementById('category-error').innerHTML = "";
    document.getElementById('brand-error').innerHTML = "";
    document.getElementById('image-error').innerHTML = "";

    if(price<=0) {
      document.getElementById('price-error').innerHTML = "Product price must be more than 0.";
      return false;
    }

    if(qty<=0) {
      document.getElementById('qty-error').innerHTML = "Product quantity must be more than 0.";
      return false;
    }

    var isValid = true;

    if (name === "") {
      document.getElementById('name-error').innerHTML = "Product name is required.";
      isValid = false;
    }

    if (price === "") {
      document.getElementById('price-error').innerHTML = "Product price is required.";
      isValid = false;
    }

    if (desc === "") {
      document.getElementById('desc-error').innerHTML = "Product description is required.";
      isValid = false;
    }

    if (qty === "") {
      document.getElementById('qty-error').innerHTML = "Product quantity is required.";
      isValid = false;
    }

    if (category === "" || category === "Select Category") {
      document.getElementById('category-error').innerHTML = "Please select a category.";
      isValid = false;
    }

    if (brand === "" || brand === "Select Brand") {
      document.getElementById('brand-error').innerHTML = "Please select a brand.";
      isValid = false;
    }

    if (img === "") {
      document.getElementById('image-error').innerHTML = "Product image is required.";
      isValid = false;
    }

    return isValid;
  }
</script>