<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
    <link rel="stylesheet" href="../../view/Type/type.css">
</head>


<body>
    <?php

    require '../Connection/connection.php';
    require 'type_class.php';

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $name = $_POST['type-name'];

    $sql = "DELETE FROM type WHERE UPPER(Type_name) = UPPER('$name')";

    $conn->exec($sql);

    echo "<script>alert('Type Deleted successfully');</script>";
    ?>

    <header>
        <h1>Crud Example</h1>
        <h1>Project Type</h1>
    </header>
    <section>
        <a href="../../view/Type/type_create.html">Create a New Type</a><br>
        <a href="type_read.php">Read Types</a><br>
        <a href="../../view/Type/type_update.html">Update a Type</a><br>
        <a href="../../view/Type/type_delete.html">Delete a Type</a><br>
    </section>




</body>

</html>