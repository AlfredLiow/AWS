<?php include("config.php");

session_start();

include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Order List</title>
</head>
<style>

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
.hover{
    padding:14px 40px;
	background:black;
	text-decoration:none;
	float:left;
	margin-top:0px;
	margin-right:40px;
	margin-left:500px;
	border-radius:2px;
	font-size:15px;
	font-weight:100;
	color:#fff;
	transition:0.8s;
	transition-property:background;
}
.hover:hover{
    background:#B0EEEE;
}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}



.button {
  padding: 15px 75px;
  font-size: 24px;
  text-align: center;
  cursor: pointer;
  outline: none;
  color: #fff;
  background-color: #4CAF50;
  border: none;
  border-radius: 15px;

}

.button:hover {background-color: #3e8e41}

.button:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  

}
</style>
<head>
	<title>Order</title>
</head>

<body>
	<?php
		$id=$_GET["id"];
		$status="This customer does not order anything.";
		$result = mysqli_query($con,"SELECT * FROM orders WHERE order_id='$id'");
		$result1 = mysqli_query($con,"SELECT user_id, f_name, order_id , address, email, city, state, zip FROM orders_info WHERE order_id='$id'");
		$row = mysqli_fetch_assoc($result);
		$row1 = mysqli_fetch_assoc($result1);
		$var = $row1['user_id'];
		$select = mysqli_query($con,"SELECT * FROM user_info WHERE user_id = '$var'");
		$re=mysqli_fetch_assoc($select);
	?>
	<div class="container">
		<div class="box">
		<form class="box">
		
		<br>
			<div class = "centerlize">
			<label for="tableid">User ID</label>
			<input type="text" id="studname" name="studname" class="form-control" value="<?php echo $row1["user_id"] ?>" disabled>
			<br>
			<label for="name" >User Name</label>
			<input type="text" id="studname" name="studname" class="form-control" value="<?php echo $re["username"] ?>" disabled>
			<br>
			<label for="date">Email</label>
			<input type="text" id="studname" name="studname" class="form-control" value="<?php echo $row1['email']?>" disabled>
			<br>	
			<label for="time">Order Date</label>
			<input type="text" id="studname" name="studname" class="form-control" value="<?php echo $row['created_at']?>" disabled> <!--temp-->
			<br>	
			<label for="address">Address</label>
			<input type="text" id="studname" name="studname" class="form-control" value="<?php echo $row1['address']?>" disabled>
			<br>
			<label for="city">City</label>
			<input type="text" id="studname" name="studname" class="form-control" value="<?php echo $row1['city']?>" disabled>
			<br>
			<label for="state">State</label>
			<input type="text" id="studname" name="studname" class="form-control" value="<?php echo $row1['state']?>" disabled>
			<br>
			<label for="postcode">Postcode</label>
			<input type="text" id="studname" name="studname" class="form-control" value="<?php echo $row1['address']?>" disabled>
			<br>
			
			
			<?php 
			if($row > 0)
			{
				$id=$_GET["id"];
				$selecttotal = mysqli_query($con,"SELECT total_amt FROM orders_info WHERE order_id = $id");
				$rowtotal = mysqli_fetch_array($selecttotal);$id
				?>
				<br>
				<table style = "margin-top:-60px;">
				
			  <tr>
				<th>Item  </th>
				<th>Brand </th>
				<th>Quantity </th>
				<th>Price(RM)</th>
			  </tr>

				<?php
				
				$resultorder = "SELECT * from order_products op, orders_info o where o.order_id=op.order_id AND o.order_id=$id";
				$result=$con-> query($resultorder);
				
					while($roworder = $result-> fetch_assoc())
					{
						$p_id=$roworder['product_id'];
						
						$subqry="SELECT * from products p where p.product_id=$p_id";
						$res=$con-> query($subqry);
						if($row2 = $res-> fetch_assoc()){
						?>
			  <tr>
				<td><?php echo $row2['product_title'] ?>  </td>
				<?php
					}
					$subqry2="SELECT * from brands b, products p where b.brand_id=p.product_brand AND p.product_id=$p_id";
                    $res2=$con-> query($subqry2);
                    if($row3 = $res2-> fetch_assoc()){
				?>
				<td><?php echo $row3['brand_title'] ?>  </td>
				<?php
					}
				?>
				<td><?php echo$roworder['qty']?>   </td>
				
				<td><?php echo$roworder['amt']?></td>
			  </tr>

			<br>
			<?php 
			}
		
			?>
			</table>		
			<br>	
			<label for="totalprice">Total Price(RM)</label>
			<input type="text" id="studname" name="studname" class="form-control" value="<?php echo $rowtotal['total_amt'] ?>" disabled>
			
			<?php 
			}else{
				?>
				<label for="orderstatus">Status</label>
			<input type="text" id="studname" name="studname" class="form-control" value="<?php echo $status ?>" disabled>
			<?php	
			}

			?>
			<br>
			</div>
		</form>
        <br><br>
		<div style="text-align:center;">
	
	
        <form method="post" name="" >
			<button class="btn btn-primary" name="delivery" id="delivery" style="width:100%;"> Out for Delivery</button>
            <br><br>
			<button class="btn btn-success" name="complete" id="complete" style="width:100%;"> Complete</button>
			<br><br>
			<button class="btn btn-warning" name="pending" id="pending" style="width:100%;"> Pending</button>
		</form>
		</div>
		</div>
		<br>
		<a href="viewAllOrders.php" class="hover" style="color:white">
		<div class="backbtn">
		<b>Back</b>
			</div>
			</a>
	<br>

	</div>
	
	
	<?php	
		?>
	<br>
	
	<br>
		
		<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
</body>
<html>

   <?php
	if(isset($_POST["complete"]))
	{
		$complete = 1;
		$update = mysqli_query($con,"UPDATE orders_info SET order_status = '$complete' WHERE order_id = '$id'");
		
		if($update)
		{
			?>
			<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
			<script type="text/javascript">
			swal({title: "Order completed",
			icon: "success",
			button: "Review"}).then(function(){window.location.href = "viewAllOrders.php";});
			</script>
			<?php
		}
	}
	
	if(isset($_POST["delivery"]))
	{
		$delivery = 2;
		$update = mysqli_query($con,"UPDATE orders_info SET order_status = '$delivery' WHERE order_id = '$id'");
		
		if($update)
		{
			?>
			<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
			<script type="text/javascript">
			swal({title: "Order is out for delivery",
			icon: "success",
			button: "Review"}).then(function(){window.location.href = "viewAllOrders.php";});
			</script>
			<?php
		}
	}

	if(isset($_POST["pending"]))
	{
		$pending = 0;
		$update = mysqli_query($con,"UPDATE orders_info SET order_status = '$delivery' WHERE order_id = '$id'");
		
		if($update)
		{
			?>
			<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
			<script type="text/javascript">
			swal({title: "Order status changed to Pending",
			icon: "success",
			button: "Review"}).then(function(){window.location.href = "viewAllOrders.php";});
			</script>
			<?php
		}
	}
	?>