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
    <script src="./assets/js/app.js" defer></script>
    <title>Apple Store - Quản lý đơn hàng</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <style>
    /* Use the same font family as the shopping cart page */
    body {
        font-family: 'Poppins', sans-serif;
        font-weight: 400;
    }
    section{
        padding: 50px;
    }
    section h1{
        margin-bottom: 30px;
    }
    </style>
</head>

<?php include("header.php"); //session_start()
     
?>
   
<body>
    <!-- Page Content -->
    <div class="page-heading header-text">
        <div class="text">
            <h1>Quản lý đơn hàng</h1>
        </div>
    </div>

    <section class="vh-100" style="  min-width: 500px; margin-top: 100;">
        <?php
        include('./config/db.php');
        if (isset($_GET['id'])) {
            $username = $_GET['id'];
            $ggid = $_GET['id'];
            $sql = "SELECT donhang.*, trangthai.*
                    FROM donhang
                    JOIN trangthai ON donhang.TrangThai = trangthai.trangthai_id
                    WHERE TenDangNhap='$username' 
                    ORDER BY Ngay DESC";
            $sql2 = "SELECT donhang.*, trangthai.*
                    FROM donhang
                    JOIN trangthai ON donhang.TrangThai = trangthai.trangthai_id
                    WHERE google_id='$ggid' 
                    ORDER BY Ngay DESC";
            $result = mysqli_query($link, $sql);
            $result2 = mysqli_query($link, $sql2);
            if (!$result || !$result2) {
                die("Lỗi truy vấn: " . mysqli_error($link));
            }
            $row = mysqli_fetch_assoc($result);
            $row2 = mysqli_fetch_assoc($result2);
            mysqli_close($link);
            if (!isset($row['TenDangNhap']) && !isset($row2['google_id'])) {
                echo '<h3>Bạn chưa có đơn hàng nào!</h3>';
            } else {
                $username = isset($row['TenDangNhap']) ? $row['TenDangNhap'] : "";
        ?>
        <h1>Danh sách đơn hàng của bạn <i style="color: green;"><?php echo  $username ?></i></h1>
        <div class="table-responsive table-bordered">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt hàng</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php mysqli_data_seek($result, 0); // Đưa con trỏ về đầu dữ liệu ?>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['MaDonHang'] ?></td>
                        <td><?php echo $row['Ngay']; ?></td>
                        <td><?php echo number_format($row['TongTien'], 0, ',', '.');?></td>
                        <?php if($row['trangthai_id'] == 1){ ?>
                        <td style="color: red;"><?php echo $row['ten_trangthai']; ?></td>
                        <?php } else { ?>
                        <td style="color: green;"><?php echo $row['ten_trangthai']; ?></td>
                        <?php } ?>
                        <td><a href="./OrderDetail.php?id=<?php echo $row['MaDonHang']?>">Xem chi tiết</a></td>
                        <?php if($row['trangthai_id'] == 4){ ?>
                        <td><a href="./PrintInvoice.php?id=<?php echo $row['MaDonHang']?>">Xuất hóa đơn</a></td>
                        <?php } else { ?>
                        <td></td>
                        <?php } ?>
                    </tr>
                    <?php } ?>
                    <?php mysqli_data_seek($result2, 0); // Đưa con trỏ về đầu dữ liệu ?>
                    <?php while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                    <tr>
                        <td><?php echo $row2['MaDonHang'] ?></td>
                        <td><?php echo $row2['Ngay']; ?></td>
                        <td><?php echo number_format($row2['TongTien'], 0, ',', '.'); ?></td>
                        <?php if($row2['trangthai_id'] == 1){ ?>
                        <td style="color: red;"><?php echo $row2['ten_trangthai']; ?></td>
                        <?php } else { ?>
                        <td style="color: green;"><?php echo $row2['ten_trangthai']; ?></td>
                        <?php } ?>
                        <td><a href="./OrderDetail.php?id=<?php echo $row2['MaDonHang']?>">Xem chi tiết</a></td>
                        <?php if($row2['trangthai_id'] == 4){ ?>
                        <td><a href="./PrintInvoice.php?id=<?php echo $row2['MaDonHang']?>">Xuất hóa đơn</a></td>
                        <?php } else { ?>
                        <td></td>
                        <?php } ?>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        </div>
    </section>
</body>
<?php } } ?>
<?php include("footer.php");?>
</html>
