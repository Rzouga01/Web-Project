<?php
require_once 'reponse.php';





$RepC = new Response(1, $_POST['text']);

$Rep = new ResponseC();

$result = $Rep->ajouterResponse($RepC);

echo $result;



header('Location: ../../View/Reponse/dashboard_reponse.php');
exit;
