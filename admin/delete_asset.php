<?php
// เชื่อมต่อกับฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repair";

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตรวจสอบว่ามีการส่งค่า ID มาหรือไม่
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // รับค่า ID จาก URL
    $parcel_id = $_GET['id'];

    // คำสั่ง SQL สำหรับลบรายการตาม ID ที่ระบุ
    $sql = "DELETE FROM equipment_parcels WHERE parcel_id = $parcel_id";

    if ($conn->query($sql) === TRUE) {
        echo "ลบรายการสำเร็จ";
        header("Location: display_assets.php");
    } else {
        echo "เกิดข้อผิดพลาดในการลบรายการ: " . $conn->error;
    }
} else {
    echo "ไม่พบ ID ที่ต้องการลบ";
}

// ปิดการเชื่อมต่อกับฐานข้อมูล
$conn->close();
?>
