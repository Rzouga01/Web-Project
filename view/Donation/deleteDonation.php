<?php
include('../../controller/Donation/DonationC.php');

$donC = new DonationC();
$donC->deleteDonation($_GET['ref']);
header('Location: showDonation.php');
?>