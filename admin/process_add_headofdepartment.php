<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repair";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $department_name = $_POST["department_name"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $position = $_POST["position"];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the department already exists
    $checkDepartment = $conn->query("SELECT dp_id FROM department WHERE dp_name = '$department_name'");
    if ($checkDepartment->num_rows > 0) {
        $row = $checkDepartment->fetch_assoc();
        $department_id = $row["dp_id"];
    } else {
        // If the department doesn't exist, insert it into the database
        $conn->query("INSERT INTO department (dp_name) VALUES ('$department_name')");
        $department_id = $conn->insert_id;
    }

    // Get the maximum head_id and increment by 1
    $result = $conn->query("SELECT MAX(head_id) AS max_head_id FROM headofdepartment");
    $row = $result->fetch_assoc();
    $head_id = $row["max_head_id"] + 1;

    // Insert head of department information
    $sql = "INSERT INTO headofdepartment (head_id, department_id, first_name, last_name, position)
            VALUES ('$head_id', '$department_id', '$first_name', '$last_name', '$position')";

    if ($conn->query($sql) === TRUE) {
        header("Location: headofdepartment.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

?>
