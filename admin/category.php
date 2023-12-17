<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../admin/assets/title.php");?>
</head>

<body class="sb-nav-fixed">
    <?php include("../admin/assets/header.php");?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Danh sách các thương hiệu</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Danh sách các thương hiệu</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-body">
                        <a href="addloaisp.php" class="btn btn-primary">Thêm thương hiệu điện thoại mới</a>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Thông tin tất cả các thương hiệu
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="dataTable" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Mã thương hiệu</th>
                                        <th>Tên thương hiệu</th>
                                        <th>Giới thiệu</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
              include('../config/db.php');
              $sql = "SELECT * FROM loaisp";
              if ($result = mysqli_query($link, $sql)) {
                while ($row = mysqli_fetch_array($result)) {
              ?>
                                    <tr>
                                        <td><?php echo $row['MaLoaiSP'] ?></td>
                                        <td><?php echo $row['TenLoaiSP'] ?></td>
                                        <td><?php echo $row['GioiThieu'] ?></td>
                                        <td style="text-align: center;">
                                            <a href="addloaisp.php?id=<?php echo $row['MaLoaiSP'] ?>"
                                                class="btn btn-primary">Sửa</a>
                                        </td>
                                        <td style="text-align: center;">
                                            <a href="xulyloaisp.php?idxoa=<?php echo $row['MaLoaiSP'] ?>"
                                                class="btn btn-danger" onclick="return confirmDelete();">Xóa</a>
                                            <script>
                                            function confirmDelete() {
                                                if (confirm("Bạn có chắc chắn muốn xóa danh mục này?")) {
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