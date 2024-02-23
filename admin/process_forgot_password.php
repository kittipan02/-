<?php
// Include database connection code here
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "repair";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $u_email = $_POST["u_email"];

    // Validate email
    if (!filter_var($u_email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        // Additional handling, such as redirecting back to the forgot password form
        exit;
    }

    // Sanitize data
    $u_email = htmlspecialchars($u_email);

    // Check if the email exists in the 'users' table
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT u_id FROM users WHERE u_email = ?");
    $stmt->bind_param("s", $u_email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Generate a unique token for password reset
        $reset_token = bin2hex(random_bytes(32));

        // Store the token in the database along with the user's email
        $stmt = $conn->prepare("UPDATE users SET reset_token = ? WHERE u_email = ?");
        $stmt->bind_param("ss", $reset_token, $u_email);
        $stmt->execute();

        // Send an email with the reset link
        $reset_link = "http://yourwebsite.com/reset_password.php?token=$reset_token";
        // Implement your email sending logic here
        
        echo "Password reset link sent to your email. Please check your inbox.";

    } else {
        echo "User not found. Please check your email and try again.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method. Please use POST.";
}
?>
