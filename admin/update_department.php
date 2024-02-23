<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Department</title>
    <?php include 'public/layout.php'; ?>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f8f8;
        }

        header {
            background-color: #1b02a8;
            color: white;
            padding: 20px;
            text-align: center;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        header img {
            width: 100px;
            height: auto;
            border-radius: 50%;
            border: 2px solid white;
        }

        nav {
            background-color: #333;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }

        nav a {
            text-decoration: none;
            color: white;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
            margin: 0 10px;
            font-weight: bold;
            position: relative;
            overflow: hidden;
        }

        nav a:hover {
            background-color: #1b02a8;
            color: #fff;
        }

        nav a::before {
            content: "";
            position: absolute;
            width: 100%;
            height: 3px;
            background-color: #1b02a8;
            bottom: 0;
            left: 0;
            transform: scaleX(0);
            transform-origin: bottom right;
            transition: transform 0.3s;
        }

        nav a:hover::before {
            transform: scaleX(1);
            transform-origin: bottom left;
        }

        main {
            padding: 20px;
            text-align: center;
        }
        

        h3 {
            color: #000;
        }

        p {
            font-size: 16px;
            color: #555;
        }

        form {
            width: 50%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        label, input, input[type="submit"] {
            font-size: 14px;
            margin: 10px 0;
            padding: 8px;
            border-radius: 4px;
            display: block;
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
  
        label {
            font-weight: bold;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <main>
        <h3>แก้ไขแผนก</h3>
        <?php
        // ตรวจสอบว่ามีการส่งค่า department_id มาหรือไม่
        if (isset($_GET['department_id']) && is_numeric($_GET['department_id'])) {
            $department_id = $_GET['department_id'];

            // เชื่อมต่อฐานข้อมูล
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "repair";

            $conn = new mysqli($servername, $username, $password, $dbname);

            // ตรวจสอบการเชื่อมต่อ
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // ดึงข้อมูลแผนกจากฐานข้อมูล
            $sql = "SELECT dp_name, employee_name, position_title FROM position WHERE dp_id = $department_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $dp_name = $row['dp_name'];
                $employee_name = $row['employee_name'];
                $position_title = $row['position_title'];
        ?>
                <!-- ให้ action ของ form เป็น update_department_process.php และใส่ department_id เป็น hidden field -->
                <form method="post" action="update_department_process.php">
                    <input type="hidden" name="department_id" value="<?php echo $department_id; ?>">
                    <label for="dp_name">ชื่อแผนก: <input type="text" id="dp_name" name="dp_name" value="<?php echo $dp_name; ?>" required></label>
                    <label for="employee_name">ชื่อ-นามสกุล: <input type="text" id="employee_name" name="employee_name" value="<?php echo $employee_name; ?>" required></label>
                    <label for="position_title">ตำแหน่ง: <input type="text" id="position_title" name="position_title" value="<?php echo $position_title; ?>" required></label>
                    <input type="submit" value="บันทึกการแก้ไข">
                </form>
        <?php
            } else {
                echo "<p>ไม่พบข้อมูลแผนก</p>";
            }

            // ปิดการเชื่อมต่อ
            $conn->close();
        } else {
            echo "<p>ไม่พบรหัสแผนกที่ต้องการแก้ไข</p>";
        }
        ?>
    </main>
</body>
</html>
