<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Read</title>
    <link rel="stylesheet" href="../../view/Type/type.css">
    <link rel="stylesheet" href="../style.css">
</head>



<?php

require '../Connection/connection.php';
require '../Type/type_class.php';


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
