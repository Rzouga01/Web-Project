<?php
require_once '../../controller/User/user.php';
$id = $_POST['id'];
$user = new UserCRUD();
$user->delete_user($id);
header('Location: ../../view/User/user_dashboard.php');
?>