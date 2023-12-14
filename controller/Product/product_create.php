<?php

require_once 'productC.php';


$ProductC = new productC();


if (isset(
  $_POST['name'],
  $_POST['description'],
  $_POST['price'],
  $_POST['image'],
  $_POST['category']
)) {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $description = $_POST['description'];
  $image = $_POST['image'];
  $category = $_POST['category'];




  $result = $ProductC->create($name, $price, $description, $image, $category);


  echo $result;
} else {

  echo "Invalid data received.";
}


header('Location: ../../view/Product/dashboard_product.php');
exit;
