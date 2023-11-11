<!DOCTYPE html>
<html lang="en">
    <head>
    <?php include("../admin/assets/title.php");?>
        <style type="text/css">
            #bang td {
                width: 200px;
                /* background-color: red; */
            }

            #bang input {
                width: max;
            }
            label {
  display: inline-block;
  font-weight: bold;
  margin-bottom: 0.5rem;
  margin-top: 0.5rem;
}
    .card-header h3{
        text-align: center;
    }
        </style>
        
    </head>
    <body class="sb-nav-fixed">
    <?php include("../admin/assets/header.php");?>
    <div id="layoutSidenav_content">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo isset($_GET['id']) ? 'Sửa thông tin người dùng' : 'Thêm người dùng mới' ?></h3>
                    </div>
                    <div class="card-body">
                        <form action="xulyuser.php" method="POST" enctype="multipart/form-data">
                            <?php if(isset($_GET['id'])) { ?>
                                <div class="form-group">
                                    <label for="user">Tên đăng nhập</label>
                                    <input id="user" name="user" type="text" class="form-control" value="<?php echo $_GET['id'] ?>" readonly />
                                </div>
                            <?php } else { ?>
                                <div class="form-group">
                                    <label for="user">Tên đăng nhập</label>
                                    <input id="user" name="user" type="text" class="form-control" placeholder="Tên đăng nhập" />
                                </div>
                            <?php } ?>
                            <div class="form-group">
                                <label for="pass">Mật khẩu</label>
                                <input id="pass" name="pass" type="password" class="form-control" placeholder="Mật khẩu" />
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="email" class="form-control" placeholder="Email" />
                            </div>
                            <div class="form-group">
                                <label for="hoten">Họ tên</label>
                                <input id="hoten" name="hoten" type="text" class="form-control" placeholder="Họ tên" />
                            </div>
                            <div class="form-group">
                                <label for="sdt">Số điện thoại</label>
                                <input id="sdt" name="sdt" type="tel" class="form-control" placeholder="Số điện thoại" />
                            </div>
                            <div class="form-group">
                                <label for="dchi">Địa chỉ</label>
                                <input id="dchi" name="dchi" type="text" class="form-control" placeholder="Địa chỉ" />
                            </div>
                            <div class="form-group">
                                <label for="quyen">Chức vụ</label>
                                <select id="quyen" name="quyen" class="form-control">
                                    <option value="">Chọn chức vụ</option>
                                    <option value="admin">Quản trị viên</option>
                                    <option value="user">Người dùng</option>
                                </select>
                            </div>
                            <div class="form-group text-center">
                                <?php if(isset($_GET['id'])) { ?>
                                    <button type="submit" name="sua" class="btn btn-primary">Sửa thông tin</button>
                                <?php } else { ?>
                                    <button type="submit" name="submit" class="btn btn-primary">Thêm người dùng</button>
                                <?php } ?>
                            </div>
                        </form>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>