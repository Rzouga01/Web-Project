<?php
require_once __DIR__ . '/../Connection/connection.php';
require_once 'user_class.php';

class UserCRUD
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createUser(UserClass $user)
    {
        $insert = $this->db->prepare("INSERT INTO user (ID_USER, First_Name, Last_Name, Password, Phone_number, Birthdate, Country, Email, Role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $result = $insert->execute([
            $user->getID_USER(),
            $user->getFirst_Name(),
            $user->getLast_Name(),
            $user->getPassword(),
            $user->getPhone_number(),
            $user->getBirthdate(),
            $user->getCountry(),
            $user->getEmail(),
            $user->getRole()
        ]);
        return $result;
    }
    public function getAllUsers()
    {
        $select = $this->db->prepare("SELECT * FROM user");
        $select->execute();
        $users = $select->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }
    public function updateUser($user)
    {
        $query = $this->db->prepare("UPDATE user SET First_Name = ?, Last_Name = ?, Email = ?, Phone_number = ?, Password = ?, Birthdate = ?, Country = ?, Role = ? WHERE ID_USER = ?");
        $query->execute([$user->getFirstName(), $user->getLastName(), $user->getEmail(), $user->getPhoneNumber(), $user->getPassword(), $user->getBirthdate(), $user->getCountry(), $user->getRole(), $user->getId()]);
    }

    public function deleteUser($id)
    {
        $query = $this->db->prepare("DELETE FROM user WHERE ID_USER = ?");
        $query->execute([$id]);
    }
}
$userCRUD = new UserCRUD($pdo);
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (isset($_POST["delete"])) {
        $userCRUD->deleteUser($_POST["delete"]);
    } elseif (isset($_POST["update"])) {
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
        $userCRUD->updateUser($user);
    } else {
        $id = uniqid(rand(1, 1000));
        $user = new UserClass(
            $id,
            $_POST["First_Name"],
            $_POST["Last_Name"],
            $_POST["Email"],
            $_POST["Phone_number"],
            $_POST["Password"],
            $_POST["Birthdate"],
            $_POST["Country"],
            $_POST["Role"]
        );
        $userCRUD->createUser($user);
    }
}
