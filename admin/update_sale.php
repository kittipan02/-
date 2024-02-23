<?php
// ตรวจสอบว่ามีการส่งข้อมูลผ่าน POST หรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["request_id"]) && isset($_POST["status"])) {
    $requestId = $_POST["request_id"];
    $statusId = $_POST["status"];

    // เชื่อมต่อฐานข้อมูล
    $conn = new mysqli("localhost", "root", "", "repair");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // อัพเดทสถานะในตาราง repair_requests
    $updateStatusQuery = "UPDATE repair_requests SET status_id = $statusId WHERE request_id = $requestId";
    $conn->query($updateStatusQuery);

    // ดึงข้อมูลสถานะจากฐานข้อมูล
    $getStatusQuery = "SELECT rs_name FROM repair_status WHERE rs_id = $statusId";
    $statusResult = $conn->query($getStatusQuery);
    $statusRow = $statusResult->fetch_assoc();
    $statusName = $statusRow["rs_name"];

    // ปิดการเชื่อมต่อ
    $conn->close();

    // ส่งข้อมูลสถานะกลับไปยังหน้าที่แสดงรายการแจ้งซ่อม
    echo json_encode(["status" => $statusName]);
}
?>
<script>
   document.addEventListener("DOMContentLoaded", function () {
    // ดึง DOM elements ที่มี attribute data-update-status
    var updateStatusForms = document.querySelectorAll("[data-update-status]");

    // วนลูปทุก form
    updateStatusForms.forEach(function (form) {
        form.addEventListener("submit", function (event) {
            event.preventDefault();

            // ให้ใช้ Fetch API หรือ XMLHttpRequest สำหรับส่งข้อมูลไปยัง update_status.php
            // โดยส่ง request เป็น POST และในรูปแบบข้อมูลที่เหมาะสม
            // หลังจากได้ response จาก update_status.php ให้ดึงสถานะมาแสดงในตาราง
            var request = new XMLHttpRequest();
            request.open("POST", this.action, true);
            request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");

            // ส่งข้อมูลจาก form ไปยัง update_status.php
            request.send(new FormData(this));

            // รอการตอบสนองจาก update_status.php
            request.onload = function () {
                if (request.status >= 200 && request.status < 400) {
                    // ดึงข้อมูล JSON ที่ได้จาก update_status.php
                    var response = JSON.parse(request.responseText);

                    // หา DOM element ที่ต้องการอัพเดท
                    var statusElement = document.getElementById("status-" + response.requestId);

                    // อัพเดทข้อมูลใน DOM
                    if (statusElement) {
                        statusElement.textContent = response.status;

                        
                    }
                }
            };
        });
    });
});
// Redirect ไปยังหน้า repair_requests.php
window.location.href = 'repair_sale_history.php';
</script>
