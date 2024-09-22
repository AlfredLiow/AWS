<?php include("config.php");

session_start();

include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<!DOCTYPE html>
<html>

<style>
.img{
	margin-right:600px;
	border-style:ridge;
	border-radius:50%;
	width:250px;
}

.box
{
	max-width: 800px;
    margin: auto;
    padding: 30px;
    border: 1px solid #eee;
    box-shadow: 0 0 10px rgba(0, 0, 0, .15);
    font-size: 16px;
    line-height: 24px;
    font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    color: #555;
}

.top{
	position:relative;
	margin:auto;
	margin-left:0px;
	
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
	<title>VIEW</title>
</head>

<body>
	<?php
		$id=$_GET["id"];
		$result = mysqli_query($con,"SELECT * FROM admin_info WHERE admin_id='$id'");
		if($row = mysqli_fetch_array($result));
		{
	?>
	
	<div class="box">
	
	<div class="container">
	<br>
	
	<div class="top">
	<div class="centerlize center">
	<label  for="name" style="text-align:center;">Name   :</label>
	<input type="text" id="studname" name="studname" value="<?php echo $row["admin_name"] ?>" disabled>
	<br>
	<br>
	<label for="Email" >Email     :</label>
	<input type="text" id="email" name="email"  value="<?php echo $row["email"] ?>" disabled>
    <br>
	<br>
	<label  for="PhoneNum" >Phone Number     :</label>
	<input type="text" id="PhoneNumber" name="email"  value="<?php echo $row["contact"] ?>" disabled>
	<br>
	<br>
	<label for="admin_type" >Admin Type     :</label>
	<input type="text" id="Created Time" name="created_time"  value="<?php echo $row["admin_type"] ?>" disabled>
	<br>
	<br>
	<br>
    </div>
	<!--</div>
	<form method="post" name="" >
			<button class="btn btn-primary" name="admin" id="complete" style="width:100%;"> Admin</button>
            <br><br>
			<button class="btn btn-primary" name="superadmin" id="delete" style="width:100%;"> SuperAdmin</button>
		</form>
	</div>-->
	<br>
	 <a href="admin_list.php" style="margin-left:330px;"><button type="button" class="btn btn-primary" >
             Back
            </button></a>
	</div>
	<br><br>
	<?php
		}
		?>
</body>
</html>		
		<?php
include('includes/scripts.php');
include('includes/footer.php');
?>

<?php
	$admin_id = $_SESSION["adminid"];
	$rresult = mysqli_query($con,"SELECT * FROM admin_info WHERE admin_id='$admin_id'");
	$rrow = mysqli_fetch_array($rresult);

	if(isset($_POST["admin"]))
	{
		if($rrow["admin_type"] == 'SuperAdmin')
		{
		$admin = "Admin";
		$update = mysqli_query($con,"UPDATE admin_info SET admin_type = '$admin' WHERE admin_id = '$id'");
		
		if($update)
		{
			?>
			<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
			<script type="text/javascript">
			swal({title: "Status has change to admin",
			icon: "success",
			button: "Review"}).then(function(){window.location.href = "admin_list.php";});
			</script>
			<?php
		}
		}
		else
		{
			?>
			<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
			<script type="text/javascript">
			swal({title: "Cannot change status",
			text:"You are not Super Admin",
			icon: "error",
			button: "Back"}).then(function(){window.location.href = "admin_list.php";});
		</script>
			<?php
		}
	}
	
		if(isset($_POST["superadmin"]))
	{
		if($rrow["Admin_type"] == 'SuperAdmin')
		{
		$admin = "SuperAdmin";
		$update = mysqli_query($con,"UPDATE admin_info SET admin_type = '$admin' WHERE admin_id = '$id'");
		
		if($update)
		{
			?>
			<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
			<script type="text/javascript">
			swal({title: "Status has change to super admin",
			icon: "success",
			button: "Review"}).then(function(){window.location.href = "admin_list.php";});
			</script>
			<?php
		}
		}else
		{
			?>
			<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
			<script type="text/javascript">
			swal({title: "Cannot change status",
			text:"You are not Super Admin",
			icon: "error",
			button: "Back"}).then(function(){window.location.href = "admin_list.php";});
		</script>
			<?php
		}
	}
	?>