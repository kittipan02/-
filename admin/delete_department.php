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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteBtn'])) {
    $dp_id = $_POST['id'];

    // ลบข้อมูลจากตาราง responsible_person
    $delete_responsible_person_query = "DELETE FROM responsible_person WHERE rp_dp_id = '$dp_id'";
    if (!$conn->query($delete_responsible_person_query)) {
        echo "Error deleting responsible person: " . $conn->error;
    }

    // ลบข้อมูลจากตาราง department_head
    $delete_department_head_query = "DELETE FROM department_head WHERE dh_dp_id = '$dp_id'";
    if (!$conn->query($delete_department_head_query)) {
        echo "Error deleting department head: " . $conn->error;
    }

    // ลบข้อมูลจากตาราง department
    $delete_department_query = "DELETE FROM department WHERE dp_id = '$dp_id'";
    if ($conn->query($delete_department_query)) {
        echo "ลบแผนกและข้อมูลที่เกี่ยวข้องสำเร็จ";
    } else {
        echo "Error deleting department: " . $conn->error;
    }
}

// ปิดการเชื่อมต่อ
$conn->close();
?>
