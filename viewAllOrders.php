<?php include("config.php");

session_start();

include('includes/header.php'); 
include('includes/navbar.php'); 
?>



<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
   <form method="post" action="export.php">
					<input class="btn btn-info btn-sm"  style="margin-left:2em; float:right;"  type="submit" name="exportorders" value="Export Order list to Excel" >
								</form>
    <h6 class="m-0 font-weight-bold text-primary">Entire Order List
         
    </h6>
  </div>

  <div class="card-body">

	
    <div class="table-responsive">
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search" title="Type in a name">

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="margin-top:10px;">
        <thead>
          <tr>
            <th> O.I.D. </th>
            <th>Customer Name </th>
			      <th>Email</th>
            <th>Address</th>
			      <th>Total Price(RM) </th>
			      <th>Order Date </th>
			      <th>Status</th>
			      <th>Details </th>
          </tr>
        </thead>
        <tbody>
     
	<?php
	$result = mysqli_query($con,"SELECT * FROM orders_info ORDER BY order_id DESC");
  
	
	//$i=1;
	while($row = mysqli_fetch_array($result))
    {
    $oid = $row['order_id'];
	$status =$row['order_status'];
	$result1 = mysqli_query($con,"SELECT * FROM orders WHERE order_id='$oid'");
  $row1 = mysqli_fetch_assoc($result1);
	?>
          <tr>
            <td> <?php echo $row['order_id']?> </td>
            <td> <?php echo $row['f_name']?> </td>
			<td> <?php echo $row['email']?> </td>
			<td> <?php echo $row['address']?> </td>		
			<td><?php echo $row['total_amt']?></td>
			<td><?php echo $row1['created_at']?></td>

            <?php
			if($status == 0)
			{
				echo '  <td><button class="btn btn-warning">Pending</button></td>';
			}
			else if($status == 1)
			{
				echo '  <td><button class="btn btn-success pull-right">Completed</button></td>';
			}else if($status == 2)
      {
        echo '<td><button class="btn btn-primary">Out for Delivery</button></td>';
      }else
			{
				echo '  <td><button class="btn btn-danger">Deleted</button></td>';
			}
			?>
      
            <td>
            		<a href="view_receipt.php?id=<?php echo $oid ?>"> <button  type="submit" name="edit_btn" class="btn btn-success"> View</button></a>
            </td>
          </tr>
<?php 
//$i++;
}
?>     
        </tbody>
      </table>

    </div>
  </div>
</div>

</div>

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
<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>