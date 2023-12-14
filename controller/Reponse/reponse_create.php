<?php
require_once 'reponse.php';
require_once '../../model/Reponse/reponseC.php';

session_start();



$Rep = new Response($_POST['ID_Reclamation'],$_SESSION["user_ID"], $_POST['text']);


$RepC = new ResponseC();

$result = $RepC->ajouterResponse($Rep);

echo $result;

header('Location: ../../View/Reponse/dashboard_reponse.php');

exit;
