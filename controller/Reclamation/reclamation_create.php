<?php
require_once 'reclamation.php';



session_start();

$RecC = new Reclamation($_SESSION["user_id"], $_POST['text']);

$Rec = new ReclamationC();

$result = $Rec->ajouterReclamation($RecC);

echo $result;



header('Location: ../../View/Reclamation/dashboard_reclamation.php');
exit;
