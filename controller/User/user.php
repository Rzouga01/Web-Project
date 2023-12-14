<?php
require_once "../../database/connect.php";
require_once '../../model/User/userC.php';

class UserCRUD {
    public function create_user($user) {
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
        return $cnx->lastInsertId();
    }

    public function getAllUsers($page = 1, $records_per_page = 6) {
        $cnx = Config::getConnexion();
        $offset = ($page - 1) * $records_per_page;
    
        $stmt = $cnx->prepare("SELECT COUNT(*) FROM user");
        $stmt->execute();
        $total_records = $stmt->fetchColumn();
        $total_pages = ceil($total_records / $records_per_page);
    
        $stmt = $cnx->prepare("SELECT * FROM user ORDER BY ID_USER LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', $records_per_page, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return ['users' => $users, 'total_pages' => $total_pages];
    }
    public function update_user($user) {
        $cnx = Config::getConnexion();
        $query = $cnx->prepare("UPDATE user SET First_Name = ?, Last_Name = ?, Email = ?, Phone_number = ?, Password = ?, Birthdate = ?, Country = ? WHERE ID_USER = ?");
        $query->execute([
            $user->getFirst_Name(),
            $user->getLast_Name(),
            $user->getEmail(),
            $user->getPhone_number(),
            $user->getPassword(),
            $user->getBirthdate(),
            $user->getCountry(),
            $user->getID_USER()
        ]);
    }

    public function delete_user($id) {
        $cnx = Config::getConnexion();
        $delete = $cnx->prepare("DELETE FROM user WHERE ID_USER = ?");
        $delete->execute([$id]);
    }

    public function getUserByEmail($email) {
        $cnx = Config::getConnexion();
        $select = $cnx->prepare("SELECT * FROM user WHERE Email = ?");
        $select->execute([$email]);
        $user = $select->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
    public function getUserById($id) {
        $cnx = Config::getConnexion();
        $select = $cnx->prepare("SELECT * FROM user WHERE ID_USER = ?");
        $select->execute([$id]);
        $user = $select->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
    public function emailExists($email) {
        $cnx = Config::getConnexion();
        $select = $cnx->prepare("SELECT * FROM user WHERE Email = ?");
        $select->execute([$email]);
        $user = $select->fetch(PDO::FETCH_ASSOC);
        if($user) {
            return true;
        }
        return false;
    }
    public function banUser($id) {
        $cnx = Config::getConnexion();
        $update = $cnx->prepare("UPDATE user SET Banned='1' WHERE ID_USER = ?");
        $update->execute([$id]);
        if($update->rowCount() > 0) {
            return true;
        }
        return false;
    }
    public function unbanUser($id) {
        $cnx = Config::getConnexion();
        $update = $cnx->prepare("UPDATE user SET Banned='0' WHERE ID_USER = ?");
        $update->execute([$id]);
        if($update->rowCount() > 0) {
            return true;
        }
        return false;
    }
    public function verifyUser($id) {
        $cnx = Config::getConnexion();
        $update = $cnx->prepare("UPDATE user SET Status='1' WHERE ID_USER = ?");
        $update->execute([$id]);
        if($update->rowCount() > 0) {
            return true;
        }
        return false;
    }
}
