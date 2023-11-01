<?php session_start();?>
<header class="">
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <h2>Apple Store</h2>
        <svg xmlns="http://www.w3.org/2000/svg" height="1.5em" viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#ffffff}</style><path d="M318.7 268.7c-.2-36.7 16.4-64.4 50-84.8-18.8-26.9-47.2-41.7-84.7-44.6-35.5-2.8-74.3 20.7-88.5 20.7-15 0-49.4-19.7-76.4-19.7C63.3 141.2 4 184.8 4 273.5q0 39.3 14.4 81.2c12.8 36.7 59 126.7 107.2 125.2 25.2-.6 43-17.9 75.8-17.9 31.8 0 48.3 17.9 76.4 17.9 48.6-.7 90.4-82.5 102.6-119.3-65.2-30.7-61.7-90-61.7-91.9zm-56.6-164.2c27.3-32.4 24.8-61.9 24-72.5-24.1 1.4-52 16.4-67.9 34.9-17.5 19.8-27.8 44.3-25.6 71.9 26.1 2 49.9-11.4 69.5-34.3z"/></svg>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Trang chủ
              <!-- <span class="sr-only">(current)</span> -->
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="dropdown-toggle nav-link" data-toggle="dropdown" data-bs-toggle="dropdown">Danh mục</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="products.php">Products</a>
              <?php 
                include('./config/db.php');
                $sql = "SELECT * FROM loaisp";
                $result = $link->query($sql);
              
                if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
              ?>
              <a class="dropdown-item" href="category.php?idloaisp=<?php echo $row['MaLoaiSP'] ?>"><?php echo $row['TenLoaiSP'] ?></a>
              <?php
                }
              }
              ?>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./cart.php">Giỏ hàng</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./about.php">Về chúng tôi</a>
          <li class="nav-item">
            <a class="nav-link" href="./contact.php">Liên hệ</a>
          </li>
          <?php //session_start();
          if (isset($_SESSION['user'])) {
            //session_start();
            
          ?>
          
            <li class="nav-item dropdown">
            <a class="dropdown-toggle nav-link" data-toggle="dropdown" data-bs-toggle="dropdown">Xin chào <?php echo $_SESSION['user']?></a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="../apple-store/admin/logout.php">Đăng xuất</a>
              <?php 
              $ten = $_SESSION['user'];
                $sql1 = "SELECT * FROM users WHERE TenDangNhap = '$ten' ";
                $sql2 = "SELECT * FROM google_users WHERE google_name = '$ten' ";
                $result2 = $link->query($sql1);
                $result3 = $link->query($sql2);
                if ($result2->num_rows > 0) {
                // output data of each row
                while($roww = $result2->fetch_assoc()) {
              ?>
            <a class="dropdown-item" href="./order-management.php?id=<?php echo $roww['TenDangNhap']?>">Quản lý đơn hàng</a>
            <?php } }
          if ($result3->num_rows > 0){
              $row2 = $result3->fetch_assoc();
              ?>
              <a class="dropdown-item" href="./order-management.php?id=<?php echo $row2['google_id']?>">Quản lý đơn hàng</a>
              <?php
            }?>   
          </li>
            </div>
          </li>
            <!-- <li class="nav-item">
              <a class="nav-link" href="../mobile-shop/admin/logout.php">Đăng xuất</a>
            </li> -->
          <?php
          } else {
          ?>
            <li class="nav-item">
              <a class="nav-link" href="./Login/GoogleLogin.php">Đăng nhập</a>
            </li>
          <?php
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>
</header>