
<!DOCTYPE html>
<html lang="en">
<head><?php include 'public/layout.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repair Requests</title>
    <script>
    function confirmDelete(requestId) {
        var isConfirmed = confirm("คุณต้องการลบรายการนี้หรือไม่?");
        if (isConfirmed) {
            console.log("Deleting request with ID: " + requestId);
            window.location.href = 'delete_repair.php?id=' + requestId;
        }
    }
</script>

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
            max-width: 50%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        select, input {
        width: 185px;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        box-sizing: border-box;
    }
    
    label {
    display: block;
    font-size: 18px;
    color: #333;
    margin-bottom: 5px; /* เพิ่มระยะห่างด้านล่างของ label */
}
    .form-row {
    display: flex;
    flex-wrap: wrap;
    gap: 10px; /* ระยะห่างระหว่างคอลัมน์ */
}

.form-column {
    flex: 1; /* ความกว้างของแต่ละคอลัมน์ */
}
<?php
    // กำหนดสีประจำสถานะ
    $statusColors = array(
        'กำลังดำเนินการ' => '#007bff', // สีฟ้า
        'รอการอนุมัติ' => '#ffc107', // สีเหลือง
        'เสร็จสมบูรณ์' => '#28a745', // สีเขียว
        'รอจำหน่าย' => '#dc3545', // สีแดง
        'รออะไหล่' => '#fd7e14', // สีส้ม
        'จำหน่ายเสร้จสิ้น' => '#FFFF00' // สีส้ม
        // สามารถเพิ่มสถานะและสีที่ต้องการเพิ่มเติมได้ตามต้องการ
    );

    // วนลูปเพื่อกำหนดสีประจำสถานะใน CSS
    foreach ($statusColors as $status => $color) {
        echo "td." . strtolower(str_replace(' ', '-', $status)) . "-status { background-color: $color; }";
    }
    ?>
       
    </style>
</head>
<body>
<div class="form-container">
        <h2>เพิ่มข้อมูลการแจ้งซ่อม</h2>
        <form method="post" action="add_repair.php" enctype="multipart/form-data">
            <div class="row">
            <div class="col-md-4">
            <!-- เพิ่มฟิลด์ข้อมูลต่างๆที่ต้องการ -->
            <label for="request_date">วันที่:</label>
            <input type="date" id="request_date" name="request_date" value="<?php echo date('Y-m-d'); ?>" required readonly>
            </div>
            <div class="col-md-4">
            <label for="department">แผนก:</label>
            <select id="department" name="department" required>
            <option value='' disabled selected>เลือกแผนก</option>
                <?php
                // เชื่อมต่อกับฐานข้อมูล
                $conn = new mysqli("localhost", "root", "", "repair");

                // ตรวจสอบการเชื่อมต่อ
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // คำสั่ง SQL สำหรับดึงข้อมูลแผนก
                $sql = "SELECT * FROM department";
                $result = $conn->query($sql);

                // แสดงตัวเลือกสำหรับแผนก
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['dp_id']}'>{$row['dp_name']}</option>";
                }

                // ปิดการเชื่อมต่อ
                $conn->close();
                ?>
            </select>
            </div>
            
            <div class="col-md-4">
            <!-- สร้างเลือกผู้ใช้จากฐานข้อมูล -->
            <label for="">อีเมล:</label>
            <input type="text" id="contact_number" name="contact_number" value="<?=$_SESSION["email"]?>" readonly required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
            <label for="">ผู้ใช้:</label>
            <input type="text" id="contact_number" name="contact_number" value="<?=$_SESSION["fullname"]?>" readonly required>
            <input type="hidden" id="user_id" name="user_id" value ="<?=$_SESSION["u_id"]?>">
            </div>
            
            <div class="col-md-4">
            <label for="contact_number">เบอร์ติดต่อ:</label>
            <input type="text" id="contact_number" name="contact_number" required>
            </div>

            <div class="col-md-4">
            <label for="equipment_type">ประเภทอุปกรณ์:</label>
            <select id="equipment_type" name="equipment_type" required>
            <option value='' disabled selected>เลือกอัตโนมัติ</option>
            <?php
            // ดึงข้อมูลประเภทอุปกรณ์จากฐานข้อมูล
            $conn = new mysqli("localhost", "root", "", "repair");

            // ตรวจสอบการเชื่อมต่อ
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // คำสั่ง SQL สำหรับดึงข้อมูลประเภทอุปกรณ์
            $sql = "SELECT * FROM equipment_type";
            $result = $conn->query($sql);

            // แสดงตัวเลือกสำหรับประเภทอุปกรณ์
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['et_id']}'>{$row['et_name']}</option>";
            }

            // ปิดการเชื่อมต่อ
            $conn->close();
            ?>
        </select>
        </div></div>

        <!-- เพิ่ม input field สำหรับหมายเลขอุปกรณ์ -->
        <div class="row">
            <div class="col-md-4">
        <label for="equipment_number">หมายเลขอุปกรณ์:</label>
        <input type="text" id="equipment_number" name="equipment_number" required onblur="fetchData()">
        </div>

        <div class="col-md-4">
        <label for="item">รายการ:</label>
        <input type="text" id="item" name="item" required>
        </div>

        <div class="col-md-4">
        <label for="brand">ยี่ห้อ:</label>
        <input type="text" id="brand" name="brand" required>
        </div></div>
        <div class="row">
            <div class="col-md-6">
        <label for="repair_details">รายละเอียดการซ่อม:</label>
        <textarea id="repair_details" name="repair_details" style="height: 70px;" class="form-control" required></textarea>
        </div></div>
        <!-- เปลี่ยน input field เป็นประเภท file -->
        <div class="row">
        <div class="col-md-12">
        <label for="image_url">รูปภาพ:</label><br>
        <img id="image_url" style="max-width: 150px; max-height: 150px;">
        <input type="file" id="image_url_input" name="image_url" accept="image/*" onchange="previewImage()">
        </div></div>
