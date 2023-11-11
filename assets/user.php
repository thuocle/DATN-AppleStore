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
                <h1 class="mt-4">Danh sách người dùng</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Danh mục người dung </li>
                </ol>
                <div class="card mb-4">
                    <div class="card-body">
                        <td><a style="text-decoration: none" href="adduser.php" class="btn btn-primary">Thêm người dùng</a></td>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Thông tin tất cả người dùng
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Tên đăng nhập</th>
                                    <th>Mật khẩu</th>
                                    <th>Email</th>
                                    <th>Họ tên</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Quyền</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                        include('../config/db.php');
                        $sql = "SELECT * FROM users";
                        if ($result = mysqli_query($link, $sql)) {
                            $i = 0;
                            while ($row = mysqli_fetch_array($result)) {
                                $i++;
                        ?>
                                <tr <?php if ($i % 2 == 0) echo 'class="table-secondary"'; ?>>
                                    <td><?php echo $row['TenDangNhap'] ?></td>
                                    <td><?php echo $row['MatKhau'] ?></td>
                                    <td><?php echo $row['Email'] ?></td>
                                    <td><?php echo $row['HoTen'] ?></td>
                                    <td><?php echo $row['SDT'] ?></td>
                                    <td><?php echo $row['DiaChi'] ?></td>
                                    <td><?php echo $row['Quyen'] ?></td>
                                    <td style="text-align: center;">
                                        <a href="adduser.php?id=<?php echo $row['TenDangNhap'] ?>"
                                            class="btn-edit">Sửa</a>
                                    </td>
                                    <td style="text-align: center;">
                                        <a href="javascript:void(0)" class="btn-delete"
                                            onclick="confirmDelete('<?php echo $row["TenDangNhap"] ?>')">Xóa</a>
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
        </main>

        <style>
        .table-striped tbody tr.table-secondary:nth-of-type(odd) {
            background-color: #f2f2f2;
        }
    .btn-edit {
        background-color: #007bff; /* màu nền cho nút sửa */
        color: #fff; /* màu chữ cho nút sửa */
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        text-decoration: none;
    }
    .btn-delete {
        background-color: #dc3545; /* màu nền cho nút xóa */
        color: #fff; /* màu chữ cho nút xóa */
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        text-decoration: none;
    }
        </style>

        <script>
        function confirmDelete(id) {
            if (confirm("Bạn có chắc chắn muốn xóa người dùng " + id + " không?")) {
                window.location.href = 'xulyuser.php?idxoa=' + id;
            }
        }
        </script>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2022</div>
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