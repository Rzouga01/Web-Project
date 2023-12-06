<?php
require_once 'reclamation.php';





$RecC = new Reclamation(2, $_POST['text']);

$Rec = new ReclamationC();

$result = $Rec->ajouterReclamation($RecC);

echo $result;




exit;