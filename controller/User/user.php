<?php
require_once "../../database/connect.php";
require_once '../../model/User/userC.php';

class UserCRUD
{
    public function create_user($user)
    {
        $cnx = Config::getConnexion();
        $insert = $cnx->prepare("INSERT INTO user (First_Name, Last_Name, Password, Phone_number, Birthdate, Country, Email, Role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $insert->execute([
            $user->getFirst_Name(),
            $user->getLast_Name(),
            $user->getPassword(),
            $user->getPhone_number(),
            $user->getBirthdate(),
            $user->getCountry(),
            $user->getEmail(),
            $user->getRole()
        ]);
    }

    public function getAllUsers()
    {
        $cnx = Config::getConnexion();
        $select = $cnx->prepare("SELECT * FROM user");
        $select->execute();
        $users = $select->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    public function update_user($user)
    {
        $cnx = Config::getConnexion();
        $query = $cnx->prepare("UPDATE user SET First_Name = ?, Last_Name = ?, Email = ?, Phone_number = ?, Password = ?, Birthdate = ?, Country = ?, Role = ? WHERE ID_USER = ?");
        $query->execute([
            $user->getFirst_Name(),
            $user->getLast_Name(),
            $user->getEmail(),
            $user->getPhone_number(),
            $user->getPassword(),
            $user->getBirthdate(),
            $user->getCountry(),
            $user->getRole(),
            $user->getID_USER()
        ]);
    }

    public function delete_user($id)
    {
        $cnx = Config::getConnexion();
        $delete = $cnx->prepare("DELETE FROM user WHERE ID_USER = ?");
        $delete->execute([$id]);
    }


}
