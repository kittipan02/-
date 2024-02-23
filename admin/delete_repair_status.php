<?php
// delete_repair_status.php

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

    // สร้างคำสั่ง SQL สำหรับลบข้อมูล
    $sql = "DELETE FROM repair_status WHERE rs_id = '$rs_id'";

    // ทำการลบข้อมูล
    if ($conn->query($sql) === TRUE) {
        header("Location: repair_status.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // ปิดการเชื่อมต่อ
    $conn->close();
} else {
    // ถ้าไม่มี rs_id ใน parameter หรือไม่ได้กำหนดค่า rs_id
    echo "ไม่ได้กำหนดสถานะที่ต้องการลบ";
}
?>
