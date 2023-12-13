<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once '../../database/connect.php';
    require_once '../../controller/User/user.php';
    require_once '../../model/User/userC.php';

    $user = new UserCRUD();
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $userData = $user->getUserByEmail($email);

        if ($userData == null) {
            echo "<script>alert('Email not found in the database!'); window.location.href='../../view/User/user.html#signin';</script>";
            exit;
        }

        if (isset($userData) && $userData['Email'] == $email && $userData['Password'] == $password) {
            if ($userData['Status'] == 1) {
                echo "<script>alert('This account is banned and cannot log in.'); window.location.href='../../view/User/user.html#signin';</script>";
                exit;
            }
            $_SESSION['user_id'] = $userData['ID_USER'];
            $_SESSION['username'] = $userData['Email'];
            $_SESSION['password'] = $userData['Password'];
            $_SESSION['firstName'] = $userData["First_Name"];
            $_SESSION['lastName'] = $userData["Last_Name"];
            $_SESSION['phoneNumber'] = $userData["Phone_Number"];
            $_SESSION['birthdate'] = $userData["Birthdate"];
            $_SESSION['country'] = $userData["Country"];
            $_SESSION['role'] = $userData["Role"];
            
            header('Location: ../../view/index.php');
            
            exit;
        } else  {
            echo "<script>alert('Invalid email or password!'); window.location.href='../../view/User/user.html#signin';</script>";
        }
    } else {
        echo "<script>alert('Please provide both email and password!'); window.location.href='../../view/User/user.html#signin';</script>";
    }
} else {
    echo "<script>alert('Invalid request method!'); window.location.href='../../view/User/user.html#signin';</script>";
}
?>