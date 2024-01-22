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
<body class="flex-row">
    <?php
        include("./view/components/header.php");
    ?>
    <aside class="filtersAside">
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ullamcorper congue laoreet. Pellentesque sit amet ligula et neque ultricies varius. Vivamus venenatis diam sed ultricies aliquam. Suspendisse sit amet magna neque. Ut ornare mollis ornare. Suspendisse sit amet purus nec ipsum elementum eleifend vitae nec ligula. Nullam in sodales arcu. Curabitur ac erat viverra, cursus neque vel, sollicitudin justo. Aliquam facilisis id turpis vel lacinia. Aliquam ullamcorper lobortis libero eu feugiat.

Donec posuere quam semper neque congue sollicitudin. Vivamus maximus nibh vitae quam aliquam, placerat iaculis magna sollicitudin. Duis mattis vestibulum purus, non dignissim sapien cursus ut. Suspendisse consectetur, lorem sit amet tristique sodales, nunc risus placerat lectus, vitae lacinia sem ligula at lacus. Mauris accumsan condimentum risus ut ornare. Praesent egestas mi ac tellus sodales, id semper velit pharetra. In a ligula ipsum. Proin tincidunt commodo quam, eu laoreet arcu faucibus ut. Duis sit amet mauris et elit lacinia auctor faucibus ac sem. Morbi varius pulvinar magna. Vivamus tortor massa, pretium quis mauris laoreet, malesuada consectetur mauris. Pellentesque molestie, tortor in ullamcorper hendrerit, felis lacus commodo neque, non suscipit diam sem et neque. Nulla finibus nulla nibh, et sagittis nibh ultrices ullamcorper.
    </aside>
    <main class="productCategoryContainer">
        <h2 class="categoryTitle">Showing products from <?php echo $categoria->getName(); ?></h2>
        <div class="productsShopContainer">
            <?php foreach($products as $product): ?>
                <?php include "./view/components/productCardComponent.php"; ?>
            <?php endforeach; ?>
        </div>
    </main>
</body>
</html>