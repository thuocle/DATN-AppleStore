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
    <title>Apple Store - Chi Tiết Hóa Đơn</title>
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

    section {
        padding: 50px;
    }

    section h1 {
        margin-bottom: 30px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: white !important;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
        border: 1px solid black;
    }

    th {
        font-weight: bold;
        background-color: #0a5249;
    }

    img {
        max-width: 100px;
        max-height: 100px;
        object-fit: cover;
    }

    table.rounded {
        border-radius: 8px !important;
        overflow: hidden;
    }

    table.rounded th,
    table.rounded td {
        border: 1px solid white;
        padding: 8px;
    }
    </style>
</head>
<?php include("header.php"); //session_start()
?>

<body>
    <!-- Page Content -->
    <div class="page-heading header-text">
        <div class="text">
            <h1>Thông tin đơn hàng</h1>
        </div>
    </div>
    <section class="vh-100" style="min-height: 400px; margin-top: 100;">
        <div class="container">
            <h1>Chi tiết đơn hàng của bạn</h1>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-success rounded">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th colspan="2">Mã đơn hàng</th>
                            <th colspan="4">Ngày đặt hàng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
            include('./config/db.php');
            if(isset($_GET['id'])){
                $madh = $_GET['id'];
                $sql = "SELECT donhang.MaDonHang, donhang.Ngay,donhang.TongTien,donhang.GhiChu,thongtindonhang.SoLuong, thongtindonhang.DonGia,donhang.TrangThai, sanpham.HinhAnh, sanpham.TenSanPham, optionproduct.BoNho, optionproduct.MauSac
                FROM donhang
                INNER JOIN thongtindonhang ON donhang.MaDonHang = thongtindonhang.MaDonHang
                INNER JOIN optionproduct ON thongtindonhang.MaSanPham = optionproduct.OPID
                INNER JOIN sanpham ON sanpham.MaSanPham = optionproduct.MaSanPham
                        WHERE donhang.MaDonHang='$madh'";
                $sql2 ="SELECT * FROM lichsudonhang JOIN trangthai ON lichsudonhang.TrangThai = trangthai.trangthai_id  WHERE MaDonHang='$madh' ORDER BY ThoiGian DESC";
                $result2 = mysqli_query($link, $sql2);
                $result = mysqli_query($link, $sql);
                if (!$result) {
                    die("Lỗi truy vấn: " . mysqli_error($link));
                }
                $row = mysqli_fetch_assoc($result);
            include('./HistoryInvoice.php');
            }
        ?>
                        <tr>
                            <td colspan="2"><?php echo $row['MaDonHang'] ?></td>
                            <td colspan="2"><?php echo $row['Ngay'] ?></td>
                        </tr>
                    </tbody>
                    <thead>
                        <tr class="bg-primary text-white">
                            <th>Hình ảnh</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Phiên bản</th>
                            <th>Màu sắc</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php mysqli_data_seek($result, 0); // Đưa con trỏ về đầu dữ liệu ?>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td style="text-align: center;"><img src="img/<?php echo $row['HinhAnh'] ?>"></td>
                            <td><?php echo $row['TenSanPham'] ?>
                            <td><?php echo $row['BoNho'] ?>
                            <td>
                            <span style="background-color: <?= $row['MauSac'] ?>; padding: 5px; margin-left: 70px; <?= $row['MauSac'] == 'white' ? 'color: black;' : 'color: white;' ?>">
                            <?= strtoupper($row['MauSac']) ?>
                            </span>
                            </td>
                            <td><?php echo $row['SoLuong'] ?>
                            <td><?php echo number_format($row['DonGia'], 0, ',', '.') ?>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <thead>
                        <tr class="bg-primary text-white">
                            <th colspan="2">Tổng tiền</th>
                            <th colspan="4">Hình thức thanh toán</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php mysqli_data_seek($result, 0); 
            $row = mysqli_fetch_assoc($result);
            // Đưa con trỏ về đầu dữ liệu ?>
                        <tr>
                            <td colspan="2"><b><?php echo number_format($row['TongTien'], 0, ',', '.') ?></b></td>
                            <?php mysqli_data_seek($result, 0); // Đưa con trỏ về đầu dữ liệu ?>
                            <td colspan="2"><?php echo $row['GhiChu'] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php
mysqli_data_seek($result, 0);
$row = mysqli_fetch_assoc($result);

