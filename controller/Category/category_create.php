<?php
require_once 'categoryC.php';
require_once '../../model/Category/category_class.php';

$CategoryC = new CategoryC();


if (isset($_POST['type-name'], $_POST['type-description'])) {
  $name = $_POST['type-name'];
  $description = $_POST['type-description'];




  $result = $CategoryC->create($name, $description);


  echo $result;
} else {

  echo "Invalid data received.";
}


header('Location: ../../view/Category/dashboard_category.php');
exit;
