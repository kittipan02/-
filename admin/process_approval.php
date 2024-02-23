<?php
$conn = new mysqli("localhost", "root", "", "repair");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $request_id = $_POST["request_id"];
    $status = $_POST["status"];

    // SQL query to update status in the repair_requests table
    $sql_update_status = "UPDATE repair_requests SET status_id = $status WHERE request_id = $request_id";

    if ($conn->query($sql_update_status) === TRUE) {
        // Redirect to repair_requests.php with the status parameter
        header("Location: repair_requests.php?status=$status");
        exit();
    } else {
        echo "Error updating status: " . $conn->error;
    }
}

$conn->close();
?>
