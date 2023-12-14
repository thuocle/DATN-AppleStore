<!DOCTYPE html>
<html lang="en">
    <head>
    <?php include("../admin/assets/title.php");?>
    
    </head>
    <body class="sb-nav-fixed">
    <?php include("../admin/assets/header.php");?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                           
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Area Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        <?php include("../admin/assets/demo/chart-bar.php");?>
                                        Thống kê đơn hàng theo tháng
                                    </div>
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        <?php include("../admin/assets/demo/chart-bar.php");?>
                                        Thống kê doanh thu theo tháng
                                    </div>
                                    <!-- <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div> -->
                                </div>
                            </div>
                    </div>
                </main>
                
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <!-- <script src="assets/demo/chart-bar-demo.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
