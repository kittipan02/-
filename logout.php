<?php
// เริ่ม session
session_start();

// ทำลาย session ทั้งหมด
session_destroy();

// ส่งกลับไปยังหน้า login (หรือหน้าที่ต้องการให้ล็อกเอาท์)
header("Location: login.php");
exit;
?>
