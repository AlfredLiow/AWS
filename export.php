<?php
	include("config.php");
	if(isset($_POST["exportadmin"]))
	{
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=Admin List.csv');
		$output = fopen("php://output", "w");
		fputcsv($output, array('ID','Admin Name','Email','Phone','Admin Type'));
		$result = mysqli_query($con,"SELECT admin_id, admin_name, email, contact, admin_type FROM admin_info where admin_status=1");
		while($row = mysqli_fetch_assoc($result))
		{
			fputcsv($output,$row);
		}
		fclose($output);
	}
	
	if(isset($_POST["exportuser"]))
	{
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=User List.csv');
		$output = fopen("php://output", "w");
		fputcsv($output, array('ID','User Name','Email','Phone'));
		$result = mysqli_query($con,"SELECT user_id, username, email, mobile FROM user_info where user_status=1");
		while($row = mysqli_fetch_assoc($result))
		{
			fputcsv($output,$row);
		}
		fclose($output);
	}
	
		if(isset($_POST["exportorders"]))
	{
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=Order List.csv');
		$output = fopen("php://output", "w");
		fputcsv($output, array('OID','Customer Name','Email','Address','Total Price(RM)','Status'));
		$result = mysqli_query($con,"SELECT order_id, f_name, email, address, total_amt, order_status FROM orders_info");
		while($row = mysqli_fetch_assoc($result))
		{
			fputcsv($output,$row);
		}
		fclose($output);
	}
	
	if(isset($_POST["exportreport"]))
	{
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=Sales Report.csv');
		$output = fopen("php://output", "w");
		fputcsv($output, array('Product Name','Brand','Category','Sales','Total Gain(RM)'));

		$result = mysqli_query($con, "SELECT product_title, brand_title, cat_title, sales, (sales * product_price) AS total FROM products, categories, brands WHERE products.product_cat=categories.cat_id AND products.product_brand=brands.brand_id AND prod_status='1'");

		$grandTotal = 0;

		while($row = mysqli_fetch_assoc($result))
		{
			$grandTotal += $row['total'];
			fputcsv($output, $row);
		}

		fputcsv($output, array('', '', '', 'Grand Total', $grandTotal));

		fclose($output);
	}

	/*if(isset($_POST["exportSales"]))
    {
        if (isset($_POST['month']) && isset($_POST['year'])) {
            $month = $_POST['month'];
            $year = $_POST['year'];
            
            // Construct the start and end dates based on the selected month and year
            $start_date = date("Y-m-d", strtotime("$year-$month-01"));
            $end_date = date("Y-m-t", strtotime("$year-$month-01"));
            
            // Fetch the sales data for the selected month and year
            $sql = "SELECT * FROM orders_info oi, orders o WHERE oi.order_id=o.order_id AND o.created_at BETWEEN '$start_date' AND '$end_date'";
            $result = $con->query($sql);
            
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=Monthly Sales Report.csv');
            $output = fopen("php://output", "w");
            fputcsv($output, array('Order ID', 'Transaction ID', 'Order Time', 'Total Price (RM)'));
            
            while ($row = $result->fetch_assoc()) {
                fputcsv($output, array($row['order_id'], $row['trx_id'], $row["created_at"], $row["total_amt"]));
            }
            
            fclose($output);
        } else {
            // Fetch all sales data if no month and year are selected
            $sql = "SELECT * FROM orders_info oi, orders o WHERE oi.order_id=o.order_id";
            $result = $con->query($sql);
            
            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=Monthly Sales Report.csv');
            $output = fopen("php://output", "w");
            fputcsv($output, array('Order ID', 'Transaction ID', 'Order Time', 'Total Price (RM)'));
            
            while ($row = $result->fetch_assoc()) {
                fputcsv($output, array($row['order_id'], $row['trx_id'], $row["created_at"], $row["total_amt"]));
            }
            
            fclose($output);
        }
    }*/

	if (isset($_POST["exportSales"])) {
		if(isset($_POST['selectedMonth']) && isset($_POST['selectedYear'])){
		$selectedMonth = $_POST["selectedMonth"];
		$selectedYear = $_POST["selectedYear"];
	
		// Construct the start and end dates based on the selected month and year
		$start_date = date("Y-m-d", strtotime("$selectedYear-$selectedMonth-01"));
		$end_date = date("Y-m-t", strtotime("$selectedYear-$selectedMonth-01"));
	
		// Fetch the sales data for the selected month and year
		$sql = "SELECT * FROM orders_info oi, orders o WHERE oi.order_id=o.order_id AND o.created_at BETWEEN '$start_date' AND '$end_date' ORDER BY o.created_at DESC";
		$result = $con->query($sql);

		$filename = "Monthly Sales Report.csv";
		}else{
			// Fetch all sales data if no month and year are selected
			$sql = "SELECT * FROM orders_info oi, orders o WHERE oi.order_id=o.order_id";
			$result = $con->query($sql);
	
			$filename = "All Sales Report.csv";
		}
	
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=' . $filename);
		$output = fopen('php://output', 'w');
	
		fputcsv($output, array('Order ID', 'Transaction ID', 'Order Time', 'Total Price (RM)'));
	
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				fputcsv($output, array($row['order_id'], $row['trx_id'], $row["created_at"], $row["total_amt"]));
			}
		} else {
			fputcsv($output, array('No sales data available.'));
		}
	
		fclose($output);
		exit();
	}
?>