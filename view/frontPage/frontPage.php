<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YETiPhone</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php
    include("./view/components/header.php");
    ?>
    <h2>Improvised link list</h2>
    <ul>
        <li><a href="index.php?controller=Product&action=showAddProducts">Add Products</a></li>
        <li><a href="index.php?controller=Product&action=showProductList">Edit de Productos</a></li>
        <li><a href="index.php?controller=Category&action=showAddCategories">Add Category</a></li>
        <li><a href="index.php?controller=Category&action=showEditCategories">Edit Category</a></li>
    </ul>
    
</body>
</html>