<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Repair</title>
    <!-- Include your CSS and any other necessary files -->
    <?php include 'public/layout.php'; ?>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #1b02a8;
        }

        .repair-details {
            margin-top: 20px;
        }

        .repair-details p {
            margin: 10px 0;
        }
        img {
    max-width: 100%;
    height: auto;
    margin-top: 10px;
}

        form {
            margin-top: 20px;
            text-align: center;
        }

        label {
            font-weight: bold;
        }

        select,
        input[type="submit"] {
            font-size: 14px;
            margin: 5px;
            padding: 8px;
            border-radius: 4px;
        }

        select {
            width: 150px;
        }

        input[type="submit"] {
            background-color: #1b02a8;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #1854a3;
        }

        .check-again-button {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 5px;
        }

        .check-again-button:hover {
            background-color: #45a049;
        }
        .edit-button, .delete-button {
            padding: 8px 10px;
            margin-top: 10px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
            text-decoration: none;
            width: 150px;
        }
        .edit-button {
            background-color: #1b02a8;
            color: white;
        }

        .edit-button:hover {
            background-color: #1854a3;
        }

        .delete-button {
            background-color: #dc3545;
            color: white;
        }

        .delete-button:hover {
            background-color: #bd2130;
        }
        .check-status-button {
        background-color: #4CAF50;
        color: white;
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 10px;
    }

    .check-status-button:hover {
        background-color: #45a049;
    }
    </style>
</head>

<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repair";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$request_id = isset($_GET["id"]) ? $_GET["id"] : null;

if ($request_id !== null && !empty($request_id)) {
    // ทำการ query ข้อมูลรายการแจ้งซ่อมที่มี request_id ตรงกับที่ระบุ
    $sql = "SELECT rr.request_id, rr.request_date, dp.dp_name, CONCAT(u.u_fname, ' ', u.u_lname) AS user_name, rr.contact_number, et.et_name, rr.item, rr.equipment_number, rr.repair_details, rr.image_url, rr.user_id, b.brand_name
            FROM repair_requests rr
            JOIN department dp ON rr.department_id = dp.dp_id
            JOIN users u ON rr.user_id = u.u_id
            JOIN equipment_type et ON rr.equipment_type_id = et.et_id
            LEFT JOIN brand b ON rr.brand_id = b.brand_id
            WHERE rr.request_id = $request_id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // แสดงข้อมูลรายการแจ้งซ่อม
            
            echo "<div class='container'>";
            echo "<button class='back-link' onclick='window.history.back()'>กลับ</button>";
            echo "<h2>รายละเอียดการแจ้งซ่อม</h2>"; echo "<img src='{$row['image_url']}' alt='Equipment Image' style='max-width: 30%; height: auto; margin-top: 10px;  float: right;'>";
            echo "<div class='repair-details'>";
            echo "<p><strong>วันที่:</strong> {$row['request_date']}</p>";
            echo "<p><strong>แผนก:</strong> {$row['dp_name']}</p>";
            echo "<p><strong>ผู้ใช้:</strong> {$row['user_name']}</p>";
            echo "<p><strong>เบอร์ติดต่อ:</strong> {$row['contact_number']}</p>";
            echo "<p><strong>หมายเลขอุปกรณ์:</strong> {$row['equipment_number']}</p>";
            echo "<p><strong>ประเภทอุปกรณ์:</strong> {$row['et_name']}</p>";
            echo "<p><strong>รายการ:</strong> {$row['item']}</p>";
            echo "<p><strong>ยี่ห้อ:</strong> {$row['brand_name']}</p>";
            echo "<p><strong>รายละเอียดการซ่อม:</strong> {$row['repair_details']}</p>";

            echo "<td>";
        echo "<a href='edit_repair.php?id=" . $row["request_id"] . "'><button type='button' class='edit-button'>แก้ไข</button></a>";
        echo "</td>";
        echo "&nbsp;";
        echo "<td>";
        echo "<a href='delete_repair.php?id=" . $row["request_id"] . "' onclick='return confirmDelete();'><button type='button' class='delete-button'>ลบ</button></a>";
        echo "</td>";

       
        echo "&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;<td>";
        echo "<td>";
        $equipmentNumber = $row["equipment_number"];
        echo "<a href='check_status_page.php?et_number=$equipmentNumber'><button type='button' class='check-status-button'>ตรวจสอบรายการ</button></a>";
echo "</td>";
        echo "</td>";

        

            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "ไม่พบรายการที่ต้องการ";
    }
} else {
    echo "รายการไม่ถูกต้อง";
}

$conn->close();
?>
