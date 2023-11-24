<?php
require_once '../../controller/User/user.php'; 
require_once '../../model/User/userC.php'; 

$user = new UserCRUD();

if (
    isset($_POST["ID_USER"], $_POST["First_Name"], $_POST["Last_Name"], $_POST["Email"], $_POST["Phone_number"], $_POST["Password"], $_POST["Birthdate"], $_POST["Country"], $_POST["Role"])
) {
    
    $id = $_POST["ID_USER"];
    $firstName = $_POST["First_Name"];
    $lastName = $_POST["Last_Name"];
    $email = $_POST["Email"];
    $phoneNumber = $_POST["Phone_number"];
    $password = $_POST["Password"];
    $birthdate = $_POST["Birthdate"];
    $country = $_POST["Country"];
    $role = $_POST["Role"];

    $userObject = new UserClass($id, $firstName, $lastName, $email, $phoneNumber, $password, $birthdate, $country, $role);

  
    $result = $user->update_user($userObject);
    echo $result;

    header('Location: ../../view/User/dashboard_user.php');
    exit;
} else {
    echo "Invalid data received.";
}
?>
