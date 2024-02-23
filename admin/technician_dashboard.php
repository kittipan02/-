<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technician Dashboard</title>
    <?php include 'public/layout.php'; ?>
    <style>
        /* CSS สำหรับหน้าช่างซ่อม */

        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f8f8;
            color: #333;
        }

        .technician-dashboard-container {
            max-width: 1200px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .work-orders-section {
            margin-top: 20px;
        }

        .work-orders-section h3 {
            color: #1b02a8;
        }

        /* Example styling for work orders section */
        .work-orders-section {
            display: flex;
            flex-wrap: wrap;
        }

        .work-order-item {
            flex: 1;
            text-align: center;
            padding: 10px;
            background-color: #e6e6e6;
            border-radius: 8px;
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .work-order-item img {
            max-width: 50px;
            max-height: 50px;
            margin-bottom: 10px;
        }

        /* Responsive layout */
        @media (max-width: 768px) {
            .technician-dashboard-container {
                padding: 10px;
            }

            .work-orders-section {
                flex-direction: column;
            }

            .work-order-item {
                margin-right: 0;
            }
        }
    </style>
</head>
<body>
    <div class="technician-dashboard-container">
        <!-- ตัวอย่าง: รายการงานซ่อมที่กำลังดำเนินการ -->
        <div class="work-orders-section">
            <h3>งานซ่อมที่กำลังดำเนินการ</h3>
            <!-- เพิ่มส่วนของรายการงานซ่อมที่ต้องการแสดง -->
        </div>
    </div>
</body>
</html>
