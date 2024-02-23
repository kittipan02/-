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

    $dp_name = $_POST["dp_name"];
    $employee_name = $_POST["employee_name"];
    $position_title = $_POST["position_title"];

    // เพิ่มตรวจสอบว่าค่าที่ต้องการใส่เป็นค่าที่ถูกต้องในตาราง department
    $check_department_sql = "SELECT dp_id FROM department WHERE dp_name = ?";
    $check_department_stmt = $conn->prepare($check_department_sql);
    $check_department_stmt->bind_param("s", $dp_name);
    $check_department_stmt->execute();
    $check_department_result = $check_department_stmt->get_result();

    if ($check_department_result->num_rows > 0) {
        // รายการแผนกถูกต้อง
        $check_department_row = $check_department_result->fetch_assoc();
        $dp_id = $check_department_row['dp_id'];

        // เตรียมและส่งคำสั่ง SQL
        $insert_sql = "INSERT INTO position (department_name, employee_name, position_title) VALUES (?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("iss", $dp_id, $employee_name, $position_title);

        if ($insert_stmt->execute()) {
            header("Location: http://localhost/repair/department_list.php");
            exit();
        } else {
            echo "Error: " . $insert_stmt->error;
        }
    } else {
        // ไม่พบแผนกที่ถูกต้อง
        echo "<h3>ไม่พบแผนกที่ถูกต้อง</h3>";
    }

    $check_department_stmt->close();
    $insert_stmt->close();
    $conn->close();
}
?>
