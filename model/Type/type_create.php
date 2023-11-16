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
    require 'type_class.php';
    create_type();
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