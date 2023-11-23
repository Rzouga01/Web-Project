<?php
require 'reclamation.php';

$RecC = new ReclamationC();

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    if (!empty($id)) {
        $RecC->supprimerReclamation($id);
        header('Location: ../../View/Reclamation/dashboard_reclamation.php');
        exit();
    }
}
