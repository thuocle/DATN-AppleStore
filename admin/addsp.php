<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../admin/assets/title.php");?>
    <style type="text/css">
        #bang td {
            width: 200px;
            /* background-color: red; */
        }
        #bang input {
            width: max;
        }
        label {
            display: inline-block;
            font-weight: bold;
            margin-bottom: 0.5rem;
            margin-top: 0.5rem;
        }
        .card-header h3 {
            text-align: center;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <?php include("../admin/assets/header.php");
    include("../config/db.php");
    
    if (isset($_GET['id'])){
        $id = $_GET['id'];
    $sql = "SELECT * FROM sanpham WHERE sanpham.MaSanPham = '$id'";
    if ($result = mysqli_query($link, $sql)) {
        while ($row = mysqli_fetch_array($result)) {
    ?>
        <div id="layoutSidenav_content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Sửa sản phẩm</h3>
                            </div>
                            <div class="card-body">
                                <form action="xuly.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="masp">Mã sản phẩm</label>
                                            <input id="masp" name="masp" type="text" class="form-control" value="<?= $id ?>" readonly />
                                        </div>
                                        <div class="form-group">
                                            <label for="tensp">Tên sản phẩm</label>
                                            <input id="tensp" value="<?= $row['TenSanPham'] ?>" name="tensp" type="text" class="form-control" placeholder="Tên sản phẩm" />
                                        </div>
                                        <div class="form-group">
                                            <label for="kichthuoc">Kích thước</label>
                                            <input id="kichthuoc" name="kichthuoc" type="text" class="form-control" placeholder="Kích thước" value="<?= $row['KichThuoc'] ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="trgluong">Trọng lượng</label>
                                            <input id="trgluong" name="trgluong" type="text" class="form-control" placeholder="Trọng lượng" value="<?= $row['TrongLuong'] ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="camera">Camera</label>
                                            <input id="camera" name="camera" type="text" class="form-control" placeholder="Camera" value="<?= $row['Camera'] ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="sim">Sim</label>
                                            <input id="sim" name="sim" type="text" class="form-control" placeholder="Sim" value="<?= $row['Sim'] ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="pin">Pin</label>
                                            <input id="pin" name="pin" type="text" class="form-control" placeholder="Pin" value="<?= $row['Pin'] ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="hdh">Hệ điều hành</label>
                                            <input id="hdh" name="hdh" type="text" class="form-control" placeholder="Hệ điều hành" value="<?= $row['HeDieuHanh'] ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="bh">Bảo hành</label>
                                            <input id="bh" name="bh" type="text" class="form-control" placeholder="Bảo hành" value="<?= $row['BaoHanh'] ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="pk">Phụ kiện</label>
                                            <input id="pk" name="pk" type="text" class="form-control" placeholder="Phụ kiện" value="<?= $row['PhuKien'] ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="fileUpload">Hình ảnh</label>
                                            <input id="fileUpload" name="fileUpload" type="file" class="form-control" placeholder="Hình ảnh" value="<?= $row['HinhAnh'] ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="loaisp">Loại sản phẩm</label>
                                            <select id="loaisp" name="loaisp" class="form-control">
                                                <option value="" selected>Chọn dòng sản phẩm</option>
                                                <option value="01" <?= $row['MaLoaiSP'] == 01 ? 'selected' : '' ?>>iPhone</option>
                                                <option value="02" <?= $row['MaLoaiSP'] == 02 ? 'selected' : '' ?>>SamSung</option>
                                                <option value="03" <?= $row['MaLoaiSP'] == 03 ? 'selected' : '' ?>>OPPO</option>
                                                <option value="04" <?= $row['MaLoaiSP'] == 04 ? 'selected' : '' ?>>XIAOMI</option>
                                                <option value="05" <?= $row['MaLoaiSP'] == 05 ? 'selected' : '' ?>>NOKIA</option>
                                            </select>
                                        </div>
                                        <div class="form-group text-center">
                                            <button type="submit" name="sua" class="btn btn-primary">Sửa sản phẩm</button>
                                        <?php }} ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } else { ?>
<div id="layoutSidenav_content">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Thêm sản phẩm</h3>
                    </div>
                    <div class="card-body">
                        <form action="xuly.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="masp">Mã sản phẩm</label>
                                <input id="masp" name="masp" type="text" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="tensp">Tên sản phẩm</label>
                                <input id="tensp" name="tensp" type="text" class="form-control" placeholder="Tên sản phẩm" />
                            </div>
                            <div class="form-group">
                                <label for="kichthuoc">Kích thước</label>
                                <input id="kichthuoc" name="kichthuoc" type="text" class="form-control" placeholder="Kích thước" />
                            </div>
                            <div class="form-group">
                                <label for="trgluong">Trọng lượng</label>
                                <input id="trgluong" name="trgluong" type="text" class="form-control" placeholder="Trọng lượng" />
                            </div>
                            <div class="form-group">
                                <label for="camera">Camera</label>
                                <input id="camera" name = "camera" type="text" class="form-control" placeholder="Camera" />
                            </div>
                            <div class="form-group">
                                <label for="sim">Sim</label>
                                <input id="sim" name="sim" type="text" class="form-control" placeholder="Sim" />
                            </div>
                            <div class="form-group">
                                <label for="pin">Pin</label>
                                <input id="pin" name="pin" type="text" class="form-control" placeholder="Pin" />
                            </div>
                            <div class="form-group">
                                <label for="hdh">Hệ điều hành</label>
                                <input id="hdh" name="hdh" type="text" class="form-control" placeholder="Hệ điều hành" />
                            </div>
                            <div class="form-group">
                                <label for="bh">Bảo hành</label>
                                <input id="bh" name="bh" type="text" class="form-control" placeholder="Bảo hành" />
                            </div>
                            <div class="form-group">
                                <label for="pk">Phụ kiện</label>
                                <input id="pk" name="pk" type="text" class="form-control" placeholder="Phụ kiện" />
                            </div>
                            <div class="form-group">
                                <label for="fileUpload">Hình ảnh</label>
                                <input id="fileUpload" name="fileUpload" type="file" class="form-control" placeholder="Hình ảnh" />
                            </div>
                            <div class="form-group">
                                <label for="loaisp">Loại sản phẩm</label>
                                <select id="loaisp" name="loaisp" class="form-control">
                                    <option value="" selected>Chọn dòng sản phẩm</option>
                                    <option value="01">iPhone</option>
                                    <option value="02">SamSung</option>
                                    <option value="03">OPPO</option>
                                    <option value="04">XIAOMI</option>
                                    <option value="05">NOKIA</option>
                                </select>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Thêm sản phẩm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>
