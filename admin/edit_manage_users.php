<?php
include 'public/layout.php';
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

    $sql = "UPDATE users SET u_fname='$u_fname', u_lname='$u_lname', u_email='$u_email', u_status='$u_status', u_type='$u_type', u_dp_id='$u_dp_id' WHERE u_id='$user_id'";

    if ($conn->query($sql) === TRUE) {
        echo "อัปเดตข้อมูลผู้ใช้สำเร็จ";
    } else {
        echo "การอัปเดตข้อมูลผู้ใช้ล้มเหลว: " . $conn->error;
    }
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    // เพิ่มเงื่อนไขตรวจสอบว่า $user_id ไม่เป็นค่าว่างหรือไม่
    if (!empty($user_id)) {
        $sql = "SELECT * FROM users WHERE u_id='$user_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            echo "ไม่พบข้อมูลผู้ใช้";
        }
    } else {
        echo "กรุณาระบุรหัสผู้ใช้ที่ต้องการแก้ไข";
    }
} else {
    echo "ไม่ได้ระบุรหัสผู้ใช้ที่ต้องการแก้ไข";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f8f8;
        }

        form {
            text-align: center;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: #333;
            text-align: left;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            color: #333;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

<center><h4>แก้ไขข้อมูลผู้ใช้</h4></center>

<form method="post" action="process_edit_manage_users.php" enctype="multipart/form-data">
    <input type="hidden" name="u_id" value="<?php echo $row['u_id']; ?>">

    <label for="u_fname">ชื่อ :</label>
    <input type="text" name="u_fname" value="<?php echo $row['u_fname']; ?>" required><br>
    
    <label for="u_lname">นามสกุล :</label>
    <input type="text" name="u_lname" value="<?php echo $row['u_lname']; ?>" required><br>
    
    <label for="u_email">Email:</label>
    <input type="email" name="u_email" value="<?php echo $row['u_email']; ?>" required><br>

    <label for="u_status">สถานะ :</label>
    <select name="u_status">
        <option value="ใช้งาน" <?php if ($row['u_status'] == 'ใช้งาน') echo 'selected'; ?>>ใช้งาน</option>
        <option value="ไม่ได้ใช้งาน" <?php if ($row['u_status'] == 'ไม่ได้ใช้งาน') echo 'selected'; ?>>ไม่ได้ใช้งาน</option>
    </select><br>

    <label for="u_type">ประเภทผู้ใช้ :</label>
    <select name="u_type">
        <option value="ช่าง" <?php if ($row['u_type'] == 'ช่าง') echo 'selected'; ?>>ช่าง</option>
        <option value="แอดมิน" <?php if ($row['u_type'] == 'แอดมิน') echo 'selected'; ?>>แอดมิน</option>
        <option value="ผู้ใช้" <?php if ($row['u_type'] == 'ผู้ใช้') echo 'selected'; ?>>ผู้ใช้</option>
    </select><br>

    <label for="u_dp_id">แผนก/กอง :</label>
    <select name="u_dp_id" required>
        <?php
        // Include database connection code here
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "repair";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // ตรวจสอบการเชื่อมต่อ
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query to retrieve Department IDs and Names from the 'department' table
        $sql_department = "SELECT dp_id, dp_name FROM department";
        $result_department = $conn->query($sql_department);

        // Fetch and display the Department Names in the dropdown
        while ($row_department = $result_department->fetch_assoc()) {
            $selected_department = ($row_department['dp_id'] == $row['u_dp_id']) ? 'selected' : '';
            echo "<option value='{$row_department['dp_id']}' $selected_department>{$row_department['dp_name']}</option>";
        }

        $conn->close();
        ?>
    </select>

    <br><br>
    <div class="form-group">
        <button type="submit">บันทึกการแก้ไข</button>
    </div>
</form>

</body>
</html>
