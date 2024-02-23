<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าหลัก</title>
    <!-- เพิ่ม Font Awesome CSS ลิงค์ที่นี่ -->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <style>
        fieldset {
        width: 900px;
        margin: 30px auto;
        background-color: #f4f4f4;
        padding: 20px;
        border-radius: 20px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }
    </style>
</head>
<?php include 'public/layout.php'; ?>
<body>
    <div class="d-flex gap-2 justify-content-center py-3">
        <fieldset>
            <br>
            <center>
        <main class="px-3">
        <h2>ยินดีต้อนรับสู่ระบบทะเบียนพัสดุครุภัณฑ์ ปศุสัตว์และสัตว์พาหนะ</h2><br>
        <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-secondary" onclick="window.location.href='add_headofdepartment.php'">เพิ่มแผนก/ฝ่าย</button>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='add_asset.php'">เพิ่มทะเบียน</button>
        <button type="button" class="btn btn-secondary" onclick="window.location.href='repair_requests.php'">แจ้งซ่อม</button>
        </div>
        </main>
        </center>
        <br>
        </fieldset>
    </div>
    <div class="container">
        
    
    </div>
</body>
</html>
