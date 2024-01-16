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
    <main class="productCategoryContainer">
        <div class="categoryTitle"><?php echo $categoria->getName(); ?></div>
        <div class="productsShopContainer">
            <?php foreach($products as $product): ?>
                <?php include "./view/components/productCardComponent.php"; ?>
            <?php endforeach; ?>
        </div>
    </main>
</body>
</html>