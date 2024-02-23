<?php
    // เชื่อมต่อฐานข้อมูล
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "repair";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // ตรวจสอบการเชื่อมต่อ
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // รับค่า id ที่จะลบ
    $etId = $_GET['id'];

    // สร้างคำสั่ง SQL สำหรับลบ
    $sql = "DELETE FROM equipment_type WHERE et_id = $etId";

    // ทำการลบ
    if ($conn->query($sql) === TRUE) {
        header("Location: equipment_types.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // ปิดการเชื่อมต่อ
    $conn->close();
?>
