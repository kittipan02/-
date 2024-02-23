<?php
// layout.php
function getStatusColor($statusName) {
    switch ($statusName) {
        case "รับแจ้ง":
            return "blue";
        case "กำลังดำเนินการ":
            return "orange";
        case "เสร็จสมบูรณ์":
            return "green";
        default:
            return "black";
    }
}

// ต่อไปคือเนื้อหาปกติของ layout.php
?>
