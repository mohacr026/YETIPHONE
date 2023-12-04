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
            <a href="index.php">Back</a>
            Filters and more
        </aside>
        <div class="container">
            <h2>List Product</h2>
            <div class="productContainer">
                <?php
                    require_once("./view/components/productComponent.php");
                    foreach ($productsArray as $product) {
                        $component = new ProductComponent($product);
                        $component->render();
                    }
                ?>
            </div>
        </div>
    </main>
</body>
</html>
