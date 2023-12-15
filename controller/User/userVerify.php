<?php
require_once '../../controller/User/user.php';  
require_once '../../model/User/userC.php';

if (isset($_GET['token'])) {
    $tokenParts = explode("/", urldecode($_GET['token']));
    
    if(count($tokenParts) < 2) {
        echo "Invalid token format.";
        exit;
    }

    $email = base64_decode($tokenParts[1]);

    $user = new UserCRUD();
    $userObject = $user->getUserByEmail($email);

    if ($userObject) {
        if ($user->verifyUser($userObject['ID_USER'])) {
            header('Location: ../../view/User/verified.html');
            exit;
        } else {
            echo "User verification failed.";
        }
    } else {
        echo "Invalid token.";
    }
} else {
    echo "Invalid request.";
}
?>