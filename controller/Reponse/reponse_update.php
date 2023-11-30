
<?php

require_once 'reponse.php';

$RepC = new ResponseC();

if (isset($_POST['id'], $_POST['text'], $_POST['date'])) {
    $id = $_POST['id'];
    $text = $_POST['text'];
    $date = $_POST['date'];

    $result = $RepC->modifierResponse($id, $text, $date, $status);
} else {

    echo "Invalid data received.";
}


header('Location: ../../View/Reponse/dashboard_reponse.php');
exit;
