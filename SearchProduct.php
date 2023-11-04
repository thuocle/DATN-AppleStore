<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" href="./assets/fonts/apple.ico" type="image/x-icon">

    <title>Tìm kiếm sản phẩm</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="./assets/js/app.js" defer></script>
    <style>
    h1 {
        color: #fff !important;
    }

    * {
        box-sizing: border-box;
    }

    form.example {
        border-radius: 25px;
        max-width: 300px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #2e2046;
        margin-left: 70%;
        margin-top: 50px;
    }

    form.example::after {
        content: "";
        clear: both;
        display: table;
    }

    .services {
        margin-top: 50px;
    }

    .service-item:hover {
        transform: translateY(-10px);
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: 'Poppins', sans-serif;
        color: #333;
    }

    .search-box {
        width: fit-content;
        height: fit-content;
        position: relative;
    }

    .input-search {
        height: 50px;
        width: 50px;
        border-style: none;
        padding: 10px;
        font-size: 18px;
        letter-spacing: 2px;
        outline: none;
        border: none;
        border-radius: 25px;
        transition: all .5s ease-in-out;
        background-color: #e3c206;
        padding-right: 40px;
        color: #fff;
    }

    .input-search::placeholder {
        color: #fff;
        font-size: 18px;
        letter-spacing: 2px;
        font-weight: 100;
    }

    .btn-search {
        width: 50px;
        height: 50px;
        border-style: none;
        font-size: 20px;
        font-weight: bold;
        outline: none;
        border: none;
        cursor: pointer;
        border-radius: 50%;
        position: absolute;
        right: 0px;
        color: #ffffff;
        background-color: transparent;
        pointer-events: painted;
    }

    .btn-search:focus~.input-search {
        width: 300px;
        border-radius: 0px;
        background-color: transparent;
        border-bottom: 1px solid rgba(255, 255, 255, .5);
        transition: all 500ms cubic-bezier(0, 0.110, 0.35, 2);
    }

    .input-search:focus {
        width: 300px;
        border-radius: 0px;
        background-color: transparent;
        outline: none;
        /* border-bottom:1px solid rgba(255,255,255,.5); */
        transition: all 500ms cubic-bezier(0, 0.110, 0.35, 2);
    }
    </style>

</head>

<body>
    <!-- style="position: absolute; margin-top: 70px;margin-left: 600px" -->
    <?php include("header.php");?>

    <!-- Page Content -->
    <div class="page-heading header-text">
        <div class="text">
            <h1>Trang sản phẩm</h1>
            <span>Sức mạnh vượt trội - Đi đầu xu hướng công nghệ</span>
        </div>
    </div>

    <?php include('./CategoryBar.php') ?>
    <form class="example" action="" method="GET">
        <div class="search-box">
            <button class="btn-search" type="submit"><i class="fas fa-search"></i></button>
            <input type="text" class="input-search" placeholder="Type to Search..." name="search">
        </div>
    </form>
    <div class="services">
        <div class="container"></div>
        <div class="row" style="margin: 0; padding-left: 100px;padding-right: 100px;">
            <?php 
      function alert($msg) {
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
    if(isset($_SESSION['mess']))
    {
      alert($_SESSION['mess']);
      unset($_SESSION['mess']);
    }
    ?>
            <?php
include('./config/db.php');
$results_per_page = 3;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$start_index = ($page - 1) * $results_per_page;

// Thực hiện truy vấn SQL để lấy kết quả tìm kiếm
$search_query = urldecode($_GET['search']);// Giả sử người dùng đã submit ô tìm kiếm và truyền giá trị vào biến 'search'

$sql = "SELECT * FROM sanpham JOIN optionproduct ON sanpham.MaSanPham = optionproduct.MaSanPham WHERE sanpham.TenSanPham LIKE '%$search_query%' GROUP BY sanpham.MaSanPham LIMIT $start_index, $results_per_page";
$result = $link->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) { ?>
  <div class="col-md-5">
            <div class="product-card">
                <img style="height: 200px;" src="img/<?= $row["HinhAnh"] ?>" alt="<?= $row["TenSanPham"] ?>" class="product-image-small">
                <div style="padding:15px;" class="product-details">
                    <h4><?= $row["TenSanPham"] ?></h4>
                    <div class="price">
                        <del><?= number_format($row["Gia"] * 1.5) ?><sup>VND</sup></del>
                       <span style="color:red;font-weight:bold"> <?= number_format($row["Gia"]) ?></span><sup style="color:red;">VND</sup>
                    </div>
                    <p><b>Phiên bản <?= $row["BoNho"] ?></b></p>
                    <a href="product-details.php?masp=<?= $row["MaSanPham"] ?>" class="view-details-button">Xem thêm</a>
                </div>
            </div>
        </div>
  <?php
  }
} else {
    echo '<script>
    window.location.href = "404notfound.php";
</script>';

}
$sql_count = "SELECT COUNT(*) AS total FROM sanpham WHERE TenSanPham LIKE '%$search_query%'";
$count_result = $link->query($sql_count);
$row_count = $count_result->fetch_assoc();
$total_results = $row_count['total'];
$total_pages = ceil($total_results / $results_per_page);
?>
        </div>
        <nav>
    <ul class="pagination pagination-lg justify-content-center">
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">«</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        <?php
        for ($i = 1; $i <= $total_pages; $i++) {
            ?>
            <li class="page-item">
                <a class="page-link" href="SearchProduct.php?search=<?php echo $search_query?>&page=<?php echo $i ?>"><?php echo $i ?></a>
            </li>
            <?php
        }
        ?>
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">»</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>
</nav>
        <br>
        <br>
        <br>
        <br>
    </div>
    </div>

    <!-- Footer Starts Here -->
    <?php include("footer.php");?>
</body>

</html>