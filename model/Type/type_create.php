<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Type</title>
    <link rel="stylesheet" href="../../view/Type/type.css">
</head>

<body>
    <?php
    require '../Connection/connection.php';
    require 'type_class.php';

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