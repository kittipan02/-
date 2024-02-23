<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repair";

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// รับข้อมูลจากฟอร์ม
$mt_tm_id = $_POST['mt_tm_id'];
$mt_dm_id = $_POST['mt_dm_id'];
$mt_name = $_POST['mt_name'];

// เขียน SQL query สำหรับเพิ่มข้อมูล
$sql = "INSERT INTO material (mt_id, mt_tm_id, mt_dm_id, mt_name) 
        VALUES ('','$mt_tm_id', '$mt_dm_id', '$mt_name')";
// ทำการ query เพื่อเพิ่มข้อมูล
if ($conn->query($sql) === TRUE) {
    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn->close();

    // หลังจากที่ข้อมูลถูกเพิ่มเรียบร้อย ทำการ redirect
    header("Location: http://localhost/repair/admin/material_types.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    // หากเกิดข้อผิดพลาด, คุณสามารถเพิ่มการจัดการผลลัพธ์ที่นี่ตามที่ต้องการ
}

?>