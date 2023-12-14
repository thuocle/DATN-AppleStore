<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/PHPMailer-master/src/SMTP.php';
// Tạo nội dung email
function sendmail2($email, $name, $orderid, $tongtien, $address, $phone){
$message = '<html><body>';
$message .= '<p>Thân chào '.$name.',</p>';
$message .= '<p>Cảm ơn bạn đã mua hàng. Đơn hàng của bạn sẽ sớm được xác nhận và giao tới bạn sớm nhất có thể.</p>';
$message .= '<p>Thông tin đơn hàng của bạn là:</p>';
$message .= '<ul>';
$message .= '<li>Mã đơn hàng: '.$orderid.'</li>';
foreach ($_SESSION['cart'] as $item) {
    $opid = $item['opid'];
    $sl = $item['sl'];
    $dongia = $item['gia'];
    $tensp =  $item['tensp'];
    $color =  $item['color'];
    $version =  $item['version'];
$message .= '<li>Sản phẩm: '.$tensp.'</li>';
$message .= '<li>Phiên bản: '.$version.' - '.$color.'</li>';
$message .= '<li>Số lượng: '.$sl.'</li>';
$message .= '<li>Đơn giá: '.$dongia.'</li>';
}
$message .= '<li>Tổng tiền: '.$tongtien.'</li>';
$message .= '<li>Thông tin giao hàng: '.$name.' - '.$address.' - '.$phone.'</li>';
$message .= '<li><a href="http://localhost/apple-store/OrderDetail.php?id='.$orderid.'">Theo dõi đơn hàng tại đây</a></li>';

$message .= '</ul>';
$message .= '<p>Chúng tôi rất vui vì bạn đã tin tưởng lựa chọn chúng tôi.</p>';
$message .= '<p>Chúc bạn có một ngày tốt lành.</p>';
$message .= '<p>Trân trọng,</p>';
$message .= '<p>Apolo Store</p>';
$message .= '</body></html>';
$tit ='Thanks for your order! ';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';
$mail->SMTPAuth = true;
$mail->Username = 'anhtuan1990nxht@gmail.com'; // Thay thế 'example@gmail.com' bằng địa chỉ email của bạn
$mail->Password = 'ndxxwlvknuetgkqg'; // Thay thế 'password' bằng mật khẩu của bạn
$mail->setFrom('anhtuan1990nxht@gmail.com', 'Apolo Store');
$mail->addReplyTo($email);
$mail->addAddress($email);
$mail->Subject .=   $tit;
$mail->msgHTML($message);

//if (!$mail->send()) {
    //echo 'Mailer Error: '.$mail->ErrorInfo;
//} else {
    //echo 'The email message was sent.';
//}
}
?>