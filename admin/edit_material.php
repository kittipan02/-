<?php
// ตรวจสอบว่ามีการส่งค่า ID ของวัสดุมาหรือไม่
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];

    // ทำการดึงข้อมูลวัสดุจากฐานข้อมูล
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "repair";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // สร้าง SQL query เพื่อดึงข้อมูลของวัสดุที่ต้องการแก้ไข
    $sql = "SELECT * FROM material WHERE mt_id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $material_name = $row['mt_name'];
        $type_material_id = $row['mt_tm_id'];
        $detail_material_id = $row['mt_dm_id'];
    } else {
        echo "Material not found.";
        exit();
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn->close();
} else {
    echo "Invalid request.";
    exit();
}

// ตรวจสอบการบันทึกการแก้ไข
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_material_name = $_POST['material_name'];
    $new_type_material_id = $_POST['type_material'];
    $new_detail_material_id = $_POST['detail_material'];

    // ทำการเชื่อมต่อฐานข้อมูล
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // ทำการอัปเดตข้อมูลในฐานข้อมูล
    $update_sql = "UPDATE material SET mt_name = '$new_material_name', mt_tm_id = $new_type_material_id, mt_dm_id = $new_detail_material_id WHERE mt_id = $id";

    if ($conn->query($update_sql) === TRUE) {
        header("Location: material_types.php");
       // echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Material</title>
    <?php include 'public/layout.php'; ?>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f8f8;
            color: #333;
        }

        h2 {
            color: #1b02a8;
            margin-bottom: 20px;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 10px 0 5px;
            color: #333;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #1b02a8;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #fff;
            color: #1b02a8;
        }
    </style>
</head>
<body>

    <center><h4>แก้ไขประเภทวัสดุ</h4></center>

    <!-- ฟอร์มแก้ไขข้อมูล -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="type_material">ประเภทวัสดุ:</label>
        <select id="type_material" name="type_material" required>
            <!-- ดึงข้อมูลประเภทวัสดุจากฐานข้อมูลและตรวจสอบประเภทวัสดุที่ถูกเลือก -->
            <?php
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $type_material_query = "SELECT * FROM type_material";
            $type_material_result = $conn->query($type_material_query);

            if ($type_material_result->num_rows > 0) {
                while ($type_material_row = $type_material_result->fetch_assoc()) {
                    $selected = ($type_material_row['tm_id'] == $type_material_id) ? "selected" : "";
                    echo "<option value='{$type_material_row['tm_id']}' $selected>{$type_material_row['tm_name']}</option>";
                }
            }
            ?>
        </select>

        <label for="detail_material">ลักษณะวัสดุ:</label>
        <select id="detail_material" name="detail_material" required>
            <!-- ดึงข้อมูลลักษณะวัสดุจากฐานข้อมูลและตรวจสอบลักษณะวัสดุที่ถูกเลือก -->
            <?php
            $detail_material_query = "SELECT * FROM detail_material";
            $detail_material_result = $conn->query($detail_material_query);

            if ($detail_material_result->num_rows > 0) {
                while ($detail_material_row = $detail_material_result->fetch_assoc()) {
                    $selected = ($detail_material_row['dm_id'] == $detail_material_id) ? "selected" : "";
                    echo "<option value='{$detail_material_row['dm_id']}' $selected>{$detail_material_row['dm_name']}</option>";
                }
            }

            // ปิดการเชื่อมต่อฐานข้อมูล
            $conn->close();
            ?>
        </select>

        <label for="material_name">ชื่อวัสดุ:</label>
        <input type="text" id="material_name" name="material_name" value="<?php echo $material_name; ?>" required>
        <input type="hidden" id="id" name="id" value="<?=$id?>">
        <input type="submit" value="บันทึกการแก้ไข">
    </form>

</body>
</html>
