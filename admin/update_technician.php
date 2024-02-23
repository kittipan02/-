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

// ตรวจสอบว่ามีการส่งค่า request_id และ technician_id ผ่าน POST หรือไม่
if(isset($_POST['request_id']) && isset($_POST['technician_id'])) {
    // รับค่า request_id และ technician_id จากฟอร์ม
    $request_id = $_POST['request_id'];
    $technician_id = $_POST['technician_id'];

    // อัพเดทชื่อช่างซ่อมในฐานข้อมูล
    $sql_update = "UPDATE repair_requests SET technician_id = '$technician_id' WHERE request_id = '$request_id'";

    if ($conn->query($sql_update) === TRUE) {
        header("Location: repair_requests.php");
        exit();
    } else {
        echo "เกิดข้อผิดพลาดในการอัพเดทช่างซ่อม: " . $conn->error;
    }
} else {
    echo "ไม่สามารถเข้าถึงไฟล์นี้โดยตรง";
}

$conn->close();
?>
