<?php
//session_start();
//echo $_SESSION["u_id"];
//echo $_SESSION["email"];
//echo $_SESSION["fullname"];
?>
<?php
session_start();
// Check if session 'u_id' exists
if (!isset($_SESSION['u_id'])) {
    // If session 'u_id' does not exist, redirect to the login page or perform logout
    echo "กรุณา <a href=\"../logout.php\"><i class=\"fa-solid fa-arrow-right-to-bracket\"></i> ไปที่login</a>";
    exit; // Exit the script
}
$user = null;
if (isset($_SESSION['u_id'])) {
   $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "repair";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // ตรวจสอบการเชื่อมต่อ
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // ดึงข้อมูลผู้ใช้จากฐานข้อมูล
    $u_id = $_SESSION['u_id'];
    $sql = "SELECT * FROM users WHERE u_id = $u_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    }

    $conn->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    
    <style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f8f8;
        font-size: 18px;
    }


    @media only screen and (max-width: 600px) {
    /* ปรับสไตล์ของ Nav Bar หรือ Element ที่ต้องการให้เหมาะสมกับขนาดหน้าจอเล็ก */
    nav {
        /* เพิ่มสไตล์ที่เหมาะสม */
        flex-direction: column;
    }

    nav a {
        /* ปรับสไตล์ของลิงก์ */
        display: block;
        text-align: center;
    }
}
header {
  margin-bottom: 10%; /* กำหนดระยะห่างด้านล่างของ header */
}

body {
  padding-top: 20px; /* กำหนดระยะห่างด้านบนของ body */
}
        #toTop {
            position: fixed;
            bottom: 20px; /* ระยะห่างจากด้านล่างของหน้าเว็บ */
            right: 20px; /* ระยะห่างจากด้านขวาของหน้าเว็บ */
            background-color: #000; /* สีพื้นหลัง */
            color: #fff; /* สีข้อความ */
            padding: 10px 20px; /* ขนาดของพื้นที่ padding */
            border-radius: 5px; /* รูปร่างของเส้นขอบ */
            display: none; /* ซ่อนลิงก์เริ่มต้น */
            z-index: 999; /* ความสูงขององค์ประกอบ */
            cursor: pointer; /* เมาส์เป็นเครื่องมือแสดงการเลื่อน */
        }

        #toTop:hover {
            background-color: #333; /* สีพื้นหลังเมื่อโฮเวอร์ */
        }

