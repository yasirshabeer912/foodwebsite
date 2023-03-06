<?php session_start();
if (!isset($_SESSION['admin_id'])) {
  header('location: login.php');
  }
$page =  substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/")+1);
?>


<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
        <!-- <img src="../assets/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo"> -->
        <span class="ms-1 font-weight-bold text-white">Admin DashBoard</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white  <?php if ($page == 'index.php') echo 'active bg-primary'; ?>  " href="./index.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white  <?php if ($page == 'category.php') echo 'active bg-primary'; ?>" href="./category.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Add Category</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?php if ($page == 'view_category.php') echo 'active bg-primary'; ?> " href="./view_category.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">View Category</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?php if ($page == 'add-food.php') echo 'active bg-primary'; ?> " href="./add-food.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Add Food</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?php if ($page == 'view-food.php') echo 'active bg-primary'; ?>  " href="./view-food.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">View Food</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?php if ($page == 'logout.php') echo 'active bg-primary'; ?>  " href="./logout.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Logout</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>