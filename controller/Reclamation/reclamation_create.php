<?php
require 'reclamation.php';





$RecC = new Reclamation(2, $_POST['text']);

$Rec = new ReclamationC();

$result = $Rec->ajouterReclamation($RecC);

echo $result;



header('Location: ../../View/Reclamation/dashboard_reclamation.php');
exit;