if ($row['TrangThai'] == 4) {
    if (isset($_POST['submit'])) {
        $newStatus = 9;
        $updateQuery = "UPDATE donhang SET TrangThai = $newStatus WHERE MaDonHang = '$madh'";
        $updateResult = mysqli_query($link, $updateQuery);
        if (!$updateResult) {
            die("Lỗi cập nhật trạng thái: " . mysqli_error($link));
        }
        $row['TrangThai'] = $newStatus; // Cập nhật trạng thái mới
        themLichSuDonHang($madh, $newStatus, $thoiGian);
        echo "<script type='text/javascript'>alert('Đã gửi yêu cầu thành công!'); window.location.href = '../apple-store/index.php';</script>";
    }
    // Đơn hàng đã được giao tới và đã được xác nhận nhận hàng
    ?>
            <button class="btn btn-success d-print-none font-weight-bold"
                onclick="window.open('PrintInvoice.php?id=<?php echo $row['MaDonHang']?>')">In hóa đơn</button>
            <p style="color:green">Đơn hàng đã được giao thành công!></p>
            <form action="" method="post">
                <button class="btn btn-danger" type="submit" name="submit">Yêu cầu trả hàng</button>
            </form>
            <?php
} else if ($row['TrangThai'] == 1) {
    if (isset($_POST['submit'])) {
        $newStatus = 8;
        $updateQuery = "UPDATE donhang SET TrangThai = $newStatus WHERE MaDonHang = '$madh'";
        $updateResult = mysqli_query($link, $updateQuery);
        if (!$updateResult) {
            die("Lỗi cập nhật trạng thái: " . mysqli_error($link));
        }
        $row['TrangThai'] = $newStatus; // Cập nhật trạng thái mới
        themLichSuDonHang($madh, $newStatus, $thoiGian);
        echo "<script type='text/javascript'>alert('Đã gửi yêu cầu thành công!'); window.location.href = '../apple-store/index.php';</script>";
    }
    ?>
            <p style="color:red">Đặt hàng thành công!</p>
            <form action="" method="post">
                <button class="btn btn-danger" type="submit" name="submit">Yêu cầu hủy đơn</button>
            </form>
            <?php
} else if ($row['TrangThai'] == 2) {
    if (isset($_POST['submit'])) {
        $newStatus = 8;
        $updateQuery = "UPDATE donhang SET TrangThai = $newStatus WHERE MaDonHang = '$madh'";
        $updateResult = mysqli_query($link, $updateQuery);
        if (!$updateResult) {
            die("Lỗi cập nhật trạng thái: " . mysqli_error($link));
        }
        $row['TrangThai'] = $newStatus; // Cập nhật trạng thái mới
        themLichSuDonHang($madh, $newStatus, $thoiGian);
        echo "<script type='text/javascript'>alert('Đã gửi yêu cầu thành công!'); window.location.href = '../apple-store/index.php';</script>";
    }
    ?>
            <p style="color:red">Đang chuẩn bị hàng!</p>
            <form action="" method="post">
                <button class="btn btn-danger" type="submit" name="submit">Yêu cầu hủy đơn</button>
            </form>
            <?php
} 
else if ($row['TrangThai'] == 3) {
    if (isset($_POST['submit'])) {
        $newStatus = 4;
        $updateQuery = "UPDATE donhang SET TrangThai = $newStatus WHERE MaDonHang = '$madh'";
        $updateResult = mysqli_query($link, $updateQuery);
        if (!$updateResult) {
            die("Lỗi cập nhật trạng thái: " . mysqli_error($link));
        }
        $row['TrangThai'] = $newStatus; // Cập nhật trạng thái mới
        themLichSuDonHang($madh, $newStatus, $thoiGian);
        echo "<script type='text/javascript'>alert('Đã gửi yêu cầu thành công!'); window.location.href = '../apple-store/index.php';</script>";
    }
    ?>
            <p style="color:red">Đơn hàng đang được giao tới!</p>
            <form action="" method="post">
                <button class="btn btn-danger" type="submit" name="submit">Đã nhận hàng</button>
            </form>
            <?php
} 
else if ($row['TrangThai'] == 7) {
    if (isset($_POST['submit'])) {
        $newStatus = 2;
        $updateQuery = "UPDATE donhang SET TrangThai = $newStatus WHERE MaDonHang = '$madh'";
        $updateResult = mysqli_query($link, $updateQuery);
        if (!$updateResult) {
            die("Lỗi cập nhật trạng thái: " . mysqli_error($link));
        }
        $row['TrangThai'] = $newStatus; // Cập nhật trạng thái mới
        echo "<script type='text/javascript'>alert('Đã gửi yêu cầu thành công!'); window.location.href = '../apple-store/index.php';</script>";
    }
    ?>
            <p style="color:red">Đơn hàng đã giao cho vận chuyển không thể hủy!</p>
            <form action="" method="post">
                <button class="btn btn-danger" type="submit" name="submit">Tiếp tục giao hàng</button>
            </form>
            <?php
} 
else if ($row['TrangThai'] == 8) {
    if (isset($_POST['submit'])) {
        $newStatus = 1;
        $updateQuery = "UPDATE donhang SET TrangThai = $newStatus WHERE MaDonHang = '$madh'";
        $updateResult = mysqli_query($link, $updateQuery);
        if (!$updateResult) {
            die("Lỗi cập nhật trạng thái: " . mysqli_error($link));
        }
        $row['TrangThai'] = $newStatus; // Cập nhật trạng thái mới
        themLichSuDonHang($madh, $newStatus, $thoiGian);
        echo "<script type='text/javascript'>alert('Đã gửi yêu cầu thành công!'); window.location.href = '../apple-store/index.php';</script>";
    }
    ?>
            <p style="color:red">Đơn hàng đã yêu cầu hủy!</p>
            <form action="" method="post">
                <button class="btn btn-danger" type="submit" name="submit">Tiếp tục giao hàng</button>
            </form>           
            <?php
}else if ($row['TrangThai'] == 10) {
    if (isset($_POST['submit'])) {
        $newStatus = 4;
        $updateQuery = "UPDATE donhang SET TrangThai = $newStatus WHERE MaDonHang = '$madh'";
        $updateResult = mysqli_query($link, $updateQuery);
        if (!$updateResult) {
            die("Lỗi cập nhật trạng thái: " . mysqli_error($link));
        }
        $row['TrangThai'] = $newStatus; // Cập nhật trạng thái mới
        themLichSuDonHang($madh, $newStatus, $thoiGian);
        echo "<script type='text/javascript'>alert('Đã gửi yêu cầu thành công!'); window.location.href = '../apple-store/index.php';</script>";
    }
    ?>
            <p style="color:red">Đơn hàng đã bị từ chối hoàn trả!</p>
            <form action="" method="post">
                <button class="btn btn-danger" type="submit" name="submit">Hủy trả hàng</button>
            </form>
            <?php
}else if ($row['TrangThai'] == 9) {
    if (isset($_POST['submit'])) {
        $newStatus = 4;
        $updateQuery = "UPDATE donhang SET TrangThai = $newStatus WHERE MaDonHang = '$madh'";
        $updateResult = mysqli_query($link, $updateQuery);
        if (!$updateResult) {
            die("Lỗi cập nhật trạng thái: " . mysqli_error($link));
        }
        $row['TrangThai'] = $newStatus; // Cập nhật trạng thái mới
        themLichSuDonHang($madh, $newStatus, $thoiGian);
        echo "<script type='text/javascript'>alert('Đã gửi yêu cầu thành công!'); window.location.href = '../apple-store/index.php';</script>";
    }
    ?>
            <p style="color:red">Đơn hàng đã yêu cầu hoàn trả!</p>
            <form action="" method="post">
                <button class="btn btn-danger" type="submit" name="submit">Hủy trả hàng</button>
            </form>
        </div>

        <?php
}
if (!$result2) {
    die("Lỗi truy vấn: " . mysqli_error($link));
} ?>
        <table class="mt-2 table table-striped table-bordered table-success rounded">
            <tr class="bg-primary text-white">
                <th colspan="2" class="text-center">
                    <h3 class="text-light">Lịch sử đơn hàng</h3>
                </th>
            </tr>
            <tr>
                <th class="text-light">Trạng thái</th>
                <th class="text-light">Thời gian</th>
            </tr>
            <?php
mysqli_data_seek($result2, 0); 
while($row = mysqli_fetch_assoc($result2)){
?>
            <tr>
                <td><?php echo $row['ten_trangthai'] ?></td>
                <td><?php echo $row['ThoiGian'] ?></td>
            </tr>
            <?php } ?>
        </table>
    </section>
    <?php include("footer.php"); ?>
    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
</body>

</html>