<?php
// เชื่อมต่อกับฐานข้อมูล
$conn = new mysqli("localhost", "root", "", "repair");

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ดึงข้อมูลจากฐานข้อมูล
$equipmentNumber = $_GET['equipment_number'];

$sql = "SELECT et_id, it_name, brand_name FROM equipment_type 
        WHERE equipment_type.et_number = '$equipmentNumber'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // แปลงข้อมูลเป็นรูปแบบ JSON
    $row = $result->fetch_assoc();
    $data = array(
        'et_id' => $row['et_id'],
        'it_name' => $row['it_name'],
        'brand_name' => $row['brand_name']
    );
    echo json_encode($data);
} else {
    echo json_encode(array());
}

// ปิดการเชื่อมต่อ
$conn->close();
?>
