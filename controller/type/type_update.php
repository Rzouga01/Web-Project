<?php

require_once 'typeC.php';
require_once '../../model/Type/type_class.php';

$TypeC = new TypeC();

if (isset($_POST['name'], $_POST['description'], $_POST['id'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $id = $_POST['id'];

    $result = $TypeC->update_type($id, $name, $description);


    echo "1";
} else {

    echo "Invalid data received.";
}


header('Location: ../../view/Type/dashboard_type.php');
exit;
