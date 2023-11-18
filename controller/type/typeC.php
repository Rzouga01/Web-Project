<?php


require '../../database/connect.php';
require '../../model/Type/type_class.php';


class Type_description
{

    function create_type($type)
    {
        $conn = Config::getConnexion();

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
    }

    function read_type()
    {

        $conn = Config::getConnexion();

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
    }




    function update_type($name, $newName, $newDescription)
    {

        $conn = Config::getConnexion();


        $checkSql = "SELECT * FROM type WHERE UPPER(Type_name)=UPPER('$name')";
        $checkResult = $conn->query($checkSql);

        if ($checkResult->rowCount() == 0) {
            echo "<script>alert('Type Does Not Exist');</script>";
        } else {
            $updateSql = "UPDATE type SET Type_name = '$newName', Type_description = '$newDescription' WHERE UPPER(Type_name) = UPPER('$name')";
            $conn->exec($updateSql);

            echo "<script>alert('Type Updated successfully');</script>";
        }
    }


    function delete_type($name)
    {
        try {
            $conn = Config::getConnexion();

            $sql = "DELETE FROM type WHERE UPPER(Type_name) = UPPER('$name')";

            $conn->exec($sql);

            echo "<script>alert('Type Deleted successfully');</script>";
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
}