<script>
function previewImage() {
    var input = document.getElementById('image_url_input');
    var preview = document.getElementById('image_url');

    var file = input.files[0];
    var reader = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
    };

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = "";
    }
}
</script>
   <!-- ฟอร์มอื่น ๆ -->
   <div class="row">
   <div class="col-md-12">
   <center><input type="submit" value="บันทึกข้อมูล"></center>
   </div>
   </div>

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


<br>
<br>
<form method="post" action="repair_requests.php">
    <label for="search">ค้นหา &nbsp;</label>
    <input type="text" id="search" name="search" placeholder="ป้อน รหัสครุภัณฑ์/สถานะการแจ้งซ่อม">
    <input type="submit" value="ค้นหา">
</form>

     <h4>&nbsp;&nbsp;รายการแจ้งซ่อม</h4>
     <?php
// เชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repair";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ค้นหาด้วยข้อมูลที่ผู้ใช้ป้อน
$search = isset($_POST["search"]) ? $_POST["search"] : "";

// แก้ไขส่วนของ SQL WHERE clause เพื่อไม่รวมสถานะ "จำหน่ายเสร็จสิ้น"
$sql = "SELECT rr.request_id, rr.request_date, dp.dp_name, CONCAT(u.u_fname, ' ', u.u_lname) AS user_name, rr.contact_number, et.et_name, rr.item, rr.equipment_number, rr.repair_details, rr.image_url, rr.user_id, b.brand_name, rs.rs_name AS status_name, CONCAT(t.u_fname, ' ', t.u_lname) AS technician_name
    FROM repair_requests rr
    JOIN department dp ON rr.department_id = dp.dp_id
    JOIN users u ON rr.user_id = u.u_id
    JOIN equipment_type et ON rr.equipment_type_id = et.et_id
    LEFT JOIN brand b ON rr.brand_id = b.brand_id
    LEFT JOIN repair_status rs ON rr.status_id = rs.rs_id
    LEFT JOIN users t ON rr.technician_id = t.u_id
    WHERE (rr.equipment_number LIKE '%$search%' OR rr.item LIKE '%$search%' OR rs.rs_name LIKE '%$search%') AND (rs.rs_name != 'เสร็จสมบูรณ์' AND rs.rs_name != 'รอจำหน่าย' AND rs.rs_name != 'จำหน่ายเสร้จสิ้น' OR rs.rs_name IS NULL)
    ORDER BY rr.request_id DESC";




