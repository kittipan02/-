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

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // รับค่า head_id ที่จะลบ
    $head_id = $_GET['id'];

    // SQL query สำหรับลบข้อมูล
    $sql = "DELETE FROM headofdepartment WHERE head_id = ?";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameter
        $stmt->bind_param("i", $head_id);

        // Execute statement
        if ($stmt->execute()) {
            // ลบเรียบร้อย
            header("Location: headofdepartment.php");
            exit();
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
} else {
    echo "Invalid request";
}

// Close connection
$conn->close();
?>
