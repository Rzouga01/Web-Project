
<?php

class Type
{
    private $name;
    private $description;


    function __construct($name, $description)
    {
        $this->name = $name;
        $this->description = $description;
    }
    function getName()
    {
        return $this->name;
    }
    function getDescription()
    {
        return $this->description;
    }
    function setName($name)
    {
        $this->name = $name;
    }
    function setDescription($description)
    {
        $this->description = $description;
    }
}

function create_type()
{
    require '../Connection/connection.php';


    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        $type = new Type($_POST['type-name'], $_POST['type-description']);

        $name = htmlspecialchars($type->getName());
        $description = htmlspecialchars($type->getDescription());

        $testSql = "SELECT * FROM type WHERE UPPER(Type_name) = UPPER(:name) AND UPPER(Type_description) = UPPER(:description)";
        $testStmt = $conn->prepare($testSql);
        $testStmt->bindParam(':name', $name, PDO::PARAM_STR);
        $testStmt->bindParam(':description', $description, PDO::PARAM_STR);
        $testStmt->execute();

        if ($testStmt->rowCount() > 0) {
            echo "Type already exists";
        } else {
            $insertSql = "INSERT INTO type (Type_name, Type_description) VALUES (?, ?)";
            $insertStmt = $conn->prepare($insertSql);
            $insertStmt->execute([$name, $description]);
            echo "<script>alert('Type created successfully');</script>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function delete_type()
{
    require '../Connection/connection.php';
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        $name = $_POST['type-name'];

        $sql = "DELETE FROM type WHERE UPPER(Type_name) = UPPER('$name')";

        $conn->exec($sql);

        echo "<script>alert('Type Deleted successfully');</script>";
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
}

function read_type()
{
    require '../Connection/connection.php';


    try {

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        $r = $conn->query("SELECT * FROM type");
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Name</th>";
        echo "<th>Description</th>";
        echo "</tr>";
        foreach ($r as $row) {
            echo "<tr>";
            echo "<td>" . $row['ID_Type'] . "</td>";
            echo "<td>" . $row['Type_name'] . "</td>";
            echo "<td>" . $row['Type_description'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

function update_type()
{
    require '../Connection/connection.php';


    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        $name = $_POST['type-name'];
        $newName = $_POST['type-name-update'];
        $newDescription = $_POST['type-description-update'];

        $checkSql = "SELECT * FROM type WHERE UPPER(Type_name)=UPPER('$name')";
        $checkResult = $conn->query($checkSql);

        if ($checkResult->rowCount() == 0) {
            echo "Type does not exist";
        } else {
            $updateSql = "UPDATE type SET Type_name = '$newName', Type_description = '$newDescription' WHERE UPPER(Type_name) = UPPER('$name')";
            $conn->exec($updateSql);

            echo "<script>alert('Type Updated successfully');</script>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
