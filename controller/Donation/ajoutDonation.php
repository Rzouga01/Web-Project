<?php
require_once '../../controller/Donation/DonationC.php';
require_once '../../model/Donation/Donation.php';

if( isset($_POST['id_user']) && isset($_POST['amount']) && isset($_POST['id_project']))
{
  $donC = new DonationC();
  $donation = new Donation($_POST['id_user'],$_POST['amount'],$_POST['id_project']);
  $donC->addDonation($donation);
}
header('Location: showDonation.php');
?>