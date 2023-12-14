<?php
require_once 'reclamation.php';


session_start();



$RecC = new Reclamation($_SESSION["user_ID"], $_POST['text']);

$Rec = new ReclamationC();

$result = $Rec->ajouterReclamation($RecC);

echo $result;


header('Location: ../../View/index.php');

exit;
