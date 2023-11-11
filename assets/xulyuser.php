<?php
    include('../config/db.php');
    if(isset($_POST['submit'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $email = $_POST['email'];
    $hoten = $_POST['hoten'];
    $sdt = $_POST['sdt'];
    $dchi = $_POST['dchi'];
    $quyen = $_POST['quyen'] == "admin" ? 1 : 0;
    $sql = "INSERT INTO users VALUES ('$user','$pass','$email','$hoten','$sdt','$dchi',$quyen)";
    if(mysqli_query($link,$sql)) {
                    
                    header(('Location:../admin/user.php'));
                    echo "<script type='text/javascript'>alert('Thêm danh mục thành công');</script>";
              } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($link);
              }
    }
    if(isset($_POST['sua']))
    {
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $email = $_POST['email'];
        $hoten = $_POST['hoten'];
        $sdt = $_POST['sdt'];
        $dchi = $_POST['dchi'];
        $quyen = $_POST['quyen'] == "admin" ? 1 : 0;
        $sql1 = "UPDATE users SET MatKhau = '$pass', Email = '$email', HoTen = '$hoten', SDT = '$sdt', DiaChi ='$dchi', Quyen = $quyen WHERE TenDangNhap='$user'";
        if(mysqli_query($link,$sql1)) {
            echo "<script type='text/javascript'>alert('Sửa danh mục thành công');</script>";
            header(('Location:../admin/user.php'));
              } else {
                    echo "Error: " . $sql1 . "<br>" . mysqli_error($link);
              }
    }
    if(isset($_GET['idxoa']))
    {
        $xoa = $_GET['idxoa'];
        $quey = "DELETE FROM users Where TenDangNhap = '$xoa'";
        if (mysqli_query($link, $quey)) {
            echo "<script type='text/javascript'>alert('Xóa danh mục thành công');</script>";
            header(('Location:../admin/user.php'));
        }
    }
?>