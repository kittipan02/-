<?php
// เช็คว่ามีการส่งข้อมูลมาจากฟอร์มหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // เชื่อมต่อกับฐานข้อมูล
    $conn = new mysqli("localhost", "root", "", "repair");

    // ตรวจสอบการเชื่อมต่อ
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // รับข้อมูลจากฟอร์ม
    $request_date = $_POST["request_date"];
    $department_id = $_POST["department"];
    $user_id = $_POST["user_id"];
    $contact_number = $_POST["contact_number"];
    $equipment_type_id = $_POST["equipment_type"];
    $item = $_POST["item"];
    $equipment_number = $_POST["equipment_number"];
    $repair_details = $_POST["repair_details"];

    // ตรวจสอบว่ามีไฟล์รูปถูกอัปโหลดหรือไม่
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
    } else {
        // ถ้าไม่มีไฟล์รูปถูกอัปโหลดให้กำหนดค่าเป็น NULL หรือตามที่คุณต้องการ
        $target_file = NULL;
    }

    // เพิ่มข้อมูลยี่ห้อลงในฐานข้อมูล (สมมติว่าคุณมีตาราง brand)
    $brand_name = $_POST["brand"];
    $brand_sql = "INSERT INTO brand (brand_name) VALUES ('$brand_name')";
    if ($conn->query($brand_sql) === TRUE) {
        $brand_id = $conn->insert_id;

        // เพิ่มข้อมูลลงในฐานข้อมูล
        $sql = "INSERT INTO repair_requests (request_date, department_id, user_id, contact_number, equipment_type_id, item, equipment_number, repair_details, image_url, brand_id) 
                VALUES ('$request_date', '$department_id', '$user_id', '$contact_number', '$equipment_type_id', '$item', '$equipment_number', '$repair_details', '$target_file', '$brand_id')";

        if ($conn->query($sql) === TRUE) {
            header("Location: repair_requests.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $brand_sql . "<br>" . $conn->error;
    }

    // ปิดการเชื่อมต่อ
    $conn->close();
}
?>