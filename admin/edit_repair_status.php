<?php
// edit_repair_status.php

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    // เชื่อมต่อฐานข้อมูล
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "repair";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // ตรวจสอบการเชื่อมต่อ
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // รับค่า rs_id จาก parameter ของ URL
    $rs_id = mysqli_real_escape_string($conn, $_GET["id"]);

    // ดึงข้อมูลจากฐานข้อมูล
    $sql = "SELECT * FROM repair_status WHERE rs_id = '$rs_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $rs_name = $row["rs_name"];
    } else {
        echo "ไม่พบข้อมูลสถานะที่ต้องการแก้ไข";
        exit();
    }

    // ปิดการเชื่อมต่อ
    $conn->close();
} else {
    // ถ้าไม่มี rs_id ใน parameter หรือไม่ได้กำหนดค่า rs_id
    echo "ไม่ได้กำหนดสถานะที่ต้องการแก้ไข";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Repair Status</title>
    <?php include 'public/layout.php'; ?>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f8f8;
        }

        form {
            text-align: center;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: 0 auto;
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
    </style>
</head>
<body>
<center><h4>แก้ไขสถานะ</h4></center>
    <form method="post" action="process_edit_status.php">
        <input type="hidden" name="rs_id" value="<?php echo $rs_id; ?>">
        <label for="rs_name">ชื่อสถานะ:</label>
        <input type="text" id="rs_name" name="rs_name" value="<?php echo $rs_name; ?>" required>
        <br>
        <input type="submit" value="บันทึกการแก้ไข">
    </form>

</body>
</html>
