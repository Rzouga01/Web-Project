<?php


require_once '../../database/connect.php';
require_once '../../model/Type/type_class.php';


class TypeC
{

    function create_type($name, $description)
    {
        $conn = Config::getConnexion();

        $testSql = "SELECT * FROM type WHERE UPPER(Type_name) = UPPER(:name) AND UPPER(Type_description) = UPPER(:description)";
        $testStmt = $conn->prepare($testSql);
        $testStmt->bindParam(':name', $name, PDO::PARAM_STR);
        $testStmt->bindParam(':description', $description, PDO::PARAM_STR);
        $testStmt->execute();

        if ($testStmt->rowCount() > 0) {
            return "Type already exists";
        } else {
            $insertSql = "INSERT INTO type (Type_name, Type_description) VALUES (:name, :description)";
            $insertStmt = $conn->prepare($insertSql);
            $insertStmt->bindParam(':name', $name, PDO::PARAM_STR);
            $insertStmt->bindParam(':description', $description, PDO::PARAM_STR);

            if ($insertStmt->execute()) {
                return "Type created successfully";
            } else {
                return "Error creating type";
            }
        }
    }

    function read_type()
    {
        $conn = Config::getConnexion();
        $types = [];

        $r = $conn->query("SELECT * FROM type");

        foreach ($r as $row) {
            $type = [
                'ID_Type' => $row['ID_Type'],
                'Type_name' => $row['Type_name'],
                'Type_description' => $row['Type_description']
            ];
            $types[] = $type;
        }

        return $types;
    }



    function update_type($id, $newName, $newDescription)
    {
        $conn = Config::getConnexion();

        $checkSql = "SELECT * FROM type WHERE UPPER(ID_Type)=UPPER(:id)";
        $checkStatement = $conn->prepare($checkSql);
        $checkStatement->bindParam(':id', $id);
        $checkStatement->execute();

        if ($checkStatement->rowCount() == 0) {
            echo "<script>alert('Type Does Not Exist');</script>";
        } else {

            $updateSql = "UPDATE type SET Type_name = :newName, Type_description = :newDescription WHERE ID_Type = :id";
            $updateStatement = $conn->prepare($updateSql);
            $updateStatement->bindParam(':newName', $newName);
            $updateStatement->bindParam(':newDescription', $newDescription);
            $updateStatement->bindParam(':id', $id);

            $updateStatement->execute();

            echo "<script>alert('Type Updated successfully');</script>";
        }
    }


    function delete_type($ID)
    {
        try {
            $conn = Config::getConnexion();

            $sql = "DELETE FROM type WHERE ID_Type = $ID";

            $conn->exec($sql);

            echo "<script>alert('Type Deleted successfully');</script>";
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
}
