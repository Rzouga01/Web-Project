<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["mail"];
    $encodedEmail = base64_encode($email);
    $token = bin2hex(random_bytes(20)) . "." . $encodedEmail; 
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = ''; 
        $mail->Password = 'tunj vicd hkrz ydxe'; 
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('support@recoverybutterfly.org', 'Butterfly Effect Support');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Password Reset';
        $mail->Body = 'Click this link to reset your password: <a href="http://localhost/Web-Project/controller/User/resetPwd.php?token=' . $token . '">Reset Password</a>';

        $mail->send();
        echo 'An email has been sent with instructions to reset your password.';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
