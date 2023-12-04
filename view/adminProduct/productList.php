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
    <main>
        <aside>
        <a href="index.php">atras</a>
            filtros y tal nose
        </aside>

<ul>
<h2>List Product</h2>

    <?php foreach ($products as $product): ?>
        <br>
            <?php echo $product->getName(); ?>
            <a href="index.php?controller=Product&action=showEditProduct&id=<?php echo $product->getId(); ?>">Edit</a>
            <a href="index.php?controller=Product&action=showActDesc&id=<?php echo $product->getId(); ?>">Active/desactive</a>

        </br>
    <?php endforeach; ?>
</ul>

</body>
</html>