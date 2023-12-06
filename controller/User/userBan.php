<?php
require_once '../../controller/User/user.php'; 
require_once '../../model/User/userC.php'; 

$id = $_POST['id'];

$userCRUD = new UserCRUD();
$userCRUD->banUser($id);

header('Location: ../../view/User/dashboard_admin.php');
exit;