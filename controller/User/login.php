<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once '../../database/connect.php'; 
    require_once '../../controller/User/user.php'; 
    require_once '../../model/User/userC.php'; 

    $user = new UserCRUD();

    if (isset($_POST["email"]) && isset($_POST["password"])) {
        $email = $_POST["email"];
        $password=$_POST["password"];
        $userData = $user->getUserByEmail($email);
        
        if ($userData == null) {
            echo "<script>alert('Email not found in the database!'); window.location.href='../../view/User/user.html#signin';</script>";
            exit;
        }

        if (isset($userData)&&$userData['Email']==$email&&$userData['Password']==$password) {
            $_SESSION['user_id'] = $userData['id'];
            $_SESSION['username'] = $userData['Email'];
            $_SESSION['password'] = $userData['Password'];
            header('Location: ../../view/index.php');
            exit;
        } else {
            echo "<script>alert('Invalid email or password!'); window.location.href='../../view/User/user.html#signin';</script>";
        }
    } else {
        echo "<script>alert('Please provide both email and password!'); window.location.href='../../view/User/user.html#signin';</script>";
    }
} else {
    echo "<script>alert('Invalid request method!'); window.location.href='../../view/User/user.html#signin';</script>";
}
?>