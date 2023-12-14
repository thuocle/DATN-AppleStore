<?php
    include('../config/db.php');
    if(isset($_POST['submit'])) {
    $masp = $_POST['masp'];
    $version = $_POST['version'];
    $qtty = $_POST['qtty'];
    $color = $_POST['color'];
    $price = $_POST['price'];
   
                $sql1 = "INSERT INTO optionproduct VAlUES ('$masp','$color','$version','$qtty','$version')";
                if (mysqli_query($link, $sql1)) {
                    echo "<script type='text/javascript'>alert('Thêm sản phẩm vào kho thành công');</script>";
                    header(('Location:../admin/warehouse.php'));
              } else {
                    echo "Error: " . $sql1 . "<br>" . mysqli_error($link);
              }
    }
    if(isset($_POST['sua']))
    {
    $masp = $_POST['masp'];
    $version = $_POST['version'];
    $qtty = $_POST['qtty'];
    $color = $_POST['color'];
    $price = $_POST['price'];
                $opid = $_POST['opid'];
                $sq = "UPDATE optionproduct SET MaSanPham = '$masp', MauSac = '$color', BoNho = '$version', SoLuong = '$qtty',Gia = '$price'WHERE OPID = '$opid'";                
                if (mysqli_query($link, $sq)) {
                    echo "<script type='text/javascript'>alert('Sửa sản phẩm thành công');</script>";
                    header(('Location:../admin/warehouse.php'));
              } else {
                    echo "Error: " . $sq . "<br>" . mysqli_error($link);
              }
    }
        if(isset($_GET['idxoa']))
{
    $xoa = $_GET['idxoa'];
    $quey = "DELETE FROM optionproduct Where OPID = '$xoa'";
    if (mysqli_query($link, $quey)) {
        echo "<script>alert('Xóa sản phẩm thành công.');</script>";
        header('Location: ../admin/warehouse.php');
    } else {
        echo "<script>alert('Xóa sản phẩm không thành công.');</script>";
        header('Location: ../admin/warehouse.php');
    }
}
?>