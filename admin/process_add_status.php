<?php
// process_add_status.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // รับค่าจากฟอร์ม
    $rs_name = mysqli_real_escape_string($conn, $_POST["rs_name"]);

    // เพิ่มข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO repair_status (rs_name) VALUES ('$rs_name')";

    if ($conn->query($sql) === TRUE) {
        // เมื่อเพิ่มข้อมูลสำเร็จ
        header("Location: repair_status.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // ปิดการเชื่อมต่อ
    $conn->close();
}
?>
