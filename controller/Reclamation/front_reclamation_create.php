<?php
require_once 'reclamation.php';





$RecC = new Reclamation(6, $_POST['text']);

$Rec = new ReclamationC();

$result = $Rec->ajouterReclamation($RecC);

echo $result;


header('Location: ../../View/index.php');

exit;