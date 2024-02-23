<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลครุภัณฑ์</title>
    
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f8f8;
            color: #333;
        }

        h2 {
            color: #1b02a8;
            margin-bottom: 20px;
        }
      

        form {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 30px;
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

        img {
            max-width: 50%;
            height: auto;
            margin-top: 10px;
        }

        input[type="file"] {
            margin-top: 10px;
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
       
    </style>

<body <?php include 'public/layout.php'; ?>>
<center><h4>แก้ไขข้อมูลครุภัณฑ์</h4></center>
    <?php
        if (isset($_GET['id'])) {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "repair";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $et_id = mysqli_real_escape_string($conn, $_GET['id']);
            $sql = "SELECT * FROM equipment_type WHERE et_id = $et_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
    ?>
 

 <div class="container">
 <form method="post" action="process_edit_equipment.php" enctype="multipart/form-data">
        <input type="hidden" name="et_id" value="<?php echo $row['et_id']; ?>">
        <div class="form-group">
        <label for="et_number">Equipment Number:</label><br>
        <input type="text" id="et_number" name="et_number" value="<?php echo $row['et_number']; ?>"><br>
        </div>
            <div class="form-group">
                <label for="et_name">ประเภทครุภัณฑ์:</label>
                <input type="text" class="form-control" id="et_name" name="et_name" value="<?php echo $row['et_name']; ?>" required>
            </div>

            <div class="form-group">
                <label for="it_name">รายการ:</label>
                <input type="text" class="form-control" id="it_name" name="it_name" value="<?php echo $row['it_name']; ?>" required>
            </div>

            <div class="form-group">
            <label for="brand_name">ยี่ห้อ:</label>
            <input type="text" class="form-control" id="brand_name" name="brand_name" value="<?php echo $row['brand_name']; ?>">
            </div>

            <div class="form-group">
                <label for="itd_name">รายละเอียด:</label>
                <textarea class="form-control" id="itd_name" name="itd_name" rows="4" required><?php echo $row['itd_name']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="un_id">หน่วยนับ:</label>
                <!-- ดึงข้อมูลหน่วยนับจากตาราง unit และแสดงใน dropdown list -->
                <select id="un_id" name="un_id" class="form-control" required>
                    <?php
                        // ดึงข้อมูลหน่วยนับจากตาราง unit
                        $sql_unit = "SELECT un_id, un_name FROM unit";
                        $result_unit = $conn->query($sql_unit);

                        // แสดงข้อมูลใน dropdown list
                        while ($row_unit = $result_unit->fetch_assoc()) {
                            $selected = ($row['un_id'] == $row_unit['un_id']) ? 'selected' : '';
                            echo "<option value='{$row_unit['un_id']}' $selected>{$row_unit['un_name']}</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="itd_price">ราคา:</label>
                <input type="text" class="form-control" id="itd_price" name="itd_price" value="<?php echo $row['itd_price']; ?>" required>
            </div>

            <div class="form-group">
                <label for="itd_image">รูปภาพ:</label>
                <input type="file" class="form-control-file" id="itd_image" name="itd_image" accept="image/*">
                <img src="<?php echo $row['itd_image']; ?>" alt="Equipment Image">
            </div>

            <input type="hidden" name="et_id" value="<?php echo $row['et_id']; ?>">

            <button type="submit" class="btn btn-primary">บันทึกการแก้ไข</button>
        </form>
    </div>

    <?php
            } else {
                echo "ไม่พบข้อมูลครุภัณฑ์";
            }

            $conn->close();
        } else {
            echo "ไม่ระบุรหัสครุภัณฑ์";
        }
    ?>

</body>
</html>
