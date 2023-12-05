<?php
session_start();

require_once '../../database/connect.php';
require_once '../../controller/User/user.php';
require_once '../../model/User/userC.php';

$user = new UserCRUD();

if (
    isset($_POST["First_Name"], $_POST["Last_Name"], $_POST["Email"], $_POST["Password"], $_POST["Phone_number"], $_POST["Birthdate"], $_POST["Country"], $_POST["Role"])
) {
    $firstName = $_POST["First_Name"];
    $lastName = $_POST["Last_Name"];
    $email = $_POST["Email"];
    $password = $_POST["Password"];
    $phoneNumber = $_POST["Phone_number"];
    $birthdate = $_POST["Birthdate"];
    $country = $_POST["Country"];
    $role = $_POST["Role"];
    $userObject = new UserClass($firstName, $lastName, $email, $phoneNumber, $password, $birthdate, $country, $role);

    $UserId = $user->create_user($userObject);

    $_SESSION['user_id'] = $UserId;
    $_SESSION['username'] = $email;
    $_SESSION['password']= $password;
    $_SESSION['firstName'] = $firstName;
    $_SESSION['lastName'] = $lastName;
    $_SESSION['phoneNumber'] = $phoneNumber;
    $_SESSION['birthdate'] = $birthdate;
    $_SESSION['country'] = $country;
    $_SESSION['role'] = $role;
    header('Location: ../../view/index.php'); 
    exit;
} else {
    echo "Invalid data received.";
}
?>
