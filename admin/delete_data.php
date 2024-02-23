<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // การเชื่อมต่อกับฐานข้อมูล
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "repair";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // ตรวจสอบการเชื่อมต่อ
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // รับค่า id ที่ต้องการลบ
    $et_id = $_POST['id'];

    // ทำคำสั่ง SQL สำหรับลบข้อมูล
    $sql_delete_itd = "DELETE FROM inside_type_detail WHERE itd_it_id IN (SELECT it_id FROM inside_type WHERE it_et_id = $et_id)";
    $conn->query($sql_delete_itd);

    $sql_delete_it = "DELETE FROM inside_type WHERE it_et_id = $et_id";
    $conn->query($sql_delete_it);

    $sql_delete_et = "DELETE FROM equipment_type WHERE et_id = $et_id";
    $conn->query($sql_delete_et);

    // ปิดการเชื่อมต่อ
    $conn->close();
}
?>
