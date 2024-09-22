<?php include("config.php");

session_start();

include('includes/header.php'); 
include('includes/navbar.php'); 
?>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Product Stock
		   <a href="addVariation.php"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile" style="margin-left:10px;">
              Add Variation
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
            <th>No </th>
            <th>Product Name </th>
            <th>Quantity </th>
			      <th>Action </th>
          </tr>
        </thead>
        <tbody>
     
	<?php
	$sql="SELECT * from product_variation v, products p WHERE p.product_id=v.product_id ";
  $result=$conn-> query($sql);
  $count=1;
  if ($result-> num_rows > 0){
    while ($row=$result-> fetch_assoc()) {
	?>
          <tr>
          <td><?=$count?></td>
          <td><?=$row["product_title"]?></td>
          <td><?=$row["quantity_in_stock"]?></td>     
          <td><button class="btn btn-danger" style="height:40px"  onclick="variationDelete('<?=$row['variation_id']?>')">Delete</button></td>
          </tr>
    <?php 
        $count=$count+1;
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
