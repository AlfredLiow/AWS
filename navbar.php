
<?php
    $uid = $_SESSION["adminid"];
	$result = mysqli_query($con,"SELECT * FROM admin_info WHERE admin_id='$uid'");
	$row=mysqli_fetch_assoc($result);
	
	?>
	
   <!-- Sidebar -->
   <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
  <div class="sidebar-brand-icon rotate-n-15">
    <i class="fa fa-home"></i>
  </div>
  <div class="sidebar-brand-text mx-3">The Core PC Store</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
  <a class="nav-link" href="dashboard.php">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Admin
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">

<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseTwo">
    <i class="fa fa-user-circle"></i>
    <span>Admin</span>
  </a>
  <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Admin:</h6>
      <a class="collapse-item" href="admin_list.php">Admin List</a>
      <a class="collapse-item" href="admin_delete.php">Deactivated Admin</a>
      <a class="collapse-item" href="editProfile.php?id=<?php echo $uid?>">Edit Profile</a>
    </div>
  </div>
</li>

<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
    <i class="fa fa-user-circle"></i>
    <span>User</span>
  </a>
  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">User:</h6>
      <a class="collapse-item" href="user_list.php">User List</a>
	  <a class="collapse-item" href="user_delete.php">Deactivated User</a>
    </div>
  </div>
</li>


	
</li>
	


<li class="nav-item">

<a class="nav-link" href="viewAllOrders.php">
    <i class="fas fa-fw fa-table"></i>
    <span>Order List</span></a>
	
	<a class="nav-link" href="viewBrands.php">
    <i class="fas fa-fw fa-table"></i>
    <span>Brand List</span></a>

<a class="nav-link" href="viewCats.php">
    <i class="fas fa-fw fa-table"></i>
    <span>Category List</span></a>
	
<a class="nav-link" href="viewAllProducts.php">
    <i class="fas fa-fw fa-table"></i>
    <span>Product List</span></a>

<a class="nav-link" href="salesReport.php">
    <i class="fas fa-fw fa-table"></i>
    <span>Sales Report</span></a>

<a class="nav-link" href="monthlySales.php">
    <i class="fas fa-fw fa-table"></i>
    <span>Monthly Report</span></a>
</li>









<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>


   


          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

             

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  
               <?php echo $row['admin_name']?> 
                  
                </span>
            
              </a>
	
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">      				
                <a class="dropdown-item" href="admin_list.php">
                   <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Admin List
                </a>
				<a class="dropdown-item" href="user_list.php">
                   <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  User List
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->


  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>


