<!DOCTYPE html>
<html lang="en">
<head> <?php include 'public/layout.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ทะเบียนครุภัณฑ์</title>
    <link rel="stylesheet" href="select2/css/select2.min.css">
    <link rel="stylesheet" href="select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .table-custom {
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table-custom th,
        .table-custom td {
            border: 1px solid #000000;
            padding: 5px; /* เปลี่ยนเป็นค่าที่เหมาะสม */
            text-align: left;
        }

        h2, h4, h5 {
            text-align: center;
        }

        form {
            text-align: center;
            margin-top: 20px;
        }

        button:hover {
        background-color: #120076;
        color: #fff;
        }

        button{
        width: 350px;
        background-color: #1b02a8;
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
        
        border-radius: 20px;
        font-size: 25px;
        }

        .button span {
            cursor: pointer;
            display: inline-block;
            position: relative;
            transition: 0.5s;
        }

        .button span:after {
            content: '\00bb';
            position: absolute;
            opacity: 0;
            top: 0;
            right: -20px;
            transition: 0.5s;
            }

        .button:hover span {
            padding-right: 25px;
            }

        .button:hover span:after {
            opacity: 1;
            right: 0;
            }

        label {
            font-size: 23px;
        }

        input[type=text] {
            width: 200px;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            
        }

        input[type=submit] {
            width: 70px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            background-color: #1b02a8;
            color: #fff;
            transition: background-color 0.2s, color 0.3s;
        }

        input[type=submit]:hover {
            background-color: royalblue;
        }
        button {
        width: 150px; /* Adjust the width as needed */
        padding: 8px; /* Adjust the padding as needed */
        background-color: #1b02a8;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
        font-size: 18px; /* Adjust the font size as needed */
        }
        /* Add this style if you want to reduce the size of the button inside the span */
        .button span {
            font-size: 18px; /* Adjust the font size as needed */
        }
        .red-button {
            background-color: #dc3545;
            color: #FFFFFF;
        }
    </style>
</head>

<body>
    <a href="add_asset.php">
        <button>
            เพิ่มทะเบียน
        </button>
    </a>
        <form>
        <label for="search">ค้นหา &nbsp;</label>
        <input type="text" id="search" name="search" placeholder="ป้อน รหัสครุภัณฑ์ ที่ต้องการ">
        <input type="submit" value="ค้นหา"> 
        </form>
    <div class="container mt-5">

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "repair";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Define $search
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    
    // Build SQL query
    $sql = "SELECT equipment_parcels.*, 
    unit.un_name, 
    brand.brand_name,  
    equipment_type.et_name, 
    equipment_type.et_number, 
    equipment_type.it_name, 
    equipment_type.itd_price, 
    equipment_type.itd_image,
    dp.dp_name AS dp_name,
    dp1.dp_name AS dp_name1,
    dp2.dp_name AS dp_name2,
    dp3.dp_name AS dp_name3,
    dp4.dp_name AS dp_name4,
    dp5.dp_name AS dp_name5,
    dp6.dp_name AS dp_name6,
    hd.first_name AS hod_first_name, 
    hd.last_name AS hod_last_name,
    hd1.first_name AS hod1_first_name,
    hd1.last_name AS hod1_last_name,
    hd2.first_name AS hod2_first_name, 
    hd2.last_name AS hod2_last_name,
    hd3.first_name AS hod3_first_name, 
    hd3.last_name AS hod3_last_name,
    hd4.first_name AS hod4_first_name, 
    hd4.last_name AS hod4_last_name,
    hd5.first_name AS hod5_first_name, 
    hd5.last_name AS hod5_last_name,
    hd6.first_name AS hod6_first_name, 
    hd6.last_name AS hod6_last_name
