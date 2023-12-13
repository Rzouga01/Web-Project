<?php
require 'productC.php';

$ProductC = new ProductC();

if (isset($_POST['id'])) {
  $id = $_POST['id'];
  if (!empty($id)) {
    $ProductC->delete($id);
    header('Location: ../../view/Product/dashboard_product.php');
    exit();
  }
}
