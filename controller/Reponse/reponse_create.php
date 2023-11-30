<?php
require_once 'reponse.php';
require_once '../../model/Reponse/reponseC.php';


$RepC = new ResponseC();
$Rep = new Response($_POST['ID_Reclamation'], $_POST['text']);

$result = $RepC->ajouterResponse($Rep);

echo $result;

header('Location: ../../View/Reponse/dashboard_reponse.php');

exit;
