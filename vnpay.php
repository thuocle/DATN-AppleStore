<?php session_start();
if(isset($_SESSION['user']))
{
if(isset($_SESSION['cart']))
{
$temp = rand(1,10000000);
include('./config/db.php');
$tongtien = 0;
foreach($_SESSION['cart'] as $item)
{
    $sl = $item['sl'];
    $dongia = $item['gia'];
    $tongtien += $sl * $dongia;
}
// $ggname = $_SESSION['user'];
// $sql = "SELECT * FROM google_users WHERE google_name ='$ggname'";

error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
date_default_timezone_set('Asia/Ho_Chi_Minh');

$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = "http://localhost/apple-store/thanhtoan.php";
$vnp_TmnCode = "2TDGTBXA";//Mã website tại VNPAY 
$vnp_HashSecret = "FJSJJNFEYHCLXBLKIFFKHFYGKGVKWNID"; //Chuỗi bí mật

$vnp_TxnRef = "DH".$temp; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
$vnp_OrderInfo = "Thanh toán hóa đơn";
$vnp_OrderType = "billpayment";
$vnp_Amount = $tongtien * 100;
$vnp_Locale = "vn";
$vnp_BankCode = "";
$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
$inputData = array(
    "vnp_Version" => "2.1.0",
    "vnp_TmnCode" => $vnp_TmnCode,
    "vnp_Amount" => $vnp_Amount,
    "vnp_Command" => "pay",
    "vnp_CreateDate" => date('YmdHis'),
    "vnp_CurrCode" => "VND",
    "vnp_IpAddr" => $vnp_IpAddr,
    "vnp_Locale" => $vnp_Locale,
    "vnp_OrderInfo" => $vnp_OrderInfo,
    "vnp_OrderType" => $vnp_OrderType,
    "vnp_ReturnUrl" => $vnp_Returnurl,
    "vnp_TxnRef" => $vnp_TxnRef
);

if (isset($vnp_BankCode) && $vnp_BankCode != "") {
    $inputData['vnp_BankCode'] = $vnp_BankCode;
}
if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
    $inputData['vnp_Bill_State'] = $vnp_Bill_State;
}

//var_dump($inputData);
ksort($inputData);
$query = "";
$i = 0;
$hashdata = "";
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
    } else {
        $hashdata .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
    }
    $query .= urlencode($key) . "=" . urlencode($value) . '&';
}

$vnp_Url = $vnp_Url . "?" . $query;
if (isset($vnp_HashSecret)) {
    $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
}
$returnData = array('code' => '00'
    , 'message' => 'success'
    , 'data' => $vnp_Url);
    if (isset($_POST['redirect'])) {
        header('Location: ' . $vnp_Url);
        die();
    } else {
        echo json_encode($returnData);
    }
}
else{
    $_SESSION['mess'] = "Giỏ hàng trống vui lòng thêm sản phẩm";
    header(('Location:../apple-store/products.php'));
  }
}
else
{
    $_SESSION['mess'] = "Vui lòng đăng nhập để tiếp tục";
    header(('Location:../apple-store/Login/GoogleLogin.php'));
}
?>