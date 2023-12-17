<?php
error_reporting(E_ALL);
// Lấy dữ liệu lọc từ form
$start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
$end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';
$type = isset($_POST['type']) ? $_POST['type'] : '';




    $data = [
        ['order_month' => '2023-01', 'total_orders' => 150.5],
        ['order_month' => '2023-02', 'total_orders' => 100.75],
        ['order_month' => '2023-03', 'total_orders' => 80.5],
        ['order_month' => '2023-04', 'total_orders' => 120.75],
        ['order_month' => '2023-06', 'total_orders' => 250.5],
        ['order_month' => '2023-07', 'total_orders' => 220.75],
        ['order_month' => '2023-08', 'total_orders' => 210.5],
        ['order_month' => '2023-09', 'total_orders' => 300.5],
        ['order_month' => '2023-10', 'total_orders' => 200.5],
        ['order_month' => '2023-11', 'total_orders' => 100.75],
        ['order_month' => '2023-12', 'total_orders' => 20.5]
    ];

?>

<script>
    // Chuyển đổi dữ liệu PHP thành JSON
    var chartData2 = <?php echo json_encode($data); ?>;
</script>
<canvas id="filteredOrdersChart2"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Sử dụng Chart.js để vẽ biểu đồ
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('filteredOrdersChart2').getContext('2d');

        var chart = new Chart(ctx, {
            type: 'doughnut', // Thay đổi type thành 'doughnut' cho biểu đồ tròn
            data: {
                labels: chartData2.map(data => data.order_month),
                datasets: [{
                    label: 'Triệu đồng',
                    data: chartData2.map(data => data.total_orders),
                    backgroundColor: [
                        '#C7395F',
                        '#E74C3C',
                        '#3498DB',
                        '#2ECC71',
                        '#F1C40F',
                        '#9B59B6',
                        '#1ABC9C',
                        '#34495E',
                        '#D35400',
                        '#7F8C8D',
                        '#F39C12'
                    ],
                    borderColor: '#FBF8BE',
                    borderWidth: 5
                }]
            },
            options: {
                // Sửa các tùy chọn cho biểu đồ tròn nếu cần thiết
            }
        });
    });
</script>
