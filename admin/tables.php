<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        td, th {
            min-width: 150px;
        }
    </style>
    <?php include("../admin/assets/title.php");?>
</head>

<body class="sb-nav-fixed">
    <?php include("../admin/assets/header.php");?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Danh sách sản phẩm</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Sản phẩm</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-body">
                        <a href="addsp.php" class="btn btn-primary">Thêm sản phẩm</a>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Thông tin các sản phẩm
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="dataTable" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Mã sản phẩm</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Dòng sản phẩm</th>
                                        <th>Kích thước</th>
                                        <th>Trọng lượng</th>
                                        <th>Camera</th>
                                        <th>Sim</th>
                                        <th>Pin</th>
                                        <th>Hệ điều hành</th>
                                        <th>Bảo hành</th>
                                        <th>Phụ kiện</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
              include('../config/db.php');
              $sql = "SELECT * FROM sanpham JOIN loaisp ON sanpham.MaLoaiSP = loaisp.MaLoaiSP";
              if ($result = mysqli_query($link, $sql)) {
                while ($row = mysqli_fetch_array($result)) {
              ?>
                                    <tr>
                                        <td><?= $row['MaSanPham'] ?>
                                        <td><?= $row['TenSanPham'] ?>
                                        <td><?= $row['TenLoaiSP'] ?>
                                        <td><?= $row['KichThuoc'] ?>
                                        <td><?= $row['TrongLuong'] ?>
                                        <td><?= $row['Camera'] ?>
                                        <td><?= $row['Sim'] ?>
                                        <td><?= $row['Pin'] ?>
                                        <td><?= $row['HeDieuHanh'] ?>
                                        <td><?= $row['BaoHanh'] ?>
                                        <td><?= $row['PhuKien'] ?>
                                        <td style="text-align: center;">
                                            <a href="addsp.php?id=<?php echo $row['MaSanPham'] ?>"
                                                class="btn btn-primary">Sửa</a>
                                        </td>
                                        <td style="text-align: center;">
                                            <a href="xuly.php?idxoa=<?php echo $row['MaSanPham']; ?>"
                                                class="btn btn-danger" onclick="return confirmDelete();">Xóa</a>

                                            <script>
                                            function confirmDelete() {
                                                if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này?")) {
                                                    return true;
                                                } else {
                                                    return false;
                                                }
                                            }
                                            </script>
                                        </td>
                                    </tr>
                                    <?php
                }
              }
              ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Apple Store</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>