<?php
require_once 'reponse.php';

session_start();


$Rep = new Response($_POST['ID_Reclamation'], $_POST['text']);

$RepC = new ResponseC();

$result = $RepC->ajouterResponse($Rep);

echo $result;

header('Location: http://localhost/Web-Project/view/index.php');

exit;