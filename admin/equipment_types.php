<?php
$search = "";
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    $search = $_GET['search'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'public/layout.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipment Types</title>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <link href="https://dribbble.com/shots/2338943-Day-12-E-commerce-Single-item">
    <link href="https://fonts.googleapis.com/css?family=Bentham|Playfair+Display|Raleway:400,500|Suranna|Trocchi" rel="stylesheet">
    <style>
        #qrcode {
            margin-top: 20px;
            text-align: center;
        }

        #qrcode img {
            max-width: 200px;
            max-height: 200px;
        }
        body {
  background-color: #F0F0F0;
}

.wrapper {
  height: 420px;
  width: 654px;
  margin: 50px auto;
  border-radius: 7px 7px 7px 7px;
  -webkit-box-shadow: 0px 14px 32px 0px rgba(0, 0, 0, 0.15);
  -moz-box-shadow: 0px 14px 32px 0px rgba(0, 0, 0, 0.15);
  box-shadow: 0px 14px 32px 0px rgba(0, 0, 0, 0.15);
}

.product-img {
  float: center;
  height: 420px;
  width: 327px;
}

.product-img img {
  border-radius: 7px 0 0 7px;
}

.product-info {
  float: center;
  height: 420px;
  width: 327px;
  border-radius: 0 7px 10px 7px;
  background-color: #ffffff;
}

.product-text {
  height: 300px;
  width: 327px;
}
.product-text h1,
.product-price-btn p {
  font-family: 'Bentham', serif;
}

.product-text h1 {
  margin: 0 0 0 20px; /* ปรับระยะห่างด้านซ้ายของ h1 */
  padding-top: 30px; /* ลดระยะห่างด้านบนของ h1 */
  font-size: 28px; /* ลดขนาดข้อความของ h1 */
}

.product-text h2 {
  margin: 0 0 10px 20px; /* ปรับระยะห่างด้านซ้ายของ h2 */
  font-size: 20px; /* ลดขนาดข้อความของ h2 */
}

.product-text p {
  height: 40px;
  margin: 0 0 0 38px;
  font-family: 'Playfair Display', serif;
  color: #474747;
  line-height: 1.7em;
  font-size: 15px;
  font-weight: lighter;
  overflow: hidden;
}

.product-price-btn {
  height: 103px;
  width: 327px;
  margin-top: 10px;
  position: relative;
}

.product-price-btn p {
  display: inline-block;
  position: absolute;
  top: -13px;
  height: 50px;
  font-family: 'Trocchi', serif;
  margin: 0 0 0 38px;
  font-size: 28px;
  font-weight: lighter;
  color: #474747;
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
  background-color: #9cebd5;
  cursor: pointer;
  outline: none;
}

.product-price-btn button:hover {
  background-color: #79b0a1;
}
.product-wrapper {
    display: flex;
    margin-bottom: 20px; /* เพิ่มระยะห่างด้านล่างของแต่ละ row */
}

.product-img {
    text-align: center;
    flex: 0;
}

.product-info {
    flex: 2; /* ปรับขนาดของส่วนข้อมูลสินค้าให้มีขนาดใหญ่ขึ้น */

}
select, input {
        width: 185px;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        box-sizing: border-box;
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
    </style>
</head>
<body>
    <a href="add_equipment.php">
        <button type="button" style="background-color: #1b02a8; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s;">
            เพิ่มประเภทครุภัณฑ์
        </button>
    </a><br>
    <!-- สร้าง input เพื่อให้ผู้ใช้ป้อนรหัสครุภัณฑ์ -->
    <input type="text" id="equipmentCode" placeholder="Enter Equipment Code">
    <button style="background-color: #000000; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s;" onclick="generateQRCode()">Generate QR Code</button>
    <!-- ส่วนที่ใช้แสดง QR Code -->
    <div id="qrcode"></div>
<?php
// เชื่อมต่อกับฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repair";

$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$per_page = 20; // จำนวนรายการต่อหน้า

// โค้ด PHP สำหรับการค้นหา
$search = "";
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["search"])) {
    $search = mysqli_real_escape_string($conn, $_GET["search"]); // เพื่อป้องกัน SQL Injection
}

// คำสั่ง SQL สำหรับนับจำนวนรายการทั้งหมด
$count_sql = "SELECT COUNT(*) AS total FROM equipment_type 
              LEFT JOIN unit ON equipment_type.un_id = unit.un_id 
              WHERE et_number LIKE '%$search%' OR et_name LIKE '%$search%' OR it_name LIKE '%$search%' OR itd_name LIKE '%$search%' OR unit.un_name LIKE '%$search%' OR itd_price LIKE '%$search%' OR brand_name LIKE '%$search%'";

