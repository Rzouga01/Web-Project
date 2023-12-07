<?php
session_start();
require_once '../../controller/User/user.php'; 
require_once '../../model/User/userC.php'; 
$id = $_POST['id'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$phoneNumber = $_POST['phoneNumber'];
$password = $_POST['password'];
$birthdate = $_POST['birthdate'];
$country = $_POST['country'];

$user = new UserClass($firstName, $lastName, $email, $phoneNumber, $password, $birthdate, $country, $role);
$user->setID_USER($id); 

$userCRUD = new UserCRUD();
$userCRUD->update_user($user);
$_SESSION['username'] = $email;
$_SESSION['password']= $password;
$_SESSION['firstName'] = $firstName;
$_SESSION['lastName'] = $lastName;
$_SESSION['phoneNumber'] = $phoneNumber;
$_SESSION['birthdate'] = $birthdate;
$_SESSION['country'] = $country;
header('Location: ../../view/User/dashboard_user.php');
exit;
