<?php
 include('../config/db.php');
  // Thực hiện truy vấn lấy số lượng đơn hàng theo tháng
  $result = mysqli_query($link, "SELECT MONTH(Ngay) AS month, COUNT(*) AS total_orders FROM donhang GROUP BY MONTH(Ngay)");
  if (!$result) {
    die("Query failed: " . mysqli_error($link));
  }
  //thống kê đơn hàng thành công
  $result2 = mysqli_query($link, "SELECT MONTH(Ngay) AS month, COUNT(*) AS total_orders FROM donhang WHERE TrangThai = 4 GROUP BY MONTH(Ngay)");
  if (!$result2) {
    die("Query failed: " . mysqli_error($link));
  }
  // Tạo một mảng để lưu trữ kết quả truy vấn
  $data = array();
  $data2 = array();


  // Chuyển đổi kết quả truy vấn thành một mảng các giá trị tương ứng với các tháng
  while ($row = mysqli_fetch_assoc($result)) {
    $data[$row['month']] = $row['total_orders'];
  }
  while ($row = mysqli_fetch_assoc($result2)) {
    $data2[$row['month']] = $row['total_orders'];
  }

  // Chuyển đổi mảng thành chuỗi JSON
  $json_data = json_encode($data);
  $json_data2 = json_encode($data2);
?>

<canvas id="myChart"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
var data = <?php echo $json_data; ?>;
var data2 = <?php echo $json_data2; ?>;

var ctx = document.getElementById('myChart').getContext('2d');
var ctx2 = document.getElementById('myChart2').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: Object.keys(data),
        datasets: [{
            label: 'Thống kê tổng đơn hàng',
            data: Object.values(data) ,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
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
var myChart2 = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels: Object.keys(data2),
        datasets: [{
            label: 'Thống kê tổng đơn hàng',
            data: Object.values(data2) ,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
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
</script>

