<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
</head>


<body>
    <?php
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $name = $_POST['type-name'];

    $sql = "DELETE FROM type WHERE UPPER(Type_name) = UPPER('$name')";

    $conn->exec($sql);

    echo "Delete successfully";





    ?>
</body>

</html>