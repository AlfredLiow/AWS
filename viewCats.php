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
    <h6 class="m-0 font-weight-bold text-primary">Category List
		   <a href="addCat.php"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile" style="margin-left:10px;">
              Add Category
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
            <th class="text-center"> Category Name </th>
			      <th class="text-center">Action</th>
			      <th class="text-center">Status</th>
          </tr>
        </thead>
        <tbody>
     
	<?php
	  $sql="SELECT * from categories";
    $result=$con-> query($sql);
	  while($row=$result-> fetch_assoc()){
	?>
          <tr>
            <td class="text-center"> <?php echo $row["cat_id"] ?></td>
            <td class="text-center"> <?php echo $row['cat_title']?> </td>
            <td class="text-center">
            <button class="btn btn-primary" onclick="editCategory('<?php echo $row['cat_id'] ?>', '<?php echo $row['cat_title'] ?>')">Edit</button>
            </td>
      <?php
        if ($row["cat_status"] == 1) {
      ?>
          <td class="text-center middle">
            <button class="btn btn-success" onclick="toggleCatStatus('<?=$row['cat_id']?>', 1)">Available</button>
          </td>
      <?php
        } else {
      ?>
          <td class="text-center middle">
            <button class="btn btn-danger" onclick="toggleCatStatus('<?=$row['cat_id']?>', 0)">Unavailable</button>
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
function editCategory(categoryId, categoryName) {
    // Show a prompt to the user to enter the new category name
    var newCategoryName = prompt("Enter the new category name:", categoryName);

    // If the user enters a name and clicks OK, update the category name
    if (newCategoryName !== null && newCategoryName.trim() !== "") {
      var categoryNames = Array.from(document.querySelectorAll("#dataTable tbody td:nth-child(2)")).map(td => td.textContent.trim());
      if (categoryNames.some(name => name.toLowerCase() === newCategoryName.trim().toLowerCase())){
        alert("Category name already exists. Please choose a different name.");
        return;
      }
      // Perform an AJAX request to update the category name in the database
      $.ajax({
        url: "updateCategory.php",
        method: "POST",
        data: {
          categoryId: categoryId,
          categoryName: newCategoryName
        },
        success: function(response) {
          alert(response); // Show a success message or handle the response accordingly
          location.reload(); // Reload the page to reflect the updated category name
        }
      });
    }
  }

function catStatusUpdate(id, action){
    var url = "";
    var message = "";

    if(action == "update"){
        url = "updateCatStatus.php";
        message = "Category Status updated successfully";
    } else if(action == "hide"){
        url = "catHideController.php";
        message = "Category Successfully Hidden from UI";
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
  
function toggleCatStatus(id, status) {
    if (status == 1) {
      catHide(id);
      ChangeBrandStatusWithoutAlert(id);
    } else {
      ChangeCatStatus(id);
    }
}
function ChangeCatStatusWithoutAlert(id) {
    $.ajax({
       url: "updateCatStatus.php",
       method: "post",
       data: {record: id},
       success: function(data) {
           $('form').trigger('reset');
           showCat();
           location.reload();
       }
   });
  }

  function ChangeCatStatus(id) {
    $.ajax({
       url: "updateCatStatus.php",
       method: "post",
       data: {record: id},
       success: function(data) {
           alert('Category status updated successfully');
           $('form').trigger('reset');
           showCat();
           location.reload();
       }
   });
  }

  function catHide(id){
        $.ajax({
            url:"catHideController.php",
            method:"post",
            data:{record:id},
            success:function(data){
                alert('Category Successfully Hidden from UI');
                $('form').trigger('reset');
                showCat();
                location.reload();
            }
        });
    }

    function showCat(){
    $.ajax({
        url:"viewCats.php",
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
