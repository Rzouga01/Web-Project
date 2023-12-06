<?php
require_once '../../controller/User/user.php'; 
require_once '../../model/User/userC.php'; 

$id = $_POST['id'];
$user = new UserCRUD();
$unbanned = $user->unbanUser($id);

if($unbanned) {
    echo "User has been unbanned successfully.";
} else {
    echo "Failed to unban user.";
}