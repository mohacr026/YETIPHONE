<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YETiPhone</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="shortcut icon" href="./src/img/snowflake.png" type="image/x-icon">
    <script src="./src/js/userMenu.js"></script>
</head>
<body>
    <?php
    include("./view/components/header.php");
    ?>
    <main>
    <aside>
    <h2>Improvised link list</h2>
    <br>
        <a href="index.php?controller=Product&action=showAddProducts">Add Products</a>
        <a href="index.php?controller=Product&action=showEditProducts">Edit de Productos</a>
        <a href="index.php?controller=Category&action=showAddCategories">Add Category</a>
        <a href="index.php?controller=Category&action=showEditCategories">Edit Category</a>
        <a href="index.php?controller=Product&action=showInterfaz">Pantalla Usuarios</a>

        </aside>
    </br>
        </main>

</body>
</html>