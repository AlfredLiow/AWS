<?php include("config.php");

session_start();

include('includes/header.php'); 
include('includes/navbar.php'); 
?>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Menu List
		   <a href="add_menu.php"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile" style="margin-left:10px;">
              Add Menu 
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
            <th> No </th>
            <th> Category Name </th>
            <th>Menu Detail </th>
			<th>Price </th>
			<th>Menu Image </th>
            <th>Status </th>
			<th>Delete</th>
          </tr>
        </thead>
        <tbody>
     
	<?php
	$result = mysqli_query($con,"SELECT * FROM products WHERE prod_status='1'");
		$i= 1;
	while($row = mysqli_fetch_array($result))
{
	if($row['menu_cate']==1)
		$cate="Laptop";
	else if ($row['menu_cate']==2)
		$cate="Desktop";
	else if ($row['menu_cate']==3)
		$cate="Accessories";
	else if ($row['menu_cate']==4)
		$cate="Snacks";
		
	
	?>
          <tr>
            <td> <?php echo $i ?></td>
            <td> <?php echo $row['product_title']?> </td>
            <td> <?php echo $row['product_desc']?> </td>
			<td> <?php echo $row['product_price']?></td>
            <td> <img width="100" height="50" src ="../user/uploads/<?php echo $row['product_image']?>"></td>
			<td> <?php echo $cate?></td>
			  <td>
                <form action="" method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $row['menu_id']; ?>">
                  <button type="submit" name="delete_btn" class="btn btn-danger"> Delete</button>
                </form>
            </td>
          </tr>
<?php 
$i++;
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

if(isset($_POST["delete_btn"]))
	{ 
		$delete_id= $_POST['delete_id'];
        
	$update = mysqli_query($con,"UPDATE menu SET menu_status = '0' WHERE menu_id = '$delete_id'");
 ?>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<script type="text/javascript">
			swal({title: "Delete Succss",
			icon: "success",
			button: "Back"}).then(function(){window.location.href = "menu_list.php";});
		</script>
						<?php
	}
	?>	

<!-- /.container-fluid -->
<script>
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
