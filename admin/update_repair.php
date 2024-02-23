<?php
// เชื่อมต่อกับฐานข้อมูล
$conn = new mysqli("localhost", "root", "", "repair");

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตรวจสอบว่ามีการส่งข้อมูลจากฟอร์มมาหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าจากฟอร์ม
    $requestId = $_POST["request_id"];
    $requestDate = $_POST["request_date"];
    $departmentId = $_POST["department_id"];
    $userId = $_POST["user_id"];
    $contactNumber = $_POST["contact_number"];
    $equipmentNumber = $_POST["equipment_number"];
    $equipmentType = $_POST["equipment_type"];
    $item = $_POST["item"];
    $brand = $_POST["brand"];
    $repairDetails = $_POST["repair_details"];

    // ตรวจสอบว่ามีการอัปโหลดรูปภาพใหม่หรือไม่
   
    if(isset($_FILES["image_url"]["tmp_name"]) && !empty($_FILES["image_url"]["tmp_name"])) {
        // สร้างไดเรกทอรีเพื่อเก็บรูปภาพ (ถ้ายังไม่มี)
        $upload_dir = "../upload_files/uploads/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        // สุ่มชื่อไฟล์เพื่อป้องกันชื่อที่ซ้ำกัน
        $file_name = uniqid() . '_' . $_FILES["image_url"]["name"];
        $target_file = $upload_dir . $file_name;

        // ย้ายไฟล์ที่อัปโหลดไปยังตำแหน่งที่ต้องการ
        move_uploaded_file($_FILES["image_url"]["tmp_name"], $target_file);
    } 

    // ตรวจสอบว่ามีข้อมูลยี่ห้อนี้ในฐานข้อมูลหรือยัง
    $brandCheckSql = "SELECT brand_id FROM brand WHERE brand_name = '$brand' LIMIT 1";
    $brandCheckResult = $conn->query($brandCheckSql);

    if ($brandCheckResult->num_rows == 0) {
        // ถ้ายี่ห้อยังไม่มีในฐานข้อมูลให้ทำการเพิ่ม
        $brandInsertSql = "INSERT INTO brand (brand_name) VALUES ('$brand')";
        $conn->query($brandInsertSql);
    }

    // ทำการอัปเดตข้อมูลในฐานข้อมูล
    $sql = "UPDATE repair_requests SET 
            request_date = '$requestDate',
            department_id = '$departmentId',
            user_id = '$userId',
            contact_number = '$contactNumber',
            equipment_number = '$equipmentNumber',
            equipment_type_id = '$equipmentType',
            item = '$item',
            brand_id = (SELECT brand_id FROM brand WHERE brand_name = '$brand' LIMIT 1),
            repair_details = '$repairDetails',
            image_url = '$target_file'
            WHERE request_id = $requestId";

    if ($conn->query($sql) === TRUE) {
        header("Location: repair_requests.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request";
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>
