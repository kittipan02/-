<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repair";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['u_id'];
    $u_fname = $_POST['u_fname'];
    $u_lname = $_POST['u_lname'];
    $u_email = $_POST['u_email'];
    $u_status = $_POST['u_status'];
    $u_type = $_POST['u_type'];
    $u_dp_id = $_POST['u_dp_id'];

    $sql = "UPDATE users SET u_fname=?, u_lname=?, u_email=?, u_status=?, u_type=?, u_dp_id=? WHERE u_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $u_fname, $u_lname, $u_email, $u_status, $u_type, $u_dp_id, $user_id);

    if ($stmt->execute()) {
        header("Location: manage_users.php");
        exit();
    } else {
        echo "การอัปเดตข้อมูลผู้ใช้ล้มเหลว: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
