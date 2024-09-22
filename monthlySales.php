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
            <?php if (isset($_POST['month']) && isset($_POST['year'])) { ?>
        <input type="hidden" name="selectedMonth" value="<?php echo $_POST['month']; ?>">
        <input type="hidden" name="selectedYear" value="<?php echo $_POST['year']; ?>">
    <?php } ?>
                <input class="btn btn-info btn-sm" style="margin-left:2em; float:right;" type="submit" name="exportSales" value="Export Monthly Sales to Excel">
            </form>
            <h6 class="m-0 font-weight-bold text-primary">Monthly Sales Report</h6>
        </div>

        <div class="card-body">
        <?php
            $grandTotal = 0;
            if (isset($_POST['month']) && isset($_POST['year'])) {
                $month = $_POST['month'];
                $year = $_POST['year'];
            
                // Construct the start and end dates based on the selected month and year
                $start_date = date("Y-m-d", strtotime("$year-$month-01"));
                $end_date = date("Y-m-t", strtotime("$year-$month-01"));
            
                // Fetch the sales data for the selected month and year
                $sql = "SELECT * FROM orders_info oi, orders o WHERE oi.order_id=o.order_id AND o.created_at BETWEEN '$start_date' AND '$end_date'";
                $result = $con->query($sql);
            
                while ($row3 = mysqli_fetch_array($result)) {
                    $total = $row3['total_amt'];
                    $grandTotal += $total;
                }
            } else {
                // Fetch all sales data if no month and year are selected
                $result = mysqli_query($con, "SELECT * FROM orders_info");
                while ($row3 = mysqli_fetch_array($result)) {
                    $total = $row3['total_amt'];
                    $grandTotal += $total;
                }
            }
            ?>

            <div class="table-responsive">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                    <form method="post" action="">
                        <select id="month" name="month">
                            <?php
                            $current_month = date('m');
                            for ($i = 1; $i <= 12; $i++) {
                                $month_value = str_pad($i, 2, '0', STR_PAD_LEFT);
                                $month_name = date('F', mktime(0, 0, 0, $i, 1));
                                echo "<option value=\"$month_value\">$month_name</option>";
                            }
                            ?>
                        </select>
                        <select id="year" name="year">
                            <?php
                            $current_year = date('Y');
                            for ($i = 0; $i <= 10; $i++) {
                                $year = $current_year - $i;
                                echo "<option value=\"$year\">$year</option>";
                            }
                            ?>
                        </select>
                        <input type="submit" value="Show" class="btn btn-primary">
                    </form>
                    <div>Grand Total(RM): <span>RM<?php echo $grandTotal; ?></span></div>
                </div>
                <div >
                <?php
                    if (isset($_POST['month']) && isset($_POST['year'])) {
                        $month = $_POST['month'];
                        $year = $_POST['year'];
                    
                        // Construct the start and end dates based on the selected month and year
                        $start_date = date("Y-m-d", strtotime("$year-$month-01"));
                        $end_date = date("Y-m-t", strtotime("$year-$month-01"));
                    
                        // Fetch the sales data for the selected month and year
                        $sql = "SELECT * FROM orders_info oi, orders o WHERE oi.order_id=o.order_id AND o.created_at BETWEEN '$start_date' AND '$end_date' ORDER BY o.created_at DESC";
                        $result = $con->query($sql);
                    
                        // Display the selected month and year
                        $selected_month = date('F', strtotime("$year-$month-01"));
                        echo '
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="margin-top:10px;">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Transaction ID</th>
                                        <th>Order Time</th>
                                        <th>Total Price(RM)</th>
                                    </tr>
                                </thead>
                                <tbody>';
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $pid = $row['product_id'];
                                    echo '
                                    <tr>
                                        <td>'.$row['order_id'].'</td>
                                        <td>'.$row['trx_id'].'</td>
                                        <td>'.$row["created_at"].'</td>
                                        <td>'.$row["total_amt"].'</td>
                                    </tr>';
                                }
                            } else {
                                echo '
                                    <tr>
                                        <td colspan="4">No sales data available.</td>
                                    </tr>';
                            }
                            echo '
                                </tbody>
                            </table>';
                            
                    } else {
                        // Fetch all sales data if no month and year are selected
                        $sql = "SELECT * FROM orders_info oi, orders o WHERE oi.order_id=o.order_id";
                        $result = $con->query($sql);
                        echo '
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="margin-top:10px;">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Transaction ID</th>
                                        <th>Order Time</th>
                                        <th>Total Price(RM)</th>
                                    </tr>
                                </thead>
                                <tbody>';
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $pid = $row['product_id'];
                                    echo '
                                    <tr>
                                        <td>'.$row['order_id'].'</td>
                                        <td>'.$row['trx_id'].'</td>
                                        <td>'.$row["created_at"].'</td>
                                        <td>'.$row["total_amt"].'</td>
                                    </tr>';
                                }
                            } else {
                                echo '
                                    <tr>
                                        <td colspan="4">No sales data available.</td>
                                    </tr>';
                            }
                            echo '
                                </tbody>
                            </table>';
                    }
                ?>    
                
            </div>
        </div>
    </div>
</div>
<?php

include('includes/scripts.php');
include('includes/footer.php');
	?>	