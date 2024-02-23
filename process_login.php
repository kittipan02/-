<?php
session_start();

// รวมรหัสการเชื่อมต่อฐานข้อมูลที่นี่
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repair";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับข้อมูลจากฟอร์ม
    $u_email = $_POST["u_email"];
    $u_password = $_POST["u_password"];

    // ตรวจสอบรูปแบบของอีเมล
    if (!filter_var($u_email, FILTER_VALIDATE_EMAIL)) {
        echo "รูปแบบอีเมลไม่ถูกต้อง";
        // จัดการเพิ่มเติม เช่น การ redirect กลับไปที่ฟอร์มล็อกอิน
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

    $stmt = $conn->prepare("SELECT u_id, u_email, u_fname, u_lname, u_password FROM users WHERE u_email = ?");
    $stmt->bind_param("s", $u_email);
    $stmt->execute();

    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($u_id, $u_email, $u_fname, $u_lname, $hashed_password);
        $stmt->fetch();
        
        $_SESSION["u_id"] = $u_id;
        $_SESSION["email"] = $u_email;
        $_SESSION["fullname"] = $u_fname . ' ' . $u_lname;        
        
        if (password_verify($u_password, $hashed_password)) {
            // ตรวจสอบประเภทผู้ใช้
            $stmt = $conn->prepare("SELECT u_type FROM users WHERE u_id = ?");
            $stmt->bind_param("i", $u_id);
            $stmt->execute();
            $stmt->bind_result($u_type);
            $stmt->fetch();
            $stmt->close();
            $conn->close();
            // กระโดดไปยังหน้าที่เหมาะสมขึ้นอยู่กับประเภทผู้ใช้
            if ($u_type === 'แอดมิน') {
                header("Location: admin/admin_dashboard.php");
                exit;
            } elseif ($u_type === 'ช่าง') {
                header("Location: technician/technician_dashboard.php");
                exit;
            } elseif ($u_type === 'ผู้ใช้') {
                header("Location: user/user_dashboard.php");
                exit;
            } else {
                // กรณีอื่น ๆ สามารถเพิ่มเส้นทางไปที่หน้าที่เหมาะสมได้ตามต้องการ
                echo "ล็อกอินสำเร็จ! ยินดีต้อนรับ, $u_email!";
            }
        } else {
            echo "รหัสผ่านไม่ถูกต้อง โปรดลองอีกครั้ง";
        }
    } else {
        echo "ไม่พบผู้ใช้งาน โปรดตรวจสอบอีเมลของคุณและลองอีกครั้ง";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "วิธีร้องขอไม่ถูกต้อง โปรดใช้ POST.";
}
?>
