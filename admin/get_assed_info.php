<?php
// เชื่อมต่อกับฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repair";
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// รับค่าหมายเลขอุปกรณ์จาก URL
if(isset($_GET['ep_et_number']) && !empty($_GET['ep_et_number'])) {
    $ep_et_number = $_GET['ep_et_number'];

    // คำสั่ง SQL สำหรับดึงข้อมูล
    $sql = "SELECT et.*, n.un_name
            FROM equipment_type et
            LEFT JOIN unit n ON et.un_id = n.un_id
            WHERE et.et_number = ?"; 

    // เตรียมคำสั่ง SQL พร้อมสำหรับการเตรียมคำสั่ง
    $stmt = $conn->prepare($sql);

    // Bind parameter
    $stmt->bind_param("s", $ep_et_number);

    // Execute statement
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    // ตรวจสอบว่ามีข้อมูลหรือไม่
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $data = [
            'et_id' => $row['et_id'],
            'it_name' => $row['it_name'],
            'itd_price' => $row['itd_price'],
            'brand_name' => $row['brand_name'],
            'un_id' => $row['un_id'],
            'itd_image' => $row['itd_image'], 
        ];

        echo json_encode($data);
    } else {
        echo json_encode([]);
    }

    // ปิดคำสั่ง SQL
    $stmt->close();
} else {
    // ถ้าไม่มีค่า ep_et_number ส่งมา
    echo json_encode([]);
}

// ปิดการเชื่อมต่อ
$conn->close();
?>
