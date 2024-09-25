<?php include("Conf.php");
session_start();
include('includes/header.php'); 
?>
<style>

.container-fluid {
  max-width: 90%; /* Ensures it fits nicely on any screen */
  padding: 20px;
}

.table-responsive {
  margin-top: 20px; /* Adds space between input and table */
}

#myInput {
  width: 100%;
  padding: 10px;
  margin-bottom: 10px;
  border: 1px solid #ddd;
  border-radius: 5px;
}

.middle {
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>

<div class="container-fluid">
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Brand List
        <a href="addBrand1.php">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile" style="margin-left:10px;">
            Add Brand
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
              <th class="text-center">No</th>
              <th class="text-center">Brand Name</th>
              <th class="text-center">Quantity</th> <!-- New Quantity Column Header -->
              <th class="text-center">Action</th>
              <th class="text-center">Delete</th> <!-- Changed Status to Delete -->
            </tr>
          </thead>
          <tbody>
            <?php
            // Fetch data including the quantity field from the database
            $sql = "SELECT * FROM brands"; // Ensure the 'quantity' field exists in the 'brands' table
            $result = $con->query($sql);
            while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
              <td class="text-center"><?php echo $row["brand_id"]; ?></td>
              <td class="text-center"><?php echo $row['brand_title']; ?></td>
              <td class="text-center"><?php echo $row['brand_qty']; ?></td> <!-- Display the Quantity -->
              <td class="text-center">
              <button class="btn btn-primary" onclick="editBrand('<?php echo $row['brand_id']; ?>', '<?php echo $row['brand_title']; ?>', '<?php echo $row['brand_qty']; ?>')">Edit</button>
              </td>
              <td class="text-center middle">
                <button class="btn btn-danger" onclick="deleteBrand('<?php echo $row['brand_id']; ?>')">Delete</button>
              </td>
            </tr>
            <?php } ?>
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
function editBrand(brandId, brandName, brandQty) {
    // Show a prompt to the user to enter the new brand name and quantity
    var newBrandName = prompt("Enter the new brand name:", brandName);
    var newBrandQty = prompt("Enter the new quantity:", brandQty);

    // Validate the input and ensure a valid number is entered for the quantity
    if (newBrandName !== null && newBrandName.trim() !== "" && newBrandQty !== null && !isNaN(newBrandQty) && newBrandQty.trim() !== "") {
        var brandNames = Array.from(document.querySelectorAll("#dataTable tbody td:nth-child(2)")).map(td => td.textContent.trim());

        // Check if the new brand name already exists, excluding the current one
        if (brandNames.some(name => name.toLowerCase() === newBrandName.trim().toLowerCase() && name !== brandName)) {
            alert("Category name already exists. Please choose a different name.");
            return;
        }

        // Perform an AJAX request to update the brand name and quantity in the database
        $.ajax({
            url: "updateBrand1.php",
            method: "POST",
            data: {
                brandId: brandId,
                brandName: newBrandName,
                brandQty: newBrandQty
            },
            success: function(response) {
                alert(response); // Show a success message or handle the response accordingly
                location.reload(); // Reload the page to reflect the updated brand name and quantity
            },
            error: function(error) {
                console.error("Error updating brand:", error);
                alert("Failed to update the brand. Please try again.");
            }
        });
    } else {
        alert("Invalid input. Please enter a valid brand name and quantity.");
    }
}

function deleteBrand(brandId) {
    // Confirm the deletion
    if (confirm("Are you sure you want to delete this brand?")) {
        // Perform an AJAX request to delete the brand from the database
        $.ajax({
            url: "deleteBrand.php",
            method: "POST",
            data: {
                brandId: brandId
            },
            success: function(response) {
                alert(response); // Show a success message or handle the response accordingly
                location.reload(); // Reload the page to reflect the deletion
            },
            error: function(error) {
                console.error("Error deleting brand:", error);
                alert("Failed to delete the brand. Please try again.");
            }
        });
    }
}

function brandStatusUpdate(id, action){
    var url = "";
    var message = "";

    if(action == "update"){
        url = "updateBrandStatus.php";
        message = "Brand Status updated successfully";
    } else if(action == "hide"){
        url = "brandHideController.php";
        message = "Brand Successfully Hidden from UI";
    }
    $.ajax({
       url: url,
       method: "post",
       data: {record: id},
       success:function(data){
           alert(message);
           $('form').trigger('reset');
           showCat();
       }
   });
  }
  
function toggleBrandStatus(id, status) {
    if (status == 1) {
      brandHide(id);
      ChangeBrandStatusWithoutAlert(id);
    } else {
      ChangeBrandStatus(id);
    }
}
function ChangeBrandStatusWithoutAlert(id) {
    $.ajax({
       url: "updateBrandStatus.php",
       method: "post",
       data: {record: id},
       success: function(data) {
           $('form').trigger('reset');
           showBrand();
           location.reload();
       }
   });
  }

  function ChangeBrandStatus(id) {
    $.ajax({
       url: "updateBrandStatus.php",
       method: "post",
       data: {record: id},
       success: function(data) {
           alert('Brand status updated successfully');
           $('form').trigger('reset');
           showBrand();
           location.reload();
       }
   });
  }

  function brandHide(id){
        $.ajax({
            url:"brandHideController.php",
            method:"post",
            data:{record:id},
            success:function(data){
                alert('Brand Successfully Hidden from UI');
                $('form').trigger('reset');
                showBrand();
                location.reload();
            }
        });
    }

    function showBrand(){
    $.ajax({
        url:"viewBrands.php",
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