$result = $conn->query($count_sql);
$row = $result->fetch_assoc();
$total_rows = $row['total'];
$total_pages = ceil($total_rows / $per_page);

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// คำนวณ OFFSET สำหรับ LIMIT
$offset = ($current_page - 1) * $per_page;

// คำสั่ง SQL สำหรับดึงข้อมูลที่ตรงกับเงื่อนไขการค้นหา
$sql = "SELECT * FROM equipment_type 
        LEFT JOIN unit ON equipment_type.un_id = unit.un_id 
        WHERE et_number LIKE '%$search%' OR et_name LIKE '%$search%' OR it_name LIKE '%$search%' OR itd_name LIKE '%$search%' OR unit.un_name LIKE '%$search%' OR itd_price LIKE '%$search%' OR brand_name LIKE '%$search%' 
        LIMIT $per_page OFFSET $offset";

$result = $conn->query($sql);
?>

<!-- ส่วนของฟอร์มค้นหา -->
<form style="text-align: center;"  method="GET" action="">
    <input type="text" name="search" value="<?php echo $search; ?>" placeholder="ค้นหา...">
    <button style="background-color: #000000; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s;" type="submit">ค้นหา</button>
</form>

<?php
$counter = 1; // กำหนดค่าเริ่มต้นให้ $counter เป็น 1
if ($result->num_rows > 0) {
    // แสดงผลลัพธ์
    while ($row = $result->fetch_assoc()) {
        $et_number = $row["et_number"];
        ?>
        <div class="container">
<div class="row">
    <div class="col-md-6 text-center">
        <div class="product-wrapper">
            <div class="product-img">
                <img src="<?php echo $row['itd_image']; ?>" height="420" width="327">
            </div>
            <div class="product-info">
                <div class="product-text">
                <h1><?php echo $row['et_name']; ?></h1><br>
                    <h2>เลขพัสดุ : <?php echo $row['et_number']; ?></h2>
                    <p>ยี่ห้อ : <?php echo $row['brand_name']; ?></p>
                    <p>หน่วยนับ : <?php echo $row['un_name']; ?></p>
                    <p>รายการ : <?php echo $row['itd_name']; ?></p>
                    <h5>ราคา : <?php echo $row['itd_price']; ?> บาท</h5>
                    <a href="edit_equipment.php?id=<?php echo $row['et_id']; ?>" class="btn">แก้ไข</a>
                    <a href='#' onclick='deleteEquipment(<?php echo $row["et_id"]; ?>)' onclick="return confirmDelete()" style="background-color: red;" class="btn">ลบ</a>
                </div>
                <div class="product-price-btn"><br>
                    <a href='check_status_page.php?et_number=<?php echo $et_number; ?>'><button type='button' class='check-status-button'>ตรวจสอบรายการ</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
        <?php
    }
} else {
    echo "0 results";
}
?>

<!-- แสดงลิงก์ Pagination -->
<div class="container">
    <ul class="pagination">
    <?php
// แสดงลิงก์ Pagination
if ($total_pages > 1) {
    // ลิงก์ "First"
    if ($current_page > 1) {
        echo "<li><a href='?search=".urlencode($search)."&page=1'>First</a></li>";
    }

    // ลิงก์ "Previous"
    if ($current_page > 1) {
        $previous_page = $current_page - 1;
        echo "<li><a href='?search=".urlencode($search)."&page=$previous_page'>Previous</a></li>";
    }

    // แสดงลิงก์หน้า
    $max_pages = 5; // จำนวนหน้าสูงสุดที่จะแสดง
    $start_page = max(1, $current_page - 2); // หน้าแรกที่จะแสดง
    $end_page = min($start_page + $max_pages - 1, $total_pages); // หน้าสุดท้ายที่จะแสดง

    // แสดงลิงก์หน้า
    for ($page = $start_page; $page <= $end_page; $page++) {
        echo '<li><a href="?search=' . urlencode($search) . '&page=' . $page . '" class="' . ($current_page == $page ? 'active' : '') . '">' . $page . '</a></li>';
    }

    // ลิงก์จุดจบ (...) ถ้าหน้าสุดท้ายยังไม่ถึง
    if ($end_page < $total_pages) {
        echo '<li><span>...</span></li>';
    }
    // ลิงก์ "Next"
    if ($current_page < $total_pages) {
        $next_page = $current_page + 1;
        echo "<li><a href='?search=".urlencode($search)."&page=$next_page'>Next</a></li>";
    }

    // ลิงก์ "Last"
    if ($current_page < $total_pages) {
        echo "<li><a href='?search=".urlencode($search)."&page=$total_pages'>Last</a></li>";
    }
}
?>
    </ul>
</div>

<?php
// ปิดการเชื่อมต่อฐานข้อมูล
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