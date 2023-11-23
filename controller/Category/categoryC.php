<?php

require "../../database/connect.php";
require  "../../model/Category/category_class.php";

class categoryC
{
    function read()
    {
        $conn = Config::getConnexion();
        $categories = [];

        $r = $conn->query("SELECT * FROM category");

        foreach ($r as $row) {
            $category = [
                'ID_Category' => $row['ID_Category'],
                'Category_name' => $row['Category_name'],
                'Category_description' => $row['Category_description']
            ];
            $categories[] = $category;
        }

        return $categories;
    }


    function delete($ID)
    {
        try {
            $conn = Config::getConnexion();

            $sql = "DELETE FROM category WHERE ID_Category = $ID";

            $conn->exec($sql);

            echo "<script>alert('Category Deleted successfully');</script>";
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    function create($name, $description)
    {
        $conn = Config::getConnexion();

        $testSql = "SELECT * FROM category WHERE UPPER(Category_name) = UPPER(:name) AND UPPER(Category_description) = UPPER(:description)";
        $testStmt = $conn->prepare($testSql);
        $testStmt->bindParam(':name', $name, PDO::PARAM_STR);
        $testStmt->bindParam(':description', $description, PDO::PARAM_STR);
        $testStmt->execute();

        if ($testStmt->rowCount() > 0) {
            return "Type already exists";
        } else {
            $insertSql = "INSERT INTO category (Category_name, Category_description) VALUES (:name, :description)";
            $insertStmt = $conn->prepare($insertSql);
            $insertStmt->bindParam(':name', $name, PDO::PARAM_STR);
            $insertStmt->bindParam(':description', $description, PDO::PARAM_STR);

            if ($insertStmt->execute()) {
                return "Category created successfully";
            } else {
                return "Error creating type";
            }
        }
    }

    function update($id, $newName, $newDescription)
    {
        $conn = Config::getConnexion();

        // Use prepared statements to prevent SQL injection
        $checkSql = "SELECT * FROM category WHERE UPPER(ID_Category)=UPPER(:id)";
        $checkStatement = $conn->prepare($checkSql);
        $checkStatement->bindParam(':id', $id);
        $checkStatement->execute();

        if ($checkStatement->rowCount() == 0) {
            echo "<script>alert('Type Does Not Exist');</script>";
        } else {
            // Use placeholders and bind parameters to prevent SQL injection
            $updateSql = "UPDATE category SET Category_name = :newName, Category_description = :newDescription WHERE ID_Category = :id";
            $updateStatement = $conn->prepare($updateSql);
            $updateStatement->bindParam(':newName', $newName);
            $updateStatement->bindParam(':newDescription', $newDescription);
            $updateStatement->bindParam(':id', $id);

            $updateStatement->execute();

            echo "<script>alert('Category Updated successfully');</script>";
        }
    }
}
