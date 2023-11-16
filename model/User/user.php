<?php
require_once 'user_class.php';
require_once '../../model/Connection/connection.php';

class UserCRUD {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function createUser(UserClass $user) {
        $rq = $this->db->prepare("INSERT INTO user (ID_USER, First_Name, Last_Name, Email, Phone_number, Password, Birthdate, Country, Role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $rq->execute([$user->getID_USER(), $user->getFirst_Name(), $user->getLast_Name(), $user->getEmail(), $user->getPhone_number(), $user->getPassword(), $user->getBirthdate(), $user->getCountry(), $user->getRole()]);
    }   
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST["ID_USER"]) &&
        isset($_POST["First_Name"]) &&
        isset($_POST["Last_Name"]) &&
        isset($_POST["Email"]) &&
        isset($_POST["Phone_number"]) &&
        isset($_POST["Password"]) &&
        isset($_POST["Birthdate"]) &&
        isset($_POST["Country"]) &&
        isset($_POST["Role"])
    ) {
        $user = new UserClass(
            $_POST["ID_USER"],
            $_POST["First_Name"],
            $_POST["Last_Name"],
            $_POST["Email"],
            $_POST["Phone_number"],
            $_POST["Password"],
            $_POST["Birthdate"],
            $_POST["Country"],
            $_POST["Role"]
        );

        $db = new PDO('mysql:host=localhost;dbname=recoverybutterfly', 'root', ''); 
        $userCRUD = new UserCRUD($db);
        $userCRUD->createUser($user);
    }
}

?>

