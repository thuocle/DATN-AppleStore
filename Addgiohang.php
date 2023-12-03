<?php
session_start();

if (isset($_POST['version'])) {
    include('./config/db.php');
    $opid = $_POST['version'];
    $sql = "SELECT * FROM sanpham INNER JOIN optionproduct ON sanpham.MaSanPham = optionproduct.MaSanPham WHERE  optionproduct.OPID = '$opid' ";
    $result = $link->query($sql);
    $sl = 1;
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Chỉ cần lấy thông tin của phiên bản sản phẩm được chọn
        $sanpham = array(
            'tensp' => $row['TenSanPham'],
            'masp' => $row['MaSanPham'],
            'img' => $row['HinhAnh'],
            'sl' => $sl,
            'gia' => $row['Gia'],
            'opid' => $row['OPID'],
            'color' => $row['MauSac'],
            'version' => $row['BoNho']
            
        );

        if (isset($_SESSION['cart'])) {
            $flag = true;
            foreach ($_SESSION['cart'] as &$item) {
                if ($item['opid'] == $opid) {
                    $item['sl'] += 1;
                    $flag = false;
                }
            }

            if ($flag) {
                $_SESSION['cart'][] = $sanpham;
            }
        } else {
            $_SESSION['cart'] = array($sanpham);
        }
    }
}
$_SESSION['mess'] = "Thêm sản phẩm thành công";
header('Location: ../apple-store/products.php');
die();
?>
