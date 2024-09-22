<?php include("config.php");

session_start();

include('includes/header.php'); 
include('includes/navbar.php'); 
?>



<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">

    <h6 class="m-0 font-weight-bold text-primary">User Inactivated List
        
    </h6>
	
  </div>

  <div class="card-body">

	
    <div class="table-responsive">
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search" title="Type in a name">

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="margin-top:10px;">
        <thead>
          <tr>
            <th> No </th>
            <th> Customer Name </th>
            <th> Phone </th>
			      <th> Email </th>
            <th>View </th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
     
	<?php
	$result = mysqli_query($con,"SELECT * FROM user_info WHERE user_status='0'");
	$i=1;
	while($row = mysqli_fetch_array($result))
	{	$userid=$row["user_id"];

	?>
          <tr>
            <td>  <?php echo"$i"?></td>
            <td> <?php echo $row['first_name']?> </td>
            <td> <?php echo $row['mobile']?> </td>
			      <td><?php echo $row['email']?></td>

            <td>
					    <a href="view_userdelete.php?id=<?php echo $userid?>"><button  type="submit" name="view_btn" class="btn btn-success"> View </button></a>   
            </td>

          <td>
              <form action="" method="post">
                <input type="hidden" name="active_id" value="<?php echo $row['user_id']; ?>">
                <button type="submit" name="active_btn" class="btn btn-warning">Activate</button>
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

if(isset($_POST["active_btn"]))
{ 
		$active_id= $_POST['active_id'];
        $id = $_SESSION["userid"];
		
	$rresult = mysqli_query($con,"SELECT * FROM user_info WHERE user_id='$id'");

	$rrow = mysqli_fetch_array($rresult);

    $update = mysqli_query($con,"UPDATE user_info SET user_status = '1' WHERE user_id = '$active_id'");
  ?>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script type="text/javascript">
        swal({title: "Activate Success",
        icon: "success",
        button: "Back"}).then(function(){window.location.href = "user_delete.php";});
      </script>
      <?php
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