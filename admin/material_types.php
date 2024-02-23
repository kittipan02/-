<?php
$search = "";
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    $search = $_GET['search'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Material Types</title>
    <?php include 'public/layout.php'; ?>
    <style>

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
            background-color: #A0A0A0; 
            color: white;
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
        .edit-button, .delete-button {
            padding: 5px 10px;
            margin: 5px;
            text-decoration: none;
            color: #fff;
            border-radius: 3px;
            display: inline-block;
        }

        .edit-button {
            background-color: #1b02a8; /* สีน้ำเงิน */
        }

        .delete-button {
            background-color: #dc3545; /* สีแดง */
        }
        * {
  margin: 0;
  padding: 0;
  font-family: sans-serif;
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
  border-radius: 2px;
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

    <!-- เพิ่มฟอร์มค้นหา -->
    <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="search">ค้นหา &nbsp;</label>
        <input type="text" id="search" name="search" placeholder="ป้อนคำค้นหา" value="<?php echo $search; ?>">
        <input type="submit" value="ค้นหา">
    </form>

    <!-- เพิ่มปุ่มเพิ่มประเภทวัสดุ -->
    <a href="add_material.php">
        <button type="button" style="background-color: #1b02a8; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s;">
            เพิ่มประเภทวัสดุ
        </button>
    </a>

    <!-- โค้ด PHP เพื่อดึงข้อมูลจากฐานข้อมูล -->
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "repair";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $per_page = 20; // จำนวนรายการต่อหน้า

    // คำนวณจำนวนแถวทั้งหมด
// คำนวณจำนวนแถวทั้งหมด
$sql = "SELECT COUNT(*) AS total FROM material LEFT JOIN type_material ON mt_tm_id=tm_id LEFT JOIN detail_material ON mt_dm_id=dm_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_rows = $row['total'];

// คำนวณจำนวนหน้าทั้งหมด
$total_pages = ceil($total_rows / $per_page);

// ตรวจสอบหากไม่ได้กำหนดหน้าใด ๆ ให้ใช้หน้าแรก
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// คำนวณการกำหนด LIMIT สำหรับคำสั่ง SQL
$offset = ($current_page - 1) * $per_page;
$counter = $offset + 1;
// เพิ่ม LIMIT และ OFFSET เข้าไปในคำสั่ง SQL
$sql = "SELECT * FROM material LEFT JOIN type_material ON mt_tm_id=tm_id LEFT JOIN detail_material ON mt_dm_id=dm_id LIMIT $per_page OFFSET $offset";
$result = $conn->query($sql);

    ?>
    <!-- แสดงตาราง -->
    <?php if ($result->num_rows > 0): ?>
        <table>
    <tr>
        <th>ลำดับ</th>
        <th>ประเภทวัสดุ</th>
        <th>ลักษณะวัสดุ</th>
        <th>ชื่อวัสดุ</th>
        <th>แก้ไข</th>
        <th>ลบ</th>
    </tr>
    <?php if ($result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $counter; ?></td>
            <td><?php echo $row['tm_name']; ?></td>
            <td><?php echo $row['dm_name']; ?></td>
            <td><?php echo $row['mt_name']; ?></td>
            <td class="action-buttons">
                <a href="edit_material.php?id=<?php echo $row['mt_id']; ?>" class="edit-button">แก้ไข</a>
            </td>
            <td class="action-buttons">
                <a href="delete_material.php?id=<?php echo $row['mt_id']; ?>" class="delete-button" onclick="return confirmDelete()">ลบ</a>
            </td>
        </tr>
        <?php $counter++; ?>
    <?php endwhile; ?>
<?php else: ?>
    <tr>
        <td colspan="6"><p>No data found.</p></td>
    </tr>
<?php endif; ?>
</table>
    <?php else: ?>
        <p>No data found.</p>
    <?php endif; ?>

    <?php $conn->close(); ?>

    <script>
    function confirmDelete() {
        return confirm("คุณแน่ใจที่จะลบวัสดุนี้หรือไม่?");
    }
    </script>
    <br>

    <!-- โค้ดข้อมูลที่ต้องการแสดง -->
</div>

<!-- ลิงก์ pagination -->
<div class="container">
    <ul class="pagination">
    <?php
$total_pages = ceil($total_rows / 20); // 20 คือจำนวนรายการต่อหน้า

// ตรวจสอบว่ามีมากกว่าหนึ่งหน้าเพื่อแสดงลิงก์
if ($total_pages > 1) {
// ลิงก์ "First"
if ($current_page > 1) {
    echo '<li><a href="?search=' . urlencode($search) . '&page=1">First</a></li>';
}

// ลิงก์ "Previous"
if ($current_page > 1) {
    echo '<li><a href="?search=' . urlencode($search) . '&page=' . ($current_page - 1) . '">Previous</a></li>';
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

    // ลิงก์หน้าสุดท้าย
    echo '<li><a href="?search=' . urlencode($search) . '&page=' . $total_pages . '">' . $total_pages . '</a></li>';

    // ลิงก์ "Next"
    if ($current_page < $total_pages) {
        echo '<li><a href="?search=' . urlencode($search) . '&page=' . ($current_page + 1) . '">Next</a></li>';
    }
}
?>
    </ul>
</div>

</body>
</html>
