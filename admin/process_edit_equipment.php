<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "repair";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // เช็คว่ามีการส่งข้อมูล et_id ผ่าน POST หรือไม่
    if(isset($_POST['et_id'])) {
        $et_id = mysqli_real_escape_string($conn, $_POST['et_id']);
    } else {
        echo "ไม่พบข้อมูลที่ต้องการอัปเดต";
        exit();
    }

    // ให้เลือกข้อมูลเดิมออกมาก่อน
    $select_query = "SELECT * FROM equipment_type WHERE et_id='$et_id'";
    $result = $conn->query($select_query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $image_name = $row['itd_image'];
    } else {
        echo "ไม่พบข้อมูลที่ต้องการอัปเดต";
        exit();
    }
    
    // ตรวจสอบและดึงข้อมูลจากฟอร์ม
    $et_number = mysqli_real_escape_string($conn, $_POST['et_number']);
    $et_name = mysqli_real_escape_string($conn, $_POST['et_name']);
    $it_name = mysqli_real_escape_string($conn, $_POST['it_name']);
    $itd_name = mysqli_real_escape_string($conn, $_POST['itd_name']);
    $un_id = mysqli_real_escape_string($conn, $_POST['un_id']);
    $itd_price = mysqli_real_escape_string($conn, $_POST['itd_price']);
    $brand_name = mysqli_real_escape_string($conn, $_POST['brand_name']);

    // ตรวจสอบว่ามีการอัปโหลดรูปภาพหรือไม่
    if (isset($_FILES['itd_image']) && $_FILES['itd_image']['name'] != "") {
        $image_name = basename($_FILES['itd_image']['name']);
        $target_dir = "../upload_files/uploads/";
        $target_file = $target_dir . $image_name;

        // ย้ายไฟล์ที่อัปโหลดมาไว้ในโฟลเดอร์ที่กำหนด
        if (move_uploaded_file($_FILES['itd_image']['tmp_name'], $target_file)) {
            // อัปเดตข้อมูล
            $stmt = $conn->prepare("UPDATE equipment_type SET et_number=?, et_name=?, it_name=?, itd_name=?, un_id=?, itd_price=?, brand_name=?, itd_image=? WHERE et_id=?");
            $stmt->bind_param("sssssssss", $et_number, $et_name, $it_name, $itd_name, $un_id, $itd_price, $brand_name, $target_file, $et_id);

            if ($stmt->execute()) {
                echo "อัปเดตข้อมูลเรียบร้อย";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "มีปัญหาในการอัปโหลดรูปภาพ";
        }
    } else {
        // ถ้าไม่ได้อัปโหลดรูปภาพใหม่ ให้ไม่ทำการอัปเดต field itd_image
        $stmt = $conn->prepare("UPDATE equipment_type SET et_number=?, et_name=?, it_name=?, itd_name=?, un_id=?, itd_price=?, brand_name=? WHERE et_id=?");
        $stmt->bind_param("sssssssi", $et_number, $et_name, $it_name, $itd_name, $un_id, $itd_price, $brand_name, $et_id);

        if ($stmt->execute()) {
            echo "อัปเดตข้อมูลเรียบร้อย";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }

    $conn->close();
    
    header("Location: equipment_types_table.php");
    exit();
}
?>
