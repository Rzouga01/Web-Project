<?php

require_once 'categoryC.php';
require_once '../../model/Category/category_class.php';

$CategoryC = new CategoryC();

// Validate POST data
if (isset($_POST['name'], $_POST['description'], $_POST['id'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $id = $_POST['id'];

    $result = $CategoryC->update($id, $name, $description);
} else {

    echo "Invalid data received.";
}


header('Location: ../../view/Category/dashboard_category.php');
exit;
