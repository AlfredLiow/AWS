<?php  include("config.php");

session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
?>


		

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered User</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

<?php
	$result = mysqli_query($con,"SELECT * FROM user_info WHERE user_status = '1'");
	
	$count1=mysqli_num_rows($result);
	?>
	
               <h4>Total Users: <?php echo $count1 ?></h4>

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php
    $total=0;
	$result3 = mysqli_query($con,"SELECT * FROM orders_info");
  
	while($row3 = mysqli_fetch_array($result3))
	{
    	$total += $row3['total_amt'];
  	}	
	?>
	
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Incomes (RM)</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo"$total"?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
	<?php
     $sql="SELECT * from orders_info  ";
	 $result=$con-> query($sql);
	 $count=0;
	 if ($result-> num_rows > 0){
		 while ($row=$result-> fetch_assoc()) {
 
			 $count=$count+1;
		 }
	 }
	?>
	
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Order</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo"$count"?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php
	$rresult = mysqli_query($con,"SELECT * FROM orders WHERE p_status='Completed'");
	
	$count2=mysqli_num_rows($rresult);
	?>
	
    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Orders Completed</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count2?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



<div class="container-fluid">
		<div class="row">
          <div class="col-md-12">
            <div class="card mb-4">
              <div class="card-header1 ">
                <h5 class="card-title">Data Analysis of The Core PC Store </h5>
              </div>
              <div class="card-body ">
                <div class="salechart">
		<?php
					
					$total1=0;
					$total2=0;
					$total3=0;
					$total4=0;
					$total5=0;
					$result101=mysqli_query($con,"SELECT * from user_info where user_status='1'");
					$count101=mysqli_fetch_assoc($result101);
					do
					{
						$total1++;
					}while($count101=mysqli_fetch_assoc($result101));
					
					$result102=mysqli_query($con,"SELECT * from admin_info where admin_status ='1'");
					$count102=mysqli_fetch_assoc($result102);
					do
					{
						$total2++;
					}while($count102=mysqli_fetch_assoc($result102));

					$result103=mysqli_query($con,"SELECT * from categories where cat_status ='1'");
					$count103=mysqli_fetch_assoc($result103);
					do
					{
						$total3++;
					}while($count103=mysqli_fetch_assoc($result103));

					$result104=mysqli_query($con,"SELECT * from brands where brand_status ='1'");
					$count104=mysqli_fetch_assoc($result104);
					do
					{
						$total4++;
					}while($count104=mysqli_fetch_assoc($result104));

					$result105=mysqli_query($con,"SELECT * from orders where p_status ='1'");
					$count105=mysqli_fetch_assoc($result105);
					do
					{
						$total5++;
					}while($count105=mysqli_fetch_assoc($result105));
										?>
											  
											

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
									<script type="text/javascript">
									  google.charts.load('current', {'packages':['bar']});
									  google.charts.setOnLoadCallback(drawStuff);

									  function drawStuff() {
										var data = new google.visualization.arrayToDataTable([
										  ['', 'Total Number'],
										  
										  ["user", <?php echo $total1;?>],
										  
										   
										  ["admin", <?php echo $total2;?>],
										  
										  ["category", <?php echo $total3;?>],
										  
										  ["brand", <?php echo $total4;?>],
										  
										  ["complete", <?php echo $total5;?>],
										  ]);

										var options = {
										  width: 1000,
										  legend: { position: 'none' },
										  chart: {
											title: 'The Core PC Store',
											}, 
											hAxis: {
											title: 'Data ',
											minValue: 0,
											},
											
										  
										  bar: { groupWidth: "40%" },
										  bars : 'vertical'
										};

										var chart = new google.charts.Bar(document.getElementById('top_x_div1'));
										// Convert the Classic options to Material options.
										chart.draw(data, google.charts.Bar.convertOptions(options));
									  };
									</script>
									  <div id="top_x_div1" style="min-height: 250px; height: 400px; max-height: 400px; max-width: 100%;"></div>
									


</div>
            </div>
             
            </div>
          </div>
        </div>
		</div>






  <?php
include('includes/scripts.php');
include('includes/footer.php');
?>