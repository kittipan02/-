<!DOCTYPE html>
<html lang="en">
<?php include 'public/layout.php'; ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ทะเบียนครุภัณฑ์</title>
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
        .back-link {
    width: 100px; /* ปรับขนาดตามที่ต้องการ */
    padding: 10px;
    background-color: #1b02a8; /* เลือกสีตามที่ต้องการ */
    color: #fff; /* เลือกสีตัวอักษร */
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s, color 0.3s;
    font-size: 16px; /* ปรับขนาดตัวอักษรตามที่ต้องการ */
}

.back-link:hover {
    background-color: #120076; /* เลือกสีที่ต้องการเมื่อ hover */
    color: #fff; /* เลือกสีตัวอักษรเมื่อ hover */
}

    </style>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repair";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

$et_number = isset($_GET['et_number']) ? $_GET['et_number'] : '';
$etNumber = $conn->real_escape_string($et_number);

$sql = "SELECT equipment_parcels.*, department.dp_name, equipment_type.et_name, equipment_type.et_number, equipment_type.it_name, equipment_type.itd_image,
headofdepartment.first_name AS hod_first_name, headofdepartment.last_name AS hod_last_name
FROM equipment_parcels
LEFT JOIN equipment_type ON equipment_parcels.ep_et_id = equipment_type.et_id
LEFT JOIN department ON equipment_parcels.department_id = department.dp_id
LEFT JOIN headofdepartment ON equipment_parcels.head_of_department_id = headofdepartment.head_id   
WHERE (equipment_type.et_number LIKE '%$etNumber%')";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $brandName = isset($row['brand_name']) ? $row['brand_name'] : '';
        $itdPrice = isset($row['itd_price']) ? $row['itd_price'] : '';
        $unName = isset($row['un_name']) ? $row['un_name'] : '';
        $hod1FirstName = isset($row['hod1_first_name']) ? $row['hod1_first_name'] : '';
        $hod1LastName = isset($row['hod1_last_name']) ? $row['hod1_last_name'] : '';
        $hod2FirstName = isset($row['hod2_first_name']) ? $row['hod2_first_name'] : '';
        $hod2LastName = isset($row['hod2_last_name']) ? $row['hod2_last_name'] : '';
        $hod3FirstName = isset($row['hod3_first_name']) ? $row['hod3_first_name'] : '';
        $hod3LastName = isset($row['hod3_last_name']) ? $row['hod3_last_name'] : '';
        $hod4FirstName = isset($row['hod4_first_name']) ? $row['hod4_first_name'] : '';
        $hod4LastName = isset($row['hod4_last_name']) ? $row['hod4_last_name'] : '';
        $hod5FirstName = isset($row['hod5_first_name']) ? $row['hod5_first_name'] : '';
        $hod5LastName = isset($row['hod5_last_name']) ? $row['hod5_last_name'] : '';
        $hod6FirstName = isset($row['hod6_first_name']) ? $row['hod6_first_name'] : '';
        $hod6LastName = isset($row['hod6_last_name']) ? $row['hod6_last_name'] : '';

  echo "<button class='back-link' onclick='window.history.back()'>กลับ</button>";
        echo '<center><div class="table-responsive">';
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
            echo '<td colspan="3"><strong>ชื่อ/ยี่ห้อผู้ทำหรือผลิต:</strong> ' . (isset($row['brand_name']) ? $row['brand_name'] : '') . '</td>';
            echo '<td colspan="3"><strong>ราคา:</strong> ' . (isset($row['itd_price']) ? $row['itd_price'] : '') . ' <strong>ใช้งบของ:</strong> ' . (isset($row['budget_used_by']) ? $row['budget_used_by'] : '') . '</td>';
            echo '<td> ' . $row['fiscal_year'] . '</td>';
            echo '<td> ' . $row['dp_name'] . '</td>';
            echo '<td> ' . $row['user_name'] . '</td>';
            echo '<td> ' . $row['hod_first_name'] . ' ' . $row['hod_last_name'] . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td colspan="3"><strong>แบบ/ชนิด/ลักษณะ:</strong> ' . (isset($row['un_name']) ? $row['un_name'] : '') . '</td>';
            echo '<td colspan="3"><strong><center>ค่าเสื่อมราคา</center></strong></td>';
            echo '<td> ' . $row['fiscal_year1'] . '</td>';
            echo '<td> ' . $row['dp_name1'] . '</td>';
            echo '<td> ' . $row['user_name1'] . '</td>';
            echo '<td> ' . (isset($row['hod1_first_name']) ? $row['hod1_first_name'] : '') . ' ' . (isset($row['hod1_last_name']) ? $row['hod1_last_name'] : '') . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td colspan="3"><strong>หมายเลขลำดับ:</strong> ' . $row['sequence_number'] . '</td>';
            echo '<td colspan="3"><strong>ปีที่ 1:</strong> ' . $row['year1_percentage'] .' <strong>%</strong> '  . '  <strong>คงเหลือ:</strong> ' . $row['year1_remaining_price'] .' <strong>บาท</strong> '. '</td>';
            echo '<td> ' . $row['fiscal_year2'] . '</td>';
            echo '<td> ' . $row['dp_name2'] . '</td>';
            echo '<td> ' . $row['user_name2'] . '</td>';
            echo '<td> ' . (isset($row['hod2_first_name']) ? $row['hod2_first_name'] : '') . ' ' . (isset($row['hod2_last_name']) ? $row['hod2_last_name'] : '') . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td colspan="3"><strong>หมายเลขเครื่อง:</strong> ' . $row['serial_number'] . '</td>';
            echo '<td colspan="3"><strong>ปีที่ 2:</strong> ' . $row['year2_percentage'] .' <strong>%</strong> '. ' <strong>คงเหลือ:</strong> ' . $row['year2_remaining_price'] . ' <strong>บาท</strong> '. '</td>';
            echo '<td> ' . $row['fiscal_year3'] . '</td>';
            echo '<td> ' . $row['dp_name3'] . '</td>';
            echo '<td> ' . $row['user_name3'] . '</td>';
            echo '<td> ' . (isset($row['hod3_first_name']) ? $row['hod3_first_name'] : '') . ' ' . (isset($row['hod3_last_name']) ? $row['hod3_last_name'] : '') . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td colspan="3"><strong>หมายเลขกรอบ:</strong> ' . $row['frame_number'] . '</td>';
            echo '<td colspan="3"><strong>ปีที่ 3:</strong> ' . $row['year3_percentage'] .' <strong>%</strong> ' . ' <strong>คงเหลือ:</strong> ' . $row['year3_remaining_price'] . ' <strong>บาท</strong> '. '</td>';
            echo '<td> ' . $row['fiscal_year4'] . '</td>';
            echo '<td> ' . $row['dp_name4'] . '</td>';
            echo '<td> ' . $row['user_name4'] . '</td>';
            echo '<td> ' . (isset($row['hod4_first_name']) ? $row['hod4_first_name'] : '') . ' ' . (isset($row['hod4_last_name']) ? $row['hod4_last_name'] : '') . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td colspan="3"><strong>หมายเลขจดทะเบียน:</strong> ' . $row['registration_number'] . '</td>';
            echo '<td colspan="3"><strong>ปีที่ 4:</strong> ' . $row['year4_percentage'] .' <strong>%</strong> ' . ' <strong>คงเหลือ:</strong> ' . $row['year4_remaining_price'] . ' <strong>บาท</strong> '. '</td>';
            echo '<td> ' . $row['fiscal_year5'] . '</td>';
            echo '<td> ' . $row['dp_name5'] . '</td>';
            echo '<td> ' . $row['user_name5'] . '</td>';
            echo '<td> ' . (isset($row['hod5_first_name']) ? $row['hod5_first_name'] : '') . ' ' . (isset($row['hod5_last_name']) ? $row['hod5_last_name'] : '') . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td colspan="3"><strong>สีของพัสดุ:</strong> ' . $row['color'] . '</td>';
            echo '<td colspan="3"><strong>ปีที่ 5:</strong> ' . $row['year5_percentage'] .' <strong>%</strong> ' . ' <strong>คงเหลือ:</strong> ' . $row['year5_remaining_price'] . ' <strong>บาท</strong> '. '</td>';
            echo '<td> ' . $row['fiscal_year6'] . '</td>';
            echo '<td> ' . $row['dp_name6'] . '</td>';
            echo '<td> ' . $row['user_name6'] . '</td>';
            echo '<td> ' . (isset($row['hod6_first_name']) ? $row['hod6_first_name'] : '') . ' ' . (isset($row['hod6_last_name']) ? $row['hod6_last_name'] : '') . '</td>';
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
            echo '<td colspan="3"><strong>เงื่อนไข-การประกัน:</strong></td>';
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
        }
} else {
    echo "ไม่มีข้อมูลสำหรับหมายเลขอุปกรณ์ที่ระบุ";
}

$conn->close();
?>