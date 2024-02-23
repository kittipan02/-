<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipment Types</title>
    <?php include 'public/layout.php'; ?>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <style>
        select, input {
        width: 185px;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        box-sizing: border-box;
    }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            padding: 10px;
            text-align: center;
        }

        form {
            text-align: center;
            margin-top: 20px;
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

        #qrcode {
            margin-top: 20px;
            text-align: center;
        }

        #qrcode img {
            max-width: 200px;
            max-height: 200px;
        }
        .product-price-btn button {
        display: inline-block;
        height: 50px;
        width: 176px;
        margin: 0 40px 0 16px;
        box-sizing: border-box;
        border: transparent;
        border-radius: 60px;
        font-family: 'Raleway', sans-serif;
        font-size: 14px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.2em;
        color: #ffffff;
        background-color: #000;
        cursor: pointer;
        outline: none;
        }

.product-price-btn button:hover {
  background-color: #79b0a1;
}
* {
  margin: 0;
  padding: 0;
  font-family: sans-serif;
}
.container {
  display: flex;
  justify-content: center;
  align-items: center;
 
}
.container .pagination {
  position: relative;
  height: 60px;
  background: rgba(255, 255, 255, 0.05);
  box-shadow: 5px 5px 30px rgba(0, 0, 0, 0.3);
  display: flex;
  align-items: center;
  justify-content: center;
  backdrop-filter: blur(3px);
  border-radius: 8px;
}
.container .pagination li {
  list-style-type: none;
  display: inline-block;
}
.container .pagination li a {
  position: relative;
  padding: 20px 25px;
  text-decoration: none;
  color: #000;
  font-weight: 500;
}
.container .pagination li a:hover,
.container .pagination li.active a {
  background: rgba(255, 255, 255, 0.2);
}
select, input {
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        overflow: hidden;
        appearance: none;
        background: url('data:image/svg+xml;utf8,<svg fill="%23ccc" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/><path d="M0 0h24v24H0z" fill="none"/></svg>') no-repeat;
        background-position: calc(100% - 10px) center;
        background-size: 20px;
        cursor: pointer;
        transition: all 0.3s;
        outline: none;
        width: 200px;
    }

    select:hover {
        border-color: #888;
    }

    select:focus {
        border-color: #555;
    }
    </style>
</head>
<body>

<!-- เพิ่มส่วน form สำหรับค้นหา -->
<form style="text-align: center;" method="GET" action="">
    <select type="text" name="search" value="" placeholder="ค้นหา...">
    <option value='' disabled selected>ประเภทครุภัณฑ์</option>
        <option>ครุภัณฑ์การเกษตร</option>
        <option>ครุภัณฑ์สำนักงาน</option>
    </select>
    <button style="background-color: #000000; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s;" type="submit">ค้นหา</button>
</form>
<form style="text-align: center;" method="GET" action="">
    <input type="text" name="search" value="" placeholder="ค้นหา...">
    <button style="background-color: #000000; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s;" type="submit">ค้นหา</button>
</form>
<!-- เพิ่มลิงก์สำหรับเพิ่มประเภทครุภัณฑ์ -->
<a href="add_equipment.php">
    <button type="button" style="background-color: #1b02a8; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s;">
        เพิ่มประเภทครุภัณฑ์
    </button>
</a>

<!-- เพิ่ม input สำหรับรหัสครุภัณฑ์ -->
<input type="text" id="equipmentCode" placeholder="Enter Equipment Code">
<button style="background-color: #000000; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s;" onclick="generateQRCode()">Generate QR Code</button>
<!-- ส่วนที่ใช้แสดง QR Code -->
<div id="qrcode"></div>

<!-- เริ่มต้นการแสดงผลข้อมูลจากฐานข้อมูล -->
<?php
$per_page = 30; // ตั้งค่าจำนวนรายการต่อหน้า

// เชื่อมต่อกับฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repair";

$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อฐานข้อมูล
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search = ""; // กำหนดค่าเริ่มต้นให้กับ $search

// ตรวจสอบว่ามีการส่งคำค้นหามาหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["search"])) {
    // กำหนดค่าคำค้นหาให้กับตัวแปร $search
    $search = mysqli_real_escape_string($conn, $_GET["search"]);
}

// เริ่มต้นส่วนการสร้างคำสั่ง SQL
$sql = "SELECT * FROM equipment_type 
        LEFT JOIN unit ON equipment_type.un_id = unit.un_id";

// ตรวจสอบว่ามีการค้นหาหรือไม่
if (!empty($search)) {
    $sql .= " WHERE et_number LIKE '%$search%' OR et_name LIKE '%$search%' OR it_name LIKE '%$search%' OR itd_name LIKE '%$search%' OR unit.un_name LIKE '%$search%' OR itd_price LIKE '%$search%' OR brand_name LIKE '%$search%'";
}

// ดำเนินการคำนวณจำนวนหน้าทั้งหมด
$result = $conn->query($sql);
$total_rows = $result->num_rows;

// คำนวณจำนวนหน้าทั้งหมด
$total_pages = ceil($total_rows / $per_page);

