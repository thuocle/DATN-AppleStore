<?php
    include('../config/db.php');
    if(isset($_POST['submit'])) {
    $maloaisp = rand(1,100);
    $tenloaisp = $_POST['tenloaisp'];
    $gt = $_POST['gt'];
    $sql = "INSERT INTO loaisp VALUES ('$maloaisp','$tenloaisp','$gt')";
    if(mysqli_query($link,$sql)) {
                    
                    header(('Location:../admin/category.php'));
                    echo "<script type='text/javascript'>alert('Thêm danh mục thành công');</script>";
              } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($link);
              }
    }
    if(isset($_POST['sua']))
    {
        $maloaisp = $_POST['maloaisp'];
        $tenloaisp = $_POST['tenloaisp'];
        $gt = $_POST['gt'];
        $sql = "UPDATE loaisp SET TenLoaiSP = '$tenloaisp',GioiThieu = '$gt' WHERE MaLoaiSP='$maloaisp'";
        if(mysqli_query($link,$sql)) {
            echo "<script type='text/javascript'>alert('Sửa danh mục thành công');</script>";
            header(('Location:../admin/category.php'));
              } else {
                    echo "Error: " . $sq . "<br>" . mysqli_error($link);
              }
    }
    if(isset($_GET['idxoa']))
    {
        $xoa = $_GET['idxoa'];
        $quey = "DELETE FROM loaisp Where MaLoaiSP = '$xoa'";
        if (mysqli_query($link, $quey)) {
            echo "<script type='text/javascript'>alert('Xóa danh mục thành công');</script>";
            header(('Location:../admin/category.php'));
        }
    }
?>