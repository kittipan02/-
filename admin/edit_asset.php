<!DOCTYPE html>
<html lang="th">
<head>
    
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขทะเบียนพัสดุครุภัณฑ์</title>
    <?php include 'public/layout.php'; ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f8f8;
    } 
/* กำหนด label ให้เป็น block element เพื่อให้แสดงด้านบนของ input */
label {
    display: block;
    font-size: 18px;
    color: #333;
    margin-bottom: 5px; /* เพิ่มระยะห่างด้านล่างของ label */
}

/* ปรับ margin ของ input เพื่อความสวยงาม */
input {
    margin-bottom: 10px;
}

/* กำหนด fieldset ให้มีขอบทรงเสริม */
fieldset {
    width: 650px;
    margin: 30px auto;
    background-color: #FFFFFF;
    padding: 20px;
    border-radius: 20px;
    box-shadow: 0 0 10px rgb(128,128,128);
}

/* กำหนดความกว้างของคอลัมน์ในแต่ละ row */
.col-md-4 {
    width: 30%; /* ปรับให้แสดงเป็น 30% ของขนาดแถว */
    display: inline-block; /* แสดงเป็น inline block เพื่อให้แสดงในแนวนอน */
    margin-right: 5%; /* เพิ่มระยะห่างด้านขวาของคอลัมน์ */
    margin-bottom: 10px; /* เพิ่มระยะห่างด้านล่างของคอลัมน์ */
}

