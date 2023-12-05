<?php 

require_once 'productC.php';
require_once '../../model/Product/product_class.php';

$ProductC = new productC();


if (isset($_POST['type-name'],
          $_POST['type-description'],
        
        $_POST['type-price'])) {
    $name = $_POST['type-name'];
    $price = $_POST['type-price'];
    $description = $_POST['type-description'];




  $result = $ProductC->create($id, $name, $price, $description);


  echo $result;
} else {

  echo "Invalid data received.";
}


header('Location: ../../view/Product/dashboard_product.php');
exit;
