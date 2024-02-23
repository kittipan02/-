<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Repair Status</title>
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
<center><h4>เพิ่มสถานะ</h4></center>
<body>
    <form method="post" action="process_add_status.php">
        <label for="rs_name">ชื่อสถานะ &nbsp;</label>
        <input type="text" id="rs_name" name="rs_name" placeholder="ป้อนชื่อสถานะ" required>
        <input type="submit" value="เพิ่มสถานะ">
    </form>

</body>

</html>
