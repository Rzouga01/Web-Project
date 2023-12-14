<?php 
use PHPMailer\PHPMailer\PHPMailer;


require_once "PHPMailer/src/PHPMailer.php";
require_once "PHPMailer/src/SMTP.php";
require_once "PHPMailer/src/Exception.php";
session_start();
$_SESSION['check']=0;
$mail = new PHPMailer(true);
$mail->IsSMTP();
$mail ->Host="smtp.gmail.com";
$mail ->SMTPAuth=true;
$mail ->Username="forminitn80@gmail.com";
$mail ->Password='myfwvcqjxkovbexr';
$mail->setFrom("forminitn80@gmail.com", "RecoveryButterfly");
$mail ->Port=465;
$mail ->SMTPSecure='ssl';
$mail->isHTML(true);
$mail->addAddress("ouertatani.yasmine@esprit.tn");
$mail->Subject = "Participation in  ".$_GET['name'];
$mail->Body= "Here is your invitaion mail , please show this mail when attending our event ".$_GET['name'];


if($mail->send())
	{
       
	   echo "Mail envoyé";	
     header('Location:MesParticipation.php');
   
    }
	else
	{
		echo $mail->ErrorInfo;
	}
    ?>