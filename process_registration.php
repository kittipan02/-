<?php
session_start();

// Include database connection code here
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repair";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับข้อมูลจากฟอร์ม
    $u_fname = $_POST["u_fname"];
    $u_lname = $_POST["u_lname"];
    $u_email = $_POST["u_email"];
    $u_password = $_POST["u_password"];
    $u_status = $_POST["u_status"];
    $u_type = $_POST["u_type"];
    $u_dp_id = $_POST["u_dp_id"];

    // ตรวจสอบรูปแบบของอีเมล
    if (!filter_var($u_email, FILTER_VALIDATE_EMAIL)) {
        echo "รูปแบบอีเมลไม่ถูกต้อง";
        exit;
    }

    // ตรวจสอบความยาวของรหัสผ่าน (เพิ่มเงื่อนไขตามความต้องการ)
    if (strlen($u_password) < 6) {
        echo "รหัสผ่านต้องมีอย่างน้อย 6 ตัว <a href=\"register.php\"><i class=\"fa-solid fa-arrow-right-to-bracket\"></i> ไปที่register</a>";
        exit;
    }

    // ทำความสะอาดข้อมูล
    $u_email = htmlspecialchars($u_email);

    // ตรวจสอบว่าอีเมลมีอยู่ในตาราง 'users' หรือไม่
    $conn = new mysqli($servername, $username, $password, $dbname);

    // ตรวจสอบการเชื่อมต่อ
    if ($conn->connect_error) {
        die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
    }

    // Query เพื่อตรวจสอบว่ามีอีเมลที่ซ้ำหรือไม่
    $check_duplicate_sql = "SELECT u_id FROM users WHERE u_email = ?";
    $check_stmt = $conn->prepare($check_duplicate_sql);
    $check_stmt->bind_param("s", $u_email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        echo "อีเมลนี้ถูกใช้งานแล้ว";
        exit;
    }

    $check_stmt->close();

    // Query สำหรับเพิ่มผู้ใช้ในกรณีที่ไม่มีอีเมลซ้ำ
    $insert_sql = "INSERT INTO users (u_fname, u_lname, u_email, u_password, u_status, u_type, u_dp_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_sql);
    $hashed_password = password_hash($u_password, PASSWORD_DEFAULT);
    $stmt->bind_param("ssssssi", $u_fname, $u_lname, $u_email, $hashed_password, $u_status, $u_type, $u_dp_id);
    $stmt->execute();

    echo "ลงทะเบียนสำเร็จ! <a href=\"login.php\"><i class=\"fa-solid fa-arrow-right-to-bracket\"></i> ไปที่login</a>";
   

    $stmt->close();
    $conn->close();
} else {
    echo "วิธีร้องขอไม่ถูกต้อง โปรดใช้ POST.";
}
?>
