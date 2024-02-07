<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/cart.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./src/js/userMenu.js"></script>
    <script type="module" src="./src/js/searchBar.js"></script>
    <script type="module" src="./src/js/ShoppingCart.js"></script>
    <script type="module" src="./src/js/shoppingCartViewer.js"></script>
</head>
<body class="flex-row cart">
    <?php include("./view/components/header.php"); ?>
    <main class="cart">
        <div id="cartElements"></div>
    </main>
    <aside class="cart">
        <div>
            <p>Resumen</p>
            <div class="separator"></div>
            <p id="total"></p>
            <button id="buy">Go to payment</button>
        </div>
    </aside>
</body>
</html>