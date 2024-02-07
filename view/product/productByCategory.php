<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YETiPhone</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="shortcut icon" href="./src/img/snowflake.png" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="./src/js/userMenu.js"></script>
    <script type="module" src="./src/js/ShoppingCart.js"></script>
</head>

<body class="flex-row">
    <?php
    include("./view/components/header.php");
    ?>
    <aside class="filtersAside">
        <div class="price-range-slider">
            <p class="range-value">
                <input type="text" id="amount" readonly>
            </p>
            <div id="slider-range" class="range-bar"></div>
        </div>
    </aside>

    <main class="productCardGrid">
        <div class="productCategoryContainer">
            <h2 class="categoryTitle">Showing products from
                <?php echo $categoria->getName(); ?>
            </h2>
            <div class="productsShopContainer">
                <?php foreach ($products as $product): ?>
                    <?php include "./view/components/productCardComponent.php"; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
</body>

</html>