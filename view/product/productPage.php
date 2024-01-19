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
                <?php $imagesArray = $product->getImage(); $i=0;?>
                <?php for ($i = 0; $i < 5; $i++): ?>
                    <?php if(isset($imagesArray[$i])): ?>
                        <img src="./src/img/products/<?= $imagesArray[$i] ?>" alt="<?= $product->getName(); ?> image">
                    <?php endif; ?>
                <?php endfor; ?>
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
            <div class="color">
                <?php
                    $colors = $product->getColors();
                    $first = true;
                    foreach ($colors as $key => $color) {
                        if ($first){ 
                            echo "<input class='colorSelector' type='radio' name='color' id='$color' value='$color' checked/>";
                            $first = false;
                        } else echo "<input class='colorSelector' type='radio' name='color' id='$color' value='$color'/>";
                        echo "<label class='colorSelector' for='$color'><span style='background-color: $color' class='colorSpan'></span></label>";
                    }
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