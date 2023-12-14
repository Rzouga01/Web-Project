
<?php

require_once 'reponse.php';
require_once '../../model/Reponse/reponseC.php';

$RepC = new ResponseC();

if (isset($_POST['id'], $_POST['text'], $_POST['ID_Reclamation'])) {
    $id = htmlspecialchars($_POST['id']);
    $text = htmlspecialchars($_POST['text']);

    $ID_Reclamation = htmlspecialchars($_POST['ID_Reclamation']);

    $result = $RepC->modifierResponse($id, $text, $ID_Reclamation);
} else {

    echo "Invalid data received.";
}


header('Location: ../../View/Reponse/dashboard_reponse.php');
exit;
