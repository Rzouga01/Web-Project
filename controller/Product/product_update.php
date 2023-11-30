<?php

require_once 'productC.php';
require_once '../../model/Product/product_class.php';

$ProductC = new ProductC();

// Validate POST data
if (isset($_POST['name'], $_POST['description'],$_POST['id'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];


    $id = $_POST['id'];

    $result = $ProductC->update($id, $name, $description,$price);
} else {

    echo "Invalid data received.";
}


header('Location: ../../view/Product/dashboard_product.php');
exit;
