<?php
// การเชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repair";

$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตรวจสอบว่ามีการส่งข้อมูลมาหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $mt_id = $_GET['id'];

    // ทำการลบข้อมูลจากตาราง material_types
    $delete_material_query = "DELETE FROM material WHERE mt_id = $mt_id";
    
    if ($conn->query($delete_material_query)) {
        // ปิดการเชื่อมต่อ
        $conn->close();

        // หลังจากลบข้อมูลเรียบร้อย ทำการ redirect
        header("Location: http://localhost/repair/admin/material_types.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// ปิดการเชื่อมต่อ
$conn->close();
?>