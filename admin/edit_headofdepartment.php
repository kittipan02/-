<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Head of Department Information</title>
    <?php include 'public/layout.php'; ?>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f8f8;
            color: #333;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label, input, input[type="submit"] {
            display: block;
            margin: 10px 0;
            font-size: 16px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #1b02a8;
            color: #fff;
            cursor: pointer;
            padding: 10px;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #fff;
            color: #1b02a8;
        }
    </style>
</head>
<body>
    <center><h4>แก้ไขข้อมูลพนักงาน</h4></center>
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

$head_id = $_GET['id'];

// SQL query to fetch data for the specified head_id
$sql = "SELECT * FROM headofdepartment WHERE head_id = $head_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>
   <form method="post" action="process_edit_headofdepartment.php">
        <!-- Remove readonly attribute from head_id field -->
        <label for="head_id">รหัสพนักงาน:</label>
    <input type="text" id="head_id" name="head_id" value="<?php echo $row['head_id']; ?>" readonly>

        <label for="department_id">แผนก:</label>
        <select id="department_id" name="department_id">
            <?php
            // SQL query to fetch department data
            $departmentQuery = "SELECT * FROM department";
            $departmentResult = $conn->query($departmentQuery);

            while ($department = $departmentResult->fetch_assoc()) {
                $selected = ($row['department_id'] == $department['dp_id']) ? 'selected' : '';
                echo "<option value='{$department['dp_id']}' $selected>{$department['dp_name']}</option>";
            }
            ?>
        </select>

        <label for="first_name">ชื่อ:</label>
        <input type="text" id="first_name" name="first_name" value="<?php echo $row['first_name']; ?>" required>

        <label for="last_name">นามสกุล:</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo $row['last_name']; ?>" required>

        <label for="position">ตำแหน่ง:</label>
        <input type="text" id="position" name="position" value="<?php echo $row['position']; ?>" required>

        <input type="submit" value="บันทึก">
    </form>
<?php
} else {
    echo "ไม่พบข้อมูลในฐานข้อมูล";
}

$conn->close();
?>
</body>
</html>