<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" href="./assets/fonts/apple.ico" type="image/x-icon">
    <script src="./assets/js/app.js" defer></script>
    <title>Chi tiết sản phẩm</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <style>
    table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 20px;
        height: 150px;
    }

    th,
    td {
        text-align: left;
        padding: 8px;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    .product-colors {
        margin-top: 20px;
        margin-left: 140px;
        max-width: 100px;
    }

    .color-options {
        display: flex;
        align-items: center;
    }

    .color-options label {
        margin-right: 10px;
    }

    .color-options input[type="radio"] {
        display: none;
    }

    .color {
        display: inline-block;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        cursor: pointer;
    }

    .red {
        background-color: red;
    }

    .blue {
        background-color: black;
    }

    .green {
        background-color: purple;
    }

    .color:hover {
        transform: scale(1.2);
    }

    .services {
        margin-top: 80px !important;
        margin-bottom: 80px;
        padding-left: 200px;
        padding-right: 200px; 
    }
    img {
        width: 100%;
        display: block;
        /* height: 100%; */
        object-fit: cover; 
    }

    .img-display {
        overflow: hidden;
        margin: 20px;
    }

    .img-showcase {
        display: flex;
        width: 100%;
        transition: all 0.5s ease;
        /* height: 350px; */
    }

    .img-showcase img {
         flex-basis: 25%;
         object-fit: contain;
    }

    .img-select {
        display: flex;
    }

    .img-item {
        margin: 0.3rem;
        flex-basis: 25%;
        object-fit: cover;
    }
    .img-item img{
        height: 80px;
        object-fit: contain;
    }

    .img-item:nth-child(1),
    .img-item:nth-child(2),
    .img-item:nth-child(3) {
        margin-right: 0;
    }

    .img-item:hover {
        opacity: 0.8;
    }

    .product-actions {
        display: flex;
        align-items: center;
        justify-content: center;
    }
   
    </style>
</head>

<body>
    <?php include("header.php"); 
    session_reset();
  include('./config/db.php');
  $masp = $_GET['masp'];
  $sql = "SELECT * FROM sanpham INNER JOIN optionproduct ON sanpham.MaSanPham = optionproduct.MaSanPham WHERE sanpham.MaSanPham = '$masp' LIMIT 1";
  $sql2 = "SELECT * FROM optionproduct WHERE MaSanPham = '$masp'";
  $result = $link->query($sql);
  $result2 = $link->query($sql2);
  // $row1 = $result->fetch_assoc();
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
  ?>
    <!-- Page Content -->
    <form action="./Addgiohang.php" method="POST" id="">
        <div class="page-heading header-text">
            <div class="text">
                <h1><?php
    $giaBan = $row["Gia"];
    $giaGoc = $giaBan * 1.5;
    echo '<del>'.number_format($giaGoc).' <sup>VND</sup></del> &nbsp;';
    echo number_format($giaBan).' <sup>VND</sup>';
  ?>
                </h1>
                <h5>
                    Khuyến mãi lớn nhất trong năm
                </h5>
            </div>
        </div>
        <?php include('./CategoryBar.php') ?>
        <div class="services">
            <div class="container" >
                <div class="row" style="gap: 200px;">
                    <div class="col-md-4" >
                        <div class="product-image">
                            <!-- <img src="img/<?php echo $row['HinhAnh'] ?>" alt="" class="img-fluid wc-image"> -->
                            <div class="product-imgs">
                                <div class="img-display">
                                    <div class="img-showcase">
                                        <img src="img/<?php echo $row['HinhAnh'] ?>" alt="shoe image">
                                        <img src="img/1671127598_Ảnh chụp màn hình 2022-12-16 010519.png"
                                            alt="shoe image">
                                        <img src="img/1671371910_Ảnh chụp màn hình 2022-12-18 205738.png"
                                            alt="shoe image">
                                        <img src="img/1671121674_Ảnh chụp màn hình 2022-12-15 221936.png"
                                            alt="shoe image">
                                    </div>
                                </div>
                                <div class="img-select">
                                    <div class="img-item">
                                        <a href="#" data-id="1">
                                        <img src="img/<?php echo $row['HinhAnh'] ?>" alt="shoe image">
                                        </a>
                                    </div>
                                    <div class="img-item">
                                        <a href="#" data-id="2">
                                        <img src="img/1671127598_Ảnh chụp màn hình 2022-12-16 010519.png"
                                            alt="shoe image">
                                        </a>
                                    </div>
                                    <div class="img-item">
                                        <a href="#" data-id="3">
                                        <img src="img/1671371910_Ảnh chụp màn hình 2022-12-18 205738.png"
                                            alt="shoe image">
                                        </a>
                                    </div>
                                    <div class="img-item">
                                        <a href="#" data-id="4">
                                        <img src="img/1671121674_Ảnh chụp màn hình 2022-12-15 221936.png"
                                            alt="shoe image">
                                        </a>
                                    </div>
                                </div>
                                <p class="product-price text-success" style="font-size: 25px; margin-top: 20px;">
<!-- Thay đổi phần màu sắc -->
<div class="color-options" style=" min-width: 400px; min-height: 200px; display: flex; flex-direction: row; flex-wrap: wrap; ">
    <?php
    if ($result2->num_rows > 0) {
        while ($row2 = $result2->fetch_assoc()) {
            $mauSac = $row2["MauSac"];
            $boNho = $row2["BoNho"];
            $opid = $row2["OPID"];
            $gia = $row2["Gia"];
            $soluong = $row2["SoLuong"];
    ?>
    <div style="flex-basis: 50%;<?php if ($soluong <= 1){ echo 'pointer-events: none;';}?>" class="op"><label for="version_<?php echo $opid; ?>" class="color" style="height: 20px; width: 40px; border-radius: 5px;  border: 1px solid black; background-color: <?php echo $mauSac; ?>;text-align: right;"><p style="margin-left: 50px;line-height: 10px; color: black; display: inline-block; background-color: black; border-radius: 2px; height: 20px; min-height: fit-content; color: white; padding: 5px;"><?php echo strtoupper($mauSac); ?></p></label>
   
    <input <?php if ($soluong <= 1){ echo 'disabled';}?>  type="radio" id="version_<?php echo $opid; ?>" name="version" value="<?php echo $opid; ?>" data-gia="<?php echo $gia; ?>">
    <p style="font-size: 15px;min-width:100px"><?php echo $boNho; ?></p>
    <?php if($soluong <= 1){ ?>
        <p style="color: red;">Hết hàng</p>
    <?php } ?>
</div>
    <?php
        }
    }
    ?>
</div>


                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="product-info" >
                            <h2 style="margin-bottom: 20px;" class="product-title"><?php echo $row['TenSanPham'] ?></h2>
                            <!--  -->
                            
                            <table class="table table-striped" style="max-height: 150px;">
                                <tbody>
                                    <tr>
                                        <td>Kích thước</td>
                                        <td><?php echo $row['KichThuoc'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Trọng lượng</td>
                                        <td><?php echo $row['TrongLuong'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Camera</td>
                                        <td><?php echo $row['Camera'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Sim</td>
                                        <td><?php echo $row['Sim'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Pin</td>
                                        <td><?php echo $row['Pin'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Hệ điều hành</td>
                                        <td><?php echo $row['HeDieuHanh'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Bảo hành</td>
                                        <td><?php echo $row['BaoHanh'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Phụ kiện</td>
                                        <td><?php echo $row['PhuKien'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="product-actions">
                            <button type="submit" class="btn btn-success" id="add-to-cart-button">Thêm vào giỏ hàng</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </form>

    <br>
    </div>
    <?php
          }
        } else {
          echo "0 results";
        }
        ?>
    </div>
    </div>
    <script src="./assets/js/ProductSlider.js"></script>
    <script>
    const radioInputs = document.querySelectorAll('input[name="version"]');
    const priceElement = document.querySelector('.product-price');

    radioInputs.forEach((radioInput) => {
        radioInput.addEventListener('change', () => {
            // Bỏ lớp 'selected' khỏi tất cả label
            document.querySelectorAll('.color-options label').forEach(label => {
                label.classList.remove('button-86');
            });

            // Thêm lớp 'selected' cho label tương ứng với radio được chọn
            const selectedLabel = document.querySelector(`label[for="${radioInput.id}"]`);
            if (selectedLabel) {
                selectedLabel.classList.add('button-86');
            }

            const selectedGia = radioInput.getAttribute('data-gia');
            priceElement.innerHTML = number_format(selectedGia) + '<sup>VND</sup>';
        });
    });

    function number_format(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
</script>




    <!-- Footer Starts Here -->
    <?php include("footer.php"); ?>
</body>

</html>