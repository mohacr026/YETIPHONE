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
    <?php include("./view/components/header.php"); ?>
    <main class="productPageContainer">
        <div>
            <div>
                <img src="./src/img/<?= $product->getImage(); ?>" alt="<?= $product->getName(); ?> image 1">
                <img src="./src/img/<?= $product->getImage(); ?>" alt="<?= $product->getName(); ?> image 2">
                <img src="./src/img/<?= $product->getImage(); ?>" alt="<?= $product->getName(); ?> image 3">
                <img src="./src/img/<?= $product->getImage(); ?>" alt="<?= $product->getName(); ?> image 4">
            </div>
            <img src="./src/img/<?= $product->getImage(); ?>" alt="">
        </div>
        <div>
            <div><?= $product->getName(); ?></div>
            <div><?= $categoria->getName(); ?></div>
            <div><?= $product->getPrice(); ?></div>
            <div><?= $product->getDescription(); ?></div>
        </div>
    </main>
</body>
</html>