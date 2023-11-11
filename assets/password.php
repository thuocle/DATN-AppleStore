<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Password Reset - Apple Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <?php
            function random_str(
                int $length = 64,
                string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
            ): string {
                if ($length < 1) {
                    throw new \RangeException("Length must be a positive integer");
                }
                $pieces = [];
                $max = mb_strlen($keyspace, '8bit') - 1;
                for ($i = 0; $i < $length; ++$i) {
                    $pieces []= $keyspace[random_int(0, $max)];
                }
                return implode('', $pieces);
            }
            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\Exception;
            include('../config/db.php');
            require 'PHPMailer/src/Exception.php';
            require 'PHPMailer/src/PHPMailer.php';
            require 'PHPMailer/src/SMTP.php';
            if(isset($_POST["send"]))
            {
                $pass = random_str(8);
                $email = $_POST['email'];
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
                $mail->Username = 'anhtuan1990nxht@gmail.com'; // Thay thế 'example@gmail.com' bằng địa chỉ email của bạn
                $mail->Password = 'ndxxwlvknuetgkqg'; // Thay thế 'password' bằng mật khẩu của bạn
                $mail->setFrom('anhtuan1990nxht@gmail.com', 'Apple Store');
                $mail->addReplyTo('anhtuan1990nxht@gmail.com', 'Le Quoc Thuoc');
                $mail->addAddress($_POST['email']);
                $mail->isHTML(true);
                $mail->Subject = "Password Recovery from Apple Store with Love";
                $mail->Body = "Bạn đã yêu cầu khôi phục mật khẩu từ Apple Store. Mật khẩu mới của bạn là: ".$pass." Vui lòng đổi mật khẩu khi đăng nhập lần kế tiếp";
                $mail->send();
                $sql1 = "UPDATE users SET MatKhau = '$pass' WHERE Email = '$email'";
                mysqli_query($link,$sql1);
                echo "<script type='text/javascript'>alert('Vui lòng kiểm tra email');</script>";
            }
        ?>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Password Recovery</h3>
                                </div>
                                <div class="card-body">
                                    <div class="small mb-3 text-muted">Enter your email address and we will send you a
                                        link to reset your password.</div>
                                    <form action="" method="POST">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" name="email" type="email"
                                                placeholder="name@example.com" />
                                            <label for="inputEmail">Email address</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="login.php">Return to login</a>
                                            <input type="submit" name="send" class="btn btn-primary"
                                                value="Reset Password" />
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Apple Store</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
</body>

</html>