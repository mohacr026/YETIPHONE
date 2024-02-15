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
        <!-- Clases temporales, cambiar las clases para aplicar nuevo CSS --> 
        <div class="userPurchaseContainer">
            <table class="purchaseTable">
                <tr>
                    <th>Product image</th>
                    <th>Product name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total price</th>
                </tr>
            <?php 
            $totalPrice = 0;
            foreach($purchaseData as $purchase): ?>
                <tr>
                    <td><img src="./src/img/products/<?php echo $purchase['image']?>" alt="<?php $purchase['name'] ?>'s product image" width="80px"></td>
                    <td><?= $purchase['name'] ?></td>
                    <td><?= $purchase['quantity'] ?></td>
                    <td><?= $purchase['price'] ?>€</td>
                    <td><?= $purchase['price'] * $purchase['quantity'] ?>€</td>
                </tr>
                <?php $totalPrice += $purchase['price'] * $purchase['quantity']; ?>
            <?php endforeach; ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Total price:</td>
                    <td><?php echo $totalPrice; ?>€</td>
                </tr>
            </table>
        </div>
    </body>
</html>