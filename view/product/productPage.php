<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YETiPhone</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="shortcut icon" href="./src/img/snowflake.png" type="image/x-icon">
    <script src="./src/js/userMenu.js"></script>
    <script src="./src/js/imageZoom.js"></script>
</head>
<body>
    <?php include("./view/components/header.php"); ?>
    <form class="productPageContainer">
        <div class="productPagePackImages">
            <div class="sideImages">
                <img src="./src/img/products/<?= $product->getImage()[0]; ?>" alt="<?= $product->getName(); ?> image 1">
                <img src="./src/img/products/<?= $product->getImage()[1]; ?>" alt="<?= $product->getName(); ?> image 2">
                <img src="./src/img/products/<?= $product->getImage()[2]; ?>" alt="<?= $product->getName(); ?> image 3">
                <img src="./src/img/products/<?= $product->getImage()[3]; ?>" alt="<?= $product->getName(); ?> image 4">
            </div>
            <img id="productPageShowingImage" src="src/img/products/iphone12.png" alt="<?= $product->getName(); ?> big image">
            <div class="zoom" id="zoom"></div>
        </div>
        <div class="productInfo">
            <h1><?= $product->getName(); ?></h1>
            <div>from <span><?= $categoria->getName(); ?></span></div>
            <label for="price"><?= $product->getPrice(); ?> €</label>
            <input type="number" value=<?= $product->getPrice(); ?> name="price" class="hidden">
            <h2>Pick a color</h2>
            <div>
                <?php
                    //print_r($product->getColor());
                ?>
            </div>
            <h2>Product details</h2>
            <div><?= $product->getDescription(); ?></div>
            <div><span>Storage: </span><?= $product->getDescription(); ?></div>
            <div><span>Memory: </span><?= $product->getDescription(); ?></div>
            <div><span>Screen: </span><?= $product->getDescription(); ?></div>
            <label for="amount">Amount</label>
            <input type="number" name="amount">
            <input type="submit" value="Add to cart">
        </div>
    </form>
</body>
</html>