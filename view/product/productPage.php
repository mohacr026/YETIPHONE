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
                <?php $imagesArray = $product->getImage();?>
                <?php for ($i = 0; $i < 5; $i++): ?>
                    <?php if(isset($imagesArray[$i])): ?>
                        <img src="./src/img/products/<?= $imagesArray[$i] ?>" alt="<?= $product->getName(); ?> image">
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
            <img id="productPageShowingImage" src="./src/img/products/<?= $imagesArray[0] ?>" alt="<?= $product->getName(); ?> big image">
            <div class="zoom" id="zoom"></div>
        </div>
        <div class="productInfo">
            <div>
                <h2> <?= $product->getName(); ?> </h2>
                <!--<div><?= $product->getDescription(); ?></div>-->
                <div class="separator"></div>
                <div>
                    <p>Storage</p>
                    <p><?= $product->getStorage(); ?> GB</p>
                </div>
                <div class="separator"></div>
                <div>
                    <p>Memory</p>
                    <p><?= $product->getMemory(); ?> GB</p>
                </div>
                <div class="separator"></div>
                <h3>Select your color</h3>
                <div class="color">
                    <?php
                        $colors = $product->getColors();
                        $first = true;
                        foreach ($colors as $key => $color) {
                            if ($first){ 
                                echo "<input class='colorSelector' type='radio' name='color' id='$color' value='$color' checked required/>";
                                $first = false;
                            } else echo "<input class='colorSelector' type='radio' name='color' id='$color' value='$color' required/>";
                            echo "<label class='colorSelector' for='$color'><span style='background-color: $color' class='colorSpan'></span></label>";
                        }
                    ?>
                </div>
                <div class="separator"></div>
            </div>
            <div>
                <div>
                    <label for="price" class="price"><?= $product->getPrice(); ?> €</label>
                    <input type="number" value=<?= $product->getPrice(); ?> name="price" class="hidden">
                    <p>Availability:</p>
                    <?php
                        $stock = $product->getStock();
                        if ($stock < 1000) {
                            echo "<p>Low units left, only $stock on stock</p>";
                        } elseif ($stock >= 1000) {
                            echo "<p>On stock</p>";
                        }                        
                    ?>
                    <div class="amount">
                        <button>-</button>
                        <input type="number" name="amount">
                        <button>+</button>
                    </div>
                    <p>no pulseis los botones hacen cosas raras</p>
                    <input type="submit" value="Add to cart" class="addCart">
                </div>
            </div>
        </div>
    </form>
</body>
</html>