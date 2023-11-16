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

        $name = $_POST['name-update'];
        $newName = $_POST['name'];
        $newDescription = $_POST['description'];

        $checkSql = "SELECT * FROM category WHERE UPPER(Category_name)=UPPER('$name')";
        $checkResult = $conn->query($checkSql);

        if ($checkResult->rowCount() == 0) {
            echo "category doesnt exist";
        } else {
            $updateSql = "UPDATE type SET Category_name = '$newName', Category_description = '$newDescription' WHERE UPPER(Category_name) = UPPER('$name')";
            $conn->exec($updateSql);

            echo "Category updated";
        }
    } catch (PDOException $e) {
        echo "error " . $e->getMessage();
    }
}

function read()
{
    try {
        require "../Connection/connection.php";
        require "category_class.php";





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
            echo "<td>" . $i['category_name'] . "</td>";
            echo "<td>" . $i['Category_description'] . "</td>";
            echo "</tr>";
        };
        echo "</table>";
    } catch (PDOException $e) {
        echo "" . $e->getMessage();
    }
}

function delete()
{

    try {
        require "../Connection/connection.php";
        require "category_class.php";

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        $name = $_POST['name'];
        $t =  "DELETE FROM category WHERE UPPER(Category_name)=UPPER($name)";
        $conn->exec($t);
    } catch (PDOException $e) {
        echo "" . $e->getMessage();
    }
}


function create()
{
    try {
        require "../Connection/connection.php";
        require "category_class.php";

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        $name = $_POST['name'];
        $desc = $_POST['description'];
        $l = "SELECT * FROM category WHERE UPPER(Category_name)=UPPER($name) AND UPPER(Category_description)=UPPER($description)";
        $r = $conn->query($l);
        if ($r->rowCount() > 0) {
            echo "already used";
        } else {
            $l = "INSERT INTO category (Category_name,Category_description) VALUES (?,?)";
            $r = $conn->prepare($l);
            $r->execute([$name, $description]);
        }
    } catch (PDOException $e) {
        echo "" . $e->getMessage();
    }
}
