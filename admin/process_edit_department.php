<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repair";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $position_id = $_POST['position_id'];
    $employee_name = $_POST['employee_name'];
    $position_title = $_POST['position_title'];

    // Update position data in the database
    $sql = "UPDATE position SET employee_name='$employee_name', position_title='$position_title' WHERE position_id=$position_id";

    if ($conn->query($sql) === TRUE) {
        echo "<p>บันทึกการแก้ไขเรียบร้อย</p>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
