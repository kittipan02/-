<?php
// รวมรหัสการเชื่อมต่อฐานข้อมูลที่นี่
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repair";

// ตรวจสอบการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

// ตรวจสอบว่าได้รับค่าไอดีที่ต้องการลบมาจากการร้องขอหรือไม่
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // สร้างคำสั่ง SQL สำหรับลบข้อมูล
    $sql = "DELETE FROM users WHERE u_id = $user_id";

    // ทำการลบข้อมูล
    if ($conn->query($sql) === TRUE) {
        echo "ลบข้อมูลผู้ใช้เรียบร้อยแล้ว";
    } else {
        echo "การลบข้อมูลผู้ใช้ล้มเหลว: " . $conn->error;
    }
} else {
    echo "ไม่ได้ระบุรหัสผู้ใช้ที่ต้องการลบ";
}

// ปิดการเชื่อมต่อ
$conn->close();
?>
