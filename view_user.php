<?php include("config.php");

session_start();

include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<!DOCTYPE html>
<html>

<style>
.img{
	border-style:ridge;
	border-radius:50%;
	width:250px;
}

.box
{
	max-width: 1100px;
	height:500px;
    
}
.top{
	position:relative;
	margin:auto;

	
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
	<div class="box">
	<div class="container">
	<?php
		$id=$_GET["id"];
		$result = mysqli_query($con,"SELECT * FROM user_info WHERE user_id='$id'");
	
		if($row = mysqli_fetch_array($result))
		{
	?>
	<div class="top">
	<div class="centerlize center">
	 <br>
	<label for="username" >Name   :</label>
	<input type="text" id="studname" name="studname" value="<?php echo $row["first_name"] ?>" disabled>
	<br>
	<br>
	<label for="Email" >Email     :</label>
	<input type="text" id="email" name="email"  value="<?php echo $row["email"] ?>" disabled>
    <br>
	<br>
	<label  for="PhoneNum" >Phone Number     :</label>
	<input type="text" id="PhoneNumber" name="email"  value="<?php echo $row["mobile"] ?>" disabled>
	<br>
	<br>
	<label for="created_at" >Created Time     :</label>
	<input type="text" id="Created Time" name="created_time"  value="<?php echo $row["email_verified_at"] ?>" disabled>
	<br>
	<br>
	  <a href="user_list.php"><button type="button" class="btn btn-primary">
             Back
            </button></a>
			<br>
			<br>
			<br>
	<?php
		}
		?>
    </div>
	</div>
	</div>
	</div>
	
		
</body>
</html>
<div style="margin-top:450px;">
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
</div>