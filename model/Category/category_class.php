<?php

class Category
{
    private $name;
    private $description;

    public function __construct($name, $description)
    {
        $this->name = $name;
        $this->description = $description;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }
}



function update()
{
    require '../Connection/connection.php';

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $name = $_POST['name-update'];
        $newName = $_POST['name'];
        $newDescription = $_POST['description'];

        // Use prepared statement to check if the category exists
        $checkSql = "SELECT * FROM category WHERE UPPER(Category_name) = UPPER(?)";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->execute([$name]);

        if ($checkStmt->rowCount() == 0) {
            echo "Category doesn't exist";
        } else {
            // Use prepared statement to update the category
            $updateSql = "UPDATE category SET Category_name = ?, Category_description = ? WHERE UPPER(Category_name) = UPPER(?)";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->execute([$newName, $newDescription, $name]);

            echo "Category updated successfully";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function read()
{
    try {
        require "../Connection/connection.php";

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $s = "SELECT * FROM category";
        $r = $conn->query($s);

        echo "<table>";
        echo "<tr>";
        echo "<th> Category id </th>";
        echo "<th> Category name </th>";
        echo "<th> Category description </th>";
        echo "</tr>";

        foreach ($r as $i) {
            echo "<tr>";
            echo "<td>" . $i['ID_Category'] . "</td>";
            echo "<td>" . $i['Category_name'] . "</td>"; // Corrected column name
            echo "<td>" . $i['Category_description'] . "</td>"; // Corrected column name
            echo "</tr>";
        }

        echo "</table>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function delete()
{
    try {
        require "../Connection/connection.php";

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $name = $_POST['name'];

        // Use prepared statement to delete a category
        $deleteSql = "DELETE FROM category WHERE UPPER(Category_name) = UPPER(?)";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->execute([$name]);

        echo "Category deleted successfully";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function create()
{
    try {
        require "../Connection/connection.php";

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $name = $_POST['name'];
        $description = $_POST['description'];

        // Use prepared statement to check if the category already exists
        $checkSql = "SELECT * FROM category WHERE UPPER(Category_name) = UPPER(?) AND UPPER(Category_description) = UPPER(?)";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->execute([$name, $description]);

        if ($checkStmt->rowCount() > 0) {
            echo "Category already exists";
        } else {
            // Use prepared statement to insert a new category
            $insertSql = "INSERT INTO category (Category_name, Category_description) VALUES (?, ?)";
            $insertStmt = $conn->prepare($insertSql);
            $insertStmt->execute([$name, $description]);

            echo "Category created successfully";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
