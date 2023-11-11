<?php
include('../config/db.php');

// Kiểm tra xem có tham số id truyền vào không
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Xóa người dùng từ bảng "google_users"
    $deleteSql = "DELETE FROM google_users WHERE google_id = '$id'";
    $deleteResult = mysqli_query($link, $deleteSql);

    if ($deleteResult) {
        // Xóa thành công, chuyển hướng về trang danh sách người dùng
        echo "<script> window.confirm('Chắc chắn xóa không');</script>";
        header("Location: google-user.php");
        exit;
    } else {
        echo "Lỗi: " . mysqli_error($link);
    }
} 
mysqli_close($link);
?>