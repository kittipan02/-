<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Repair Request</title>
    <?php include 'public/layout.php'; ?>
    <style>
         table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #1b02a8;
            color: white;
            padding: 10px;
            text-align: center;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
        }

        .edit-button, .delete-button {
            padding: 8px 5px;
            margin-top: 10px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
            text-decoration: none;
            width: 50px;
        }

        .edit-button {
            background-color: #1b02a8;
            color: white;
        }

        .edit-button:hover {
            background-color: #1854a3;
        }

        .delete-button {
            background-color: #dc3545;
            color: white;
        }

        .delete-button:hover {
            background-color: #bd2130;
        }

        .thumbnail {
            max-width: 100px;
            max-height: 100px;
        }

        label, input, input[type="submit"] {
            font-size: 14px;
            margin: 5px;
            padding: 8px;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #1b02a8;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #fff;
            color: #1b02a8;
        }

        .form-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .thumbnail {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
</head>
<body>
<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "repair");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if data has been sent from the form using POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data and update the repair request
    // ...
} else {
    // Retrieve repair request ID from the URL parameter
    $requestId = isset($_GET['id']) ? $_GET['id'] : null;

    if ($requestId) {
        // Retrieve repair request data
        $sql = "SELECT * FROM repair_requests WHERE request_id = $requestId";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Retrieve brand information based on the repair request's brand_id
            $brandId = $row['brand_id'];
            $brandSql = "SELECT * FROM brand WHERE brand_id = $brandId";
            $brandResult = $conn->query($brandSql);
            $brandRow = $brandResult->fetch_assoc();

            // Display the edit form
            ?>
    <div class="form-container">
    <button class='back-link' onclick='window.history.back()'>กลับ</button>
        <h2>แก้ไขข้อมูลการแจ้งซ่อม</h2>
        <form method="post" action="update_repair.php" enctype="multipart/form-data">
            <input type="hidden" name="request_id" value="<?php echo $row['request_id']; ?>">

            <!-- เพิ่มฟิลด์ที่ต้องการแก้ไข -->
            <label for="request_date">วันที่:</label>
            <input type="date" id="request_date" name="request_date" value="<?php echo date('Y-m-d'); ?>" required readonly>
            
            <label for="department">แผนก:</label>
            <select id="department_id" name="department_id" required>
                <?php
                // ดึงข้อมูลแผนกจากฐานข้อมูล
                $sql_department = "SELECT * FROM department";
                $result_department = $conn->query($sql_department);

                while ($row_department = $result_department->fetch_assoc()) {
                    $selected_department = ($row_department['dp_id'] == $row['department_id']) ? 'selected' : '';
                    echo "<option value='{$row_department['dp_id']}' $selected_department>{$row_department['dp_name']}</option>";
                }
                ?>
            </select>
            
<br>
            <!-- สร้างเลือกผู้ใช้จากฐานข้อมูล -->
            <label for="">อีเมล:</label>
            <?=$_SESSION["email"]?>
            &nbsp; &nbsp; &nbsp; &nbsp;
            <label for="">ผู้ใช้:</label>
            <?=$_SESSION["fullname"]?>
            <input type="hidden" id="user_id" name="user_id" value ="<?=$_SESSION["u_id"]?>">


            <br>
            <label for="contact_number">เบอร์ติดต่อ:</label>
            <input type="tel" id="contact_number" name="contact_number" value="<?php echo $row["contact_number"]; ?>" required>
            <br>
            <label for="equipment_number">หมายเลขอุปกรณ์:</label>
            <input type="text" id="equipment_number" name="equipment_number" value="<?php echo $row['equipment_number']; ?>" required>

            <label for="equipment_type">ประเภทอุปกรณ์:</label>
            <select id="equipment_type" name="equipment_type" required>
                <?php
                // ดึงข้อมูลประเภทอุปกรณ์จากฐานข้อมูล
                $sql_equipment_type = "SELECT * FROM equipment_type";
                $result_equipment_type = $conn->query($sql_equipment_type);

                while ($row_equipment_type = $result_equipment_type->fetch_assoc()) {
                    $selected = ($row_equipment_type['et_id'] == $row['equipment_type_id']) ? 'selected' : '';
                    echo "<option value='{$row_equipment_type['et_id']}' $selected>{$row_equipment_type['et_name']}</option>";
                }
                ?>
            </select>
            <br>
            <label for="item">รายการ:</label>
            <input type="text" id="item" name="item" value="<?php echo $row['item']; ?>" required>

            <label for="brand">ยี่ห้อ:</label>
                    <input type="text" id="brand" name="brand" value="<?php echo htmlspecialchars($brandRow['brand_name']); ?>" required>


            <br>
            <label for="repair_details">รายละเอียดการซ่อม:</label>
            <textarea id="repair_details" name="repair_details" style="height: 50px;" required><?php echo $row['repair_details']; ?></textarea>
            <br>
            <label for="image_url">รูปภาพ:</label>
            <input type="file" class="form-control-file" id="image_url" name="image_url" accept="image/*">
            <img src="<?php echo $row['image_url']; ?>" alt="Equipment Image" style="max-width: 150px; max-height: 150px;">
            
            <input type="hidden" name="request_id" value="<?php echo $row['request_id']; ?>">
            <button type="submit" class="btn btn-primary">บันทึกการแก้ไข</button>
        </form>
    </div>
    <script>
       document.getElementById('equipment_number').addEventListener('blur', function () {
    fetchData();
});

function fetchData() {
    var equipmentNumber = document.getElementById('equipment_number').value;
    var url = 'get_equipment_info.php?equipment_number=' + equipmentNumber;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            document.getElementById('equipment_type').value = data.et_id || '';
            document.getElementById('item').value = data.it_name || '';
            document.getElementById('brand').value = data.brand_name || '';
        }
    };
    xhr.open('GET', url, true);
    xhr.send();
}

    </script>
 <?php
        } else {
            echo "ไม่พบข้อมูลการแจ้งซ่อมที่ต้องการแก้ไข";
        }
    } else {
        echo "Missing request ID";
    }
}

// Close the database connection
$conn->close();
?>

</body>
</html>
