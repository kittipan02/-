<?php
// delete_repair.php

// Check if the request contains the 'id' parameter
if (isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $requestId = intval($_GET['id']);

    // Perform the deletion operation (you should validate permissions here)
    $conn = new mysqli("localhost", "root", "", "repair");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Perform the deletion query
    $deleteSql = "DELETE FROM repair_requests WHERE request_id = $requestId";

    if ($conn->query($deleteSql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();

    // Redirect back to the repair_requests.php page after deletion
    header("Location: repair_requests.php");
    exit();
} else {
    // If 'id' parameter is not provided, redirect to repair_requests.php
    header("Location: repair_requests.php");
    exit();
}
?>
