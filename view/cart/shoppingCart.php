<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
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
    <?php
        if(isset($_GET['error'])) echo "<script src='./src/js/errorCartPopup.js'></script>";
    ?>
    <main class="cart">
        <div id="cartElements"></div>
    </main>
    <aside class="cart">
    <div class="cart2">
        <p>Resume</p>
        <ul id="resume">

        </ul>
        <div class="separator"></div>
        <p id="total"></p>
        <button id="buy">Go to payment</button>
        <div class="payment-methods">
            <img src="src/img/visa.png" alt="Método de pago visa">
            <img src="src/img/paypal.png" alt="Método de pago paypal">
        </div>
    </div>
</aside>

</body>
</html>