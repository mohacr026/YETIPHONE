<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment resume</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/payment.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./src/js/userMenu.js"></script>
    <script type="module" src="./src/js/searchBar.js"></script>
    <script type="module" src="./src/js/ShoppingCart.js"></script>
    <script type="module" src="./src/js/purchaseSubmitter.js"></script>
</head>
<body class="flex-row">
    <?php include("./view/components/header.php"); ?>
    <main class="payment">
        <form action="index.php?controller=ShoppingCart&action=purchase" method="post" id="shippingDirection">
            <div class="formRow">
                <label for="direction">DIRECTION</label>
                <input type="text" name="direction" id="direction" required>
            </div>
            <div class="formRow">
                <label for="province">PROVINCE</label>
                <input list="provinces" id="province" name="province" required>
            </div>
            <div class="formRow">
                <label for="city">CITY</label>
                <input type="text" name="city" id="city" required>
            </div>
            <div class="formRow">
                <label for="zipCode">Zip code</label>
                <input type="number" name="zipCode" id="zipCode" required>
            </div>
            <div class="formRow">
                <label for="specifications">Additional specifications</label>
                <input type="text" name="specifications" id="specifications">
            </div>
            <input type="hidden" name="user" id="user" value="">
            <input type="hidden" name="cart" id="cart" value="">
            <datalist id="provinces">
                <option value="Álava">
                <option value="Albacete">
                <option value="Alicante">
                <option value="Almería">
                <option value="Asturias">
                <option value="Ávila">
                <option value="Badajoz">
                <option value="Barcelona">
                <option value="Burgos">
                <option value="Cáceres">
                <option value="Cádiz">
                <option value="Cantabria">
                <option value="Castellón">
                <option value="Ciudad Real">
                <option value="Córdoba">
                <option value="Cuenca">
                <option value="Gerona">
                <option value="Granada">
                <option value="Guadalajara">
                <option value="Guipúzcoa">
                <option value="Huelva">
                <option value="Huesca">
                <option value="Islas Baleares">
                <option value="Jaén">
                <option value="La Coruña">
                <option value="La Rioja">
                <option value="Las Palmas">
                <option value="León">
                <option value="Lérida">
                <option value="Lugo">
                <option value="Madrid">
                <option value="Málaga">
                <option value="Murcia">
                <option value="Navarra">
                <option value="Orense">
                <option value="Palencia">
                <option value="Pontevedra">
                <option value="Salamanca">
                <option value="Segovia">
                <option value="Sevilla">
                <option value="Soria">
                <option value="Tarragona">
                <option value="Santa Cruz de Tenerife">
                <option value="Teruel">
                <option value="Toledo">
                <option value="Valencia">
                <option value="Valladolid">
                <option value="Vizcaya">
                <option value="Zamora">
                <option value="Zaragoza">
            </datalist>
        </form>
        <div class="resume">
            <h3>Order details</h3>
            <div id="details">
                fherfhuierhfuier
            </div>
            <p id="totalPrice">TOTAL PRICE: 123123</p>
            <button id="purchase" form="shippingDirection" action="submit">Purchase</button>
            <button id="back">Go back</button>
        </div>
    </main>
</body>
</html>