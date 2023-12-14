<?php
require_once '../../controller/Donation/DonationC.php';
require_once '../../model/Donation/Donation.php';

session_start();

if (isset($_POST['amount']) && isset($_POST['id_project'])) {
  $donC = new DonationC();
  $donation = new Donation($_SESSION['user_id'], $_POST['amount'], $_POST['id_project']);
  $donC->addDonation($donation);
}
header('Location: showDonation.php');
