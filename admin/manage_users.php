<?php include 'public/layout.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipment Types</title>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
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
            background-color: #1b02a8;
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

        #qrcode {
            margin-top: 20px;
            text-align: center;
        }

        #qrcode img {
            max-width: 200px;
            max-height: 200px;
        }
    </style>
</head>
<body>
<center><h4>จัดการข้อมูลผู้ใช้</h4></center>
<form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="search">ค้นหา &nbsp;</label>
    <input type="text" id="search" name="search" placeholder="ป้อน...ที่ต้องการ">
    <input type="submit" value="ค้นหา">
</form>

<?php
// รวมรหัสการเชื่อมต่อฐานข้อมูลที่นี่
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repair";

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

// สร้างคำสั่ง SQL เพื่อดึงข้อมูลผู้ใช้และชื่อแผนก
$sql = "SELECT users.u_id, users.u_fname, users.u_lname, users.u_email, users.u_status, users.u_type, department.dp_name 
        FROM users
        INNER JOIN department ON users.u_dp_id = department.dp_id";

// ถ้ามีการส่งค่าการค้นหามา
if(isset($_GET['search']) && !empty($_GET['search'])) {
    // ใช้ค่าจากฟอร์มค้นหา
    $search = $_GET['search'];
    // เพิ่มเงื่อนไข WHERE ใน SQL
    $sql .= " WHERE users.u_fname LIKE '%$search%' OR users.u_lname LIKE '%$search%' OR users.u_email LIKE '%$search%' OR department.dp_name LIKE '%$search%' OR users.u_type LIKE '%$search%'";
}

$result = $conn->query($sql);

// ตรวจสอบว่ามีข้อมูลหรือไม่
if ($result->num_rows > 0) {
    // แสดงข้อมูลในตาราง
    echo "<table border='1'>";
    echo "<tr><th>รหัสผู้ใช้</th><th>ชื่อ</th><th>นามสกุล</th><th>อีเมล</th><th>สถานะ</th><th>ประเภท</th><th>แผนก</th><th>แก้ไข</th><th>ลบ</th><th>แก้รหัส</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["u_id"] . "</td>";
        echo "<td>" . $row["u_fname"] . "</td>";
        echo "<td>" . $row["u_lname"] . "</td>";
        echo "<td>" . $row["u_email"] . "</td>";
        echo "<td>" . $row["u_status"] . "</td>";
        echo "<td>" . $row["u_type"] . "</td>";
        echo "<td>" . $row["dp_name"] . "</td>";
        echo "<td><a href='edit_manage_users.php?id={$row['u_id']}'><button style='background-color: #1b02a8; color: white; padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s;'>แก้ไข</button></a></td>";
        echo "<td><a href='#' onclick='deleteusers({$row['u_id']})'><button style='background-color: #e74c3c; color: white; padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s;'>ลบ</button></a></td>";  
        echo "<td><a href='../forgot_password.php?id={$row['u_id']}'><button style='background-color: #FF7F50; color: white; padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s;'>เปลี่ยนรหัสผ่าน</button></a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "ไม่พบข้อมูลผู้ใช้";
}
// ปิดการเชื่อมต่อ
$conn->close();
?>
<script>
    function confirmDelete() {
        return confirm('คุณแน่ใจหรือไม่ที่จะลบข้อมูลนี้?');
    }

    function deleteusers(uId) {
        if (confirmDelete()) {
            // ส่งคำขอลบไปยัง PHP โดยใช้ XMLHttpRequest
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // อัปเดตหน้าเว็บหลังจากการลบข้อมูล
                    location.reload();
                }
            };
            xhr.open("GET", "delete_users.php?id=" + uId, true);
            xhr.send();
        }
    }
</script>
</body>
</html>