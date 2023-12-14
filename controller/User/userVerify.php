<?php 
require_once '../../controller/User/user.php'; 
require_once '../../model/User/userC.php'; 

$user = new UserCRUD(); 
$result = $user->verifyUser($id); 

if ($result) {
    echo "User verified successfully.";
} else {
    echo "Failed to verify user.";
}