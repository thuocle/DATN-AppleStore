    <?php session_start();
        if(isset($_POST['email']) && isset($_POST['pass'])) {
            $user = $_POST['email'];
            $pass = $_POST['pass'];
            include('../config/db.php');
            $sql = "SELECT * FROM users WHERE TenDangNhap = '$user' AND MatKhau = '$pass'";
            $result = $link->query($sql);
            if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if($row['Quyen'] == "0")
            {
                $_SESSION['user'] = $user;
                header(('Location:../index.php'));
            }
            if($row['Quyen'] == "1")
            {
                $_SESSION['admin'] = $user;
                header(('Location:../admin'));
            }
        }
            else
            echo "<script>if(confirm('Sai tên hoặc mật khẩu!')){window.location.href='../Login/GoogleLogin.php'};</script>";
        }
        ?>
<!-- </head> -->

<!-- <body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Đăng nhập</h3>
                                </div>
                                <div class="card-body">
                                    <form action="login.php" method="POST">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="email" placeholder="name@example.com" />
                                            <label for="inputEmail">Tên đăng nhập hoặc email</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" type="password" name="pass"
                                                placeholder="Password" />
                                            <button type="button" id="show-password">Hiện mật khẩu</button>
                                            <label for="inputPassword">Mật khẩu</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" id="inputRememberPassword" type="checkbox"
                                                value="" />
                                            <label class="form-check-label" for="inputRememberPassword">Nhớ mật
                                                khẩu</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="password.php">Quên mật khẩu?</a>
                                            <input type="submit" class="btn btn-primary" value="Đăng nhập">
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="register.php">Chưa có tài khoản? Đăng kí ngay!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script> -->
    <!-- <script>
  var passwordInput = document.getElementById("inputPassword");
  var showPasswordButton = document.getElementById("show-password");
  showPasswordButton.addEventListener("click", function() {
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      showPasswordButton.textContent = "Ẩn mật khẩu";
    } else {
      passwordInput.type = "password";
      showPasswordButton.textContent = "Hiện mật khẩu";
    }
  });
</script> -->
