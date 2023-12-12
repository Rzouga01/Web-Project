<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['token'])) {
    $token = $_GET['token'];
    $tokenParts = explode(".", $token);
    $encodedEmail = $tokenParts[1];
    $email = base64_decode($encodedEmail);
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Reset Password</title>
    </head>

    <body>
        <h2>Reset Your Password</h2>
        <form method="post" action="resetPwd.php">
            <input type="hidden" name="token" value="<?php echo $token; ?>">
            <input type="hidden" name="email" value="<?php echo $email; ?>">
            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" required>
            <input type="submit" value="Reset Password">
        </form>
    </body>

    </html>
    <?php
} else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['token'])) {
    $token = $_POST['token'];
    $newPassword = $_POST['new_password'];
    echo "Password updated successfully!";
} else {
    echo "Invalid request!";
}
?>