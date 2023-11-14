<?php


require '../Connection/connection.php';
require '../Type/type_class.php';


try {

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $type = new Type($_POST['type-name'], $_POST['type-description']);

    $sql = "INSERT INTO type (Type_name, Type_description	) VALUES (?, ?)";
    $statement = $conn->prepare($sql);



    $name = htmlspecialchars($type->getName());
    $description = htmlspecialchars($type->getDescription());



    $test = "SELECT * FROM type WHERE UPPER(Type_name)=UPPER('$name') and UPPER(Type_description)=UPPER('$description')";

    if ($conn->query($test)->rowCount() > 0) {
        echo "Type already exists";
        return;
    } else {
        $statement->execute([$name, $description]);
    }

    echo "New Type created successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