.to-top{
	color:white;
	padding-top:1.8em;
	display:inline-block;/* or block */
	position:relative;
	border-color:white;
	text-decoration:none;
	transition:all .3s ease-out;
}
.to-top:before{
	content:'▲';
	font-size:.9em;
	position:absolute;
	top:0;
	left:50%;
	margin-left:-.7em;
	border:solid .13em white;
	border-radius:10em;
	width:1.4em;
	height:1.4em;
	line-height:1.3em;
	border-color:inherit;
	transition:transform .5s ease-in;
}
.to-top:hover{
	color:pink;
	border-color:pink;
}
.to-top:hover:before{
	transform: rotate(360deg);
}
    nav {
        background-color: #fff;
        margin: auto;
        padding: 10px;
        display: flex;
        justify-content: space-between;
        border: 1px solid #ddd;
        border-radius: 8px;
        align-items: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    nav a {
    text-decoration: none;
    color: black;
    padding: 10px;
    border-radius: 5px;
    transition: background-color 0.3s, color 0.3s;
    font-weight: bold;
    position: relative;
    overflow: hidden;
    margin-bottom: 5px; /* เพิ่มบรรทัดนี้ */
    display: flex; /* เพิ่มบรรทัดนี้ */
    flex-direction: column; /* เพิ่มบรรทัดนี้ */
    align-items: center; /* เพิ่มบรรทัดนี้ */
}

nav div {
        display: flex;
    }
    nav {
    position: fixed; /* ติดตามตำแหน่งแม้ว่าจะเลื่อนหน้าเว็บ */
    top: 0; /* ตั้งที่ด้านบนของหน้าเว็บ */
    width: 100%; /* ความกว้างเต็มหน้าจอ */
    z-index: 1000; /* ให้แถบนำทางอยู่ด้านบนขององค์ประกอบอื่น ๆ */
}
    nav a {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: left;
        margin: 0 10px;
        margin-right: 20px; /* เพิ่มระยะห่างด้านขวาของคอลัมน์ */
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

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropbtn {
        text-decoration: none;
        color: black;
        padding: 10px;
        border-radius: 5px;
        transition: background-color 0.3s, color 0.3s;
        margin: 0 10px;
        font-weight: bold;
        position: relative;
        overflow: hidden;
    }

    .dropdown-content {
    display: none;
    position: absolute;
    background-color: #fff;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    }
    .dropdown-content a {
        color: white;
        padding: 8px 10px; /* ปรับขนาด padding เพื่อลดขนาดของปุ่ม */
        text-decoration: none;
        display: block;
        transition: background-color 0.3s, color 0.3s;
    }

    .dropdown-content a:hover {
        background-color: #1b02a8;
        color: #fff;
    }

    .dropdown:hover .dropdown-content {
    display: block;
    align-items: center;
    justify-content: center;
    }

    h3 {
        color: #FFFFFF;
    }

    p {
        font-size: 16px;
        color: #555;
    }
    
    header {
  margin-bottom: 1%; /* กำหนดระยะห่างด้านล่างของ header */
}

    /* ปรับแต่งสไตล์ปุ่ม */
    .btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #1b02a8;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s, color 0.3s;
        cursor: pointer; /* เพิ่ม cursor เป็น pointer เมื่อชี้ที่ปุ่ม */
    }

    .btn:hover {
        background-color: #fff;
        color: #1b02a8;
    }
    
    @media only screen and (max-width: 600px) {
    .dropdown-content .dropdown {
        display: none; /* ซ่อน dropdown หรือปรับการแสดงผลของมัน */
    }
}

</style>
    <!-- Include your other stylesheets and scripts here -->
</head>
<body>
    <header>
<nav>
<img src="../upload_files/uploads/ตรา.อบจ.png" alt="โลโก้ของคุณ" style="width: 80px; ">
<div>
    <div class="dropdown">
        <a href="admin_dashboard.php"><i class="fa-solid fa-house-chimney-window fa-2x"></i></a>
        <div style="background-color: #fff;" class="dropdown-content">
            <span style="color: #000; display: block; width: auto; height: auto; font-size: 20px; text-align: center;">หน้าแรก</span>
        </div>
    </div>

    <div class="dropdown">
        <a href="material_types.php"><i class="fa-solid fa-box fa-2x"></i></a>
        <div style="background-color: #fff;" class="dropdown-content">
            <span style="color: #000; display: block; width: auto; height: auto; font-size: 20px; text-align: center;">วัสดุ</span>
        </div>
    </div>

    <div class="dropdown">
        <a href="equipment_types_table.php"><i class="fa-solid fa-table-list fa-2x"></i></a>
        <div style="background-color: #fff;" class="dropdown-content">
            <span style="color: #000; display: block; width: 150px; height: auto; font-size: 20px; text-align: center;">ประเภทครุภัณฑ์</span>
        </div>
    </div>

    <div class="dropdown">
        <a href="repair_requests.php"><i class="fa-solid fa-screwdriver-wrench fa-2x"></i></a>
        <div style="background-color: #fff;" class="dropdown-content">
            <span style="color: #000; display: block; width: auto; height: auto; font-size: 20px; text-align: center;">แจ้งซ่อม</span>
        </div>
    </div>

    <div class="dropdown">
        <a href="display_assets.php"><i class="fa-solid fa-layer-group fa-2x"></i></a>
        <div style="background-color: #fff;" class="dropdown-content">
            <span style="color: #000; display: block; width: 190px; height: auto; font-size: 20px; text-align: center;">ทะเบียนพัสดุครุภัณฑ์</span>
        </div>
    </div>
</div>


    <div class="dropdown">
            <!-- Display username on the button -->
            <?php if ($user): ?>
            <div class="dropdown">
            <a href="#" class="dropbtn"><i class="fa-solid fa-user-tie fa-2x"></i>(<?php echo $user['u_email']; ?>)</a>
                <div style="background-color: #333;" class="dropdown-content"><br>
                    <a href="manage_users.php"><i class="fa-solid fa-users"></i> จัดการผู้ใช้</a>
                    <a href="headofdepartment.php">
                    <i class="fa-solid fa-briefcase fa">แผนก/ฝ่าย</i></a>
                <a href="repair_sale.php">
                    <i class="fa-solid fa-cart-shopping">รอจำหน่าย</i></a>
                    <a href="repair_sale_history.php">
                    <i class="fa-solid fa-receipt">ประวัติการจำหน่าย</i></a>
                <a href="repair_status.php">
                    <i class="fa-solid fa-diagram-project fa">สถานะ</i></a>
                <a href="repair_report_history.php">
                    <i class="fa-solid fa-book fa">ประวัติการแจ้งซ่อม</i></a>
                <a href="repair_requests_summary.php">
                    <i class="fa-solid fa-chart-pie fa">กราฟสรุป</i></a>
                    <a href="../logout.php"><i class="fas fa-sign-out-alt"></i> ล็อกเอ้า</a>
                </div>
            </div>
            <?php else: ?>
            <?php endif; ?>
        </div>
    </nav>
    </header>
    <br><br><br>
    <a href="#" id="toTop"><i class="fa fa-arrow-up fa-2x" aria-hidden="true"></i></a>
    <script>
        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {scrollFunction()};

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("toTop").style.display = "block";
            } else {
                document.getElementById("toTop").style.display = "none";
            }
        }
        // When the user clicks on the button, scroll to the top of the document
        document.getElementById("toTop").onclick = function() {
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
        }
    </script>
    <br><br>
</body>
</html>
