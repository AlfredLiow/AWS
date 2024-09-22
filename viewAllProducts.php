<?php include("config.php");

session_start();

include('includes/header.php'); 
include('includes/navbar.php'); 
?>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Product List
		   <a href="addProd.php"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile" style="margin-left:10px;">
              Add Product 
            </button>
			</a>
    </h6>
  </div>

  <div class="card-body">

	
    <div class="table-responsive">
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search" title="Type in a name">

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="margin-top:10px;">
        <thead>
          <tr>
            <th>No</th>
            <th>Product Image </th>
            <th>Product Name </th>
			      <th>Product Description </th>
			      <th>Category </th>
            <th>Brand </th>
            <th>Price </th>
            <th>Stock</th>
            <th>Action</th>
            <th>Edit</th>
			      <th>Status </th>
          </tr>
        </thead>
        <tbody>
     
	<?php
	$sql="SELECT * from products, categories, brands WHERE products.product_cat=categories.cat_id AND products.product_brand=brands.brand_id";
    $result=$con-> query($sql);
    if ($result-> num_rows > 0){
        while ($row=$result-> fetch_assoc()) {
          $pid = $row['product_id'];
	?>
          <tr>
            <td> <?php echo $row['product_id']?> </td>
            <td><img height='100px' src='../Stormwind/<?php echo $row["product_image"]?>'></td>
            <td> <?php echo $row['product_title']?> </td>
			      <td> <?php echo $row['product_desc']?></td>
            <td> <?php echo $row["cat_title"]?></td> 
            <td> <?php echo $row["brand_title"]?></td> 
            <td> <?php echo $row["product_price"]?></td>
            <td> <?php echo $row["stock"]?></td>

            <td>
            <a href="editProduct.php?id=<?php echo $pid ?>" class="btn btn-warning">Edit</a>
            </td>

            <td>
            		<!--<a href="addVariation.php?id=<//?php echo $pid ?>"> <button  type="submit" name="edit_btn" class="btn btn-success"> Add</button></a>-->
                <button type="button" class="btn btn-info" onclick="addStock(<?php echo $pid ?>)">Add Stock</button>
            </td>
            <?php
        if ($row["prod_status"] == 1) {
      ?>
          <td class="text-center middle">
            <button class="btn btn-success" onclick="toggleProdStatus('<?=$row['product_id']?>', 1)">Available</button>
          </td>
      <?php
        } else {
      ?>
          <td class="text-center middle">
            <button class="btn btn-danger" onclick="toggleProdStatus('<?=$row['product_id']?>', 0)">Unavailable</button>
          </td>
      <?php
        }
      ?>
          </tr>
    <?php 
        }
    }
    ?>     
        </tbody>
      </table>

    </div>
  </div>
</div>

</div>
<?php

include('includes/scripts.php');
include('includes/footer.php');
	?>	

<!-- /.container-fluid -->
<script>
function addStock(productId) {
    var quantity = prompt("Enter the quantity to add:", "");
    if (quantity !== null && quantity !== "") {
      //validate the quantity
      if (parseInt(quantity) <= 0) {
            alert("Quantity must be greater than 0");
            return;
        }
        // Perform an AJAX request to update the stock quantity
        $.ajax({
            url: "addStock.php",
            method: "POST",
            data: { productId: productId, quantity: quantity },
            success: function (data) {
                // Display a success message
                alert("Stock quantity updated successfully");

                // Refresh the table to reflect the updated data
                showProducts();

                // Refresh the page
                location.reload();
            },
            error: function (xhr, status, error) {
                // Display an error message
                alert("Error updating stock quantity: " + error);
            }
        });
    }
}
function showProducts() {
    $.ajax({
        url: "viewAllProducts.php",
        method: "post",
        data: { record: 1 },
        success: function (data) {
            $('.allContent-section').html(data);
            
            // Reload the page after the table is refreshed
            location.reload();
        }
    });
}

function prodStatusUpdate(id, action){
    var url = "";
    var message = "";

    if(action == "update"){
        url = "updateProdStatus.php";
        message = "Product Status updated successfully";
    } else if(action == "hide"){
        url = "prodHideController.php";
        message = "Product Successfully Hidden from UI";
    }
    $.ajax({
       url: url,
       method: "post",
       data: {record: id},
       success:function(data){
           alert(message);
           $('form').trigger('reset');
           showProd();
       }
   });
  }
  
function toggleProdStatus(id, status) {
    if (status == 1) {
      prodHide(id);
      ChangeBrandStatusWithoutAlert(id);
    } else {
      ChangeProdStatus(id);
    }
}
function ChangeProdStatusWithoutAlert(id) {
    $.ajax({
       url: "updateProdStatus.php",
       method: "post",
       data: {record: id},
       success: function(data) {
           $('form').trigger('reset');
           showProd();
           location.reload();
       }
   });
  }

  function ChangeProdStatus(id) {
    $.ajax({
       url: "updateProdStatus.php",
       method: "post",
       data: {record: id},
       success: function(data) {
           alert('Product status updated successfully');
           $('form').trigger('reset');
           showProd();
           location.reload();
       }
   });
  }

  function prodHide(id){
        $.ajax({
            url:"prodHideController.php",
            method:"post",
            data:{record:id},
            success:function(data){
                alert('Product Successfully Hidden from UI');
                $('form').trigger('reset');
                showProd();
                location.reload();
            }
        });
    }

    function showProd(){
    $.ajax({
        url:"viewAllPorducts.php",
        method:"post",
        data:{record:1},
        success:function(data){
            $('.allContent-section').html(data);
        }
      });
    }

function myFunction() {

  // Declare variables 
  var input = document.getElementById("myInput");
  var filter = input.value.toUpperCase();
  var table = document.getElementById("dataTable");
  var trs = table.tBodies[0].getElementsByTagName("tr");

  // Loop through first tbody's rows
  for (var i = 0; i < trs.length; i++) {

    // define the row's cells
    var tds = trs[i].getElementsByTagName("td");

    // hide the row
    trs[i].style.display = "none";

    // loop through row cells
    for (var i2 = 0; i2 < tds.length; i2++) {

      // if there's a match
      if (tds[i2].innerHTML.toUpperCase().indexOf(filter) > -1) {

        // show the row
        trs[i].style.display = "";

        // skip to the next row
        continue;

      }
    }
  }

}
</script>
