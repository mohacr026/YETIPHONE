<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YETiPhone</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="shortcut icon" href="./src/img/snowflake.png" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./src/js/userMenu.js"></script>
    <script src="./src/js/imageZoom.js"></script>
    <script src="./src/js/imageChanger.js"></script>
    <script src="./src/js/productAmountHandler.js"></script>
    <script type="module" src="./src/js/searchBar.js"></script>
    <script type="module" src="./src/js/ShoppingCart.js"></script>
</head>
<body>
    <?php include("./view/components/header.php"); ?>
    <div class="productPageContainer">
        <div class="productPagePackImages">
            <div class="sideImages">
                <?php $imagesArray = $product->getImage();?>
                <?php for ($i = 0; $i < 5; $i++): ?>
                    <?php if(isset($imagesArray[$i])): ?>
                        <img class="sideImage" src="./src/img/products/<?= $imagesArray[$i] ?>" alt="<?= $product->getName(); ?> image">
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
                    <p class="infoLabel">Description</p>
                    <p><?= $product->getDescription(); ?></p>
                </div>
                <div class="separator"></div>
                <div>
                    <p class="infoLabel">Storage</p>
                    <p><?= $product->getStorage(); ?> GB</p>
                </div>
                <div class="separator"></div>
                <div>
                    <p class="infoLabel">Memory</p>
                    <p><?= $product->getMemory(); ?> GB</p>
                </div>
                <div class="separator"></div>
                <p class="infoLabel">Select your color</p>
                <div class="color">
                    <?php
                        $colors = $product->getColors();
                        $first = true;
                        foreach ($colors as $key => $color) {
                            $color = trim($color);
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
                    <p class="price"><?= $product->getPrice(); ?> €</p>
                    <div class="separator"></div>
                    <p>Availability:</p>
                    <?php
                        $stock = $product->getStock();
                        if ($stock < 100) {
                            echo "<p>Low units left, only $stock on stock</p>";
                        } elseif ($stock >= 100) {
                            echo "<p>On stock</p>";
                        }                        
                    ?>
                    <div class="amount">
                        <button id="decreaseAmount">
                            <img src="./src/img/decBtn.png" alt="decrease quantity">
                        </button>

                        <label for="amount" aria-label="Write an amount of stock to buy" class="hidden">Increase amount of stock</label>
                        <input type="number" name="amount" id="amount" value="1" max="<?= $stock ?>">

                        <button id="increaseAmount">
                            <img src="./src/img/addBtn.png" alt="increase quantity">
                        </button>
                    </div>
                    <button class="addCart" data-product="<?= $product->getId(); ?>" data-price="<?= $product->getPrice(); ?>" data-name="<?= $product->getName(); ?>" data-image="<?= $product->getImage()[0]; ?>">Add to cart</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>