FROM equipment_parcels
LEFT JOIN equipment_type ON equipment_parcels.ep_et_id  = equipment_type.et_id
LEFT JOIN department dp ON equipment_parcels.department_id = dp.dp_id
LEFT JOIN department dp1 ON equipment_parcels.dp_name1 = dp1.dp_id
LEFT JOIN department dp2 ON equipment_parcels.dp_name2 = dp2.dp_id
LEFT JOIN department dp3 ON equipment_parcels.dp_name3 = dp3.dp_id
LEFT JOIN department dp4 ON equipment_parcels.dp_name4 = dp4.dp_id
LEFT JOIN department dp5 ON equipment_parcels.dp_name5 = dp5.dp_id
LEFT JOIN department dp6 ON equipment_parcels.dp_name6 = dp6.dp_id
LEFT JOIN headofdepartment hd ON equipment_parcels.head_of_department_id = hd.head_id
LEFT JOIN headofdepartment hd1 ON equipment_parcels.head_of_department1 = hd1.head_id
LEFT JOIN headofdepartment hd2 ON equipment_parcels.head_of_department2 = hd2.head_id
LEFT JOIN headofdepartment hd3 ON equipment_parcels.head_of_department3 = hd3.head_id
LEFT JOIN headofdepartment hd4 ON equipment_parcels.head_of_department4 = hd4.head_id
LEFT JOIN headofdepartment hd5 ON equipment_parcels.head_of_department5 = hd5.head_id
LEFT JOIN headofdepartment hd6 ON equipment_parcels.head_of_department6 = hd6.head_id
LEFT JOIN unit ON equipment_parcels.ep_un_id = unit.un_id
LEFT JOIN brand ON equipment_parcels.ep_brand_id = brand.brand_id
WHERE (equipment_parcels.ep_et_id LIKE '%$search%' OR equipment_type.et_number LIKE '%$search%')";