/* กำหนดให้คอลัมน์สุดท้ายไม่มีระยะห่างด้านขวา */
.col-md-4:last-child {
    margin-right: 0;
}

    input,
    textarea,
    select {
        width: auto;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    legend {
        font-size: 20px;
        text-align: auto; 
        color: #333;
        
    }

    button:hover {
        background-color: royalblue;
    }
    button{
        width: 450px;
        background-color: #1b02a8;
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
        
        border-radius: 20px;
        font-size: 20px;
    }

    .center {
        margin-top: 30px;
        margin-bottom: 30px;
        position: absolute;
        left: 50%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
    }

    .grouping {
        margin-bottom: 130px;
    }

    .parcel {
        width: 900px;
    }

    .parcel2 {
        width: 1200px;
    }

    .parcel3 {
        width: 1000px;
    }

    select, input {
        width: 185px;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        box-sizing: border-box;
    }
    
</style>

</head>

<body>
<center><h4>แก้ไขข้อมูลครุภัณฑ์</h4></center>
<?php
    // ตรวจสอบว่ามีการส่งค่า ID มาจาก GET request หรือไม่
    if (isset($_GET['id'])) {
        // เชื่อมต่อฐานข้อมูล
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "repair";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // นำเอาค่า ID ที่ส่งมาใช้ในการค้นหาข้อมูลในฐานข้อมูล
        $parcel_id = mysqli_real_escape_string($conn, $_GET['id']);
        $sql = "SELECT * FROM equipment_parcels WHERE parcel_id = $parcel_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
?>
<form action="process_edit_asset.php" method="post" enctype="multipart/form-data">
    <div class="container">
    <fieldset class="parcel">
                            <legend>รายละเอียดพัสดุ</legend>
                            <!-- ใส่ค่า parcel_id ลงในฟอร์มเพื่อใช้ในการอัปเดตข้อมูล -->
                            <input type="hidden" name="parcel_id" value="<?php echo $row['parcel_id']; ?>">
                            <div class="row">
                            <div class="col-md-4">
                            <label for="ep_et_id">เลขรหัสพัสดุ/ครุภัณฑ์:</label>
                            <!-- ใส่ค่า ep_et_number ลงในฟอร์ม -->
                            <input type="text" id="ep_et_number" name="ep_et_number" value="<?php echo $row['ep_et_number']; ?>" size="20" required onblur="fetchData()">
                            </div>
                            <!-- โค้ด JavaScript สำหรับดึงข้อมูล -->
                            <script>
                                function fetchData() {
                                    var ep_et_number = document.getElementById('ep_et_number').value;
                                    var url = 'get_assed_info.php?ep_et_number=' + ep_et_number;
                                    var xhr = new XMLHttpRequest();
                                    xhr.onreadystatechange = function () {
                                        if (this.readyState == 4 && this.status == 200) {
                                            var data = JSON.parse(this.responseText);
                                            document.getElementById('ep_et_id').value = data.et_id || '';
                                            document.getElementById('ep_it_name').value = data.it_name || '';
                                            document.getElementById('ep_itd_price').value = data.itd_price || '';
                                            document.getElementById('ep_brand_id').value = data.brand_id || '';
                                            document.getElementById('ep_un_id').value = data.un_id || '';
                                            var imageElement = document.getElementById('ep_itd_image');
                                            imageElement.src = data.itd_image || '';
                                        }
                                    };
                                    xhr.open('GET', url, true);
                                    xhr.send();
                                }
                            </script>
                            <div class="col-md-4">
                            <label for="ep_et_id">ประเภทครุภัณฑ์:</label>
                            <select id="ep_et_id" name="ep_et_id" required>
                                <?php
                                    // เชื่อมต่อฐานข้อมูล
                                    $conn = new mysqli("localhost", "root", "", "repair");

                                    // ตรวจสอบการเชื่อมต่อ
                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    }

                                    // คำสั่ง SQL สำหรับดึงข้อมูลประเภทครุภัณฑ์
                                    $sql = "SELECT * FROM equipment_type";
                                    $result = $conn->query($sql);

                                    // แสดงตัวเลือกสำหรับประเภทครุภัณฑ์
                                    while ($row_et = $result->fetch_assoc()) {
                                        // เลือกตัวเลือกที่ตรงกับค่าในฐานข้อมูล
                                        $selected = ($row_et['et_id'] == $row['ep_et_id']) ? "selected" : "";
                                        echo "<option value='{$row_et['et_id']}' $selected>{$row_et['et_name']}</option>";
                                    }
                                    // ปิดการเชื่อมต่อ
                                    $conn->close();
                                ?>
                            </select>
                            </div>
                    <div class="col-md-4">                   
            <label for="office">สำนักงาน:</label>
            <input type="text" id="office" name="office" value="<?php echo $row['office']; ?>" required>
            </div></div>
            <div class="row">
            <div class="col-md-4">
            <label for="district">อำเภอ:</label>
            <input type="text" id="district" name="district" value="<?php echo $row['district']; ?>" required>
            </div>

            <div class="col-md-4">
            <label for="province">จังหวัด:</label>
            <input type="text" id="province" name="province" value="<?php echo $row['province']; ?>" required>
            </div>

            <div class="col-md-4">
            <label for="ep_it_name">ชื่อพัสดุ:</label>
            <input type="text" id="ep_it_name" name="ep_it_name" value="<?php echo $row['ep_it_name']; ?>" required>
            </div></div>

            <div class="row">
            <div class="col-md-4">
            <label for="delivery_note">ใบส่งของที่:</label>
            <input type="text" id="delivery_note" name="delivery_note" value="<?php echo $row['delivery_note']; ?>">
            </div>

            <div class="col-md-4">
            <label for="ep_brand_id">ยี่ห้อ:</label>
            <input type="text" id="ep_brand_id" name="ep_brand_id" value="<?php echo $row['ep_brand_id']; ?>">
            </div>
            
            <div class="col-md-4">
            <label for="ep_un_id">แบบ/ชนิด/ลักษณะ:</label>
            <select id="ep_un_id" name="ep_un_id" required>
                <?php
                // เชื่อมต่อฐานข้อมูล
                $conn = new mysqli("localhost", "root", "", "repair");

                // ตรวจสอบการเชื่อมต่อ
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // คำสั่ง SQL สำหรับดึงข้อมูลแบบ/ชนิด/ลักษณะ
                $sql = "SELECT * FROM unit";
                $result = $conn->query($sql);

                // แสดงตัวเลือกสำหรับแบบ/ชนิด/ลักษณะ
                while ($row_unit = $result->fetch_assoc()) {
                    $selected = ($row_unit['un_id'] == $selected_un_id) ? "selected" : "";
                    echo "<option value='{$row_unit['un_id']}' $selected>{$row_unit['un_name']}</option>";
                }

                // ปิดการเชื่อมต่อ
                $conn->close();
                ?>
            </select>
            </div></div>   

            <div class="row">
            <div class="col-md-4">
            <label for="sequence_number">หมายเลขลำดับ:</label>
            <input type="text" id="sequence_number" name="sequence_number" value="<?php echo $row['sequence_number']; ?>">
            </div>

            <div class="col-md-4">
            <label for="serial_number">หมายเลขเครื่อง:</label> 
            <input type="text" id="serial_number" name="serial_number" value="<?php echo $row['serial_number']; ?>">
            </div>

            <div class="col-md-4">
            <label for="frame_number">หมายเลขกรอบ:</label>
            <input type="text" id="frame_number" name="frame_number" value="<?php echo $row['frame_number']; ?>">
            </div></div>
            
            <div class="row">
            <div class="col-md-4">
            <label for="registration_number">หมายเลขจดทะเบียน:</label>
            <input type="text" id="registration_number" name="registration_number" value="<?php echo $row['registration_number']; ?>">
            </div>

            <div class="col-md-4">
            <label for="color">สีของพัสดุ:</label>
            <input type="text" id="color" name="color" value="<?php echo $row['color']; ?>">
            </div>

            <div class="col-md-4">
            <label for="other_details">อื่น ๆ(ถ้ามีระบุ):</label>
            <input type="text" id="other_details" name="other_details" value="<?php echo $row['other_details']; ?>">
            </div></div>

            <div class="row">
            <div class="col-md-4">
            <label for="warranty_expiration_date">พัสดุรับประกันถึงวันที่:</label>
            <input type="date" id="warranty_expiration_date" name="warranty_expiration_date" min="2550-01-01" value="<?php echo $row['warranty_expiration_date']; ?>">
            </div>

            <div class="col-md-4">
            <label for="warranty_company">พัสดุรับประกันไว้ที่บริษัท:</label>
            <input type="text" id="warranty_company" name="warranty_company" value="<?php echo $row['warranty_company']; ?>">
            </div>

            <div class="col-md-4">
            <label for="warranty_date">วันที่ประกันพัสดุ:</label>
            <input type="date" id="warranty_date" name="warranty_date" min="2550-01-01" value="<?php echo $row['warranty_date']; ?>">
            </div>

            <div class="row">
            <div class="col-md-4">
            <label for="acquisition_source">ซื้อ/จ้าง/ได้มาจาก:</label>
            <input type="text" id="acquisition_source" name="acquisition_source" value="<?php echo $row['acquisition_source']; ?>">
            </div>

            <div class="col-md-4">
            <label for="purchase_contract_date">ซื้อ/จ้าง/ได้เมื่อวันที่:</label>
            <input type="date" id="purchase_contract_date" name="purchase_contract_date" min="2550-01-01" value="<?php echo $row['purchase_contract_date']; ?>">
            </div>

            <div class="col-md-4">
            <label for="ep_itd_price">ราคา:</label>
            <input type="number" id="ep_itd_price" name="ep_itd_price" size="10" value="<?php echo $row['ep_itd_price']; ?>">
            </div></div>

            <div class="row">
            <div class="col-md-12">
            <label for="budget_used_by">ใช้งบประมาณของ:</label>
            <input type="text" id="budget_used_by" name="budget_used_by" size="30" value="<?php echo $row['budget_used_by']; ?>">
            </div></div>
        </fieldset>

        <fieldset>
            <legend>ค่าเสื่อมราคา</legend>
            <div class="row">
            <div class="col-md-6">
            <label for="year1_percentage">ปีที่ 1:</label>
            <input type="number" id="year1_percentage" name="year1_percentage" size="10" value="<?php echo $row['year1_percentage']; ?>">
            </div>
            <div class="col-md-6">
            <label for="year1_remaining_price">คงเหลือราคา:</label>
            <input type="number" id="year1_remaining_price" name="year1_remaining_price" size="10" value="<?php echo $row['year1_remaining_price']; ?>">
            </div></div>
            <div class="row">
            <div class="col-md-6">
            <label for="year2_percentage">ปีที่ 2:</label>
            <input type="number" id="year2_percentage" name="year2_percentage" size="10" value="<?php echo $row['year2_percentage']; ?>">
            </div>

            <div class="col-md-6">
            <label for="year2_remaining_price">คงเหลือราคา:</label>
            <input type="number" id="year2_remaining_price" name="year2_remaining_price" size="10" value="<?php echo $row['year2_remaining_price']; ?>">
            </div></div>

            <div class="row">
            <div class="col-md-6">
            <label for="year3_percentage">ปีที่ 3:</label>
            <input type="number" id="year3_percentage" name="year3_percentage" size="10" value="<?php echo $row['year3_percentage']; ?>">
            </div>
            <div class="col-md-6">
            <label for="year3_remaining_price">คงเหลือราคา:</label>
            <input type="number" id="year3_remaining_price" name="year3_remaining_price" size="10" value="<?php echo $row['year3_remaining_price']; ?>">
            </div></div>

            <div class="row">
            <div class="col-md-6">
            <label for="year4_percentage">ปีที่ 4:</label>
            <input type="number" id="year4_percentage" name="year4_percentage" size="10" value="<?php echo $row['year4_percentage']; ?>">
            </div>
            <div class="col-md-6">
            <label for="year4_remaining_price">คงเหลือราคา:</label>
            <input type="number" id="year4_remaining_price" name="year4_remaining_price" size="10" value="<?php echo $row['year4_remaining_price']; ?>">
            </div></div>

            <div class="row">
            <div class="col-md-6">
            <label for="year5_percentage">ปีที่ 5:</label>
            <input type="number" id="year5_percentage" name="year5_percentage" size="10" value="<?php echo $row['year5_percentage']; ?>">
            </div>
            <div class="col-md-6">
            <label for="year5_remaining_price">คงเหลือราคา:</label>
            <input type="number" id="year5_remaining_price" name="year5_remaining_price" size="10" value="<?php echo $row['year5_remaining_price']; ?>">
            </div></div>
        </fieldset>

        <fieldset class="parcel0">
            <legend>การจำหน่าย</legend>
            <div class="row">
            <div class="col-md-6">
            <label for="sale_date">วันที่จำหน่าย:</label>
            <input type="date" id="sale_date" name="sale_date" min="2550-01-01" value="<?php echo $row['sale_date']; ?>">
            </div>
            <div class="col-md-6">
            <label for="sale_method">วิธีจำหน่าย:</label>
            <input type="text" id="sale_method" name="sale_method" value="<?php echo $row['sale_method']; ?>">
            </div></div>

            <div class="row">
            <div class="col-md-6">
            <label for="approval_document_number">เลขที่หนังสืออนุมัติ:</label>
            <input type="text" id="approval_document_number" name="approval_document_number" value="<?php echo $row['approval_document_number']; ?>">
            </div>

            <div class="col-md-6">
            <label for="sale_price">ราคาจำหน่าย:</label>
            <input type="number" id="sale_price" name="sale_price" size="20" value="<?php echo $row['sale_price']; ?>">
            </div></div>

            <div class="row">
            <div class="col-md-6">
            <label for="profit_loss">กำไร/ขาดทุน:</label>
            <input type="number" id="profit_loss" name="profit_loss" size="20" value="<?php echo $row['profit_loss']; ?>">
            </div></div>
        </fieldset>

        <fieldset class="parcel2">
            <legend>ชื่อผู้ใช้/ดูแล/รับผิดชอบ</legend>
            <div class="row">
            <div class="col-md-3">
            <label for="fiscal_year">พ.ศ.</label>
            <input type="text" id="fiscal_year" name="fiscal_year" placeholder="2566" size="2" maxlength="4" value="<?php echo $row['fiscal_year']; ?>">
            </div>
            <div class="col-md-3">
        <label for="department_id">แผนก:</label>
        <select id="department_id" name="department_id" required>
        <option value=""></option>
        <?php
        // เชื่อมต่อกับฐานข้อมูล
        $conn = new mysqli("localhost", "root", "", "repair");

        // ตรวจสอบการเชื่อมต่อ
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // คำสั่ง SQL สำหรับดึงข้อมูลแผนก
        $sql = "SELECT * FROM department";
        $result = $conn->query($sql);

        // แสดงตัวเลือกสำหรับแผนก
        while ($row_department = $result->fetch_assoc()) {
            // ตรวจสอบว่าค่าของแผนกที่เลือกตรงกับค่าในฐานข้อมูลหรือไม่
            $selected = ($row_department['dp_id'] == $row['department_id']) ? 'selected' : '';
            echo "<option value='{$row_department['dp_id']}' $selected>{$row_department['dp_name']}</option>";
        }

        // ปิดการเชื่อมต่อ
        $conn->close();
        ?>
    </select>
    </div>

    <div class="col-md-3">
            <label for="user_name">ชื่อผู้ใช้พัสดุ:</label>
            <input type="text" id="user_name" name="user_name" size="30" value="<?php echo $row['user_name']; ?>">
            </div>

            <div class="col-md-3">
            <label for="head_of_department_id">ชื่อหัวหน้าราชการ:</label>
            <select id="head_of_department_id" name="head_of_department_id" required>
            <option value=""></option>
            <?php
            // เชื่อมต่อกับฐานข้อมูล
            $conn = new mysqli("localhost", "root", "", "repair");

            // ตรวจสอบการเชื่อมต่อ
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // คำสั่ง SQL สำหรับดึงข้อมูล
            $sql = "SELECT * FROM headofdepartment";
            $result = $conn->query($sql);

            // แสดงตัวเลือกสำหรับแผนก
            while ($row_headofdepartment = $result->fetch_assoc()) {
                $selected = ($row_headofdepartment['head_id'] == $row['head_of_department_id']) ? 'selected' : '';
                echo "<option value='{$row_headofdepartment['head_id']}' $selected>{$row_headofdepartment['first_name']} {$row_headofdepartment['last_name']}</option>";
            }

            // ปิดการเชื่อมต่อ
            $conn->close();
            ?>
            </select>
          </div> </div>

            <div class="row">
            <div class="col-md-3">
            <label for="fiscal_year1">พ.ศ.</label>
            <input type="text" id="fiscal_year1" name="fiscal_year1" placeholder="2566" size="2" maxlength="4" value="<?php echo $row['fiscal_year1']; ?>">
            </div>

            <div class="col-md-3">
            <label for="dp_name1">แผนก:</label>
            <select id="dp_name1" name="dp_name1">
               <option value=""></option>
                <?php
                // เชื่อมต่อกับฐานข้อมูล
                $conn = new mysqli("localhost", "root", "", "repair");

                // ตรวจสอบการเชื่อมต่อ
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // คำสั่ง SQL สำหรับดึงข้อมูลแผนก
                $sql = "SELECT * FROM department";
                $result = $conn->query($sql);

                // แสดงตัวเลือกสำหรับแผนก
                while ($row_department = $result->fetch_assoc()) {
                    // ตรวจสอบว่าค่าของแผนกที่เลือกตรงกับค่าในฐานข้อมูลหรือไม่
                    $selected = ($row_department['dp_id'] == $row['dp_name1']) ? 'selected' : '';
                    echo "<option value='{$row_department['dp_id']}' $selected>{$row_department['dp_name']}</option>";
                }

                // ปิดการเชื่อมต่อ
                $conn->close();
                ?>
            </select>
            </div>
            
            <div class="col-md-3">
            <label for="user_name1">ชื่อผู้ใช้พัสดุ:</label>
            <input type="text" id="user_name1" name="user_name1" size="30" value="<?php echo $row['user_name1']; ?>">
            </div>

            <div class="col-md-3">
            <label for="head_of_department1">ชื่อหัวหน้าราชการ:</label>
            <select id="head_of_department1" name="head_of_department1">
            <option value=""></option>
            <?php
            // เชื่อมต่อกับฐานข้อมูล
            $conn = new mysqli("localhost", "root", "", "repair");

            // ตรวจสอบการเชื่อมต่อ
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // คำสั่ง SQL สำหรับดึงข้อมูล
            $sql = "SELECT * FROM headofdepartment";
            $result = $conn->query($sql);

            // แสดงตัวเลือกสำหรับแผนก
            while ($row_headofdepartment = $result->fetch_assoc()) {
                $selected = ($row_headofdepartment['head_id'] == $row['head_of_department1']) ? 'selected' : '';
                echo "<option value='{$row_headofdepartment['head_id']}' $selected>{$row_headofdepartment['first_name']} {$row_headofdepartment['last_name']}</option>";
            }

            // ปิดการเชื่อมต่อ
            $conn->close();
            ?>
            </select>
            </div></div>

            <div class="row">
            <div class="col-md-3">
            <label for="fiscal_year2">พ.ศ.</label>
            <input type="text" id="fiscal_year2" name="fiscal_year2" placeholder="2566" size="2" maxlength="4" value="<?php echo $row['fiscal_year2']; ?>">
            </div>

            <div class="col-md-3">
            <label for="dp_name2 ">แผนก:</label>
            <select id="dp_name2 " name="dp_name2">
            <option value=""></option>
                <?php
                // เชื่อมต่อกับฐานข้อมูล
                $conn = new mysqli("localhost", "root", "", "repair");

                // ตรวจสอบการเชื่อมต่อ
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // คำสั่ง SQL สำหรับดึงข้อมูลแผนก
                $sql = "SELECT * FROM department";
                $result = $conn->query($sql);

                // แสดงตัวเลือกสำหรับแผนก
                while ($row_department = $result->fetch_assoc()) {
                    // ตรวจสอบว่าค่าของแผนกที่เลือกตรงกับค่าในฐานข้อมูลหรือไม่
                    $selected = ($row_department['dp_id'] == $row['dp_name2']) ? 'selected' : '';
                    echo "<option value='{$row_department['dp_id']}' $selected>{$row_department['dp_name']}</option>";
                }

                // ปิดการเชื่อมต่อ
                $conn->close();
                ?>
            </select>
            </div>

            <div class="col-md-3">
            <label for="user_name2">ชื่อผู้ใช้พัสดุ:</label>
            <input type="text" id="user_name2" name="user_name2" size="30" value="<?php echo $row['user_name2']; ?>">
            </div>

            <div class="col-md-3">
            <label for="head_of_department2">ชื่อหัวหน้าราชการ:</label>
            <select id="head_of_department2" name="head_of_department2">
            <option value=""></option>
            <?php
            // เชื่อมต่อกับฐานข้อมูล
            $conn = new mysqli("localhost", "root", "", "repair");

            // ตรวจสอบการเชื่อมต่อ
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // คำสั่ง SQL สำหรับดึงข้อมูล
            $sql = "SELECT * FROM headofdepartment";
            $result = $conn->query($sql);

            // แสดงตัวเลือกสำหรับแผนก
            while ($row_headofdepartment = $result->fetch_assoc()) {
                $selected = ($row_headofdepartment['head_id'] == $row['head_of_department2']) ? 'selected' : '';
                echo "<option value='{$row_headofdepartment['head_id']}' $selected>{$row_headofdepartment['first_name']} {$row_headofdepartment['last_name']}</option>";
            }

            // ปิดการเชื่อมต่อ
            $conn->close();
            ?>
            </select>
            </div>

            <div class="row">
            <div class="col-md-3">
            <label for="fiscal_year3">พ.ศ.</label>
            <input type="text" id="fiscal_year3" name="fiscal_year3" placeholder="2566" size="2" maxlength="4" value="<?php echo $row['fiscal_year3']; ?>">
            </div>
            
            <div class="col-md-3">
            <label for="dp_name3">แผนก:</label>
            <select id="dp_name3" name="dp_name3">
            <option value=""></option>
                <?php
                // เชื่อมต่อกับฐานข้อมูล
                $conn = new mysqli("localhost", "root", "", "repair");

                // ตรวจสอบการเชื่อมต่อ
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // คำสั่ง SQL สำหรับดึงข้อมูลแผนก
                $sql = "SELECT * FROM department";
                $result = $conn->query($sql);

                // แสดงตัวเลือกสำหรับแผนก
                while ($row_department = $result->fetch_assoc()) {
                    // ตรวจสอบว่าค่าของแผนกที่เลือกตรงกับค่าในฐานข้อมูลหรือไม่
                    $selected = ($row_department['dp_id'] == $row['dp_name3']) ? 'selected' : '';
                    echo "<option value='{$row_department['dp_id']}' $selected>{$row_department['dp_name']}</option>";
                }

                // ปิดการเชื่อมต่อ
                $conn->close();
                ?>
            </select>
            </div>

            <div class="col-md-3">
            <label for="user_name3">ชื่อผู้ใช้พัสดุ:</label>
            <input type="text" id="user_name3" name="user_name3" size="30" value="<?php echo $row['user_name3']; ?>">
            </div>

            <div class="col-md-3">
            <label for="head_of_department3">ชื่อหัวหน้าราชการ:</label>
            <select id="head_of_department3" name="head_of_department3">
            <option value=""></option>
            <?php
            // เชื่อมต่อกับฐานข้อมูล
            $conn = new mysqli("localhost", "root", "", "repair");

            // ตรวจสอบการเชื่อมต่อ
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // คำสั่ง SQL สำหรับดึงข้อมูล
            $sql = "SELECT * FROM headofdepartment";
            $result = $conn->query($sql);

            // แสดงตัวเลือกสำหรับแผนก
            while ($row_headofdepartment = $result->fetch_assoc()) {
                $selected = ($row_headofdepartment['head_id'] == $row['head_of_department3']) ? 'selected' : '';
                echo "<option value='{$row_headofdepartment['head_id']}' $selected>{$row_headofdepartment['first_name']} {$row_headofdepartment['last_name']}</option>";
            }

            // ปิดการเชื่อมต่อ
            $conn->close();
            ?>
            </select>
            </div></div>

            <div class="row">
            <div class="col-md-3">
            <label for="fiscal_year4">พ.ศ.</label>
            <input type="text" id="fiscal_year4" name="fiscal_year4" placeholder="2566" size="2" maxlength="4" value="<?php echo $row['fiscal_year4']; ?>">
            </div>

            <div class="col-md-3">
            <label for="dp_name4">แผนก:</label>
            <select id="dp_name4" name="dp_name4">
            <option value=""></option>
                <?php
                // เชื่อมต่อกับฐานข้อมูล
                $conn = new mysqli("localhost", "root", "", "repair");

                // ตรวจสอบการเชื่อมต่อ
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // คำสั่ง SQL สำหรับดึงข้อมูลแผนก
                $sql = "SELECT * FROM department";
                $result = $conn->query($sql);

                // แสดงตัวเลือกสำหรับแผนก
                while ($row_department = $result->fetch_assoc()) {
                    // ตรวจสอบว่าค่าของแผนกที่เลือกตรงกับค่าในฐานข้อมูลหรือไม่
                    $selected = ($row_department['dp_id'] == $row['dp_name4']) ? 'selected' : '';
                    echo "<option value='{$row_department['dp_id']}' $selected>{$row_department['dp_name']}</option>";
                }

                // ปิดการเชื่อมต่อ
                $conn->close();
                ?>
            </select>
            </div>

            <div class="col-md-3">
            <label for="user_name4">ชื่อผู้ใช้พัสดุ:</label>
            <input type="text" id="user_name4" name="user_name4" size="30" value="<?php echo $row['user_name4']; ?>">
            </div>

            <div class="col-md-3">
            <label for="head_of_department4">ชื่อหัวหน้าราชการ:</label>
            <select id="head_of_department4" name="head_of_department4">
            <option value=""></option>
            <?php
            // เชื่อมต่อกับฐานข้อมูล
            $conn = new mysqli("localhost", "root", "", "repair");

            // ตรวจสอบการเชื่อมต่อ
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // คำสั่ง SQL สำหรับดึงข้อมูล
            $sql = "SELECT * FROM headofdepartment";
            $result = $conn->query($sql);

            // แสดงตัวเลือกสำหรับแผนก
            while ($row_headofdepartment = $result->fetch_assoc()) {
                $selected = ($row_headofdepartment['head_id'] == $row['head_of_department4']) ? 'selected' : '';
                echo "<option value='{$row_headofdepartment['head_id']}' $selected>{$row_headofdepartment['first_name']} {$row_headofdepartment['last_name']}</option>";
            }

            // ปิดการเชื่อมต่อ
            $conn->close();
            ?>
            </select>
            </div></div>

            <div class="row">
            <div class="col-md-3">
            <label for="fiscal_year5">พ.ศ.</label>
            <input type="text" id="fiscal_year5" name="fiscal_year5" placeholder="2566" size="2" maxlength="4" value="<?php echo $row['fiscal_year5']; ?>">
            </div>

            <div class="col-md-3">
            <label for="dp_name5">แผนก:</label>
            <select id="dp_name5" name="dp_name5">
            <option value=""></option>
                <?php
                // เชื่อมต่อกับฐานข้อมูล
                $conn = new mysqli("localhost", "root", "", "repair");

                // ตรวจสอบการเชื่อมต่อ
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // คำสั่ง SQL สำหรับดึงข้อมูลแผนก
                $sql = "SELECT * FROM department";
                $result = $conn->query($sql);

                // แสดงตัวเลือกสำหรับแผนก
                while ($row_department = $result->fetch_assoc()) {
                    // ตรวจสอบว่าค่าของแผนกที่เลือกตรงกับค่าในฐานข้อมูลหรือไม่
                    $selected = ($row_department['dp_id'] == $row['dp_name5']) ? 'selected' : '';
                    echo "<option value='{$row_department['dp_id']}' $selected>{$row_department['dp_name']}</option>";
                }

                // ปิดการเชื่อมต่อ
                $conn->close();
                ?>
            </select>
            </div>
            
            <div class="col-md-3">
            <label for="user_name5">ชื่อผู้ใช้พัสดุ:</label>
            <input type="text" id="user_name5" name="user_name5" size="30" value="<?php echo $row['user_name5']; ?>">
            </div>

            <div class="col-md-3">
            <label for="head_of_department5">ชื่อหัวหน้าราชการ:</label>
            <select id="head_of_department5" name="head_of_department5">
            <option value=""></option>
            <?php
            // เชื่อมต่อกับฐานข้อมูล
            $conn = new mysqli("localhost", "root", "", "repair");

            // ตรวจสอบการเชื่อมต่อ
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // คำสั่ง SQL สำหรับดึงข้อมูล
            $sql = "SELECT * FROM headofdepartment";
            $result = $conn->query($sql);

            // แสดงตัวเลือกสำหรับแผนก
            while ($row_headofdepartment = $result->fetch_assoc()) {
                $selected = ($row_headofdepartment['head_id'] == $row['head_of_department5']) ? 'selected' : '';
                echo "<option value='{$row_headofdepartment['head_id']}' $selected>{$row_headofdepartment['first_name']} {$row_headofdepartment['last_name']}</option>";
            }

            // ปิดการเชื่อมต่อ
            $conn->close();
            ?>
            </select>
            </div></div>

            <div class="row">
            <div class="col-md-3">
            <label for="fiscal_year6">พ.ศ.</label>
            <input type="text" id="fiscal_year6" name="fiscal_year6" placeholder="2566" size="2" maxlength="4" value="<?php echo $row['fiscal_year6']; ?>">
            </div>

            <div class="col-md-3">
            <label for="dp_name6">แผนก:</label>
            <select id="dp_name6" name="dp_name6">
            <option value=""></option>
                <?php
                // เชื่อมต่อกับฐานข้อมูล
                $conn = new mysqli("localhost", "root", "", "repair");

                // ตรวจสอบการเชื่อมต่อ
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // คำสั่ง SQL สำหรับดึงข้อมูลแผนก
                $sql = "SELECT * FROM department";
                $result = $conn->query($sql);

                // แสดงตัวเลือกสำหรับแผนก
                while ($row_department = $result->fetch_assoc()) {
                    // ตรวจสอบว่าค่าของแผนกที่เลือกตรงกับค่าในฐานข้อมูลหรือไม่
                    $selected = ($row_department['dp_id'] == $row['dp_name6']) ? 'selected' : '';
                    echo "<option value='{$row_department['dp_id']}' $selected>{$row_department['dp_name']}</option>";
                }

                // ปิดการเชื่อมต่อ
                $conn->close();
                ?>
            </select>
            </div>
            
            <div class="col-md-3">
            <label for="user_name6">ชื่อผู้ใช้พัสดุ:</label>
            <input type="text" id="user_name6" name="user_name6" size="30" value="<?php echo $row['user_name6']; ?>">
            </div>

            <div class="col-md-3">
            <label for="head_of_department6">ชื่อหัวหน้าราชการ:</label>
            <select id="head_of_department6" name="head_of_department6" >
            <option value=""></option>
            <?php
            // เชื่อมต่อกับฐานข้อมูล
            $conn = new mysqli("localhost", "root", "", "repair");

            // ตรวจสอบการเชื่อมต่อ
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // คำสั่ง SQL สำหรับดึงข้อมูล
            $sql = "SELECT * FROM headofdepartment";
            $result = $conn->query($sql);

            // แสดงตัวเลือกสำหรับแผนก
            while ($row_headofdepartment = $result->fetch_assoc()) {
                $selected = ($row_headofdepartment['head_id'] == $row['head_of_department6']) ? 'selected' : '';
                echo "<option value='{$row_headofdepartment['head_id']}' $selected>{$row_headofdepartment['first_name']} {$row_headofdepartment['last_name']}</option>";
            }

            // ปิดการเชื่อมต่อ
            $conn->close();
            ?>
            </select>
            </div></div>
            
        </fieldset>

        <fieldset class="parcel">
            <legend>การหาผลประโยชน์ในพัสดุ</legend>
            <div class="row">
            <div class="col-md-4">
            <label for="year0">พ.ศ.</label>
            <input type="text" id="year0" name="year0" placeholder="2566" size="2" maxlength="4" value="<?php echo $row['year0']; ?>">
            </div>
            <div class="col-md-4">
            <label for="item_list">รายการ: </label>
            <input type="text" id="item_list" name="item_list" size="40" value="<?php echo $row['item_list']; ?>">
            </div>
            <div class="col-md-4">
            <label for="monthly_or_annual_benefit">ผลประโยชน์(บาท)เดือน/ปี: </label>
            <input type="text" id="monthly_or_annual_benefit" name="monthly_or_annual_benefit" size="30" value="<?php echo $row['monthly_or_annual_benefit']; ?>">
            </div></div>
            <div class="row">
            <div class="col-md-4">
            <label for="year01">พ.ศ.</label>
            <input type="text" id="year01" name="year01" placeholder="2566" size="2" maxlength="4" value="<?php echo $row['year01']; ?>">
            </div>
            <div class="col-md-4">
            <label for="item_list01">รายการ: </label>
            <input type="text" id="item_list01" name="item_list01" size="40" value="<?php echo $row['item_list01']; ?>">
            </div>
            <div class="col-md-4">
            <label for="monthly_or_annual_benefit01">ผลประโยชน์(บาท)เดือน/ปี: </label>
            <input type="text" id="monthly_or_annual_benefit01" name="monthly_or_annual_benefit01" size="30" value="<?php echo $row['monthly_or_annual_benefit01']; ?>">
            </div></div>
            <div class="row">
            <div class="col-md-4">
            <label for="year02">พ.ศ.</label>
            <input type="text" id="year02" name="year02" placeholder="2566" size="2" maxlength="4" value="<?php echo $row['year02']; ?>">
            </div>
            <div class="col-md-4">
            <label for="item_list02">รายการ: </label>
            <input type="text" id="item_list02" name="item_list02" size="40" value="<?php echo $row['item_list02']; ?>">
            </div>
            <div class="col-md-4">
            <label for="monthly_or_annual_benefit02">ผลประโยชน์(บาท)เดือน/ปี: </label>
            <input type="text" id="monthly_or_annual_benefit02" name="monthly_or_annual_benefit02" size="30" value="<?php echo $row['monthly_or_annual_benefit02']; ?>">
            </div></div>

            <div class="row">
            <div class="col-md-4">
            <label for="year03">พ.ศ.</label>
            <input type="text" id="year03" name="year03" placeholder="2566" size="2" maxlength="4" value="<?php echo $row['year03']; ?>">
            </div>
            <div class="col-md-4">
            <label for="item_list03">รายการ: </label>
            <input type="text" id="item_list03" name="item_list03" size="40" value="<?php echo $row['item_list03']; ?>">
            </div>
            <div class="col-md-4">
            <label for="monthly_or_annual_benefit03">ผลประโยชน์(บาท)เดือน/ปี: </label>
            <input type="text" id="monthly_or_annual_benefit03" name="monthly_or_annual_benefit03" size="30" value="<?php echo $row['monthly_or_annual_benefit03']; ?>">
            </div></div>

            <div class="row">
            <div class="col-md-4">
            <label for="year04">พ.ศ.</label>
            <input type="text" id="year04" name="year04" placeholder="2566" size="2" maxlength="4" value="<?php echo $row['year04']; ?>">
            </div>
            <div class="col-md-4">
            <label for="item_list04">รายการ: </label>
            <input type="text" id="item_list04" name="item_list04" size="40" value="<?php echo $row['item_list04']; ?>">
            </div>
            <div class="col-md-4">
            <label for="monthly_or_annual_benefit04">ผลประโยชน์(บาท)เดือน/ปี: </label>
            <input type="text" id="monthly_or_annual_benefit04" name="monthly_or_annual_benefit04" size="30" value="<?php echo $row['monthly_or_annual_benefit04']; ?>">
            </div></div>

            <div class="row">
            <div class="col-md-4">
            <label for="year05">พ.ศ.</label>
            <input type="text" id="year05" name="year05" placeholder="2566" size="2" maxlength="4" value="<?php echo $row['year05']; ?>">
            </div>
            <div class="col-md-4">
            <label for="item_list05">รายการ: </label>
            <input type="text" id="item_list05" name="item_list05" size="40" value="<?php echo $row['item_list05']; ?>">
            </div>
            <div class="col-md-4">
            <label for="monthly_or_annual_benefit05">ผลประโยชน์(บาท)เดือน/ปี: </label>
            <input type="text" id="monthly_or_annual_benefit05" name="monthly_or_annual_benefit05" size="30" value="<?php echo $row['monthly_or_annual_benefit05']; ?>">
            </div></div>

            <div class="row">
            <div class="col-md-4">
            <label for="year06">พ.ศ.</label>
            <input type="text" id="year06" name="year06" placeholder="2566" size="2" maxlength="4" value="<?php echo $row['year06']; ?>">
            </div>
            <div class="col-md-4">
            <label for="item_list06">รายการ: </label>
            <input type="text" id="item_list06" name="item_list06" size="40" value="<?php echo $row['item_list06']; ?>">
            </div>
            <div class="col-md-4">
            <label for="monthly_or_annual_benefit06">ผลประโยชน์(บาท)เดือน/ปี: </label>
            <input type="text" id="monthly_or_annual_benefit06" name="monthly_or_annual_benefit06" size="30" value="<?php echo $row['monthly_or_annual_benefit06']; ?>">
            </div></div>

            <div class="row">
            <div class="col-md-4">
            <label for="year07">พ.ศ.</label>
            <input type="text" id="year07" name="year07" placeholder="2566" size="2" maxlength="4" value="<?php echo $row['year07']; ?>">
            </div>
            <div class="col-md-4">
            <label for="item_list07">รายการ: </label>
            <input type="text" id="item_list07" name="item_list07" size="40" value="<?php echo $row['item_list07']; ?>">
            </div>
            <div class="col-md-4">
            <label for="monthly_or_annual_benefit07">ผลประโยชน์(บาท)เดือน/ปี: </label>
            <input type="text" id="monthly_or_annual_benefit07" name="monthly_or_annual_benefit07" size="30" value="<?php echo $row['monthly_or_annual_benefit07']; ?>">
            </div></div>

            <label for="ep_itd_image">รูปภาพ:</label>
            <img id="ep_itd_image" alt="รูปอุปกรณ์" style="max-width: 200px; max-height: 200px;">
            <input type="file" id="ep_itd_image_input" name="ep_itd_image" accept="image/*" onchange="previewImage()">

            <script>
            function previewImage() {
                var input = document.getElementById('ep_itd_image_input');
                var preview = document.getElementById('ep_itd_image');

                var file = input.files[0];
                var reader = new FileReader();

                reader.onloadend = function () {
                    preview.src = reader.result;
                };

                if (file) {
                    reader.readAsDataURL(file);
                } else {
                    preview.src = "";
                }
            }
</script>
            <br>

        </fieldset>
        <div class="center">
            <button type="submit">บันทึกข้อมูล</button>
        </div>
    </div>
     </form>

    <?php
            } else {
                echo "ไม่พบข้อมูลครุภัณฑ์";
            }
        }
    ?>

</body>
</html>
