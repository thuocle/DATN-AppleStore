<?php
    include('../config/db.php');
    if(isset($_POST['submit'])) {
    $file=$_FILES['fileUpload'];
    $hinhanh=$file['name'];
    $hinhanh_tmp=$_FILES['fileUpload']['tmp_name'];
    $hinhanh = time().'_'.$hinhanh;
    $i = "SP".rand(1,100);
    $tensp = $_POST['tensp'];
    $kichthuoc = $_POST['kichthuoc'];
    $trgluong = $_POST['trgluong'];
    $camera = $_POST['camera'];
    $ram = $_POST['ram'];
    $sim = $_POST['sim'];
    $pin = $_POST['pin'];
    $hdh = $_POST['hdh'];
    $bh = $_POST['bh'];
    $pk = $_POST['pk'];
    $loaisp = $_POST['loaisp'];
    $sql = "SELECT * FROM loaisp WHERE TenLoaiSP = '$loaisp'";
                                    if ($result = mysqli_query($link, $sql)) {
                                        while ($row = mysqli_fetch_array($result)) {
                                            $id = $row['MaLoaiSP'];
                                        }
                                    }
                $sql1 = "INSERT INTO sanpham VAlUES ('$i','$tensp','$kichthuoc','$trgluong','$camera','$ram','$sim','$pin','$hdh','$bh','$pk','$hinhanh','$id')";
                if (mysqli_query($link, $sql1)) {
                    $padt = "D:/".$hinhanh;
                    $pa = "../img/".$hinhanh;
                    move_uploaded_file($hinhanh_tmp,$padt);
                    rename($padt,$pa);
                    echo "<script type='text/javascript'>alert('Thêm sản phẩm thành công');</script>";
                    header(('Location:../admin/tables.php'));
              } else {
                    echo "Error: " . $sql1 . "<br>" . mysqli_error($link);
              }
    }
    if(isset($_POST['sua']))
    {
        $file=$_FILES['fileUpload'];
    $hinhanh=$file['name'];
    $hinhanh_tmp=$_FILES['fileUpload']['tmp_name'];
    $hinhanh = time().'_'.$hinhanh;
    $i = "SP".rand(1,100);
    $tensp = $_POST['tensp'];
    $kichthuoc = $_POST['kichthuoc'];
    $trgluong = $_POST['trgluong'];
    $camera = $_POST['camera'];
    $ram = $_POST['ram'];
    $sim = $_POST['sim'];
    $pin = $_POST['pin'];
    $hdh = $_POST['hdh'];
    $bh = $_POST['bh'];
    $pk = $_POST['pk'];
    $loaisp = $_POST['loaisp'];
    $sql = "SELECT * FROM loaisp WHERE TenLoaiSP = '$loaisp'";
                if ($result = mysqli_query($link, $sql)) {
                    while ($row = mysqli_fetch_array($result)) {
                             $id = $row['MaLoaiSP'];
                    }
                 }
                $masp = $_POST['masp'];
                $sq = "UPDATE sanpham SET TenSanPham = '$tensp', KichThuoc = '$kichthuoc', TrongLuong = '$trgluong', Camera = '$camera',Sim = '$sim', Pin = '$pin', HeDieuHanh = '$hdh', BaoHanh = '$bh', PhuKien = '$pk', HinhAnh = '$hinhanh', MaLoaiSP = '$loaisp' WHERE MaSanPham = '$masp'";                
                if (mysqli_query($link, $sq)) {
                    $padt = "D:/".$hinhanh;
                    $pa = "../img/".$hinhanh;
                    move_uploaded_file($hinhanh_tmp,$padt);
                    rename($padt,$pa);
                    echo "<script type='text/javascript'>alert('Sửa sản phẩm thành công');</script>";
                    header(('Location:../admin/tables.php'));
              } else {
                    echo "Error: " . $sq . "<br>" . mysqli_error($link);
              }
    }
        if(isset($_GET['idxoa']))
{
    $xoa = $_GET['idxoa'];
    $quey = "DELETE FROM sanpham Where MaSanPham = '$xoa'";
    if (mysqli_query($link, $quey)) {
        echo "<script>alert('Xóa sản phẩm thành công.');</script>";
        header('Location: ../admin/tables.php');
    } else {
        echo "<script>alert('Xóa sản phẩm không thành công.');</script>";
        header('Location: ../admin/tables.php');
    }
}
?>