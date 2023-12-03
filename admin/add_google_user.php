<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../admin/assets/title.php"); ?>
    <script>
        function showAlert(message) {
            alert(message);
            window.location.href = 'google-user.php';
        }
    </script>
</head>

<body class="sb-nav-fixed">
    <?php include("../admin/assets/header.php"); ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Thêm người dùng</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Thêm người dùng</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-body">
                        <?php
                        include('../config/db.php');

                        // Xử lý khi người dùng nhấp vào nút Thêm
                        if (isset($_POST['submit'])) {
                            $google_name = $_POST['google_name'];
                            $google_email = $_POST['google_email'];
                            $google_link = $_POST['google_link'];
                            $google_picture_link = $_POST['google_picture_link'];
                            $DiaChi = $_POST['DiaChi'];

                            // Truy vấn để thêm người dùng vào cơ sở dữ liệu
                            $sql = "INSERT INTO google_users (google_name, google_email, google_link, google_picture_link, DiaChi) VALUES ('$google_name', '$google_email', '$google_link', '$google_picture_link', '$DiaChi')";
                            $result = mysqli_query($link, $sql);

                            if ($result) {
                                echo "<script>showAlert('Thêm người dùng thành công.');</script>";
                            } else {
                                echo "Có lỗi xảy ra khi thêm người dùng.";
                            }
                        }
                        ?>

                        <form action="" method="post">
                            <div class="form-group">
                                <label for="google_name">Google Name:</label>
                                <input type="text" class="form-control" id="google_name" name="google_name" required>
                            </div>
                            <div class="form-group">
                                <label for="google_email">Google Email:</label>
                                <input type="email" class="form-control" id="google_email" name="google_email" required>
                            </div>
                            <div class="form-group">
                                <label for="google_link">Google Link:</label>
                                <input type="text" class="form-control" id="google_link" name="google_link" required>
                            </div>
                            <div class="form-group">
                                <label for="google_picture_link">Google Picture Link:</label>
                                <input type="text" class="form-control" id="google_picture_link" name="google_picture_link" required>
                            </div>
                            <div class="form-group">
                                <label for="DiaChi">Địa chỉ:</label>
                                <input type="text" class="form-control" id="DiaChi" name="DiaChi" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Thêm</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <!-- Footer và các script -->
    </div>
    <!-- Các script -->
</body>

</html>