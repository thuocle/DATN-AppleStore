<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
include 'config/db.php';

// // Lấy thông tin tài khoản đăng ký từ database
// $username = 'username'; // Thay thế 'username' bằng tên đăng nhập của tài khoản
// $email = 'example@example.com'; // Thay thế 'example@example.com' bằng địa chỉ email của tài khoản
// $password = 'password'; // Thay thế 'password' bằng mật khẩu của tài khoản

// Tạo nội dung email
$message = '<html><body>';
$message .= '<p>Chào bạn,</p>';
$message .= '<p>Cảm ơn bạn đã đăng ký tài khoản của chúng tôi. Tài khoản của bạn đã được tạo thành công.</p>';
$message .= '<p>Thông tin tài khoản của bạn như sau:</p>';
$message .= '<ul>';
$message .= '<li>Tên đăng nhập: '.$username.'</li>';
$message .= '<li>Email: '.$email.'</li>';
$message .= '<li>Mật khẩu: '.$password.'</li>';
$message .= '</ul>';
$message .= '<p>Chúng tôi rất vui mừng khi bạn đã trở thành thành viên của chúng tôi.</p>';
$message .= '<p>Trân trọng,</p>';
$message .= '<p>Apple Store</p>';
$message .= '</body></html>';
$tit ='Thank you for successfully registering';
$mp = 'mphuong27122001@gmail.com';
$huy = 'phamhuy240901@gmail.com';
$thanh ='kieuvinhthanh08@gmail.com';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';
$mail->SMTPAuth = true;
$mail->Username = 'anhtuan1990nxht@gmail.com'; // Thay thế 'example@gmail.com' bằng địa chỉ email của bạn
$mail->Password = 'ndxxwlvknuetgkqg'; // Thay thế 'password' bằng mật khẩu của bạn
$mail->setFrom('anhtuan1990nxht@gmail.com', 'Apple Store');
$mail->addReplyTo('lequocthuoc01012001@gmail.com', 'ThanhMom');
$mail->addAddress('lequocthuoc01012001@gmail.com', 'ThanhMom');
$mail->Subject .=   $tit;
$mail->msgHTML($message);

if (!$mail->send()) {
    echo 'Mailer Error: '.$mail->ErrorInfo;
} else {
    echo 'The email message was sent.';
}
?>