<?php
require 'categoryC.php';

$CategoryC = new CategoryC();

if (isset($_POST['id'])) {
  $id = $_POST['id'];
  if (!empty($id)) {
    $CategoryC->delete($id);
    header('Location: ../../view/Category/dashboard_category.php');
    exit();
  }
}
