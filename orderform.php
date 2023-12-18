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
    <title>Apolo Store</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700');

body{
  font-family: 'Roboto Condensed', sans-serif;
  color: #262626;
  background-position: cover;
}
.container{
  width: 100%;
  padding-right: 15px;
  padding-left: 15px;
  margin-right: auto;
  margin-left: auto;
  margin-top:50px;
}
@media (min-width: 1200px)
{
  .container{
    max-width: 1140px;
  }
}
.d-flex{
  display: flex;
  flex-direction: row;
  background: #f6f6f6;
  border-radius: 0 0 5px 5px;
  padding: 25px;
}
form{
  flex: 4;
}
.Yorder{
  flex: 2;
}
.title{
  background-color:#004040;
  border-radius:5px 5px 0 0 ;
  padding: 20px;
  color: #f6f6f6;
}
h2{
  margin: 0;
  padding-left: 15px; 
}
.required{
  color: red;
}
label, table{
  display: block;
  margin: 15px;
}
label>span{
  float: left;
  width: 25%;
  margin-top: 12px;
  padding-right: 10px;
}
input[type="text"], input[type="tel"], input[type="email"], select
{
  width: 70%;
  height: 30px;
  padding: 5px 10px;
  margin-bottom: 10px;
  border: 1px solid #dadada;
  color: #888;
}
select{
  width: 72%;
  height: 45px;
  padding: 5px 10px;
  margin-bottom: 10px;
}
.Yorder{
  margin-top: 15px;
  height: 600px;
  padding: 20px;
  border: 1px solid #dadada;
}
table{
  margin: 0;
  padding: 0;
}
th{
  border-bottom: 1px solid #dadada;
  padding: 10px 0;
}
tr>td:nth-child(1){
  text-align: left;
  color: #2d2d2a;
}
tr>td:nth-child(2){
  text-align: right;
  color: #fc460a;
}
td{
  border-bottom: 1px solid #dadada;
  padding: 25px 25px 25px 0;
}

p{
  display: block;
  color: #888;
  margin: 0;
  padding-left: 25px;
}
.Yorder>div{
  padding: 15px 0; 
}

.button{
  width: 100%;
  margin-top: 50px;
  padding: 10px;
  border: none;
  border-radius: 30px;
  background: #5939b9;
  color: #fff;
  font-size: 15px;
  font-weight: bold;
  float:left;
}
.button:hover{
  cursor: pointer;
  background: #428a7d;
}
    </style>
</head>
<?php
      session_start();?>
<body>
<div class="container">
  <div class="title">
      <h2>Thông tin chi tiết đặt hàng</h2>
  </div>
<div class="d-flex">
  <form action="vnpay.php" method="POST" id="paymentForm">
    <label>
      <span class="name">Họ và tên <span class="required">*</span></span>
      <input type="text" name="name" placeholder="vd: Nguyễn Văn A" required>
    </label>

    <label>
      <span>Địa chỉ nhận hàng<span class="required">*</span></span>
      <input type="text" name="address" placeholder="Vui lòng nhập địa chỉ nhận hàng tại đây..." required>
    </label>
    <label>
      <span>Số điện thoại <span class="required">*</span></span>
      <input type="tel" name="phone" placeholder="vd:0123456789" required>
    </label>
    <label>
      <span>Email <span class="required">*</span></span>
      <input type="email" name="email" placeholder="vd: abc@gmail.com" required>
    </label>
    <input type="submit" class="button" name="redirect"
                                    value="Đặt hàng" id="placeOrderButton" />
  </form>
  <div class="Yorder">
    <table>
      <tr>
        <th colspan="2">Đơn hàng của bạn</th>
      </tr>
      <?php
      $tongtien = 0;
        foreach($_SESSION['cart'] as $item)
        {
            $tien = $item['gia']*$item['sl'];
            $tongtien += $tien;
            ?>
      <tr>
        <td><?=$item['tensp']?>(<?=$item['sl']?> chiếc)</td>
        <td><span>X       </span><?= number_format($item['gia'])?> VND</td>
      </tr>
      <?php }?>
      <tr>
        <td>Thành tiền:</td>
        <td  style="color:green"><?=number_format($tongtien)?>VND</td>
      </tr>
      <tr>
        <td>Phí vận chuyển</td>
        <td style="color:blue">Miễn phí</td>
      </tr>
    </table><br>
    <div>
      <input type="radio" name="cash" value="on" checked> Thanh toán online
      <img height="32px" style="margin-bottom:-7px" src="./img/bank.png" alt="">
    </div>
    <div>
      <input type="radio" name="cash" value="bk"> Thanh toán sau khi nhận hàng 
      <img height="32px" style="margin-bottom:-7px" src="./img/delivery.png" alt="">
    </div>
    
  </div><!-- Yorder -->
 </div>
</div>
<script>
document.getElementById('placeOrderButton').addEventListener('click', function() {
    // Lấy giá trị của radio button đã chọn
    var paymentMethod = document.querySelector('input[type="radio"][name="cash"]:checked');

    // Kiểm tra giá trị để xác định URL action
    var actionUrl = "vnpay.php"; // Giá trị mặc định

    if (paymentMethod) {
        // Nếu có radio button được chọn, cập nhật URL action tương ứng
        if (paymentMethod.value === "on") {
            actionUrl = "vnpay.php"; // Thanh toán online
        } else if (paymentMethod.value === "bk") {
            actionUrl = "thanhtoan.php"; // Thanh toán sau khi nhận hàng
        }
    }

    // Thiết lập giá trị action của form
    document.getElementById('paymentForm').action = actionUrl;

    // Gửi form
    document.getElementById('paymentForm').submit();
});
</script>
</body>
</html>