<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Register - Apple Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script> -->
    <?php 
        include('../config/db.php');
        if(isset($_POST['submit']))
        {
        if($_POST['pass1'] === $_POST['pass2'])
        {
            $pass = $_POST['pass1'];
            $user = $_POST['user'];
            $name = $_POST['hoten'];
            $email = $_POST['email'];
            $adress = $_POST['diachi'];
            
            $sql = "INSERT INTO `users`(`TenDangNhap`, `MatKhau`, `Email`, `HoTen`, `DiaChi`, `Quyen`) VALUES ('$user','$pass','$email','$name', '$adress',0)";
            if(mysqli_query($link,$sql)) {
                echo "<script>if(confirm('Đăng ký thành công! Mời bạn đăng nhập để trải nghiệm mua sắm!')){window.location.href='../Login/GoogleLogin.php'};</script>";
                include('./sendmail.php');
                sendmail($email, $user, $name);
            } else {
                echo "<script type='text/javascript'>alert('Vui lòng thử lại');</script>";
            }
            
        }
        else
        {
            echo "<script type='text/javascript'>alert('Vui lòng thử lại');</script>";
        }
    }
        ?>
<!-- </head> -->

<!-- <body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Create Account</h3>
                                </div>
                                <div class="card-body">
                                    <form action="" method="POST">
                                       
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="" name="hoten" type="text"
                                                placeholder="Enter your name" />
                                            <label for="inputEmail">Your name</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="" name="user" type="text"
                                                placeholder="Enter your Username" />
                                            <label for="inputEmail">Username</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" name="email" type="email"
                                                placeholder="name@example.com" />
                                            <label for="inputEmail">Email address</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="diachi" type="text"
                                                placeholder="Enter your address" />
                                            <label for="inputEmail">Address</label>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" name="pass1" id="inputPassword"
                                                        type="password" placeholder="Create a password" />
                                                    <label for="inputPassword">Password</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" name="pass2" id="inputPasswordConfirm"
                                                        type="password" placeholder="Confirm password" />
                                                    <label for="inputPasswordConfirm">Confirm Password</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 mb-0">
                                            <div class="d-grid"><input type="submit" name="submit"
                                                    class="btn btn-primary btn-block" value="Create Account" /></div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="login.php">Have an account? Go to login</a></div>
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

</html> -->