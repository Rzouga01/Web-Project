<?php
require_once 'reponse.php'; // Assuming this is your Response class definition
require_once 'reponseC.php'; // Assuming this is your ResponseC class definition

// Assuming $_POST['ID_Reclamation'] and $_POST['text'] are set
$RepC = new ResponseC(); // Corrected to use ResponseC instead of Response
$Rep = new Response($_POST['ID_Reclamation'], $_POST['text']); // Assuming Response is your entity class

$result = $RepC->ajouterResponse($Rep); // Corrected to use $RepC instead of $Rep

echo $result;

header('Location: ../../View/Reponse/dashboard_reponse.php');
exit;
