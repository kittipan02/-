<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repair Report History</title>
    <script>
        function confirmDelete(requestId) {
            var result = confirm("คุณต้องการลบรายการนี้ใช่หรือไม่?");
            if (result) {
                // ถ้าผู้ใช้ยืนยันการลบ
                window.location = "repair_report_history.php?delete_id=" + requestId;
            }
        }
    </script>
    <?php
    if (isset($_GET['delete_id'])) {
        $deleteId = $_GET['delete_id'];

        // เพิ่มโค้ดสำหรับลบข้อมูลจากฐานข้อมูล
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "repair";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $deleteQuery = "DELETE FROM repair_requests WHERE request_id = $deleteId";

        if ($conn->query($deleteQuery) === TRUE) {
            echo "<script>alert('ลบรายการสำเร็จ');</script>";
            echo "<script>window.location.href = 'repair_report_history.php';</script>";
        } else {
            echo "<script>alert('Error deleting record: " . $conn->error . "');</script>";
        }

        // ปิดการเชื่อมต่อฐานข้อมูล
        $conn->close();
    }
    ?>
    <?php include 'public/layout.php'; ?>
    <style>
        /* เพิ่มสไตล์ตามความต้องการ */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        img.thumbnail {
            max-width: 100px;
            max-height: 100px;
        }

        .delete-button {
            padding: 8px 5px;
            margin-top: 10px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
            text-decoration: none;
            width: 50px;
        }

        .delete-button {
            background-color: #1b02a8;
            color: white;
        }

        .delete-button:hover {
            background-color: #1b02a8;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f8f8;
            color: #333;
        }
        
        form {
            text-align: center;
            margin-top: 20px;
        }
        label, input, input[type="submit"] {
            font-size: 14px;
            margin: 5px;
            padding: 8px;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #1b02a8;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }
        <?php
    // กำหนดสีประจำสถานะ
    $statusColors = array(
        'เสร็จสมบูรณ์' => '#28a745', // สีเขียว
        'รอจำหน่าย' => '#dc3545', // สีแดง
        
    );

    // วนลูปเพื่อกำหนดสีประจำสถานะใน CSS
    foreach ($statusColors as $status => $color) {
        echo "td." . strtolower(str_replace(' ', '-', $status)) . "-status { background-color: $color; }";
    }
    ?>
    </style>
</head>
<body>

    <form method="post" action="repair_report_history.php">
        <label for="search">ค้นหา &nbsp;</label>
        <input type="text" id="search" name="search" placeholder="ป้อนคำที่ต้องการค้นหา">
        <input type="submit" value="ค้นหา">
    </form>

    <h4>ประวัติรายการแจ้งซ่อม</h4>
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

    $search = isset($_POST["search"]) ? $_POST["search"] : "";
    $sql = "SELECT rr.request_id, rr.request_date, dp.dp_name, CONCAT(u.u_fname, ' ', u.u_lname) AS user_name, rr.contact_number, et.et_name, rr.item, rr.equipment_number, rr.repair_details, rr.image_url, rr.user_id, b.brand_name, rs.rs_name AS status_name , CONCAT(t.u_fname, ' ', t.u_lname) AS technician_name
    FROM repair_requests rr
    JOIN department dp ON rr.department_id = dp.dp_id
    JOIN users u ON rr.user_id = u.u_id
    JOIN equipment_type et ON rr.equipment_type_id = et.et_id
    LEFT JOIN brand b ON rr.brand_id = b.brand_id
    LEFT JOIN repair_status rs ON rr.status_id = rs.rs_id
    LEFT JOIN users t ON rr.technician_id = t.u_id
    WHERE (rs.rs_name = 'เสร็จสมบูรณ์') AND (rr.equipment_number LIKE '%$search%' OR rr.item LIKE '%$search%' OR dp.dp_name LIKE '%$search%' OR u.u_fname LIKE '%$search%' OR u.u_lname LIKE '%$search%' OR et.et_name LIKE '%$search%' OR b.brand_name LIKE '%$search%' OR rr.repair_details LIKE '%$search%')
    ORDER BY rr.request_id DESC";


    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ครั้งที่</th><th>วันที่</th><th>แผนก</th><th>ผู้ใช้</th><th>เบอร์ติดต่อ</th><th>หมายเลขอุปกรณ์</th><th>ประเภทอุปกรณ์</th><th>รายการ</th><th>ยี่ห้อ</th><th>รายละเอียดการซ่อม</th><th>รูป</th><th>สถานะแจ้งซ่อม</th><th>ช่างผู้รับผิดชอบ</th><th>Action</th></tr>";
        $count = 1;

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $count . "</td>";
            echo "<td><center>" . $row["request_date"] . "</td>";
            echo "<td><center>" . $row["dp_name"] . "</td>";
            echo "<td><center>" . $row["user_name"] . "</td>";
            echo "<td><center>" . $row["contact_number"] . "</td>";
            echo "<td><center>" . $row["equipment_number"] . "</td>";
            echo "<td><center>" . $row["et_name"] . "</td>";
            echo "<td><center>" . $row["item"] . "</td>";
            echo "<td><center>" . $row["brand_name"] . "</td>";
            echo "<td><center>" . $row["repair_details"] . "</td>";

            // ตรวจสอบว่ามี URL รูปภาพหรือไม่
            if (!empty($row["image_url"])) {
                echo "<td><img src='{$row['image_url']}' alt='Equipment Image' class='thumbnail'></td>";
            } else {
                echo "<td>No Image</td>";
            }


            echo "<td class='" . strtolower(str_replace(' ', '-', $row["status_name"])) . "-status'>";
            echo "<center>" . htmlspecialchars($row["status_name"]) . "</center>";
            echo "</td>";

            echo "<td><center>";
            echo htmlspecialchars($row["technician_name"]); // แสดงชื่อช่างซ่อม

            echo "<td><center>";
            echo "<button type='button' class='delete-button' onclick='confirmDelete(" . $row["request_id"] . ")' style='background-color: #ff0000; color: #ffffff;'>ลบ</button>";
            echo "</td>";
            echo "</tr>";
            $count++;
        }

        echo "</table>";
    } else {
        echo "ไม่พบข้อมูล";
    }

    $conn->close();
    ?>
</body>
</html>
