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
    <title>Apple Store - Chi Tiết Hóa Đơn</title>
    <!-- Bootstrap core CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Additional CSS Files -->
   
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
        }

        td {
            background-color: white !important;
        }

        th {
            font-weight: bold !important;
            background-color: #0a5249 !important;
            color: white;
            border: none !important;
        }

        th .text-center {
            background-color: #0a5249 !important;
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
    <?php include("../admin/assets/title.php");?>
</head>

<body class="sb-nav-fixed">
    <?php include("../admin/assets/header.php");?>
    <div class="page-heading header-text">
        <div class="text">
            <h1 style="color: white;">Thông tin đơn hàng</h1>
        </div>
    </div>
    <section class="vh-100" style="min-height: 400px; margin-top: 100;">
        <div class="container">
            <h1>Chi tiết đơn hàng</h1>
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
            include('../config/db.php');
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
                include('../HistoryInvoice.php');
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
                            <td style="text-align: center;"><img src="../img/<?php echo $row['HinhAnh'] ?>"></td>
                            <td><?php echo $row['TenSanPham'] ?></td>
                            <td><?php echo $row['BoNho'] ?></td>
                            <td>
                            <span style="background-color: <?= $row['MauSac'] ?>; padding: 5px;<?= $row['MauSac'] == 'white' ? 'color: black;' : 'color: white;' ?>">
                            <?= strtoupper($row['MauSac']) ?>
                            </span>
                            </td>
                            <td><?php echo $row['SoLuong'] ?></td>
                            <td><?php echo number_format($row['DonGia'], 0, ',', '.') ?></td>
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
            <table class="mt-2 table table-striped table-bordered table-success rounded">
                <tr class="bg-primary text-white">
                    <th colspan="2" class="text-center">
                        <h3 class="text-success">Lịch sử đơn hàng</h3>
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
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>
