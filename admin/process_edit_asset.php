<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

// เรียกใช้ฟังก์ชั่นเชื่อมต่อฐานข้อมูล
function connectToDatabase() {
    $conn = new mysqli("localhost", "root", "", "repair");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

// ฟังก์ชั่นปิดการเชื่อมต่อกับฐานข้อมูล
function closeConnection($conn, $stmt) {
    if ($stmt !== null && $stmt !== false) {
        $stmt->close();
    }
    $conn->close();
}

// ฟังก์ชั่นสร้างไดเร็กทอรีสำหรับอัปโหลด
function createUploadDirectory($upload_dir) {
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['parcel_id'])) {
    $stmt = null;

    try {
        // เชื่อมต่อฐานข้อมูล
        $conn = connectToDatabase();
        $upload_dir = "../upload_files/uploads/";
        createUploadDirectory($upload_dir);        

        $target_file = NULL;

        // ตรวจสอบว่าไฟล์ถูกเลือกสำหรับอัปโหลดหรือไม่
        if (isset($_FILES["ep_itd_image"]) && $_FILES["ep_itd_image"]["error"] == 0) {
            $file_name = uniqid() . '_' . $_FILES["ep_itd_image"]["name"];
            $target_file = $upload_dir . $file_name;
            move_uploaded_file($_FILES["ep_itd_image"]["tmp_name"], $target_file);
        } else {
            $target_file = NULL;
        }

        // แทนที่ค่าว่างด้วยค่า null
        $values = [];
        $columns = [];

        foreach ($_POST as $key => $value) {
            if ($key !== 'parcel_id' && !empty($value)) {
                $values[$key] = $value;
                $columns[] = "$key = ?";
            }
        }

        // เพิ่มฟิลด์ ep_itd_image ใน $values หากมีการอัปโหลดไฟล์
        if ($target_file !== NULL) {
            $values["ep_itd_image"] = $target_file;
        }

        $columns_str = implode(", ", $columns);

        $sql = "UPDATE equipment_parcels SET $columns_str WHERE parcel_id = ?";
        $stmt = $conn->prepare($sql);
        
        if ($stmt !== false) {
            $param_types = str_repeat('s', count($values) + 1); // รวม parcel_id
            $bind_params = [$param_types];

            foreach ($values as &$value) {
                $bind_params[] = &$value;
            }

            $bind_params[] = $_POST['parcel_id']; // parcel_id
            
            $stmt->bind_param(...$bind_params);

            if ($stmt->execute()) {
                header("Location: display_assets.php");
                exit();
            } else {
                throw new Exception("Error executing SQL statement: " . $stmt->error);
            }
        } else {
            throw new Exception("Error preparing SQL statement: " . $conn->error);
        }
    } catch (Exception $e) {
        echo "Error: An unexpected error occurred. Please try again later. Additional Info: " . $e->getMessage();
    } finally {
        closeConnection($conn, $stmt);
    }
}
?>