// ตรวจสอบหากไม่ได้กำหนดหน้าใด ๆ ให้ใช้หน้าแรก
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// คำนวณการกำหนด LIMIT สำหรับคำสั่ง SQL
$offset = ($current_page - 1) * $per_page;

// โค้ดสคริปต์ PHP สำหรับคำสั่ง SQL และการแสดงผล
$sql .= " LIMIT $per_page OFFSET $offset";
$result = $conn->query($sql);

// ตรวจสอบว่ามีข้อมูลหรือไม่
if ($result->num_rows > 0) {
    // เริ่มต้นส่วนแสดงผลตาราง
    ?>
    <table>
        <tr>
            <th>ลำดับ</th>
            <th>รหัสครุภัณฑ์</th>
            <th>ประเภทครุภัณฑ์</th>
            <th>รายการ</th>
            <th>ยี่ห้อ</th>
            <th>รายละเอียด</th>
            <th>หน่วยนับ</th>
            <th>ราคา</th>
            <th>รูปภาพ</th>
            <th>เพิ่มเติม</th>
        </tr>
    <?php
    $counter = $offset + 1;

    // วนลูปแสดงข้อมูล
    while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $counter; ?></td>
            <td><?php echo $row['et_number']; ?></td>
            <td><?php echo $row['et_name']; ?></td>
            <td><?php echo $row['it_name']; ?></td>
            <td><?php echo $row['brand_name']; ?></td>
            <td><?php echo $row['itd_name']; ?></td>
            <td><?php echo $row['un_name']; ?></td>
            <td><?php echo $row['itd_price']; ?></td>
            <td><img src='<?php echo $row['itd_image']; ?>' alt='Equipment Image' style='max-width: 150px; max-height: 150px; display: block; margin-left: auto; margin-right: auto;'></td>
            <td class="action-buttons" style="text-align: center;">
                <a href="edit_equipment.php?id=<?php echo $row['et_id']; ?>" class="btn">แก้ไข</a>
                <a href='#' onclick='deleteEquipment(<?php echo $row["et_id"]; ?>)' onclick="return confirmDelete()" style="background-color: red;" class="btn">ลบ</a>
                <br>
                <div class="product-price-btn" style="margin-top: 10px;">
                    <a href='check_status_page.php?et_number=<?php echo $row['et_number']; ?>'><button type='button' class='check-status-button'>ตรวจสอบทะเบียน</button></a>
                </div>
            </td>
        </tr>
        <?php
        $counter++; // เพิ่มค่าตัวแปร counter
    }
    ?>
    </table>
    <br>
    <?php
} else {
    echo "<p>No data found.</p>";
}

// แสดงลิงค์ Pagination
if ($total_pages > 1) {
    ?>
    <div class="container">
        <ul class="pagination">
            <?php
            // ลิงค์ไปยังหน้าแรก
            echo '<li><a href="?search=' . urlencode($search) . '&page=1">First</a></li>';
            // ลิงค์ไปยังหน้าก่อนหน้า
            if ($current_page > 1) {
                $prev_page = $current_page - 1;
                echo '<li><a href="?search=' . urlencode($search) . '&page=' . $prev_page . '">Previous</a></li>';
            }
            // แสดงลิงค์หน้า
            for ($page = 1; $page <= $total_pages; $page++) {
                echo '<li><a href="?search=' . urlencode($search) . '&page=' . $page . '" class="' . ($current_page == $page ? 'active' : '') . '">' . $page . '</a></li>';
            }
            // ลิงค์ไปยังหน้าถัดไป
            if ($current_page < $total_pages) {
                $next_page = $current_page + 1;
                echo '<li><a href="?search=' . urlencode($search) . '&page=' . $next_page . '">Next</a></li>';
            }
            // ลิงค์ไปยังหน้าสุดท้าย
            echo '<li><a href="?search=' . urlencode($search) . '&page=' . $total_pages . '">Last</a></li>';
            ?>
        </ul>
    </div>
    <?php
}

$conn->close();
?>


<!-- โค้ดสคริปต์ JavaScript -->
<script>
    function confirmDelete() {
        return confirm('คุณแน่ใจหรือไม่ที่จะลบข้อมูลนี้?');
    }

    function deleteEquipment(etId) {
        if (confirmDelete()) {
            // ส่งคำขอลบไปยัง PHP โดยใช้ XMLHttpRequest
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // อัปเดตหน้าเว็บหลังจากการลบข้อมูล
                    location.reload();
                }
            };
            xhr.open("GET", "delete_equipment.php?id=" + etId, true);
            xhr.send();
        }
    }

    function generateQRCode() {
        // ดึงค่ารหัสครุภัณฑ์จาก input
        var equipmentCode = document.getElementById('equipmentCode').value;

        // สร้าง QR Code
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            width: 200,
            height: 200
        });

        // สร้างลิงก์หรือข้อมูลที่ต้องการแปลงเป็น QR Code
        var qrData = "10.60.52.55/repair/user/repair_requests.php?search=" + encodeURIComponent(equipmentCode);

        // สร้าง QR Code จากข้อมูล
        qrcode.makeCode(qrData);
    }
</script>

</body>
</html>
