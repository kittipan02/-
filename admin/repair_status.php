<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ส่วนหัวเว็บเพจ -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repair Status</title>
    <?php include 'public/layout.php'; ?>
    <style>
        /* สไตล์เดิมของคุณ */

        table {
            width: 50%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-left: auto;
            margin-right: auto;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #1b02a8;
            color: white;
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

        input[type="submit"]:hover {
            background-color: #fff;
            color: #1b02a8;
        }

        .edit-button, .delete-button {
            padding: 5px 10px;
            margin: 5px;
            text-decoration: none;
            color: #fff;
            border-radius: 3px;
            display: inline-block;
        }

        .edit-button {
            background-color: #1b02a8; /* สีน้ำเงิน */
        }

        .delete-button {
            background-color: #dc3545; /* สีแดง */
        }
        <?php
    // กำหนดสีประจำสถานะ
    $statusColors = array(
        'กำลังดำเนินการ' => '#007bff', // สีฟ้า
        'รอการอนุมัติ' => '#ffc107', // สีเหลือง
        'เสร็จสมบูรณ์' => '#28a745', // สีเขียว
        'รอจำหน่าย' => '#dc3545', // สีแดง
        'รออะไหล่' => '#fd7e14', // สีส้ม
        'จำหน่ายเสร้จสิ้น' => '#FFFF00' // สีส้ม
        // สามารถเพิ่มสถานะและสีที่ต้องการเพิ่มเติมได้ตามต้องการ
    );

    // วนลูปเพื่อกำหนดสีประจำสถานะใน CSS
    foreach ($statusColors as $status => $color) {
        echo "td." . strtolower(str_replace(' ', '-', $status)) . "-status { background-color: $color; }";
    }
    ?>
    </style>
</head>

<body>

    <!-- แบบฟอร์มค้นหา -->
    <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="search">ค้นหา &nbsp;</label>
        <input type="text" id="search" name="search" placeholder="ป้อนคำค้นหา" value="<?php echo isset($search) ? $search : ''; ?>">
        <input type="submit" value="ค้นหา">
    </form>

    <!-- ปุ่มเพิ่มสถานะ -->
    <a href="add_repair_status.php">
        <button type="button" style="background-color: #1b02a8; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s;">
            เพิ่มสถานะ
        </button>
    </a>

    <?php
    // โค้ดเชื่อมต่อฐานข้อมูล
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "repair";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // ตรวจสอบการเชื่อมต่อ
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // ตรวจสอบการค้นหา
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["search"])) {
        $search = mysqli_real_escape_string($conn, $_GET["search"]);
        $searchSql = "SELECT * FROM repair_status WHERE rs_name LIKE '%$search%'";
        $searchResult = $conn->query($searchSql);

        // แสดงผลลัพธ์ค้นหา
        if ($searchResult->num_rows > 0) {
            echo "<table>";
            echo "<tr><center><th>No.</th><th>สถานะ</th><th>แก้ไข</th><th>ลบ</th></tr>";
            while ($row = $searchResult->fetch_assoc()) {
                $statusId = $row["rs_id"];
                $statusName = $row["rs_name"];
                echo "<tr><td>" . $statusId . "</td><td class='" . strtolower(str_replace(' ', '-', $statusName)) . "-status'>" . $statusName . "</td>";
                echo "<td><center><a href='edit_repair_status.php?id=$statusId' class='edit-button'>แก้ไข</a></td>";
                echo "<td><a href='delete_repair_status.php?id=$statusId' class='delete-button'>ลบ</a></td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p>ไม่พบผลลัพธ์สำหรับคำค้นหา: '$search'</p>";
        }
    } else {
        // แสดงข้อมูลทั้งหมดถ้าไม่มีการค้นหา
        $statusSql = "SELECT * FROM repair_status";
        $statusResult = $conn->query($statusSql);

        // แสดงข้อมูลทั้งหมด
        if ($statusResult->num_rows > 0) {
            echo "<table>";
            echo "<tr><center><th>No.</th><th>สถานะ</th><th>แก้ไข</th><th>ลบ</th></tr>";
            while ($row = $statusResult->fetch_assoc()) {
                $statusId = $row["rs_id"];
                $statusName = $row["rs_name"];
                echo "<tr><td><center>" . $statusId . "</td><td class='" . strtolower(str_replace(' ', '-', $statusName)) . "-status'>" . $statusName . "</td>";
                echo "<td><a href='edit_repair_status.php?id=$statusId' class='edit-button'>แก้ไข</a></td>";
                echo "<td><a href='delete_repair_status.php?id=$statusId' class='delete-button'>ลบ</a></td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p>ไม่พบข้อมูลสถานะ</p>";
        }
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn->close();
    ?>

</body>

</html>
