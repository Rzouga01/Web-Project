<?php
require 'reponse.php';

$RepC = new ResponseC();

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    if (!empty($id)) {
        $RepC->supprimerResponse($id);
        header('Location: ../../View/Reponse/dashboard_reponse.php');
        exit();
    }
}