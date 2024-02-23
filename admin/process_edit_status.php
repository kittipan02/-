<?php
// process_edit_status.php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["rs_id"])) {
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

    // รับค่าที่ส่งมาจากฟอร์ม
    $rs_id = mysqli_real_escape_string($conn, $_POST["rs_id"]);
    $rs_name = mysqli_real_escape_string($conn, $_POST["rs_name"]);

    // สร้างคำสั่ง SQL เพื่อปรับปรุงข้อมูล
    $sql = "UPDATE repair_status SET rs_name = '$rs_name' WHERE rs_id = '$rs_id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: http://localhost/repair/repair_status.php");
        exit();
    } else {
        // หากเกิดข้อผิดพลาดในการปรับปรุงข้อมูล
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // ปิดการเชื่อมต่อ
    $conn->close();
} else {
    // ถ้าไม่มีข้อมูลที่ส่งมาจากฟอร์มหรือไม่ได้กำหนดค่า rs_id
    echo "ไม่สามารถทำรายการได้";
}
?>
