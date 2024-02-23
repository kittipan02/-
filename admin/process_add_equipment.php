<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repair";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $et_number = $_POST["et_number"];
    $et_name = $_POST["et_name"];
    $it_name = $_POST["it_name"];
    $itd_name = $_POST["itd_name"];
    $itd_price = $_POST["itd_price"];
    $brand_name = $_POST["brand_name"];
    
    // Handle image upload
    $target_dir = "../upload_files/uploads/";
    $target_file = $target_dir . basename($_FILES["itd_image"]["name"]);
    move_uploaded_file($_FILES["itd_image"]["tmp_name"], $target_file);    
    $itd_image = $target_file;


    // Unit handling
    $unit_id = $_POST["unit_id"];

// Check if the equipment number already exists
$sql_check_duplicate = "SELECT * FROM equipment_type WHERE et_number = ?";
$stmt_check_duplicate = $conn->prepare($sql_check_duplicate);
$stmt_check_duplicate->bind_param("s", $et_number);
$stmt_check_duplicate->execute();
$result_check_duplicate = $stmt_check_duplicate->get_result();

// Check if the equipment number already exists
if ($result_check_duplicate->num_rows > 0) {
    echo "รหัสครุภัณฑ์ซ้ำกัน กรุณากรอกรหัสครุภัณฑ์ใหม่";
} else {
    // Perform the SQL query to insert the new equipment
    $sql = "INSERT INTO equipment_type (et_number, et_name, it_name, itd_name, un_id, itd_price, itd_image, brand_name) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssdsss", $et_number, $et_name, $it_name, $itd_name, $unit_id, $itd_price, $itd_image, $brand_name);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Redirect to a success page or perform any additional actions
        header("Location: add_asset.php");
        exit();
    } else {
        // Handle errors
        echo "Error: " . $stmt->error;
    }
}
}
// Close the database connection
$conn->close();
?>
