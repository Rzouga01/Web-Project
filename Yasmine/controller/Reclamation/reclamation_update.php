<?php

require_once 'reclamation.php';

$RecC = new ReclamationC();

if (isset($_POST['id'], $_POST['text'], $_POST['date'], $_POST['status'])) {
    $id = $_POST['id'];
    $text = $_POST['text'];
    $date = $_POST['date'];
    $status = $_POST['status'];

    $result = $RecC->modifierReclamation($id, $text, $date, $status);
} else {

    echo "Invalid data received.";
}


header('Location: ../../View/Reclamation/dashboard_reclamation.php');
exit;
