<?php
require_once 'typeC.php';

$TypeC = new TypeC();

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    if (!empty($id)) {
        $TypeC->delete_type($id);
        header('Location: ../../view/Type/dashboard_type.php');
        exit();
    }
}
