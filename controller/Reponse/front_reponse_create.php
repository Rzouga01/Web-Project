<?php
require_once 'reponse.php';



$RepC = new ResponseC();
$Rep = new Response($_POST['ID_Reclamation'], $_POST['text']);

$result = $RepC->ajouterResponse($Rep);

echo $result;

header('Location: http://localhost/Web-Project/view/index.php');

exit;
