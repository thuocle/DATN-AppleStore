<?php
// Hàm để thêm lịch sử đơn hàng
date_default_timezone_set('Asia/Ho_Chi_Minh');
$thoiGian = date("Y-m-d H:i:s", time());
function themLichSuDonHang($maDonHang, $trangThai, $thoiGian) {
    if(isset($_SESSION['admin'])){
        include('../config/db.php');
    }else{
        include('./config/db.php');
    }
    global $thoiGian;
    // Chuẩn bị câu lệnh SQL để thêm lịch sử đơn hàng
    $sql = "INSERT INTO lichsudonhang (MaDonHang, TrangThai, ThoiGian) VALUES ('$maDonHang', '$trangThai', '$thoiGian')";
    // Thực thi câu lệnh SQL
    mysqli_query($link, $sql);
}
?>