$result = $conn->query($sql);

        if ($result) {

            $counter = 1;

            while ($row = $result->fetch_assoc()) {
            echo '<center><div class="table-responsive">';
            echo '<td><strong>No : </strong> ' . $counter . '</td>';
            echo '<table class="table table-custom">';
            echo '<tr>';
            echo '<td colspan="10"><strong><center><h4>ทะเบียนครุภัณฑ์ ปศุสัตว์และสัตว์พาหนะ</h4></center></strong></td>' . '<td colspan="10"><strong><right><h4>พ.ด. 2</h4></right></strong></td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td colspan="3"><strong>ประเภท:</strong> ' . $row['et_name'] . '</td>';
            echo '<td colspan="3"><strong>สำนักงาน:</strong> ' . $row['office'] . '</td>';
            echo '<td colspan="2"><strong>อำเภอ:</strong> ' . $row['district'] . '</td>';
            echo '<td colspan="1"><strong>จังหวัด:</strong> ' . $row['province'] . '</td>';
            echo '<td colspan="1"><strong>หมายเลขอุปกรณ์:</strong> ' . $row['et_number'] . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td colspan="3"><strong>ชื่อพัสดุ:</strong> ' . $row['it_name'] . '</td>';
            echo '<td colspan="3"><strong>ซื้อ/จ้าง/ได้มากจาก:</strong> ' . $row['acquisition_source'] . '</td>';
            echo '<td colspan="4"><strong><center>ชื่อผู้ใช้/ดูแล/รับผิดชอบ:</center></strong></td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td colspan="3"><strong>ใบส่งของที่:</strong> ' . $row['delivery_note'] . '</td>';
            echo '<td colspan="3"><strong>ซื้อ/จ้าง/ได้เมื่อวันที่:</strong> ' . $row['purchase_contract_date'] . '</td>';
            echo '<td><strong>พ.ศ.:</strong></td>';
            echo '<td><strong>ชื่อส่วนราชการ:</strong></td>';
            echo '<td><strong>ชื่อผู้ใช้พัสดุ:</strong></td>';
            echo '<td><strong>ชื่อหัวหน้าส่วนราชการ:</strong></td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td colspan="3"><strong>ชื่อ/ยี่ห้อผู้ทำหรือผลิต:</strong> ' . $row['brand_name'] . '</td>';
            echo '<td colspan="3"><strong>ราคา:</strong> ' . $row['itd_price'] . ' <strong>ใช้งบของ:</strong> ' . $row['budget_used_by'] . '</td>';
            echo '<td> ' . $row['fiscal_year'] . '</td>';
            echo '<td> ' . $row['dp_name'] . '</td>';
            echo '<td> ' . $row['user_name'] . '</td>';
            echo '<td> ' . $row['hod_first_name'] . ' ' . $row['hod_last_name'] . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td colspan="3"><strong>แบบ/ชนิด/ลักษณะ:</strong> ' . $row['un_name'] . '</td>';
            echo '<td colspan="3"><strong><center>ค่าเสื่อมราคา</center></strong></td>';
            echo '<td> ' . $row['fiscal_year1'] . '</td>';
            echo '<td> ' . $row['dp_name1'] . '</td>';
            echo '<td> ' . $row['user_name1'] . '</td>';
            echo '<td> ' . $row['hod1_first_name'] . ' ' . $row['hod1_last_name'] . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td colspan="3"><strong>หมายเลขลำดับ:</strong> ' . $row['sequence_number'] . '</td>';
            echo '<td colspan="3"><strong>ปีที่ 1:</strong> ' . $row['year1_percentage'] .' <strong>%</strong> '  . '  <strong>คงเหลือ:</strong> ' . $row['year1_remaining_price'] .' <strong>บาท</strong> '. '</td>';
            echo '<td> ' . $row['fiscal_year2'] . '</td>';
            echo '<td> ' . $row['dp_name2'] . '</td>';
            echo '<td> ' . $row['user_name2'] . '</td>';
            echo '<td> ' . $row['hod2_first_name'] . ' ' . $row['hod2_last_name'] . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td colspan="3"><strong>หมายเลขเครื่อง(ถ้ามี):</strong> ' . $row['serial_number'] . '</td>';
            echo '<td colspan="3"><strong>ปีที่ 2:</strong> ' . $row['year2_percentage'] .' <strong>%</strong> '. ' <strong>คงเหลือ:</strong> ' . $row['year2_remaining_price'] . ' <strong>บาท</strong> '. '</td>';
            echo '<td> ' . $row['fiscal_year3'] . '</td>';
            echo '<td> ' . $row['dp_name3'] . '</td>';
            echo '<td> ' . $row['user_name3'] . '</td>';
            echo '<td> ' . $row['hod3_first_name'] . ' ' . $row['hod3_last_name'] . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td colspan="3"><strong>หมายเลขกรอบ(ถ้ามี):</strong> ' . $row['frame_number'] . '</td>';
            echo '<td colspan="3"><strong>ปีที่ 3:</strong> ' . $row['year3_percentage'] .' <strong>%</strong> ' . ' <strong>คงเหลือ:</strong> ' . $row['year3_remaining_price'] . ' <strong>บาท</strong> '. '</td>';
            echo '<td> ' . $row['fiscal_year4'] . '</td>';
            echo '<td> ' . $row['dp_name4'] . '</td>';
            echo '<td> ' . $row['user_name4'] . '</td>';
            echo '<td> ' . $row['hod4_first_name'] . ' ' . $row['hod4_last_name'] . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td colspan="3"><strong>หมายเลขจดทะเบียน(ถ้ามี):</strong> ' . $row['registration_number'] . '</td>';
            echo '<td colspan="3"><strong>ปีที่ 4:</strong> ' . $row['year4_percentage'] .' <strong>%</strong> ' . ' <strong>คงเหลือ:</strong> ' . $row['year4_remaining_price'] . ' <strong>บาท</strong> '. '</td>';
            echo '<td> ' . $row['fiscal_year5'] . '</td>';
            echo '<td> ' . $row['dp_name5'] . '</td>';
            echo '<td> ' . $row['user_name5'] . '</td>';
            echo '<td> ' . $row['hod5_first_name'] . ' ' . $row['hod5_last_name'] . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td colspan="3"><strong>สีของพัสดุ:</strong> ' . $row['color'] . '</td>';
            echo '<td colspan="3"><strong>ปีที่ 5:</strong> ' . $row['year5_percentage'] .' <strong>%</strong> ' . ' <strong>คงเหลือ:</strong> ' . $row['year5_remaining_price'] . ' <strong>บาท</strong> '. '</td>';
            echo '<td> ' . $row['fiscal_year6'] . '</td>';
            echo '<td> ' . $row['dp_name6'] . '</td>';
            echo '<td> ' . $row['user_name6'] . '</td>';
            echo '<td> ' . $row['hod6_first_name'] . ' ' . $row['hod6_last_name'] . '</td>';
            echo '</tr>';
            echo '<tr>';


            echo '<td colspan="3"><strong>อื่นๆ(ถ้ามีระบุ):</strong> ' . $row['other_details'] . '</td>';
            echo '<td colspan="3"><strong><center>การจำหน่าย</center></strong></td>';
            
            if (isset($row['itd_image'])) {
                echo "<td colspan='4',   rowspan='12' <strong>รูปถ่ายพัสดุ (ถ้ามี) หรือตำหนิรูปพรรณสัตว์ </strong> <img src='{$row['itd_image']}' alt='equipment_parcels' style='width: auto; height: 300px; display: block; margin-left: auto; margin-right: auto; '></td>";
            } else {
                echo '<td colspan="4", rowspan="12">ไม่มีรูปภาพ</td>';
            }
            
            echo '</tr>';


            echo '<tr>';
            echo '<td colspan="3"><strong><center>เงื่อนไข-การประกัน:</center></strong></td>';
            echo '<td colspan="3"><strong>วันที่จำหน่าย: </strong>' . $row['sale_date'] . '</td>';
            
            echo '</tr>';
            echo '<tr>';
            echo '<td colspan="3"><strong>พัสดุรับประกันถึงวันที่:</strong> ' . $row['warranty_expiration_date'] . '</td>';
            echo '<td colspan="3"><strong>วิธีจำหน่าย:</strong> ' . $row['sale_method'] . '</td>';
           
            echo '</tr>';
            echo '<tr>';
            echo '<td colspan="3"><strong>พัสดุรับประกันไว้ที่บริษัท:</strong> ' . $row['warranty_company'] . '</td>';
            echo '<td colspan="3"><strong>เลขที่หนังสืออนุมัติ:</strong> ' . $row['approval_document_number'] . '</td>';
          
            echo '</tr>';
            echo '<tr>';
            echo '<td colspan="3"><strong>วันที่ประกันพัสดุ:</strong> ' . $row['warranty_date'] . '</td>';
            echo '<td colspan="3"><strong>ราคาจำหน่าย:</strong> ' . $row['sale_price'] . ' <strong>บาท</strong> '. '</td>';
           
            echo '</tr>';
            echo '<tr>';
            echo '<td colspan="3"><strong>:</strong></td>';
            echo '<td colspan="3"><strong>กำไร/ขาดทุน:</strong> ' . $row['profit_loss'] . ' <strong>บาท</strong> '. '</td>';
           
            echo '</tr>';

            echo '<tr>';
            echo '<td colspan="6"><strong><center>การหาผลประโยชน์ในพัสดุ</center></strong></td>';
           
            echo '</tr>';
            
            echo '<tr>';
            echo '<td colspan=""><strong>พ.ศ.:</strong></td>';
            echo '<td colspan=""><strong>รายการ:</strong></td>';
            echo '<td colspan=""><strong>ผลประโยชน์(บาท)เดือน/ปี</strong></td>';
            echo '<td colspan=""><strong>พ.ศ.:</strong></td>';
            echo '<td colspan=""><strong>รายการ:</strong></td>';
            echo '<td colspan=""><strong>ผลประโยชน์(บาท)เดือน/ปี</strong></td>';
            echo '</tr>';
            
            echo '<tr>';
            echo '<td>: ' . $row['year0'] . '</td>';
            echo '<td>: ' . $row['item_list'] . '</td>';
            echo '<td>: ' . $row['monthly_or_annual_benefit'] . '</td>';
            echo '<td>: ' . $row['year01'] . '</td>';
            echo '<td>: ' . $row['item_list01'] . '</td>';
            echo '<td>: ' . $row['monthly_or_annual_benefit01'] . '</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td>: ' . $row['year02'] . '</td>';
            echo '<td>: ' . $row['item_list02'] . '</td>';
            echo '<td>: ' . $row['monthly_or_annual_benefit02'] . '</td>';
            echo '<td>: ' . $row['year03'] . '</td>';
            echo '<td>: ' . $row['item_list03'] . '</td>';
            echo '<td>: ' . $row['monthly_or_annual_benefit03'] . '</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td>: ' . $row['year04'] . '</td>';
            echo '<td>: ' . $row['item_list04'] . '</td>';
            echo '<td>: ' . $row['monthly_or_annual_benefit04'] . '</td>';
            echo '<td>: ' . $row['year05'] . '</td>';
            echo '<td>: ' . $row['item_list05'] . '</td>';
            echo '<td>: ' . $row['monthly_or_annual_benefit05'] . '</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td>: ' . $row['year06'] . '</td>';
            echo '<td>: ' . $row['item_list06'] . '</td>';
            echo '<td>: ' . $row['monthly_or_annual_benefit06'] . '</td>';
            echo '<td>: ' . $row['year07'] . '</td>';
            echo '<td>: ' . $row['item_list07'] . '</td>';
            echo '<td>: ' . $row['monthly_or_annual_benefit07'] . '</td>';
            echo '</tr>';
           
            // ตัวแปร $id ถูกกำหนดโดยใช้ค่า ID ที่ต้องการแก้ไขหรือลบ
            $parcel_id = isset($row['parcel_id']) ? $row['parcel_id'] : null;

            // สร้างปุ่มแก้ไข (Edit) โดยลิงก์ไปยังหน้า edit_asset.php พร้อมส่งค่า ID ของรายการที่ต้องการแก้ไขผ่าน URL
            echo '<td colspan="2"><a href="edit_asset.php?id=' . $row['parcel_id'] . '"><button>Edit</button></a></td>';
            echo '<td colspan="2"><a href="delete_asset.php?id=' . $row['parcel_id'] . '" onclick="return confirm(\'คุณต้องการลบรายการนี้ใช่หรือไม่?\');"><button class="red-button">Delete</button></a></td>';
            echo '</table>';
            echo '</div></center>';
            echo '<br>';
            $counter++;    
                }
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        ?>
    </div>
</body>

</html>