<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Material</title>
    <?php include 'public/layout.php'; ?>
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

        input[type="submit"] {
            background-color: #1b02a8;
            color: #fff;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            padding: 10px;
            width: 100%;
            transition: background-color 0.3s, color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
       
    </style>
</head>
<body>
    <main>
        <h4>เพิ่มประเภทวัสดุ</h4>
        <form method="post" action="process_add_material.php">

            <label for="mt_tm_id">ประเภทวัสดุ</label>
            <select id="mt_tm_id" name="mt_tm_id" >
                <?php
                // เชื่อมต่อกับฐานข้อมูล
                $conn = new mysqli("localhost", "root", "", "repair");

                // ตรวจสอบการเชื่อมต่อ
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // คำสั่ง SQL สำหรับดึงข้อมูลแผนก
                $sql = "SELECT * FROM type_material";
                $result = $conn->query($sql);

                // แสดงตัวเลือกสำหรับแผนก
                while ($row = $result->fetch_assoc()) {
                    echo "<option value=".$row['tm_id'].">".$row['tm_name']."</option>";
                    //echo "<option value='{$row['tm_id ']}'>{$row['tm_name']}</option>";
                }

                // ปิดการเชื่อมต่อ
                $conn->close();
                ?>
            </select>
            <label for="mt_dm_id">ลักษณะวัสดุ</label>
            <select id="mt_dm_id" name="mt_dm_id" >
                <?php
                // เชื่อมต่อกับฐานข้อมูล
                $conn = new mysqli("localhost", "root", "", "repair");

                // ตรวจสอบการเชื่อมต่อ
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // คำสั่ง SQL สำหรับดึงข้อมูลแผนก
                $sql = "SELECT * FROM detail_material";
                $result = $conn->query($sql);

                // แสดงตัวเลือกสำหรับแผนก
                while ($row = $result->fetch_assoc()) {
                    echo "<option value=".$row['dm_id'].">".$row['dm_name']."</option>";
                }

                // ปิดการเชื่อมต่อ
                $conn->close();
                ?>
            </select>

            <label for="mt_name">ชื่อวัสดุ</label>
            <input type="text" id="mt_name" name="mt_name" required><br><br>

            <input type="submit" value="เพิ่มรายการ">
        </form>
    </main>
</body>
</html>
