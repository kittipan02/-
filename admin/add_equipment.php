<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มครุภัณฑ์</title>
    <?php include 'public/layout.php'; ?>
    <!-- รวมสไตล์หรือสคริปต์ที่จำเป็น -->
    <style>
         body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f8f8;
        }

        h2 {
            color: #1b02a8;
        }

        form {
            max-width: 500px;
            margin: 20px auto;
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 10px 0 5px;
            color: #333;
        }

        input, textarea, select {
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
        h4 {
            color: #000;
        }
    </style>
</head>
<body>

    <center><h4>เพิ่มประเภทครุภัณฑ์</h4></center>

    <form method="post" action="process_add_equipment.php" enctype="multipart/form-data">
        <label for="et_number">รหัสครุภัณฑ์:</label>
        <input type="text" id="et_number" name="et_number" required>

        <label for="et_name">ประเภทครุภัณฑ์:</label>
        <input type="text" id="et_name" name="et_name" required>

        <label for="it_name">รายการ:</label>
        <input type="text" id="it_name" name="it_name" required>

        <label for="brand_name">ยี่ห้อ:</label>
        <input type="text" id="brand_name" name="brand_name">

        <label for="itd_name">รายละเอียด:</label>
        <textarea id="itd_name" name="itd_name" rows="4" required></textarea>

        <label for="unit_id">แบบ/ชนิด/ลักษณะ:</label>
    <select id="unit_id" name="unit_id" required>
    <?php
    // ตัวอย่างการเชื่อมต่อฐานข้อมูล
    $conn = new mysqli("localhost", "root", "", "repair");

    // ตรวจสอบการเชื่อมต่อ
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // คำสั่ง SQL สำหรับดึงข้อมูลหน่วยนับ
    $sql = "SELECT * FROM unit";
    $result = $conn->query($sql);

    // แสดงตัวเลือกสำหรับหน่วยนับ
    while ($row = $result->fetch_assoc()) {
        echo "<option value='{$row['un_id']}'>{$row['un_name']}</option>";
    }

    // ปิดการเชื่อมต่อ
    $conn->close();
    ?>
</select>
        <label for="itd_price">ราคา:</label>
        <input type="text" id="itd_price" name="itd_price" >

        <label for="itd_image">รูปภาพ:</label>
        <input type="file" id="itd_image" name="itd_image" accept="image/*">

        <input type="submit" value="เพิ่มครุภัณฑ์">
    </form>

    <!-- รวมเนื้อหาหรือสคริปต์เพิ่มเติมตามต้องการ -->

</body>
</html>