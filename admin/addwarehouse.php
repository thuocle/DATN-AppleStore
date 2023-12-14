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
    $sql = "SELECT * FROM optionproduct join sanpham on optionproduct.MaSanPham = sanpham.MaSanPham WHERE optionproduct.OPID = '$id'";
    $sql2 = "SELECT * FROM sanpham ";

    if ($result = mysqli_query($link, $sql)) {
        while ($row = mysqli_fetch_array($result)) {
            $masp = $row['MaSanPham'];
            if ($result2 = mysqli_query($link, $sql2)) {
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
                                <form action="xulywarehouse.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="opid">Mã sản phẩm</label>
                                            <input id="opid" name="opid" type="text" class="form-control" value="<?= $id ?>" readonly />
                                        </div>
                                        <div class="form-group">
                                            <label for="masp">Tên sản phẩm</label>
                                            
                                            <select id="masp" name="masp" class="form-control">
                                            <?php 
                                            while ($row2 = mysqli_fetch_array($result2)) {
                                                $selected = ($row2['MaSanPham'] == $row['MaSanPham']) ? 'selected' : '';
                                            ?>
                                                <option value="<?= $row2['MaSanPham'] ?>" <?= $selected ?>><?= $row2['TenSanPham'] ?></option>
                                                
                                            <?php }}?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="version">Phiên Bản</label>
                                            <input id="version" name="version" type="text" class="form-control" placeholder="Phiên bản" value="<?= $row['BoNho'] ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="color">Màu sắc</label>
                                            <input id="color" name="color" type="text" class="form-control" placeholder="Màu sắc" value="<?= $row['MauSac'] ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="qtty">Số lượng</label>
                                            <input id="qtty" name="qtty" type="text" class="form-control" placeholder="Số lượng" value="<?= $row['SoLuong'] ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label for="price">Giá</label>
                                            <input id="price" name="price" type="text" class="form-control" placeholder="Giá" value="<?= $row['Gia'] ?>" />
                                        </div>
                                        <div class="form-group text-center">
                                            <button type="submit" name="sua" class="btn btn-success">Sửa sản phẩm</button>
                                        <?php }} ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } else {
            $sql2 = "SELECT * FROM sanpham ";
        if ($result2 = mysqli_query($link, $sql2)) {
?>
    <div id="layoutSidenav_content">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Thêm sản phẩm mới</h3>
                        </div>
                        <div class="card-body">
                            <form action="xulywarehouse.php" method="POST" enctype="multipart/form-data">
                                   
                                    <div class="form-group">
                                        <label for="masp">Tên sản phẩm</label>
                                        
                                        <select id="masp" name="masp" class="form-control">
                                        <?php 
                                        while ($row2 = mysqli_fetch_array($result2)) {
                                        ?>
                                            <option value="<?= $row2['MaSanPham'] ?>"><?= $row2['TenSanPham'] ?></option>
                                            
                                        <?php }}?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="version">Phiên Bản</label>
                                        <input id="version" name="version" type="text" class="form-control" placeholder="Phiên bản" value="4GB-128GB" />
                                    </div>
                                    <div class="form-group">
                                        <label for="color">Màu sắc</label>
                                        <input id="color" name="color" type="text" class="form-control" placeholder="Màu sắc" value="black"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="qtty">Số lượng</label>
                                        <input id="qtty" name="qtty" type="text" class="form-control" placeholder="Số lượng" value="100" />
                                    </div>
                                    <div class="form-group">
                                            <label for="price">Giá</label>
                                            <input id="price" name="price" type="text" class="form-control" placeholder="Giá" value="20000000" />
                                        </div>
                                    <div class="form-group text-center">
                                        <button type="submit" name="add" class="btn btn-success">Thêm sản phẩm</button>
                                </div>
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
