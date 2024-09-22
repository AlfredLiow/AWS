<?php include("config.php");

session_start();

include('includes/header.php'); 
include('includes/navbar.php'); 
?>



<style>
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
		   <a href="addBrand.php"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile" style="margin-left:10px;">
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
            <th class="text-center"> No </th>
            <th class="text-center"> Brand Name </th>
			      <th class="text-center">Action</th>
			      <th class="text-center">Status</th>
          </tr>
        </thead>
        <tbody>
     
	<?php
	$sql="SELECT * from brands";
  $result=$con-> query($sql);
	while($row=$result-> fetch_assoc()){
	?>
          <tr>
            <td class="text-center"> <?php echo $row["brand_id"] ?></td>
            <td class="text-center"> <?php echo $row['brand_title']?> </td>
            <td class="text-center">
            <button class="btn btn-primary" onclick="editBrand('<?php echo $row['brand_id'] ?>', '<?php echo $row['brand_title'] ?>')">Edit</button>
            </td>
      <?php
        if ($row["brand_status"] == 1) {
      ?>
          <td class="text-center middle">
            <button class="btn btn-success" onclick="toggleBrandStatus('<?=$row['brand_id']?>', 1)">Available</button>
          </td>
      <?php
        } else {
      ?>
          <td class="text-center middle">
            <button class="btn btn-danger" onclick="toggleBrandStatus('<?=$row['brand_id']?>', 0)">Unavailable</button>
          </td>
      <?php
        }
      ?>
          </tr> 
          <?php 
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
function editBrand(brandId, brandName) {
    // Show a prompt to the user to enter the new brand name
    var newbrandName = prompt("Enter the new brand name:", brandName);

    // If the user enters a name and clicks OK, update the brand name
    if (newbrandName !== null && newbrandName.trim() !== "") {
      var brandNames = Array.from(document.querySelectorAll("#dataTable tbody td:nth-child(2)")).map(td => td.textContent.trim());
      if (brandNames.some(name => name.toLowerCase() === newbrandName.trim().toLowerCase())){
        alert("Category name already exists. Please choose a different name.");
        return;
      }
      // Perform an AJAX request to update the brand name in the database
      $.ajax({
        url: "update_brand.php",
        method: "POST",
        data: {
          brandId: brandId,
          brandName: newbrandName
        },
        success: function(response) {
          alert(response); // Show a success message or handle the response accordingly
          location.reload(); // Reload the page to reflect the updated brand name
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
