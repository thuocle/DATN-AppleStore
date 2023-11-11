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
                        <h3 class="card-title"><?php echo isset($_GET['id']) ? 'Sửa loại sản phẩm' : 'Thêm loại sản phẩm' ?></h3>
                    </div>
                    <div class="card-body">
                        <form action="xulyloaisp.php" method="POST" enctype="multipart/form-data">
                            <?php if(isset($_GET['id'])) { ?>
                                <div class="form-group">
                                    <label for="maloaisp">Mã loại sản phẩm</label>
                                    <input id="maloaisp" name="maloaisp" type="text" class="form-control" value="<?php echo $_GET['id'] ?>" readonly />
                                </div>
                            <?php } ?>
                            <div class="form-group">
                                <label for="tenloaisp">Tên loại sản phẩm</label>
                                <input id="tenloaisp" name="tenloaisp" type="text" class="form-control" placeholder="Tên loại sản phẩm" />
                            </div>
                            <div class="form-group">
                                <label for="gt">Giới thiệu</label>
                                <textarea id="gt" name="gt" class="form-control" placeholder="Giới thiệu"></textarea>
                            </div>
                            <div class="form-group text-center">
                                <?php if(isset($_GET['id'])) { ?>
                                    <button type="submit" name="sua" class="btn btn-primary">Sửa loại sản phẩm</button>
                                <?php } else { ?>
                                    <button type="submit" name="submit" class="btn btn-primary">Thêm loại sản phẩm</button>
                                <?php } ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>