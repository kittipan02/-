<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repair";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับค่าที่ถูกส่งมาจากฟอร์มแก้ไข
    $head_id = $_POST['head_id'];
    $department_id = $_POST['department_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $position = $_POST['position'];

    // SQL query สำหรับอัปเดตข้อมูล
    $sql = "UPDATE headofdepartment SET department_id=?, first_name=?, last_name=?, position=? WHERE head_id=?";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("isssi", $department_id, $first_name, $last_name, $position, $head_id);

        // Execute statement
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                // อัปเดตเรียบร้อย
                header("Location: http://localhost/repair/admin/headofdepartment.php");
                exit();
            } else {
                // ไม่มีแถวที่ถูกอัปเดต
                echo "ไม่พบข้อมูลที่ตรงกับ head_id ที่ระบุ";
            }
        } else {
            // เกิดข้อผิดพลาดในการ execute
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    } else {
        // เกิดข้อผิดพลาดในการเตรียม statement
        echo "Error in preparing statement: " . $conn->error;
    }
}

// Close connection
$conn->close();
?>
