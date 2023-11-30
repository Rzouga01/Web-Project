<?php
require_once 'reponse.php';





$RepC = new Response($_POST['ID_Reclamation'], $_POST['text']);

$Rep = new ResponseC();

$result = $Rep->ajouterResponse($RepC);

echo $result;



header('Location: ../../View/Reponse/dashboard_reponse.php');
exit;
