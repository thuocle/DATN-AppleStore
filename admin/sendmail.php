<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
// Tạo nội dung email
function sendmail($email, $username, $name){
    $message = '<html><body>';
$message .= '<p>Thân chào '.$name.',</p>';
$message .= '<p>Cảm ơn bạn đã đăng ký tài khoản của chúng tôi. Tài khoản của bạn đã được kích hoạt thành công.</p>';
$message .= '<p>Thông tin tài khoản của bạn như sau:</p>';
$message .= '<ul>';
$message .= '<li>Tên đăng nhập: '.$username.'</li>';
$message .= '<li>Email: '.$email.'</li>';
$message .= '</ul>';
$message .= '<p>Chúng tôi rất vui vì bạn đã tin tưởng lựa chọn chúng tôi.</p>';
$message .= '<p>Trân trọng,</p>';
$message .= '<p>Apolo Store</p>';
$message .= '</body></html>';
$tit ='Thank you for successfully registering';
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

if (!$mail->send()) {
    echo 'Mailer Error: '.$mail->ErrorInfo;
} else {
    echo 'The email message was sent.';
}
}
?>