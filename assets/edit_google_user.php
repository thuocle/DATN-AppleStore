<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../admin/assets/title.php"); ?>
</head>

<body class="sb-nav-fixed">
    <?php include("../admin/assets/header.php"); ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Sửa người dùng</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Sửa người dùng</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-body">
                        <?php
                        include('../config/db.php');

                        // Kiểm tra xem có tham số id truyền vào không
                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];

                            // Truy vấn thông tin người dùng dựa trên id
                            $sql = "SELECT * FROM google_users WHERE google_id = '$id'";
                            $result = mysqli_query($link, $sql);

                            if (mysqli_num_rows($result) == 1) {
                                $row = mysqli_fetch_assoc($result);

                                // Hiển thị biểu mẫu sửa với thông tin người dùng hiện tại
                                ?>
                                <form action="edit_google_user.php?id=<?php echo $id; ?>" method="post">
                                    <div class="form-group">
                                        <label for="google_name">Google Name:</label>
                                        <input type="text" class="form-control" id="google_name" name="google_name" value="<?php echo $row['google_name']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="google_email">Google Email:</label>
                                        <input type="email" class="form-control" id="google_email" name="google_email" value="<?php echo $row['google_email']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="google_link">Google Link:</label>
                                        <input type="text" class="form-control" id="google_link" name="google_link" value="<?php echo $row['google_link']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="google_picture_link">Google Picture Link:</label>
                                        <input type="text" class="form-control" id="google_picture_link" name="google_picture_link" value="<?php echo $row['google_picture_link']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="DiaChi">Địa chỉ:</label>
                                        <input type="text" class="form-control" id="DiaChi" name="DiaChi" value="<?php echo $row['DiaChi']; ?>" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="submit">Lưu</button>
                                </form>
                                <?php
                            } else {
                                echo "Không tìm thấy người dùng.";
                            }
                        } else {
                            echo "Không tìm thấy người dùng.";
                        }

                        // Xử lý khi người dùng nhấp vào nút Lưu
                        if (isset($_POST['submit'])) {
                            $google_name = $_POST['google_name'];
                            $google_email = $_POST['google_email'];
                            $google_link = $_POST['google_link'];
                            $google_picture_link = $_POST['google_picture_link'];
                            $DiaChi = $_POST['DiaChi'];

                            // Truy vấn để cập nhật thông tin người dùng
                            $sql = "UPDATE google_users SET google_name='$google_name', google_email='$google_email', google_link='$google_link', google_picture_link='$google_picture_link', DiaChi='$DiaChi' WHERE google_id='$id'";
                            $result = mysqli_query($link, $sql);

                            if ($result) {
                                echo "Cập nhật người dùng thành công.";
                                echo "<script>window.location.href = 'google-user.php';</script>";
                            } else {
                                echo "Có lỗi xảy ra khi cập nhật người dùng.";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </main>
        <!-- Footer và các script -->
    </div>
    <!-- Các script -->
</body>

</html>