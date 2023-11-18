<?php

require_once 'typeC.php';
require_once '../../model/Type/type_class.php';

$TypeC = new TypeC();

// Validate POST data
if (isset($_POST['type-name'], $_POST['type-description'])) {
    $name = $_POST['type-name'];
    $description = $_POST['type-description'];


    $result = $TypeC->update_type($id, $newName, $newDescription);

    // Handle the result or display an alert if needed
    echo $result;
} else {
    // Handle missing or invalid POST data
    echo "Invalid data received.";
}

// Redirect to the dashboard_type.php page
header('Location: ../../view/Type/dashboard_type.php');
exit;
