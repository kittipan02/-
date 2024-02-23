<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Head of Department Information</title>
    <?php include 'public/layout.php'; ?>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f8f8;
            color: #333;
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

    </style>
</head>
<body>
    
<form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="search">ค้นหา &nbsp;</label>
    <input type="text" id="search" name="search" placeholder="ป้อนคำค้นหา" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
    <input type="submit" value="ค้นหา">
</form>

<a href="add_headofdepartment.php">
    <button type="button" style="background-color: #1b02a8; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s;">
        เพิ่มข้อมูลพนักงาน
    </button>
</a>

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

// Initialize $search
$search = isset($_GET['search']) ? $_GET['search'] : '';

// SQL query
$sql = "SELECT h.head_id, h.department_id, h.first_name, h.last_name, h.position, d.dp_name 
        FROM headofdepartment h
        LEFT JOIN department d ON h.department_id = d.dp_id
        WHERE h.head_id LIKE '%$search%' 
           OR d.dp_name LIKE '%$search%' 
           OR h.first_name LIKE '%$search%' 
           OR h.last_name LIKE '%$search%' 
           OR h.position LIKE '%$search%'";
         

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Display results in a table
    echo "<table>";
    echo "<tr><th>รหัสพนักงาน</th><th>แผนก</th><th>ชื่อ</th><th>นามสกุล</th><th>ตำแหน่ง</th><th>แก้ไข</th><th>ลบ</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["head_id"] . "</td>";
        echo "<td>" . $row["dp_name"] . "</td>";
        echo "<td>" . $row["first_name"] . "</td>";
        echo "<td>" . $row["last_name"] . "</td>";
        echo "<td>" . $row["position"] . "</td>";
        echo "<td>";
        echo "<a href='edit_headofdepartment.php?id={$row['head_id']}'><button style='background-color: #1b02a8; color: white; padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s;'>แก้ไข</button></a>";
        echo "</td>";
        echo "<td>";
        echo "<a href='delete_headofdepartment.php?id={$row['head_id']}' onclick='return confirm(\"คุณต้องการลบข้อมูลนี้หรือไม่?\")'><button style='background-color: #e74c3c; color: white; padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s;'>ลบ</button></a>";
        echo "</td>";
        
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "ไม่พบข้อมูลในตาราง";
}

$conn->close();
?>

</body>
</html>
