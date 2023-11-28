<?php
require_once 'projectC.php';

$projectC = new ProjectC();

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    if (!empty($id)) {
        $projectC->delete($id);
        header('Location: ../../view/Project/dashboard_project.php');
        exit();
    }
}