$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>No.</th><th>วันที่</th><th>แผนก</th><th>ผู้ใช้</th><th>เบอร์ติดต่อ</th><th>หมายเลขอุปกรณ์</th><th>ประเภทอุปกรณ์</th><th>ยี่ห้อ</th><th>รายการ</th><th>รายละเอียดการซ่อม</th><th>รูป</th><th>ตรวจสอบแจ้งซ่อม</th><th>สถานะแจ้งซ่อม</th><th>ช่างผู้รับผิดชอบ</th><th>Action</th></tr>";
    $count = 1;

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $count . "</td>";
        echo "<td><center>" . $row["request_date"] . "</center></td>";
        echo "<td><center>" . $row["dp_name"] . "</center></td>";
        echo "<td><center>" . $row["user_name"] . "</center></td>";
        echo "<td><center>" . $row["contact_number"] . "</center></td>";
        echo "<td><center>" . $row["equipment_number"] . "</center></td>";
        echo "<td><center>" . $row["et_name"] . "</center></td>";
        echo "<td><center>" . $row["brand_name"] . "</center></td>";
        echo "<td><center>" . $row["item"] . "</center></td>";
        echo "<td><center>" . $row["repair_details"] . "</center></td>";

        // ตรวจสอบว่ามี URL รูปภาพหรือไม่
        if (!empty($row["image_url"])) {
            echo "<td><img src='{$row['image_url']}' alt='Equipment Image' class='thumbnail'></td>";
        } else {
            echo "<td>No Image</td>";
        }

        // Check Repair button
        echo "<td><center>";
        echo "<a href='check_repair.php?id=" . $row["request_id"] . "'><button type='button' class='check-again-button'>ตรวจสอบแจ้งซ่อม</button></a>";
        echo "</td>";

        echo "<td class='" . strtolower(str_replace(' ', '-', $row["status_name"])) . "-status'>";
        echo "<center>" . htmlspecialchars($row["status_name"]) . "</center>";
        echo "</td>";

        // แสดงชื่อช่างซ่อมและฟอร์มอัพเดทช่างซ่อม
        echo "<td><center>";
        echo htmlspecialchars($row["technician_name"]); // แสดงชื่อช่างซ่อม

        echo "<td><center>";

        if ($row["status_name"] != "เสร็จสมบูรณ์") {
            // Display the form to update status
            echo "<form method='post' action='update_status.php'>";
            echo "<select name='status'>";
            echo "<option value='' disabled selected>เลือกสถานะ</option>";
        
            // Fetch status data from the database
            $statusQuery = "SELECT * FROM repair_status";
            $statusResult = $conn->query($statusQuery);
        
            while ($statusRow = $statusResult->fetch_assoc()) {
                echo "<option value='{$statusRow['rs_id']}'>{$statusRow['rs_name']}</option>";
            }
        
            echo "</select>";
            echo "<input type='hidden' name='request_id' value='{$row["request_id"]}'>";
            echo "<input type='submit' value='อัพเดทสถานะ' style='background-color: #009900; color: #ffffff;'>";
            echo "</form>";

            // Display the form to update technician
            echo "<form method='post' action='update_technician.php'>";
            echo "<select name='technician_id'>";
            echo "<option value='' disabled selected>เลือกช่างซ่อม</option>";
        
            // Fetch technician data from the database
            $technicianQuery = "SELECT * FROM users WHERE u_type = 'ช่าง'";
            $technicianResult = $conn->query($technicianQuery);
        
            while ($technicianRow = $technicianResult->fetch_assoc()) {
                echo "<option value='{$technicianRow['u_id']}'>{$technicianRow['u_fname']} {$technicianRow['u_lname']}</option>";
            }
        
            echo "</select>";
            echo "<input type='hidden' name='request_id' value='{$row["request_id"]}'>";
            echo "<input type='submit' value='อัพเดทช่างผู้รับผิดชอบ' style='background-color: #009900; color: #ffffff;'>";
            echo "</form>";
          
        }

        // Display the button for editing
        echo "<a href='edit_repair.php?id=" . $row["request_id"] . "'><button type='button' class='edit-button'>แก้ไข</button></a>";

        // Display the button for deletion
        echo "&nbsp;";
        echo "<button type='button' class='delete-button' onclick='confirmDelete(" . $row["request_id"] . ")'>ลบ</button>";

        echo "</td>";
        echo "</tr>";

        $count++;
    }

    echo "</table>";
} else {
    echo "ไม่พบข้อมูล";
}

$conn->close();
?>