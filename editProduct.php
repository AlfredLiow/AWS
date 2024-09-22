<?php include("config.php");

session_start();

include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<!DOCTYPE html>
<html>

<style>
.img{
	border-style:ridge;
	border-radius:50%;
	width:250px;
}

.box
{
	max-width: 1100px;
	height:500px;
    
}
.top{
	position:relative;
	margin:auto;

	
}
.hover{
    padding:15px;
	background:blue;
	text-decoration:none;
	margin-top:0px;
	margin-right:-140px;
	border-radius:2px;
	font-size:15px;
	font-weight:600;
	color:#fff;
	transition:0.8s;
	transition-property:background;
}
.hover:hover{
    background:#25149c;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}
</style>
<head>
	<title>Product</title>
</head>

<body>
	<div class="box">
	<div class="container">
	<?php
		$id=$_GET["id"];
		$result = mysqli_query($con,"SELECT * from products, categories, brands WHERE products.product_cat=categories.cat_id AND products.product_brand=brands.brand_id AND product_id='$id'");
	
		if($row = mysqli_fetch_array($result))
		{
            $product_title=$row["product_title"];
            $product_price=$row["product_price"];
            $product_desc=$row["product_desc"];
            $stock=$row["stock"];
            $product_image=$row["product_image"];
            $new_product_image=$row["product_image"];
            $product_cat = $row["product_cat"];
			$product_brand = $row["product_brand"];
        }
	?>
	<div class="top">
	<div class="centerlize center">
    <form action="" method="POST">
	<br>
	<label for="name" >Product Name   :</label>
	<input type="text" name="product_title" class="form-control" required value="<?php echo $product_title ?>">
	<br>
	<br>
	<label for="price" >Price (RM)   :</label>
	<input type="text" name="product_price" class="form-control" required value="<?php echo $product_price ?>">
	<br>
	<label  for="desc" >Description     :</label>
	<input type="text" name="product_desc" class="form-control" required value="<?php echo $product_desc ?>">
	<br>
    <label for="stock">Stock:</label>
	<input type="text" name="stock" class="form-control" required value="<?php echo $stock?>">
    <br>
    <label for="stock">Category:</label>
    <select name="product_cat" class="form-control" required>
    <option disabled selected>Select Category</option>
    <?php
        $sql = "SELECT * FROM categories where cat_status = '1'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $selected = ($row['cat_id'] == $product_cat) ? "selected" : "";
                //echo "<option value='".$row['cat_id']."'>".$row['cat_title']."</option>";
                echo "<option value='".$row['cat_id']."' ".$selected.">".$row['cat_title']."</option>";
            }
        }
    ?>
    </select>
    <br>
    <label for="brand">Brand:</label>
    <select name="product_brand" class="form-control" required>
    <option disabled selected>Select Brand</option>
    <?php
        $sql = "SELECT * FROM brands where brand_status = '1'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $selected = ($row['brand_id'] == $product_brand) ? "selected" : "";
                //echo "<option value='".$row['brand_id']."'>".$row['brand_title']."</option>";
                echo "<option value='".$row['brand_id']."' ".$selected.">".$row['brand_title']."</option>";
            }
        }
    ?>
    </select>
    <br>
	<label for="img" >Image     :</label>
	<input type="file" name="product_image" class="form-control" >
    <br>
    <img src="../Latest/product_images/<?Php echo $product_image; ?>" width="70" height="70" >
	<br>
	<br>
	<a href="viewAllProducts.php"><button type="button" class="btn btn-primary">Back</button></a>
    <input type="hidden" name="product_id" value="<?php echo $id ?>">
    <input type="submit" name="update" value="Update Product" class="btn btn-primary">
	<br>
	<br>
    </form>

	<?php
if (isset($_POST['update'])) {
    $product_title = $_POST['product_title'];
    $product_price = $_POST['product_price'];
    $product_desc = $_POST['product_desc'];
    $stock = $_POST['stock'];
    $product_cat = $_POST['product_cat'];
    $product_brand = $_POST['product_brand'];

    // Check if the stock value is valid
    if ($stock <= 0) {
        echo "<script>alert('Stock value must be greater than 0')</script>";
        // You can redirect the user back to the form or handle the error in a different way
        exit;
    }

    if ($product_price <= 0){
        echo "<script>alert('Stock value must be greater than 0')</script>";
        // You can redirect the user back to the form or handle the error in a different way
        exit;
    }

    if (!empty($_FILES['product_image']['name'])) {
        $product_image = $_FILES['product_image']['name'];
        $temp_product_image = $_FILES['product_image']['tmp_name'];
    
        move_uploaded_file($temp_product_image, "../Latest/product_images/$product_image");
    } else {
        $product_image = $new_product_image; // Keep the original image if no new file was uploaded
    }

    $update_prod = "UPDATE products SET product_title='$product_title',product_price='$product_price',product_desc='$product_desc',product_image='$product_image',stock='$stock'";
    if (!empty($product_cat)) {
        $update_prod .= ", product_cat='$product_cat'";
    }
    if (!empty($product_brand)) {
        $update_prod .= ", product_brand='$product_brand'";
    }
    $update_prod .= " WHERE product_id='$id'";
    
    $run_prod = mysqli_query($con,$update_prod);
    if($run_prod){
        echo "<script>alert('Item Has Been Updated Successfully')</script>";
        echo "<script>window.location.href = 'viewAllProducts.php';</script>";
        exit;
    }
}
?>
    </div>
	</div>
	</div>
	</div>
</body>
</html>
<div style="margin-top:450px;">
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
</div>