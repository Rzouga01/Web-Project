<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

function sendVerificationEmail($email)
{
    $encodedEmail = base64_encode($email);
    $token = bin2hex(random_bytes(20)) . "/" . $encodedEmail;

    $mail = new PHPMailer(true);
    $emailContent = '<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <style type="text/css">
        a:hover {
            text-decoration: underline !important;
        }
    </style>
</head>
<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: \'Open Sans\', sans-serif;">
        <tr>
            <td>
                <table style="background-color: #f2f3f8; max-width:670px; margin:0 auto;" width="100%" border="0"
                    align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="padding:0 35px; text-align: center;">
                            <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:\'Rubik\',sans-serif;text-align: center;">
                                Account Verification
                            </h1>
                            <hr style="border: 0; height: 1px; background: #333; background-image: linear-gradient(to right, #ccc, #333, #ccc);">
                            <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                To complete your account verification, please click the button below.
                            </p>
                            <a href="http://localhost/Web-Project/controller/User/userVerify.php?token=' . urlencode($token) . '"
                                style="background:#F4BE37;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;">Verify
                                Account</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="text-align:center; padding-top: 30px;">
                <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">
                    &copy; <strong>RecoveryButterfly</strong>
                </p>
            </td>
        </tr>
        <tr>
            <td style="height:80px;">&nbsp;</td>
        </tr>
    </table>
</body>
</html>';
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'rzouga.psn@gmail.com';
        $mail->Password = 'tunj vicd hkrz ydxe';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('support@recoverybutterfly.org', 'Butterfly Effect Support');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Account Verification';
        $mail->Body = $emailContent;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
?>