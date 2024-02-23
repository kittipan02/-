<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Head of Department</title>
    <?php include 'public/layout.php'; ?>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f8f8;
            color: #333;
        }

        form {
            width: 50%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #1b02a8;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
     <center><h4>เพิ่มข้อมูลพนักงาน</h4></center>
    <form method="post" action="process_add_headofdepartment.php">
      
        <label for="department_name">แผนก:</label>
        <input type="text" id="department_name" name="department_name" required>

        <label for="first_name">ชื่อ:</label>
        <input type="text" id="first_name" name="first_name" required>

        <label for="last_name">นามสกุล:</label>
        <input type="text" id="last_name" name="last_name" required>

        <label for="position">ตำแหน่ง:</label>
        <input type="text" id="position" name="position" required>

        <button type="submit">เพิ่มข้อมูล</button>
    </form>

</body>
</html>
