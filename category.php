<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="./assets/fonts/apple.ico" type="image/x-icon">
    <script src="./assets/js/app.js" defer></script>
    <title>Apple Store</title>
    <title>Tất cả sản phẩm</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/owl.css">
</head>

<body>

    <?php include("header.php"); ?>

    <!-- Page Content -->
    <div class="page-heading header-text">
        <div class="text">
                    <?php //session_start();
                    include('./config/db.php');
                    $idloaisp = $_GET['idloaisp'];
                    $sq = "SELECT * FROM loaisp WHERE MaLoaiSP = '$idloaisp'";
                    $resul = $link->query($sq);
                    
                    if ($resul->num_rows > 0) {
                        // output data of each row
                        while ($ro = $resul->fetch_assoc()) {
                    ?>
                            <h1><?php echo $ro["TenLoaiSP"] ?></h1>
                            <span><?php echo $ro["GioiThieu"] ?></span>
                    <?php
                        }
                    } ?>
        </div>
    </div>
    <?php include('./CategoryBar.php') ?>
    <div class="services">
        <div class="container">
            <div class="row">
                <?php
                $sql = "SELECT * FROM sanpham JOIN optionproduct ON sanpham.MaSanPham =  optionproduct.MaSanPham WHERE MaLoaiSP = '$idloaisp'";
                $page=0;
                if(isset($_GET['page']))
                {
                $page = $_GET['page'];
                $page = ($page-1)*3;
                }
                $sql .= " GROUP BY 'MaSanPham' ORDER BY 'MaSanPham' ASC LIMIT $page,3";
                $result = $link->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) { ?>
                        <div class="col-md-4">
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
                    echo "0 results";
                }
                ?>
            </div>

            <br>
            <br>

            <nav>
                <ul class="pagination pagination-lg justify-content-center">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">«</span>
                            <span class="sr-only">Previous</span>
                        </a>
<?php
              $sqltrang = mysqli_query($link,"SELECT * FROM sanpham WHERE MaLoaiSP = '$idloaisp'");
              $rowcount = mysqli_num_rows($sqltrang);
              $page = ceil($rowcount/3);
              for($i=1;$i<=$page;$i++) {
            ?>
            <li class="page-item"><a class="page-link" href="category.php?idloaisp=<?php echo $idloaisp ?>&page=<?php echo $i ?>"><?php echo $i ?></a></li>
            <?php }
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
    <?php include("footer.php"); ?>
</body>

</html>