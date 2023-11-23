<?php
require_once "../../database/connect.php";
require_once '../../model/User/userC.php';

class UserCRUD
{
    public function create_user($user)
    {
        $cnx = Config::getConnexion();
        $insert = $cnx->prepare("INSERT INTO user (ID_USER, First_Name, Last_Name, Password, Phone_number, Birthdate, Country, Email, Role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
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
        return $result ? "User created successfully" : "Error creating user";
    }

    public function getAllUsers()
    {
        $cnx = Config::getConnexion();
        $select = $cnx->prepare("SELECT * FROM user");
        $select->execute();
        $users = $select->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    public function read_users()
    {
        $cnx = Config::getConnexion();
        $users = [];
        $select = $cnx->query("SELECT * FROM user");
        foreach ($select as $row) {
            $user = [
                'ID_USER' => $row['ID_USER'],
                'First_Name' => $row['First_Name'],
                'Last_Name' => $row['Last_Name'],
                'Password' => $row['Password'],
                'Phone_number' => $row['Phone_number'],
                'Birthdate' => $row['Birthdate'],
                'Country' => $row['Country'],
                'Email' => $row['Email'],
                'Role' => $row['Role']
            ];
            $users[] = $user;
        }
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
        return $query->rowCount() > 0 ? "User updated successfully" : "Error updating user";
    }

    public function delete_user($id)
    {
        try {
            $cnx = Config::getConnexion();
            $sql = "DELETE FROM user WHERE ID_USER = :id";
            $deleteStmt = $cnx->prepare($sql);
            $deleteStmt->bindParam(':id', $id, PDO::PARAM_INT);
            $deleteStmt->execute();
            return "User deleted successfully";
        } catch (PDOException $e) {
            return "Error deleting user: " . $e->getMessage();
        }
    }
  
}
