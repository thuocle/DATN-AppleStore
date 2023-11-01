 <?php 
?> 
<?php
$servername = "localhost"; // tên máy chủ
$username = "root"; // tên người dùng
$password = ""; // mật khẩu
$dbname = "applestore"; // tên cơ sở dữ liệu

// Tạo kết nối đến cơ sở dữ liệu
$link = mysqli_connect($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if (!$link) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}
?>
