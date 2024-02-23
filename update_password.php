<?php
// ตรวจสอบว่ามีข้อมูลที่ถูกส่งมาจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // เชื่อมต่อกับฐานข้อมูล (กรุณาแทนที่ชื่อ host, ชื่อผู้ใช้, รหัสผ่าน, และชื่อฐานข้อมูลตามการตั้งค่าของคุณ)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "repair";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // ดึงค่าที่ถูกส่งมาจากฟอร์ม
    $email = $_POST['email'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    // สร้างคำสั่ง SQL เพื่ออัปเดตรหัสผ่านสำหรับอีเมลที่กำหนด
    $sql = "UPDATE `users` SET `u_password` = '$new_password' WHERE `u_email` = '$email'";

    if ($conn->query($sql) === TRUE) {
        echo "รหัสผ่านถูกอัปเดตเรียบร้อยแล้ว";
        header("Location: login.php");
    } else {
        echo "มีข้อผิดพลาดในการอัปเดตรหัสผ่าน: " . $conn->error;
    }

    // ปิดการเชื่อมต่อกับฐานข้อมูล
    $conn->close();
}
?>
