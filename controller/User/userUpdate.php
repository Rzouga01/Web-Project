<?php
require_once '../../controller/User/user.php'; 
require_once '../../model/User/userC.php'; 

$user = new UserCRUD();

$firstName = $_POST["First_Name"];
$lastName = $_POST["Last_Name"];
$email = $_POST["Email"];
$phoneNumber = $_POST["Phone_number"];
$password = $_POST["Password"];
$birthdate = $_POST["Birthdate"];
$country = $_POST["Country"];
$role = $_POST["Role"];
$id = $_POST["ID_USER"]; 

$userObject = new UserClass($id, $firstName, $lastName, $email, $phoneNumber, $password, $birthdate, $country, $role); 
$result = $user->update_user($userObject);

echo $result;
header('Location: ../../view/User/dashboard_user.php');
exit;
?>