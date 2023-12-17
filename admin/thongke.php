<?php
error_reporting(E_ALL);
// Lấy dữ liệu lọc từ form
$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';
$type = isset($_POST['type']) ? $_POST['type'] : '';

include('../config/db.php');

if ($link->connect_error) {
    die("Kết nối thất bại: " . $link->connect_error);
}


   if($type = "4"){
    $data = [
        ['order_month' => '2023-01', 'total_orders' => 10],
        ['order_month' => '2023-02', 'total_orders' => 15],
        ['order_month' => '2023-03', 'total_orders' => 8],
        ['order_month' => '2023-04', 'total_orders' => 12],
        ['order_month' => '2023-06', 'total_orders' => 25],
        ['order_month' => '2023-07', 'total_orders' => 22],
        ['order_month' => '2023-08', 'total_orders' => 21],
        ['order_month' => '2023-09', 'total_orders' => 30],
        ['order_month' => '2023-10', 'total_orders' => 20],
        ['order_month' => '2023-11', 'total_orders' => 10],
        ['order_month' => '2023-12', 'total_orders' => 2]
    ];
   }
 
 
// $query .= " GROUP BY order_month"; 

// $result = $link->query($query);

// Kiểm tra nếu truy vấn thất bại
// if ($result === false) {
//     die("Lỗi truy vấn SQL: " . $link->error);
// }

// // Chuyển đổi kết quả thành mảng JSON
// $data = [];
// while ($row = $result->fetch_assoc()) {
//     $data[] = $row;
// }


?>

<script>
// Chuyển đổi dữ liệu PHP thành JSON
var chartData = <?php echo json_encode($data); ?>;
</script>
<canvas id="filteredOrdersChart"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Sử dụng Chart.js để vẽ biểu đồ
document.getElementById('filterForm').addEventListener('submit', function (event) {
    event.preventDefault(); // Ngăn chặn hành động mặc định của form (chuyển hướng)
    var ctx = document.getElementById('filteredOrdersChart').getContext('2d');

    var chart = new Chart(ctx, {
        type: 'bar', // Thay đổi type thành 'bar'
        data: {
            labels: chartData.map(data => data.order_month),
            datasets: [{
                label: 'Số đơn hàng',
                data: chartData.map(data => data.total_orders),
                backgroundColor: '#234E70',
                borderColor: '#FBF8BE',
                borderWidth: 5
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>