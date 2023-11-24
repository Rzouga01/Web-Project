
<?php

require_once 'projectC.php';

$TypeC = new TypeC();


if (isset($_POST['type-name'], $_POST['type-description'])) {
    $name = $_POST['type-name'];
    $description = $_POST['type-description'];

    $result = $TypeC->create_type($name, $description);

    echo $result;
} else {

    echo "Invalid data received.";
}


header('Location: ../../view/Project/dashboard_project.php');
exit;
