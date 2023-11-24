<?php
require_once '../../controller/User/user.php'; 

$user = new UserCRUD();

if (isset($_POST['ID_USER'])) {
    $id = $_POST['ID_USER'];
    if (!empty($id)) {
        $user->delete_user($id);
        header('Location: ../../view/User/dashboard_user.php');
        exit();
    }
}
?>
