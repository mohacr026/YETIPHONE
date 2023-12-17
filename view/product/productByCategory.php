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
        <div><?php $category->getName() ?></div>
        <div class="productsShopContainer">
            <?php foreach($products as $product)
                include "./view/components/productTargetComponent.php"; 
            endforeach; ?>
        </div>
    </main>
</body>
</html>
