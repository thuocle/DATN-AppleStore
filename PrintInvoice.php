<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Thêm CSS của Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="shortcut icon" href="./assets/fonts/apple.ico" type="image/x-icon">
    <title>Hóa đơn</title>
    <style>
        .table {
  font-size: 14px;
}

.table th,
.table td {
  vertical-align: middle;
  text-align: center;
}

.table thead th {
  font-weight: bold;
}

.table tbody td {
  font-weight: normal;
}

.table thead th,
.table tbody td {
  border-color: #dee2e6;
}

.table thead th,
.table tfoot td {
  background-color: #f1f1f1;
}

.table tfoot td {
  font-weight: bold;
}

.table-bordered th,
.table-bordered td {
  border: 1px solid #dee2e6;
}

.table-bordered thead th,
.table-bordered thead td {
  border-bottom-width: 2px;
}

.table-striped tbody tr:nth-of-type(odd) {
  background-color: #f9f9f9;
}

.table-hover tbody tr:hover {
  background-color: #f1f1f1;
}
.invoice {
  border: 1px solid #000;
  padding: 20px;
}
.d-flex .justify-content-between .align-items-center .justify-content-center .text-center{
  justify-content: center !important;
}
    </style>
</head>
<body>
    <div class="container">
        <?php
        include('./config/db.php');
        if(isset($_GET['id'])){
            $madh = $_GET['id'];
            $sql = "SELECT users.HoTen, users.Email, users.SDT, users.DiaChi, donhang.MaDonHang, donhang.Ngay, donhang.TongTien, donhang.GhiChu, thongtindonhang.SoLuong, sanpham.TenSanPham, sanpham.HinhAnh, optionproduct.Gia
                    FROM users
                    INNER JOIN donhang ON users.TenDangNhap = donhang.TenDangNhap
                    INNER JOIN thongtindonhang ON donhang.MaDonHang = thongtindonhang.MaDonHang 
                    INNER JOIN optionproduct ON thongtindonhang.MaSanPham = optionproduct.OPID 
                    INNER JOIN sanpham ON optionproduct.MaSanPham = sanpham.MaSanPham
                    WHERE donhang.MaDonHang='$madh'";
            $sql2 = "SELECT google_name, google_email,google_users.SDT, donhang.DiaChi, donhang.MaDonHang, donhang.Ngay, donhang.TongTien, donhang.GhiChu, thongtindonhang.SoLuong, sanpham.TenSanPham, sanpham.HinhAnh, optionproduct.Gia
                    FROM google_users
                    INNER JOIN donhang ON google_users.google_id = donhang.google_id
                    INNER JOIN thongtindonhang ON donhang.MaDonHang = thongtindonhang.MaDonHang
                    INNER JOIN optionproduct ON thongtindonhang.MaSanPham = optionproduct.OPID 
                    INNER JOIN sanpham ON optionproduct.MaSanPham = sanpham.MaSanPham
                    WHERE donhang.MaDonHang='$madh'";
            $result = mysqli_query($link, $sql);
            $result2 = mysqli_query($link, $sql2);
            if (!$result && !$result2) {
                die("Lỗi truy vấn: " . mysqli_error($link));
            }
            // Kiểm tra xem kết quả truy vấn có dữ liệu hay không
            if (mysqli_num_rows($result) > 0) {
                // In hóa đơn
                $row = mysqli_fetch_assoc($result);
        ?>
        <div class="invoice p-3 my-5 shadow">
        <div class="d-flex justify-content-between align-items-center text-center">
          <h1 class="h3 font-weight-bold mb-0">HÓA ĐƠN</h1>
  <button class="btn btn-success d-print-none font-weight-bold" onclick="window.print()">IN HÓA ĐƠN</button>
</div>
<hr class="my-4">
<div class="row">
  <div class="col-md-6">
    <p class="font-weight-bold mb-0">Mã đơn hàng:</p>
    <p><?php echo $row['MaDonHang']; ?></p>
    <p class="font-weight-bold mb-0">Ngày đặt hàng:</p>
    <p><?= $row['Ngay']=date('d/m/Y'); ?></p>
    <p class="font-weight-bold mb-0">Ghi chú:</p>
    <p><?php echo $row['GhiChu']; ?></p>
  </div>
  <div class="col-md-6">
  <p class="font-weight-bold mb-0">Tên khách hàng:</p>
    <p><?php echo $row['HoTen']; ?></p>
    <p class="font-weight-bold mb-0">Địa chỉ giao hàng:</p>
    <p><?php echo $row['DiaChi']; ?></p>
    <p class="font-weight-bold mb-0">Số điện thoại:</p>
    <p><?php echo $row['SDT']; ?></p>
    <p class="font-weight-bold mb-0">Email:</p>
    <p><?php echo $row['Email']; ?></p>
    
  </div>
</div>
<hr class="my-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Đơn vị tính</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    mysqli_data_seek($result, 0);
                    while($row = mysqli_fetch_assoc($result)){
                        $item_total = $row['SoLuong'] * $row['Gia'];
                        $total += $item_total;
                        echo '<tr><td>' . $row['TenSanPham'] . '</td><td>' . number_format($row['Gia'], 0, ',', '.') . '</td><td>' . $row['SoLuong'] . '</td><td><p>Chiếc</p> </td><td>' . number_format($item_total, 0, ',', '.') . '</td></tr>';
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4"><strong>Tổng tiền:</strong></td>
                        <td><?php echo number_format($total,0, ',', '.'); ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <?php
            } 
            if (mysqli_num_rows($result2) > 0) {
              // In hóa đơn
              $row = mysqli_fetch_assoc($result2);
      ?>
      <div class="invoice p-3 my-5 shadow">
      <div class="d-flex justify-content-between align-items-center">
<h1 class="h3 font-weight-bold mb-0">HÓA ĐƠN</h1>
<button class="btn btn-success d-print-none font-weight-bold" onclick="window.print()">IN HÓA ĐƠN</button>
</div>
<hr class="my-4">
<div class="row">
<div class="col-md-6">
  <p class="font-weight-bold mb-0">Mã đơn hàng:</p>
  <p><?php echo $row['MaDonHang']; ?></p>
  <p class="font-weight-bold mb-0">Ngày đặt hàng:</p>
  <p><?php echo $row['Ngay']; ?></p>
  <p class="font-weight-bold mb-0">Ghi chú:</p>
  <p><?php echo $row['GhiChu']; ?></p>
</div>
<div class="col-md-6">
<p class="font-weight-bold mb-0">Tên khách hàng:</p>
  <p><?php echo $row['google_name']; ?></p>
  <p class="font-weight-bold mb-0">Địa chỉ giao hàng:</p>
  <p><?php echo $row['DiaChi'] == null ? "":$row['DiaChi']; ?></p>
  <p class="font-weight-bold mb-0">Số điện thoại:</p>
  <p><?php echo $row['SDT']== null ? "":$row['SDT']; ?></p>
  <p class="font-weight-bold mb-0">Email:</p>
  <p><?php echo $row['google_email']; ?></p>
  
</div>
</div>
<hr class="my-4">
          <table class="table table-bordered">
              <thead>
                  <tr>
                      <th>Tên sản phẩm</th>
                      <th>Đơn giá</th>
                      <th>Số lượng</th>
                      <th>Đơn vị tính</th>
                      <th>Thành tiền</th>
                  </tr>
              </thead>
              <tbody>
                  <?php
                  $total = 0;
                  mysqli_data_seek($result2, 0);
                  while($row = mysqli_fetch_assoc($result2)){
                      $item_total = $row['SoLuong'] * $row['Gia'];
                      $total += $item_total;
                      echo '<tr><td>' . $row['TenSanPham'] . '</td><td>' . number_format($row['Gia'], 0, ',', '.') . '</td><td>' . $row['SoLuong'] . '</td><td><p>Chiếc</p> </td><td>' . number_format($item_total, 0, ',', '.') . '</td></tr>';
                  }
                  ?>
              </tbody>
              <tfoot>
                  <tr>
                      <td colspan="4"><strong>Tổng tiền:</strong></td>
                      <td><?=number_format($total,0, ',', '.'); ?></td>
                  </tr>
              </tfoot>
          </table>
      </div>
      <?php
          }
        }
        mysqli_close($link);
        ?>

    </div>
    <!-- Thêm JavaScript của Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>