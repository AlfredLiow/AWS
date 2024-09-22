<?php include("config.php");

session_start();

include('includes/header.php'); 
include('includes/navbar.php'); 
?>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Admin List
           <form method="post" action="export.php">
					<input class="btn btn-info btn-sm"  style="margin-left:2em; float:right;"  type="submit" name="exportadmin" value="Export Admin list to Excel" >
								</form>
			<br>					
		   <a href="add_admin.php"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Add Admin 
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
            <th> Admin Name </th>
            <th>Email </th>
			<th>PHONE </th>
			<th>Admin Type </th>
            <th>VIEW </th>
            <th>Action </th>
          </tr>
        </thead>
        <tbody>
     
	<?php
	$result = mysqli_query($con,"SELECT * FROM admin_info WHERE admin_status='1'");
	$i=1;
	while($row = mysqli_fetch_array($result))
{
	$adminid = $row['admin_id'];
	?>
          <tr>
            <td>  <?php echo"$i"?></td>
            <td> <?php echo $row['admin_name']?> </td>
            <td> <?php echo $row['email']?> </td>
			<td><?php echo $row['contact']?></td>
             <td><?php echo $row['admin_type']?></td>
            <td>
               
            <a href="view_admin.php?id=<?php echo $adminid ?>"><button  type="submit" name="edit_btn" class="btn btn-success">  View</button></a>
  
            </td>
            <td>
                <form action="" method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $row['admin_id']; ?>">
                  <button type="submit" name="delete_btn" class="btn btn-danger">Inactive</button>
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
<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');

if(isset($_POST["delete_btn"]))
	{ 
		$delete_id= $_POST['delete_id'];
        $id = $_SESSION["adminid"];
		
	$rresult = mysqli_query($con,"SELECT * FROM admin_info WHERE admin_id='$id'");

	$rrow = mysqli_fetch_array($rresult);
		
	$super = "SuperAdmin";
	if($rrow['admin_id'] == $delete_id)
	{
		?>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<script type="text/javascript">
			swal({title: "You cannot inactive yourself",
			icon: "error",
			button: "Back"}).then(function(){window.location.href = "admin_list.php";});
		</script>
		<?php
	}
	else{
	if($rrow['admin_type']== $super)
	{
	$update = mysqli_query($con,"UPDATE admin_info SET admin_status = '0' WHERE admin_id = '$delete_id'");
 ?>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<script type="text/javascript">
			swal({title: "Inactive Succss",
			icon: "success",
			button: "Back"}).then(function(){window.location.href = "admin_list.php";});
		</script>
						<?php
	}
	else{
		?>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<script type="text/javascript">
			swal({title: "Cannot Inactive Admin",
			text:"You are not Super Admin",
			icon: "error",
			button: "Back"}).then(function(){window.location.href = "admin_list.php";});
		</script>
		<?php
	}
	}
	}
	?>	
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