<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สรุปการแจ้งซ่อม</title>
    <?php include 'public/layout.php'; ?>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f8f8;
            color: #333;
            text-align: center;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        #chart-container {
            max-width: 600px;
            width: 100%;
            margin-top: 20px;
        }

        canvas {
            width: 100%;
            height: auto;
            max-height: 500px;
        }

        #repairList {
            text-align: left;
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
        }
    </style>
</head>
<body>
    <h2>สรุปการแจ้งซ่อมตามสถานะ</h2>
    <br>
    <canvas id="repairStatusChart"></canvas>

    <?php
    // เชื่อมต่อฐานข้อมูล
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "repair";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL สำหรับรวมข้อมูลตามสถานะ
    $sql = "SELECT rs.rs_name, COUNT(rr.request_id) AS total
            FROM repair_status rs
            LEFT JOIN repair_requests rr ON rs.rs_id = rr.status_id
            GROUP BY rs.rs_name
            ORDER BY rs.rs_id";

    $result = $conn->query($sql);

    $labels = [];
    $data = [];

    while ($row = $result->fetch_assoc()) {
        $labels[] = $row["rs_name"];
        $data[] = $row["total"];
    }
  
    $conn->close();
    ?>

    <div id="repairList"></div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('repairStatusChart').getContext('2d');
        var repairStatusChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    data: <?php echo json_encode($data); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                        'rgba(255, 159, 64, 0.8)',
                    ],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: 'สรุปการแจ้งซ่อมตามสถานะ'
                }
            }
        });
    </script>
</body>
</html>
